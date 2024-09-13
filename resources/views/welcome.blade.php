<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        button{
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }
        button:active{
            transform: scale(0.95);
        }
        button:focus{
            outline: none;
        }
        button:ghost{
            background-color: transparent;
            border-color: #FFFFFF;
        }
        input{
            background-color: #eee;
            border-radius: 20px;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 80%;
        }
        .container{
            display: flex;
            margin: 50px 150px;
            padding: 10px 20px;
            background-color: #ffff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0,0.25), 0 10px 10px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
            width: 700px;
            max-height: 100%;
            min-height: 480px;
        }
        .form-container{
            position: absolute;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        .singn-in-container{
            left: 0;
            width: 50%;
            z-index: 2;
        }
        .container.right-panel-active .singn-in-container{
            transform: translateX(100%);
        }
        .singn-up-container{
            left: 0;
            width: 50%;
            opacity: 0;
        }
        .container.right-panel-active .singn-up-container{
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;

        }    
    </style>
    <div class="container" id="container">
        <div class="sign-up-container">
            <form action="#" method="post">
                @csrf
                <div class="social-container">
                    <a href=""><i class="fab fa-google-plus-g"></i></a>
                </div>
                <div class="info">
                    <span>or use email for registration</span>
                    <input type="text" name="name" id="ame" placeholder="Name">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input type="password" name="Verify_Password" id="Verify_Password" placeholder="Verify Password">
                </div>
                    <button type="submit">Sing Up</button>
            </form>
        </div>
        <div class="sign-in-container">
            <form action="#" method="post">
                @csrf
                <div class="social-container">
                    <a href=""><i class="fab fa-google-plus-g"></i></a>
                </div>
                <div class="info">
                    <span>or use email for registration</span>
                    <input type="text" name="name" id="ame" placeholder="Name">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input type="password" name="Verify_Password" id="Verify_Password" placeholder="Verify Password">
                </div>
                    <button type="submit">Sing Up</button>
            </form>
        </div>
    </div>
    <script>
        const singUpButton = document.getElementById('signUp');
        const singInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        singUpButton.add
    </script>
</body>
</html>