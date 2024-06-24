<?php

session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Moodly</title>
</head>
<body>
    
    <div class="container">
        <div class="barral">
            <div class="icon"><img class="user" src="<?php echo $_SESSION['imagemUL']; ?>" id="userImage"></div>
            <p id="userName"><?php echo isset($_SESSION['apelidoUL']) ? $_SESSION['apelidoUL'] : $_SESSION['nomeUL']; ?></p>
            <div class="button">
                <div class="espaco">
                    <button class="icone">Ícone</button>
                    <button class="apel">Apelido</button>
                    <a href="home.php"><button class="exit">Sair</button></a>
                </div>
            </div>
            <div class="fotos">
                <button class="lolo" type="button" onclick="changeImage('img/cat1.png')"><img class="lol1" src="img/cat1.png"></button>
                <button class="lola" type="button" onclick="changeImage('img/cat2.png')"><img class="lol2" src="img/cat2.png"></button>
            </div>
            <div class="fotos2">
                <button class="lole" type="button" onclick="changeImage('img/cat3.png')"><img class="lol3" src="img/cat3.png"></button>
                <button class="loli" type="button" onclick="changeImage('img/cat4.png')"><img class="lol4" src="img/cat4.png"></button>
            </div>
            <form action="atualizar_perfil.php" method="post" id="formPerfil">
                <input type="hidden" name="img_src" id="imgSrcInput" value="">
                <div class="apelido">
                    <input class="input" name="apelido" type="text" id="apelidoInput">
                    <span class="input-border"></span>
                </div>
                <button type="submit" class="aIM"><img class="certo" src="img/cer.png"></button>
                <button type="submit" class="pIM"><img class="certo" src="img/cer.png"></button>
                <div class="alert"></div>
                <div class="alert-success"></div>
            </form>
        </div>

        <script src="script.js"></script>
        
</body>
</html>