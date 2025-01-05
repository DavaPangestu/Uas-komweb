<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ebe8e8;
            color: #ffffff;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .image-section {
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }

        .product-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .image-section:hover .product-image {
            transform: scale(1.05);
        }

        .text-section {
            text-align: center;
        }

        .signup-button {
            width: 100%;
            background-color: #302f2f;
            color: #d6d2d2;
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .signup-button:hover {
            background-color: #726b6b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        .message {
            font-size: 14px;
            color: #222020;
            margin-top: 20px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .signup-button {
                font-size: 16px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="images/gambarGaotaBagianSignUp.png" alt="Product Image" class="product-image">
        </div>
        
        <a href="{{ route('register.form') }}">
        <button class="signup-button">Sign up</button>
            </a>
             <p class="message">You must have an account to proceed with this payment.</p>
        </div>
    </div>

    <script>
        document.querySelector('.signup-button').addEventListener('click', function () {
            alert('Redirecting to the signup page...');
            window.location.href = 'signup.php';
        });
    </script>
</body>
</html> 