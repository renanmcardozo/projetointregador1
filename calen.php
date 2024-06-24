<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['idUL'])) {
    header("Location: logar.php");
    exit();
}

$idUL = $_SESSION['idUL'];

// Consultar o ID do curso em que o usuário está inscrito
$queryCurso = "SELECT id_curso FROM Inscricao WHERE id_usuario = :id_usuario";
$stmtCurso = $conn->prepare($queryCurso);
$stmtCurso->bindParam(':id_usuario', $idUL, PDO::PARAM_INT);
$stmtCurso->execute();
$idCurso = $stmtCurso->fetchColumn();

// Consultar as datas dos conteúdos do curso em que o usuário está inscrito
$queryConteudos = "SELECT data_final FROM Conteudo WHERE id_curso = :id_curso";
$stmtConteudos = $conn->prepare($queryConteudos);
$stmtConteudos->bindParam(':id_curso', $idCurso, PDO::PARAM_INT);
$stmtConteudos->execute();
$datas = $stmtConteudos->fetchAll(PDO::FETCH_ASSOC);

// Função para gerar o calendário
function gerarCalendario($ano, $mes, $datas) {
    $primeiroDia = mktime(0, 0, 0, $mes, 1, $ano);
    $diasDoMes = date('t', $primeiroDia);
    $diaDaSemana = date('w', $primeiroDia);
    $datasArray = array_column($datas, 'data_final');

    echo '<table>';
    echo '<tr>';
    echo '<th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>';
    echo '</tr><tr>';

    for ($i = 0; $i < $diaDaSemana; $i++) {
        echo '<td></td>';
    }

    for ($dia = 1; $dia <= $diasDoMes; $dia++) {
        $dataAtual = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);
        $highlight = in_array($dataAtual, $datasArray) ? 'highlight' : '';
        $todayClass = ($dataAtual == date('Y-m-d')) ? 'today' : '';

        echo "<td class='$highlight $todayClass'>$dia</td>";

        if (($dia + $diaDaSemana) % 7 == 0) {
            echo '</tr><tr>';
        }
    }

    while (($dia + $diaDaSemana) % 7 != 0) {
        echo '<td></td>';
        $dia++;
    }

    echo '</tr>';
    echo '</table>';
}

// Defina o mês e o ano desejados
$ano = 2024;
$mes = 6;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/cursos.css">
    <title>Calendário</title>
</head>
<body>
<div class="calendario">

<?php
// Gere o calendário
gerarCalendario($ano, $mes, $datas);
?>

</div>

<nav id="slide-menu">
	<ul>
		<li><a href="home.php"><img class="navb" src="img/home.png"></a></li>
		<li><<a href="linhadtempo.php"><img class="navb" src="img/ltd.png"></li>
		<li><a href="cursos.php"><img class="navb" src="img/curso.png"></a></li>
		<li><img class="navbO" src="img/calen.png"></li>
		<li><a href="index.php"><img class="navb" src="img/rem.png"></a></li>
	</ul>
    </nav>
<!-- Content -->
<div id="content">
	<div class="menu-trigger"></div>
</div>

    <script src="valen.js"></script>
</body>
</html>