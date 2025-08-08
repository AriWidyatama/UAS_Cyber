<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body {
      background-image: url(image/bg_login.jpg);
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
    }
    .alert {
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
        font-weight: bold;
        text-align: center;
    }

    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }
  </style>
  </head>
  <body>
    <br/><br/><br/>
    <div class="box">
    <div class="container">
        <form class="form" action="{{ route('login') }}" method="POST" >
            @csrf
            <div class="row justify-content-md-center">
                <div class="col col-lg-5">    
                    <div class="card">
                        <div class="card-body">
                            <div class="top">
                                <span>Have an account?</span>
                                <header>Login</header>
                                @if (session('error'))
                                    <div class="alert alert-danger" align="center" id="alert-message">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success" align="center" id="alert-message">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                            <div class="warning" align="center">
                                <?php
                                    if(isset($_GET["error"])){
                                        $kode = $_GET["error"];

                                        if($kode=="01"){
                                            echo "<div id=\"pesan\" class=\"alert alert-danger\" role=\"alert\">
                                                    Lengkapi username dan password!
                                                </div>";
                                        }
                                    }

                                ?>
                            </div>
                    
                            <div class="input-field">
                                <input type="text" class="input" name="username" placeholder="Username" id="" required>
                                <i class='bx bx-user' ></i>
                            </div> <br>

                            <div class="input-field">
                                <input type="Password" class="input" name="password" placeholder="Password" id="" required>
                                <i class='bx bx-lock-alt'></i>
                            </div><br>
                    
                            <div class="input-field">
                                <input type="submit" class="submit" value="Login" id="">
                            </div>
                    
                            <div class="two-col">
                                <div class="one">
                                    <input type="checkbox" name="" id="check">
                                    <label for="check"> Remember Me</label>
                                </div>
                                <div class="two">
                                    <label><a href="#">Forgot password?</a></label>
                                </div>
                            </div>
                            <div class="col3">
                                <p>Belum memiliki akun? </p>
                                <a class="regis" href="{{ route('register.form') }}">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script>
        const myTimeout = setTimeout(myGreeting, 3000);
        function myGreeting() {
            document.getElementById("pesan").style.display = "none";
        }

        setTimeout(function () {
            const alertBox = document.getElementById('alert-message');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
