<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>

    <link rel="icon" type="image/png" sizes="16x16" href="images/pdmanplas.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="AdminLTE_3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="AdminLTE_3/dist/css/adminlte.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Source Sans Pro', sans-serif;
            display: flex;
            height: 100vh;
        }

        .left-side {
            width: 50%;
            background: url('https://i.postimg.cc/kX9Z9PQ8/Chat-GPT-Image-May-4-2025-06-27-18-PM.png') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
          
        }

        .right-side {
            width: 40%;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .login-box-msg {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            text-align: center;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 1.5rem;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #ced4da;
        }

        .input-group-text {
            background-color: #e9ecef;
            border: none;
            padding: 0.75rem;
        }

        .form-control {
            border: none;
            padding: 0.75rem;
        }

        .btn-primary {
            background: linear-gradient(to right,#00ff33,#0a3d1a);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1rem;
            font-weight: bold;
            width: 100%;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .img-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .img-container img {
            max-width: 150px;
        }

        center p {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        center a {
            color: #fc6076;
            text-decoration: none;
        }

        center a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }

            .right-side {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="left-side">
        <div class="overlay"></div>
    </div>
    <div class="right-side">
        <div class="login-box">
            <div class="img-container">
                <img src="https://i.postimg.cc/kX9Z9PQ8/Chat-GPT-Image-May-4-2025-06-27-18-PM.png" alt="Logo" />
            </div>
            <center style="margin-top: 20px;">
    <small style="color: gray;">“Limbah hari ini, jadi berkah esok hari.”</small>
</center>
            <p class="login-box-msg">LIMBAH JAYA BERKAH</p>
            <p class="login-box-msg">Masukkan Username & Password</p>
            <form action="#">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" id="username" autofocus />
                    <div class="input-group-append">
                        <div class="input-group-text" id='icon-user'>
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" id="password" />
                    <div class="input-group-append">
                        <div class="input-group-text" id='icon-pass'>
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="btn_login">LOGIN</button>
            </form>
            <center>
                <p>Robiyansah <a href='https://www.tiktok.com/@robiyansah.3?is_from_webapp=1&sender_device=pc' target='_blank'>Limbah Jaya Berkah</a></p>
            </center>
        </div>
    </div>

    <script src="AdminLTE_3/plugins/jquery/jquery.min.js"></script>
    <script src="AdminLTE_3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="AdminLTE_3/dist/js/adminlte.min.js"></script>

    <script>
        $(function () {
            var base_url = window.location.origin + '/plastik';

            $('#btn_login').click(function (e) {
                e.preventDefault();
                $('.login-box-msg').removeClass('text-danger');
                $('.login-box-msg').html('Masukkan Username dan Password');
                $('input').removeClass('border-danger');
                $('.input-group-text').removeClass('border border-danger bg-danger');

                if ($('#username').val() == '') {
                    $('.login-box-msg').addClass('text-danger');
                    $('.login-box-msg').html('Username Masih Kosong');
                    $('#username').addClass('border border-danger');
                    $('#icon-user').addClass('border border-danger bg-danger');
                    return false;
                }
                if ($('#password').val() == '') {
                    $('.login-box-msg').addClass('text-danger');
                    $('.login-box-msg').html('Password Masih Kosong');
                    $('#password').addClass('border border-danger');
                    $('#icon-pass').addClass('border border-danger bg-danger');
                    return false;
                }
                let params = {
                    username: $('#username').val(),
                    password: $('#password').val()
                }

                $.ajax({
                    url: base_url + '/app/proses_login.php',
                    type: 'POST',
                    data: params,
                    dataType: 'json',
                    success: function (res) {
                        if (res.kode == 0) {
                            $('.login-box-msg').addClass('text-danger');
                            $('.login-box-msg').removeClass('text-success');
                        } else {
                            $('.login-box-msg').addClass('text-success');
                        }
                        $('.login-box-msg').html(res.pesan);
                    }
                });

            });
        });
    </script>
</body>

