<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = ['All', 'Frappe', 'Coffee', 'Non Coffee'];
        $category = $request->get('category', 'All');
        $products = ($category === 'All') ? Menu::all() : Menu::where('category', $category)->get();
        $cart = session('cart', []);

        // Hitung ulang total harga keranjang
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('menu.index', compact('products', 'cart', 'category', 'categories', 'total'));
    }

    public function show($id)
    {
        $product = Menu::findOrFail($id);

        $sizes = [
            ['name' => 'Small', 'price' => 0],
            ['name' => 'Regular', 'price' => 4000],
            ['name' => 'Large', 'price' => 7000],
        ];

        $iceOptions = ["No Ice", "Less Ice", "Normal Ice", "Extra Ice"];
        $sugarFlavors = ["No Sugar", "Less Sweet", "Normal Sweet", "Extra Sweet"];

        return view('menu.detail', compact('product', 'sizes', 'iceOptions', 'sugarFlavors'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string|in:Small,Regular,Large',
            'ice' => 'required|string|in:No Ice,Less Ice,Normal Ice,Extra Ice',
            'sugar' => 'required|string|in:No Sugar,Less Sweet,Normal Sweet,Extra Sweet',
        ]);

        $cart = session('cart', []);
        $product = Menu::findOrFail($validated['id']);

        // Penyesuaian harga berdasarkan ukuran
        $sizePriceAdjustment = match ($validated['size']) {
            'Small' => 0,
            'Regular' => 4000,
            'Large' => 7000,
            default => 0,
        };

        $finalPrice = $product->price + $sizePriceAdjustment;

        // Cek apakah produk sudah ada di keranjang dengan kombinasi yang sama
        foreach ($cart as &$item) {
            if (
                $item['id'] == $product->id &&
                $item['size'] == $validated['size'] &&
                $item['ice'] == $validated['ice'] &&
                $item['sugar'] == $validated['sugar']
            ) {
                $item['quantity'] += $validated['quantity'];
                session(['cart' => $cart]);
                return redirect()->route('menu.index')->with('success', 'Product quantity updated in cart!');
            }
        }

        // Tambahkan produk baru ke keranjang
        $cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $finalPrice,
            'quantity' => $validated['quantity'],
            'size' => $validated['size'],
            'ice' => $validated['ice'],
            'sugar' => $validated['sugar'],
            'image' => $product->image,
        ];

        session(['cart' => $cart]);

        return redirect()->route('menu.index')->with('success', 'Product added to cart!');
    }

    public function updateCartItem(Request $request, $id)
    {
        $validated = $request->validate([
            'size' => 'required|string|in:Small,Regular,Large',
            'ice' => 'required|string|in:No Ice,Less Ice,Normal Ice,Extra Ice',
            'sugar' => 'required|string|in:No Sugar,Less Sweet,Normal Sweet,Extra Sweet',
        ]);

        $cart = session('cart', []);
        $product = Menu::findOrFail($id);

        // Penyesuaian harga berdasarkan ukuran
        $sizePriceAdjustment = match ($validated['size']) {
            'Small' => 0,
            'Regular' => 4000,
            'Large' => 7000,
            default => 0,
        };

        $finalPrice = $product->price + $sizePriceAdjustment;

        foreach ($cart as &$item) {
            if ($item['id'] == $product->id) {
                $item['size'] = $validated['size'];
                $item['ice'] = $validated['ice'];
                $item['sugar'] = $validated['sugar'];
                $item['price'] = $finalPrice;
                session(['cart' => $cart]);

                return redirect()->route('menu.index')->with('success', 'Cart item updated successfully!');
            }
        }

        return redirect()->route('menu.index')->with('error', 'Product not found in cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        $cart = array_filter($cart, fn($item) => $item['id'] != $id);
        session(['cart' => array_values($cart)]);

        return redirect()->route('menu.index')->with('success', 'Product removed from cart!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $validated = $request->validate(['action' => 'required|in:increase,decrease']);
        $cart = session('cart', []);

        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                if ($validated['action'] === 'increase') {
                    $item['quantity'] += 1;
                } elseif ($validated['action'] === 'decrease') {
                    $item['quantity'] -= 1;

                    if ($item['quantity'] <= 0) {
                        return $this->removeFromCart($id);
                    }
                }

                session(['cart' => $cart]);
                return redirect()->route('menu.index')->with('success', 'Cart updated successfully!');
            }
        }

        return redirect()->route('menu.index')->with('error', 'Product not found in cart!');
    }
}
