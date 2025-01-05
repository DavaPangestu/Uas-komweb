<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            padding: 40px;
            background: #ffffff;
            color: #333;
            margin: 0;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 42px;
            color: #000;
            margin-bottom: 20px;
            font-weight: 700;
            animation: fadeInTop 1s ease-in-out;
        }

        .thank-you-message {
            font-size: 22px;
            margin-bottom: 20px;
            color: #555;
        }

        .total-price {
            font-size: 28px;
            color: #000;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .menu-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .menu-item {
            width: 250px;
            padding: 15px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            background-color: #f0f0f0;
        }

        .menu-item h4 {
            font-size: 18px;
            color: #000;
            margin: 10px 0 5px;
            font-weight: 700;
        }

        .menu-item p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .payment-method {
            margin-top: 20px;
            font-size: 18px;
            color: #000;
            font-weight: 500;
        }

        .countdown-container {
            margin-top: 30px;
            font-size: 18px;
            color: #333;
            animation: fadeIn 1.4s ease-in-out;
        }

        .countdown-message {
            font-size: 20px;
            font-weight: 600;
            color: rgb(0, 0, 0);
            margin-bottom: 10px;
        }

        .countdown-number {
            font-size: 26px;
            font-weight: 700;
            color: #000;
        }

        .notif-container {
            background-color: rgb(8, 8, 8);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: opacity 0.5s ease;
            opacity: 0;
            visibility: hidden;
        }

        .notif-container.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-menu {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            background: rgb(0, 0, 0);
            border-radius: 50px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .back-to-menu:hover {
            background: rgb(0, 0, 0);
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInTop {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <h1>Thank You for Your Purchase!</h1>

    @if(session('success'))
        <p class="thank-you-message">{{ session('success') }}</p>
    @endif

    @if(session('total_price'))
        <p class="total-price">Total Paid: Rp{{ number_format(session('total_price'), 0, ',', '.') }}</p>
    @endif

    @if(session('payment_method'))
        <p class="payment-method">Payment Method: {{ session('payment_method') }}</p>
    @endif

    @if(session('purchased_items'))
        <div class="menu-list">
            @foreach(session('purchased_items') as $item)
                <div class="menu-item">
                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <h4>{{ $item['name'] }}</h4>
                    <p>Quantity: {{ $item['quantity'] }}</p>
                    <p>Size: {{ $item['size'] ?? 'Regular' }}</p>
                    <p>Ice: {{ $item['ice'] ?? 'Normal Ice' }}</p>
                    <p>Sugar: {{ $item['sugar'] ?? 'Normal Sweet' }}</p>
                    <p>Price: Rp{{ number_format(($item['modified_price'] ?? $item['price']) * $item['quantity'], 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="countdown-container">
        <p class="countdown-message">Your order will be ready in</p>
        <p class="countdown-number">2:00</p>
    </div>

    <div id="notif" class="notif-container">
        <p>Your order is ready!</p>
    </div>

    <a href="{{ route('menu.index') }}" class="back-to-menu">Continue Shopping</a>

    <script>
        let countdownTime = 120; // 2 minutes in seconds
        const countdownElement = document.querySelector('.countdown-number');
        const notifElement = document.getElementById('notif');

        function updateCountdown() {
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;
            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            if (countdownTime > 0) {
                countdownTime--;
                setTimeout(updateCountdown, 1000);
            } else {
                showNotification();
            }
        }

        function showNotification() {
            notifElement.classList.add('show');
        }

        updateCountdown();
    </script>
</body>
</html>
