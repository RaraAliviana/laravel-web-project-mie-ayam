<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mie Ayam Gapuro</title>

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset('build/assets/img/mie_ayam1.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            font-family: 'Raleway', sans-serif;
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .content {
            text-align: center;
            max-width: 800px;
            width: 100%;
            padding: 40px;
            background: rgba(0, 0, 0, 0.7); 
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        /* Title Styles */
        .title {
            font-size: 64px;
            font-weight: bold;
            margin: 0;
            color: #fff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.4);
        }

        /* Subtitle */
        .subtitle {
            font-size: 20px;
            margin-top: 20px;
            color: #f0f0f0;
            font-weight: 400;
        }

        /* Buttons Styles */
        .links a {
            color: #fff;
            padding: 15px 30px;
            margin: 10px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 25px;
            background-color: #ff6600;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Button Hover Effects */
        .links a:hover {
            background-color: #ffcc00;
            transform: translateY(-5px);
        }

        /* Links Section */
        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .title {
                font-size: 48px;
            }
            .subtitle {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <div class="flex-center">
        <div class="content">
            <!-- Title -->
            <div class="title">
                MIE AYAM GAPURO
            </div>

            <!-- Subtitle -->
            <div class="subtitle">
                Temukan Mie Ayam Favoritmu di sini
            </div>

            <!-- Navigation Links -->
            <div class="links">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>

</body>
</html>
