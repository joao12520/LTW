<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="register.css" rel="stylesheet">
    <script>
        if (location.href=='http://localhost:9000/pages/register')
            location.href='../pages/register/index.php'
    </script>
    <script defer type="text/javascript" src="register.js"></script>

</head>

<body>
    <img src="../../assets\img\logo.png" alt="App Logo SVG" width=200 />


    <header id="title_container">
        <h1>Registar</h1>
    </header>

    <form style="border:none !important" class="form-c" method="POST" id="registerForm" action="registerVal.php" enctype="multipart/form-data">

        <div class="usernameReg">
            <label class="input-label" for="username"><b>Utilizador:</b></label>
            <input type="text" placeholder="Nome de Utilizador" name="username" required>
            <h6 class="regErrorMessages"> </h6>
        </div>

        <div class="passwordReg">
            <label class="input-label" for="password"><b>Palavra-passe:</b></label>
            <input type="password" placeholder="Senha" name="password" required>
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="password2Reg">
            <label class="input-label" for="password2"><b>Confirme a sua Palavra-passe:</b></label>
            <input type="password" placeholder="Senha" name="password2" required>
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="contactoReg">
            <label class="input-label" for="contact"><b>Contacto:</b></label>
            <input type="text" placeholder="Telemóvel/Telefone" name="contact" required>
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="nifReg">
            <label class="input-label" for="nif"><b>NIF:</b></label>
            <input type="text" placeholder="Número de Identificação Fiscal" name="nif" required>
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="moradaReg">
            <label class="input-label" for="address"><b>Morada:</b></label>
            <input type="text" placeholder="Introduza a sua morada" name="address" required>
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="photoReg">
            <label class="input-label" for="photo"><b>Foto de perfil: </b></label>
            <input type="file" name="photo">
            <h6 class="regErrorMessages"></h6>
        </div>

        <div class="adminReg">
            <label class="input-label" for="isAdmin"><b> Business Owner Account? </b></label>
            <input type="checkbox" value="true" name="isAdmin">
        </div>


        <div id="result"></div>

        <script defer type="text/javascript" src="register.js"></script>

        <div class="button-container">
            <button id="registerSubmit">Registar</button>

        </div>

    </form>

</body>
<footer>
</footer>

</html>