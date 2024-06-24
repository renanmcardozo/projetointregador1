<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/login.css">
    <title>Moodly</title>
</head>

<body>
    
    <section>
        <div>
            <form action="logar.php" method="post">
                <div class="branco">
                    <img class="cam" src="img/Tester.png">
                    <div class="linha">
                <div class="input-wrapper">
                    <input type="text" placeholder="E-MAIL" name="email" class="input" required>
                </div>
                <div class="input-wrapper">
                    <input type="password" placeholder="SENHA" name="senha" class="input" required>
                </div>
                <div class="alert"></div>
                <div class="alert-success"></div>
                <button>Entrar</button>
                <div class="register">
                    <p>Não tem conta? <a href="register.php">Registrar</a></p>
                </div>
                </div>
                    </div>
            </form>
            
        </div>
    </section>

    <script src="spc.js"></script>
    
</body>

</html>
