<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Menu;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout dengan daftar keranjang dan total harga.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as &$item) {
            $menu = Menu::find($item['id']); // Menggunakan Eloquent Model
            if ($menu) {
                $item['price'] = $menu->price; // Perbarui harga dasar dari database

                // Hitung ulang harga berdasarkan ukuran (size)
                $sizePriceAdjustment = match ($item['size'] ?? 'Regular') {
                    'Small' => 0,
                    'Regular' => 4000,
                    'Large' => 7000,
                    default => 0,
                };

                $item['modified_price'] = $item['price'] + $sizePriceAdjustment;
                $total += $item['modified_price'] * $item['quantity'];
            }
        }

        session()->put('cart', $cart);

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Memproses data checkout dan menyimpan ke database.
     */
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|max:50',
            'phone_number' => 'nullable|required_if:payment_method,Ovo,Gopay|numeric',
        ]);

        $totalPrice = 0;

        foreach ($cart as &$item) {
            $menu = Menu::find($item['id']);
            if ($menu) {
                $item['price'] = $menu->price;

                // Hitung harga berdasarkan modifikasi
                $sizePriceAdjustment = match ($item['size'] ?? 'Regular') {
                    'Small' => 0,
                    'Regular' => 4000,
                    'Large' => 7000,
                    default => 0,
                };

                $item['modified_price'] = $item['price'] + $sizePriceAdjustment;
                $totalPrice += $item['modified_price'] * $item['quantity'];
            }
        }

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'user_id' => auth()->id() ?? null,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $cartItems = [];
            foreach ($cart as $item) {
                $cartItems[] = [
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['id'],
                    'size' => $item['size'] ?? 'Regular',
                    'ice' => $item['ice'] ?? 'Normal Ice',
                    'sugar' => $item['sugar'] ?? 'Normal Sweet',
                    'quantity' => $item['quantity'],
                    'price' => $item['modified_price'],
                    'subtotal' => $item['modified_price'] * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            CartItem::insert($cartItems);

            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_method' => $validated['payment_method'],
                'status' => 'completed',
            ]);

            // Simpan data untuk halaman "Thank You"
            session()->put('purchased_items', $cart);
            session()->put('total_price', $totalPrice);
            session()->put('payment_method', $validated['payment_method']);

            session()->forget('cart');

            DB::commit();

            return redirect()->route('thank_you.index')->with('success', 'Thank you for your purchase!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Checkout Error: ' . $e->getMessage(), [
                'cart' => $cart,
                'validated' => $validated,
                'total_price' => $totalPrice,
            ]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

}
