<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Models\CartItem;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            // Ambil cart dari session
            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Your cart is empty. Please add items before checkout.');
            }

            $total_price = 0;
            $purchased_items = []; // Untuk menyimpan data pembelian

            // Hitung total harga dan siapkan data menu yang dibeli
            foreach ($cart as $item) {
                $modified_price = $item['modified_price'] ?? $item['price'] ?? 0;
                $quantity = $item['quantity'] ?? 1;

                $total_price += $modified_price * $quantity;

                $purchased_items[] = [
                    'name' => $item['name'] ?? 'Unknown Item',
                    'image' => $item['image'] ?? 'default.jpg',
                    'quantity' => $quantity,
                    'price' => $modified_price,
                ];
            }

            // Validasi metode pembayaran
            $payment_method = $request->input('payment_method');
            if (!$payment_method) {
                return redirect()->back()->with('error', 'Please select a payment method.');
            }

            // Mulai transaksi database
            DB::beginTransaction();

            // Simpan transaksi ke database
            $transaction = Transaction::create([
                'user_id' => auth()->id() ?? null,
                'total_price' => $total_price,
                'status' => 'pending',
            ]);

            // Simpan item yang dibeli ke tabel `cart_items`
            $cartItems = [];
            foreach ($cart as $item) {
                $cartItems[] = [
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['id'],
                    'size' => $item['size'] ?? 'Regular',
                    'ice' => $item['ice'] ?? 'Normal Ice',
                    'sugar' => $item['sugar'] ?? 'Normal Sweet',
                    'quantity' => $item['quantity'],
                    'price' => $item['modified_price'] ?? $item['price'],
                    'subtotal' => ($item['modified_price'] ?? $item['price']) * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if (!empty($cartItems)) {
                CartItem::insert($cartItems);
            }

            // Simpan informasi pembayaran
            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_method' => $payment_method,
                'status' => 'completed',
            ]);

            // Simpan data ke sesi untuk halaman Thank You
            session()->put('purchased_items', $purchased_items);
            session()->put('total_price', $total_price);
            session()->put('payment_method', $payment_method);

            // Kosongkan keranjang setelah checkout
            session()->forget('cart');

            // Commit transaksi database
            DB::commit();

            // Redirect ke halaman Thank You
            return redirect()->route('thank_you.index')->with('success', 'Payment processed successfully!');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Payment Error: ' . $e->getMessage(), [
                'cart' => session()->get('cart', []),
                'payment_method' => $request->input('payment_method'),
            ]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
