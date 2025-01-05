<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ebe9e9, #f8f6f5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
            animation: slideIn 0.8s ease-out;
            transform: scale(1);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.03);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: #ffffff;
            color: rgb(71, 70, 70);
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-content {
            padding: 20px 30px;
        }

        .space-y-4 > * + * {
            margin-top: 1.5rem;
        }

        .space-y-2 > * + * {
            margin-top: 0.75rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #555;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 12px 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #494746;
            box-shadow: 0 0 10px rgba(73, 71, 70, 0.5);
            outline: none;
        }

        .radio-group {
            display: flex;
            gap: 10px;
        }

        .radio-item {
            display: flex;
            align-items: center;
        }

        .radio-item input[type="radio"] {
            margin-right: 8px;
            accent-color: #494746;
        }

        .button {
            width: 100%;
            padding: 12px 16px;
            background: #333333;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: linear-gradient(135deg, #868484, #494746);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .card {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Register Now
            </div>
            <div class="card-content">
                <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                    <div class="space-y-2">
                        <label for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="tel" placeholder="Enter your phone number" required>
                    </div>
                    <div class="space-y-2">
                        <label for="name">Full Name</label>
                        <input id="name" name="name" type="text" placeholder="Enter your name" required>
                    </div>
                    <div class="space-y-2">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" placeholder="Enter your email" required>
                    </div>
                    <div class="space-y-2">
                        <label for="dob">Date of Birth</label>
                        <input id="dob" name="dob" type="date" required>
                    </div>
                    <div class="space-y-2">
                        <label>Gender</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="male" name="gender" value="male" checked>
                                <label for="male">Male</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="other" name="gender" value="other">
                                <label for="other">Other</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\semogaWebHambaBisaYaallah\resources\views/register.blade.php ENDPATH**/ ?>