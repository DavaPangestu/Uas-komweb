



<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu Pickup</title>
        <style>
            /* Styling yang sama seperti sebelumnya */
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f9;
                color: #333;
            }

            /* Header Styling */
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 30px;
                background: 
                color: #fff;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
                font-weight: bold;
            }

            .navbar {
                display: flex;
                justify-content: center;
                background: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 10px 0;
                margin-bottom: 20px;
            }

            .navbar a {
                margin: 0 10px;
                text-decoration: none;
                color: #121010;
                font-size: 16px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: 50px;
                transition: all 0.3s ease-in-out;
            }

            .navbar a:hover, .navbar a.active {
                background: #121010;
                color: #fff;
                box-shadow: 0 4px 10px rgba(255, 115, 0, 0.5);
            }

            .menu {
                padding: 20px 30px;
            }

            .menu-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 20px;
                padding: 15px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }


            .menu-item img {
                width: 80px;
                height: 80px;
                border-radius: 10px;
                margin-right: 20px;
                object-fit: cover;
            }

            .item-details {
                flex-grow: 1;
            }

            .item-details h3 {
                margin: 0;
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            .item-details p {
                margin: 5px 0;
                font-size: 14px;
                color: #777;
            }

            .buttons {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 10px;
            }

            .details-button, .checkout-button, .add-to-cart {
                padding: 10px 20px;
                border-radius: 50px;
                text-decoration: none;
                color: #fff;
                text-align: center;
                border: none;
                cursor: pointer;
                transition: transform 0.3s ease, background-color 0.3s ease;
            }

            .details-button {
                background: #333;
            }

            .details-button:hover {
                transform: scale(1.1);
                background: #555;
            }

            .remove-from-cart {
                background: #dc3545;
            }

            .remove-from-cart:hover {
                transform: scale(1.1);
                background: #a71d2a;
            }

            .add-to-cart {
                background: #121010;
                font-weight: bold;
            }

            .add-to-cart:hover {
                transform: scale(1.1);
                background: #635f5f;
            }

            .checkout-button {
                background: #28a745;
                margin-top: 20px;
            }

            .checkout-button:hover {
                transform: scale(1.1);
                background: #218838;
            }

            /* Quantity Buttons Styling */
            .quantity-container {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .quantity-display {
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                width: 50px;
            }

            .quantity-btn {
                background: #121010;
                border: none;
                color: #fff;
                font-size: 20px;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 10px rgba(255, 115, 0, 0.3);
                transition: all 0.3s ease-in-out;
            }

            .quantity-btn:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 15px rgba(255, 115, 0, 0.5);
            }

            /* Cart Section */
            /* Styling yang lebih keren untuk tampilan Shopping Cart */
            .cart-section {
                padding: 20px 30px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                margin-top: 40px;
            }

            .cart-section h2 {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin-bottom: 20px;
            }

            .cart-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 15px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                margin-bottom: 15px;
                transition: transform 0.3s ease;
            }

            .cart-item:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            }

            .cart-item img {
                width: 80px;
                height: 80px;
                margin-right: 20px;
                border-radius: 10px;
                object-fit: cover;
            }

            .cart-item div {
                flex-grow: 1;
                font-size: 16px;
                color: #555;
            }

            .cart-item strong {
                font-weight: bold;
                font-size: 18px;
            }

            .remove-from-cart {
                background: #dc3545;
                color: white;
                padding: 8px 15px;
                border-radius: 50px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .remove-from-cart:hover {
                background: #a71d2a;
                transform: scale(1.1);
            }

            .cart-total {
                font-size: 20px;
                font-weight: bold;
                color: #333;
                text-align: ;
                margin-top: 20px;
            }

            .checkout-button {
                display: block;
                background: #28a745;
                color: white;
                text-align: center;
                padding: 12px 20px;
                border-radius: 50px;
                font-weight: bold;
                margin-top: 20px;
                transition: transform 0.3s ease, background-color 0.3s ease;
            }

            .checkout-button:hover {
                background: #218838;
                transform: scale(1.05);
            }
            /* Fade-in Animation */
            @keyframes fadeIn {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Animasi masuk untuk item menu */
            .menu-item {
                opacity: 0;
                animation: fadeIn 0.6s ease forwards;
            }

            /* Tambahkan delay berbeda untuk setiap menu item */
            .menu-item:nth-child(1) {
                animation-delay: 0.1s;
            }
            .menu-item:nth-child(2) {
                animation-delay: 0.2s;
            }
            .menu-item:nth-child(3) {
                animation-delay: 0.3s;
            }
            /* Lanjutkan sesuai jumlah item */

            /* Animasi hover untuk tombol */
            .buttons .add-to-cart,
            .buttons .details-button,
            .buttons .remove-from-cart {
                animation: none;
            }

            .buttons .add-to-cart:hover,
            .buttons .details-button:hover,
            .buttons .remove-from-cart:hover {
                animation: pulse 1s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.05);
                }
                100% {
                    transform: scale(1);
                }
            }

            /* Loading animation untuk keranjang belanja */
            .cart-section {
                position: relative;
            }

            .cart-loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(255, 255, 255, 0.8);
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                display: none; /* Tampilkan hanya saat loading */
            }

            .cart-loading span {
                display: block;
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .cart-loading .loader {
                width: 40px;
                height: 40px;
                border: 4px solid #ff7300;
                border-top: 4px solid transparent;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }
            

            


            
        </style>

    <<body>
    <header class="header">
        <h1>Menu</h1>
    </header>
    <div class="container">
        <nav class="navbar">
            @foreach ($categories as $cat)
                <a href="{{ route('menu.index', ['category' => $cat]) }}"
                    class="{{ $category === $cat ? 'active' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </nav>

        <main class="menu">
            @foreach ($products as $product)
                <div class="menu-item">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="item-details">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="buttons">
                        @php
                            $isInCart = false;
                            $quantity = 0;
                            foreach ($cart as $item) {
                                if ($item['id'] == $product->id) {
                                    $isInCart = true;
                                    $quantity = $item['quantity'];
                                    break;
                                }
                            }
                        @endphp

                        @if ($isInCart)
                            <div class="quantity-container">
                                <form method="POST" action="{{ route('cart.update', $product->id) }}" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="quantity-btn minus-btn">-</button>
                                </form>

                                <span class="quantity-display">{{ $quantity }}</span>

                                <form method="POST" action="{{ route('cart.update', $product->id) }}" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="quantity-btn plus-btn">+</button>
                                </form>
                            </div>
                        @else
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="size" id="selected-size" value="Regular">
                            <input type="hidden" name="ice" id="selected-ice" value="Normal Ice">
                            <input type="hidden" name="sugar" id="selected-sugar" value="Normal Sweet">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>

                        @endif

                        <a href="{{ route('menu.detail', $product->id) }}" class="details-button">Details</a>
                    </div>
                </div>
            @endforeach
        </main>

        <div class="cart-section">
            <h2>Shopping Cart</h2>
            @if (!empty($cart))
                @foreach ($cart as $item)
                    <div class="cart-item">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                        <div>
                            <strong>{{ $item['name'] }}</strong><br>
                            Size: {{ $item['size'] ?? 'Regular' }}<br>
                            Ice: {{ $item['ice'] ?? 'Normal Ice' }}<br>
                            Sugar: {{ $item['sugar'] ?? 'Normal Sweet' }}<br>
                            Quantity: {{ $item['quantity'] }}<br>
                            Total: Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </div>
                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            <button type="submit" class="remove-from-cart">Remove</button>
                        </form>
                    </div>
                @endforeach

                <div class="cart-total">
                    <strong>Total: Rp{{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <form action="{{ route('checkout.show') }}" method="GET">
                    @csrf
                    <button type="submit" class="checkout-button">Checkout</button>
                </form>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>



    </div>
</body>

    


    <script>
        // Placeholder untuk logika tambahan, seperti animasi atau AJAX.
        function decreaseQty(id) {
                const quantityInput = document.getElementById(`quantity_${id}`);
                const quantityDisplay = document.getElementById(`quantity_display_${id}`);
                let quantity = parseInt(quantityInput.value);
                
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                    quantityDisplay.textContent = quantity;
                } else {
                    // Jika kuantitas mencapai 0, item akan dihapus dan tombol ditampilkan lagi
                    removeFromCart(id);
                }
            }

            function increaseQty(id) {
                const quantityInput = document.getElementById(`quantity_${id}`);
                const quantityDisplay = document.getElementById(`quantity_display_${id}`);
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
                quantityDisplay.textContent = quantity;
            }

            // Fungsi untuk menghapus item jika kuantitas = 0
            function removeFromCart(id) {
                // Menyembunyikan tombol Add to Cart jika kuantitas 0
                document.getElementById(`add_to_cart_${id}`).style.display = 'inline-block';
            }
            document.querySelector('.checkout-button').addEventListener('click', function () {
                const cartLoading = document.createElement('div');
                cartLoading.classList.add('cart-loading');
                cartLoading.innerHTML = `
                    <span>Processing...</span>
                    <div class="loader"></div>
                `;
                document.querySelector('.cart-section').appendChild(cartLoading);
                cartLoading.style.display = 'block';

                // Simulasi delay (misalnya, proses checkout)
                setTimeout(() => {
                    cartLoading.remove();
                    alert('Checkout Successful!');
                }, 3000); // 3 detik delay
            });
    </script>
</body>
</html>
