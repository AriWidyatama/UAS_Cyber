<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" type="text/css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>REGISTER</title>
    <style>
        body {
            background-image: url(image/bg_login.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
        }

        .box {
            width: 400px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: auto;
            margin-top: 100px;
        }

        .container {
            display: flex;
            flex-direction: column;
        }

        .form {
            display: flex;
            flex-direction: column;
        }

        .top {
            text-align: center;
            margin-bottom: 20px;
        }

        header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

       .input-field {
    position: relative;
    margin-bottom: 20px;
}

.input {
    width: 100%;
    padding: 10px 40px 10px 35px; /* kiri 35px untuk jarak ikon */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
    box-sizing: border-box; /* penting biar lebar tetap pas */
}

.input:focus {
    border-color: #4f46e5;
    outline: none;
}

.bx {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #4f46e5;
    font-size: 18px;
}


        .button1 {
            display: inline-block;
            margin-right: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #4f46e5;
            color: white;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .btn-default {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-default:hover {
            background-color: #e0e0e0;
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="box">
        <div class="container">
            <form class="form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="top">
                    <header>REGISTER</header>
                </div>

                <div class="input-field">
                    <input type="text" class="input" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama" required />
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" class="input" name="username" value="{{ old('username') }}" placeholder="Masukkan Username" required />
                    <i class="bx bx-user-circle"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="input" name="password" placeholder="Masukkan Password" required />
                    <i class="bx bx-lock"></i>
                </div>

                <div class="input-field">
                    <input type="file" name="foto" class="input" />
                </div>

                <div class="input-field">
                    <div class="button1">
                        <a href="/">
                            <button type="button" class="btn btn-default">Cancel</button>
                        </a>
                    </div>
                    <div class="button1">
                        <input type="reset" name="batal" value="Reset" class="btn" />
                    </div>
                    <div class="button1">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
