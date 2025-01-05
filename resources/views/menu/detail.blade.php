<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - {{ $product->name }}</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(to right, #f9f9f9, #e0e0e0);
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease forwards;
        }
        .product-image {
            width: 100%;
            max-width: 300px;
            height: auto;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
                align-items: center;
            }

            .product-image {
                max-width: 200px;
                margin-bottom: 20px;
            }

            .product-info {
                padding-left: 0;
                text-align: center;
            }
        }

        .product-info {
            flex-grow: 1;
            padding-left: 30px;
        }
        .product-info h2 {
            font-size: 2rem;
            color: #333;
        }
        .product-info .price {
            font-size: 1.8rem;
            color: #ff7300;
            font-weight: bold;
        }
        .options {
            margin: 20px 0;
        }
        .option-group {
            margin-bottom: 20px;
        }
        .option-group p {
            margin: 0;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .options button {
            padding: 10px 20px;
            background: linear-gradient(to right, #333, #555);
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .options button:hover {
            background: linear-gradient(to right, #555, #777);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            background: #f4f4f4;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .quantity-control button {
            width: 50px;
            height: 50px;
            font-size: 20px;
            font-weight: bold;
            border: none;
            border-radius: 50%;
            background: linear-gradient(to right, #007bff, #0056b3);
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .quantity-control button:hover {
            background: linear-gradient(to right, #0056b3, #003e82);
            transform: scale(1.1);
        }
        .quantity-control input {
            width: 60px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background-color: white;
        }
        .add-to-cart-btn {
            padding: 12px 25px;
            background: linear-gradient(to right, #28a745, #218838);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .add-to-cart-btn:hover {
            background: linear-gradient(to right, #218838, #1e7e34);
            transform: translateY(-2px);
        }
        .description {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>
    <div class="product-detail">
    <img class="product-image" src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        <div class="product-info">
            <h2>{{ $product->name }}</h2>
            <p class="price" id="total-price" data-base-price="{{ $product->price }}">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <!-- Size Options -->
            <div class="option-group">
                <p>Size:</p>
                <div class="options">
                    @foreach ($sizes as $size)
                        <button class="size-btn" data-price="{{ $size['price'] }}" data-name="{{ $size['name'] }}">
                            {{ $size['name'] }}
                        </button>
                    @endforeach
                </div>
                <p class="description" id="size-description">Please select a size.</p>
            </div>

            <!-- Ice Options -->
            <div class="option-group">
                <p>Ice:</p>
                <div class="options">
                    @foreach ($iceOptions as $ice)
                        <button class="ice-btn" data-value="{{ $ice }}">{{ $ice }}</button>
                    @endforeach
                </div>
                <p class="description" id="ice-description">Please select an ice level.</p>
            </div>

            <!-- Sugar Options -->
            <div class="option-group">
                <p>Sugar:</p>
                <div class="options">
                    @foreach ($sugarFlavors as $sugar)
                        <button class="sugar-btn" data-value="{{ $sugar }}">{{ $sugar }}</button>
                    @endforeach
                </div>
                <p class="description" id="sugar-description">Please select a sugar level.</p>
            </div>


            <!-- Quantity Control -->
            <div class="quantity-control">
                <button class="quantity-decrease">-</button>
                <input type="number" id="quantity" name="quantity" value="1" min="1" readonly>
                <button class="quantity-increase">+</button>
            </div>

            <!-- Add to Cart Button -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="selected-size" value="Regular">
                <input type="hidden" name="price" id="modified-price" value="{{ $product->price }}">
                <input type="hidden" name="ice" id="selected-ice" value="Normal Ice">
                <input type="hidden" name="sugar" id="selected-sugar" value="Normal Sweet">
                <input type="hidden" name="quantity" id="selected-quantity" value="1">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        let basePrice = parseFloat(document.getElementById('total-price').dataset.basePrice);
        let sizePrice = 0;
        let icePrice = 0;
        let sugarPrice = 0;

        // Update price when size is selected
        document.querySelectorAll('.size-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');

                sizePrice = parseFloat(this.dataset.price);

                // Update hidden input for size
                document.getElementById('selected-size').value = this.dataset.name;

                // Update size description
                document.getElementById('size-description').innerText = `You selected size: ${this.dataset.name}.`;

                updateTotalPrice();
            });
        });

        // Update price when ice is selected
        document.querySelectorAll('.ice-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.ice-btn').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');

                // Update hidden input for ice
                document.getElementById('selected-ice').value = this.dataset.value;

                // Update ice description
                document.getElementById('ice-description').innerText = `You selected ice level: ${this.dataset.value}.`;

                updateTotalPrice();
            });
        });

        // Update price when sugar is selected
        document.querySelectorAll('.sugar-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.sugar-btn').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');

                // Update hidden input for sugar
                document.getElementById('selected-sugar').value = this.dataset.value;

                // Update sugar description
                document.getElementById('sugar-description').innerText = `You selected sugar level: ${this.dataset.value}.`;

                updateTotalPrice();
            });
        });

        // Quantity Controls
        document.querySelector('.quantity-decrease').addEventListener('click', () => {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
            document.getElementById('selected-quantity').value = input.value;
            updateTotalPrice();
        });

        document.querySelector('.quantity-increase').addEventListener('click', () => {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
            document.getElementById('selected-quantity').value = input.value;
            updateTotalPrice();
        });

        // Update the total price on the page
        function updateTotalPrice() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const totalPrice = (basePrice + sizePrice + icePrice + sugarPrice) * quantity;
            document.getElementById('total-price').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            document.getElementById('modified-price').value = basePrice + sizePrice + icePrice + sugarPrice;
        }

        // Initial price update
        updateTotalPrice();
    });

    </script>
</body>
</html>
