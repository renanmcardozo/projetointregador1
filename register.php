<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/register.css">
    <title>Moodly</title>
</head>

<body>

    <div class="titi">
    <img class="cam" src="img/teste.png">
    </div>

    <section>            
            <div class="branco">
            <form class="form" action="cadUsuario.php" method="post">
                <div class="input-wrapper">
                    <input type="text" placeholder="NOME" name="nome" class="nome" required>
                </div>
                <div class="input-wrapper">
                    <input type="text" placeholder="E-MAIL" name="email" class="email" required>
                </div>
                <div class="input-wrapper">
                    <input type="text" placeholder="SENHA" name="senha" class="senha" required>
                </div>
                <button class="button">REGISTRAR</button>
            </form>
                <a href="index.php" class="voltar">CANCELAR</></a>
            </div>

            <script src="regis.js"></script>
    </section>


</body>

</html>
