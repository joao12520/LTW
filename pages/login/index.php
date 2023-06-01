<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="login.js" defer></script>
    <link href="login.css" rel="stylesheet">
    <script>
        if (location.href=='http://localhost:9000/pages/login')
            location.href='../pages/login/index.php'
    </script>
</head>

<body>
    <a href="../main/index.php">
    <img src="../../assets\img\logo.png" alt="App Logo SVG" width=200 />
    </a>


    <div class="form-container">
        <header id="title_container">
            <h1>Iniciar Sessão</h1>
        </header>

        <form style="border:none !important" class="form-c" method="post" action="loginval.php">
            <div class="username">
                <label class="input-label" for="username"><b>Username:</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
            </div>

            <div class="password">
                <label class="input-label" for="psw" name='password'><b>Password:</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
            </div>


            <div class="button-container">
                <button type="submit" >Login</button>
                <button onclick="return changeToRegister();">Não tenho conta</button>
            </div>
        </form>

        <!-- <div class="modal"> LOGIN ERROR MESSAGE </div> -->

        <div class="ftr">
            <span class="psw">Forgot <a href="#">password?</a></span>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Lembrar-me
            </label>

        </div>
    </div>


</body>

</html>