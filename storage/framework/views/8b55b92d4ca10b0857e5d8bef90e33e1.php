<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .checkout-container {
            width: 100%;
            max-width: 900px;
            padding: 40px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }

        .cart-item-info {
            text-align: left;
            flex-grow: 1;
            margin-left: 20px;
        }

        .cart-item-info h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .cart-item-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .cart-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #4caf50;
        }

        .cart-total {
            font-size: 22px;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .checkout-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #000;
            color: white;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .payment-options {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
        }

        .payment-option input[type="radio"] {
            margin-right: 15px;
            transform: scale(1.3);
            accent-color: #000;
        }

        .payment-option label {
            font-size: 16px;
            font-weight: 600;
        }

        .payment-image {
            width: 40px;
            height: 40px;
            margin-left: auto;
            border-radius: 5px;
            object-fit: contain;
        }

        .popout {
            display: none;
            margin-top: 20px;
            background: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .popout-show {
            display: block;
        }

        .popout input {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .notification {
            display: none;
            padding: 10px;
            background-color: #ffcc00;
            color: #000;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .notification.show {
            display: block;
        }

        .countdown {
            font-size: 20px;
            font-weight: bold;
            color: red;
            margin-top: 20px;
        }

        /* Center the QRIS image and make it bigger */
        .qris-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .qris-image-container img {
            width: 500px;  /* Make image bigger */
            height: 500px; /* Make image bigger */
            object-fit: contain;
        }

        /* Style for input fields for OVO and Gopay */
        .popout label {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .popout input {
            font-size: 16px;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <!-- Cart Items -->
        <?php if(!empty($cart)): ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cart-item">
                    <img src="<?php echo e(asset('images/' . $item['image'])); ?>" alt="<?php echo e($item['name']); ?>">
                    <div class="cart-item-info">
                        <h4><?php echo e($item['name']); ?></h4>
                        <p>Quantity: <?php echo e($item['quantity']); ?></p>
                        <p>Size: <?php echo e($item['size'] ?? 'Regular'); ?></p>
                        <p>Ice: <?php echo e($item['ice'] ?? 'Normal Ice'); ?></p>
                        <p>Sugar: <?php echo e($item['sugar'] ?? 'Normal Sweet'); ?></p>
                    </div>
                    <div class="cart-item-price">
                        Rp<?php echo e(number_format($item['modified_price'] * $item['quantity'], 0, ',', '.')); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="cart-total">
                Total: Rp<?php echo e(number_format($total, 0, ',', '.')); ?>

            </div>

            <form action="<?php echo e(route('payment.process')); ?>" method="POST" id="checkout-form">
                <?php echo csrf_field(); ?>
                <div class="payment-options">
                    <div class="payment-option">
                        <input type="radio" id="Ovo" name="payment_method" value="Ovo">
                        <label for="Ovo">Ovo</label>
                        <img src="<?php echo e(asset('images/ovo.jpg')); ?>" alt="Ovo" class="payment-image">
                    </div>
                    <div class="payment-option">
                        <input type="radio" id="Gopay" name="payment_method" value="Gopay">
                        <label for="Gopay">Gopay</label>
                        <img src="<?php echo e(asset('images/gopay.png')); ?>" alt="Gopay" class="payment-image">
                    </div>
                    <div class="payment-option">
                        <input type="radio" id="Qris" name="payment_method" value="Qris">
                        <label for="Qris">Qris</label>
                        <img src="<?php echo e(asset('images/Qris.jpg')); ?>" alt="Qris" class="payment-image">
                    </div>
                </div>

                <!-- Popouts for OVO, Gopay, and QRIS -->
                <div id="ovo-popout" class="popout">
                    <label for="ovo-phone-number">Enter your OVO phone number:</label>
                    <input type="text" id="ovo-phone-number" name="phone_number" placeholder="Phone Number">
                </div>
                <div id="gopay-popout" class="popout">
                    <label for="gopay-phone-number">Enter your Gopay phone number:</label>
                    <input type="text" id="gopay-phone-number" name="phone_number" placeholder="Phone Number">
                </div>
                <div id="qris-popout" class="popout">
                    <p>Please scan the QR code to complete your payment:</p>
                    <div class="qris-image-container">
                        <img src="<?php echo e(asset('images/Isiqrisloh.jpg')); ?>" alt="QRIS">
                    </div>
                </div>

                <button type="submit" class="checkout-button" onclick="return validateForm()">Proceed to Payment</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>

        <div id="notification" class="notification">You need to open the OVO app to continue the payment process.</div>
        <div id="countdown" class="countdown"></div>
    </div>

    <script>
        // JavaScript to handle the showing of popouts, notifications, and countdown
        document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
            elem.addEventListener('change', function() {
                var paymentMethod = this.value;

                if (paymentMethod === 'Ovo') {
                    document.getElementById('ovo-popout').classList.add('popout-show');
                    document.getElementById('gopay-popout').classList.remove('popout-show');
                    document.getElementById('qris-popout').classList.remove('popout-show');
                    showNotification('You need to open the OVO app to continue the payment process.');
                } else if (paymentMethod === 'Gopay') {
                    document.getElementById('gopay-popout').classList.add('popout-show');
                    document.getElementById('ovo-popout').classList.remove('popout-show');
                    document.getElementById('qris-popout').classList.remove('popout-show');
                    showNotification('You need to open the Gopay app to continue the payment process.');
                } else if (paymentMethod === 'Qris') {
                    document.getElementById('qris-popout').classList.add('popout-show');
                    document.getElementById('ovo-popout').classList.remove('popout-show');
                    document.getElementById('gopay-popout').classList.remove('popout-show');
                    showNotification('Please scan the QR code to complete the payment.');
                } else {
                    hideNotification();
                }
            });
        });

        // Show notification
        function showNotification(message) {
            var notification = document.getElementById('notification');
            notification.textContent = message;
            notification.classList.add('show');
            startCountdown();
        }

        // Hide notification
        function hideNotification() {
            var notification = document.getElementById('notification');
            notification.classList.remove('show');
            document.getElementById('countdown').textContent = '';
        }

        // Countdown timer
        function startCountdown() {
            var countdownElement = document.getElementById('countdown');
            var countdownTime = 300; // 5 minutes in seconds

            var interval = setInterval(function() {
                var minutes = Math.floor(countdownTime / 60);
                var seconds = countdownTime % 60;
                countdownElement.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

                if (countdownTime <= 0) {
                    clearInterval(interval);
                    countdownElement.textContent = 'Time is up! Please try again.';
                } else {
                    countdownTime--;
                }
            }, 1000);
        }

        function validateForm() {
            // Check if phone number is entered
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method');
                return false;
            }

            var phoneNumber = (paymentMethod.value === 'Ovo') ? document.getElementById('ovo-phone-number').value : 
                               (paymentMethod.value === 'Gopay') ? document.getElementById('gopay-phone-number').value : '';
            
            if (!phoneNumber && (paymentMethod.value === 'Ovo' || paymentMethod.value === 'Gopay')) {
                alert('Please enter your phone number');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\semogaWebHambaBisaYaallah\resources\views/checkout/index.blade.php ENDPATH**/ ?>