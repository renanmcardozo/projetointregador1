<?php

session_start();
// require_once("conexao.php");

$required_access_level = 'Administrador';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/home.css">
    <title>Moodly</title>
</head>
<body>
    
    <div class="container">
        <div class="barral">
            <h1 class="titulo">MOODLY</h1>
            <div class="linha"></div>
            <div class="icon"><img class="user" src="<?php echo $_SESSION['imagemUL']; ?>"></div>
            <p><?php echo isset($_SESSION['apelidoUL']) ? $_SESSION['apelidoUL'] : $_SESSION['nomeUL']; ?></p>
            <div class="botoes">
                <a href="perfil.php"><button class="butto">Perfil</button></a>
                <a href="index.php"><button class="butto">Sair</button></a>
            </div>
            <div class="linha"></div>
            <div><a href="game.php"><button class="game"><img class="gm" src="img/game.png"></button></a></div>
        </div>

        <div class="barral-two">
            <h1 class="titulo">NOTICIAS</h1>
            <div class="linha"><br></div>
            <div class="ret2"><a href="https://sjp.ifsp.edu.br/component/content/article/63-noticias/399-save-the-date-arduino-day-2024"><img class="img_not1" src="img/ard.png"></a></div><br><br>
            <div class="ret3"><a href="https://sjp.ifsp.edu.br/destaque/382-semana-de-acolhimento-aos-estudantes-ingressantes"><img class="img_not2" src="img/aco.png"></a></div><br><br>
            <div class="ret4"><a href="https://sjp.ifsp.edu.br/destaque/392-ifsp-sao-jose-do-rio-preto-celebra-o-dia-internacional-da-mulher-2024-com-a-campanha-ser-mulher-e-ser-o-que-voce-quiser"><img class="img_not3" src="img/wom.png"></a></div>
        </div>
    </div>

    <div class="ban_cat">
        <img class="testss" src="img/ban_cat1.png">
    </div>  

    <div class="butoes2">
        <a href="linhadtempo.php"><button class="butao1">Linha do Tempo</button></a><br>
        <a href="cursos.php"><button class="butao2">Cursos</button></a><br>
        <a href="calen.php"><button class="butao3">Calendário</button></a>
    </div>

    <script src="home.js"></script>

    <?php
// Verifique se o usuário NÃO tem o nível de acesso necessário
if (!isset($_SESSION['acessoUL']) || $_SESSION['acessoUL'] !== $required_access_level) {
    // Exiba uma mensagem ou nada se o usuário não tiver o nível de acesso necessário
    echo '';
} else {
    // Exiba o botão se o usuário tiver o nível de acesso necessário
    echo '<a href="listarusuario.php" tabindex="0" class="plusButton">
  <svg class="plusIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
    <g mask="url(#mask0_21_345)">
      <path d="M13.75 23.75V16.25H6.25V13.75H13.75V6.25H16.25V13.75H23.75V16.25H16.25V23.75H13.75Z"></path>
    </g>
  </svg>
</a>';
}
?>

</body>
</html>