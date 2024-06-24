<?php
session_start();

// Conexão com o banco de dados
require_once 'conexao.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUL'])) {
    header("Location: index.php");
    exit;
}

$id_usuario = $_SESSION['idUL'];

// Verifica se o ID do curso foi passado via GET
if (!isset($_GET['id_curso'])) {
    echo "Curso não selecionado.";
    exit;
}

$id_curso_selecionado = intval($_GET['id_curso']);

// Consulta para verificar se o usuário está inscrito no curso selecionado
$sql_verifica_inscricao = "SELECT 1 FROM Inscricao WHERE id_usuario = :id_usuario AND id_curso = :id_curso";
$stmt_verifica_inscricao = $conn->prepare($sql_verifica_inscricao);
$stmt_verifica_inscricao->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_verifica_inscricao->bindParam(':id_curso', $id_curso_selecionado, PDO::PARAM_INT);
$stmt_verifica_inscricao->execute();

if ($stmt_verifica_inscricao->rowCount() == 0) {
    echo "<p>Você não está inscrito neste curso.</p>";
    exit;
}


// Consulta para obter o conteúdo do curso selecionado
$sql_conteudo = "
SELECT cu.id_curso, cu.titulo_curso, c.id_conteudo, c.titulo_conteudo, c.descricao, c.status
FROM Conteudo c
INNER JOIN Curso cu ON c.id_curso = cu.id_curso
WHERE c.id_curso = :id_curso
ORDER BY c.titulo_conteudo";

$stmt_conteudo = $conn->prepare($sql_conteudo);
$stmt_conteudo->bindParam(':id_curso', $id_curso_selecionado, PDO::PARAM_INT);
$stmt_conteudo->execute();

if ($stmt_conteudo === false) {
    die("Erro na execução da consulta: " . $conn->errorInfo()[2]);
}

// Montar a lista de conteúdos
$conteudos = '';
$titulo_curso_atual = '';

if ($stmt_conteudo->rowCount() > 0) {
    while ($row_conteudo = $stmt_conteudo->fetch(PDO::FETCH_ASSOC)) {
        if ($titulo_curso_atual !== $row_conteudo["titulo_curso"]) {
            $titulo_curso_atual = $row_conteudo["titulo_curso"];
            $conteudos .= '<br><div class="curso">' . htmlspecialchars($titulo_curso_atual) . '</div>';
        }
        $conteudos .= '
<div class="conteudo-inner">
    <div class="conteudo-right">
        <div class="titulo">' . htmlspecialchars($row_conteudo["titulo_conteudo"]) . '</div>
        <div class="descricao">' . htmlspecialchars($row_conteudo["descricao"]) . '</div>
        <!-- Adicione o formulário para enviar o ID do conteúdo -->
        <form action="enviar.php" method="GET">
            <input type="hidden" name="id_conteudo" value="' . htmlspecialchars($row_conteudo['id_conteudo']) . '">
            <button class="butto" type="submit">Adicionar</button>
        </form>
    </div>
</div>';
    }
} else {
    $mensagem = "Nenhum conteúdo encontrado.";
}

// Fechar a conexão
$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso</title>
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/listaconteudo.css">
</head>
<body>

<div class="borda">
    <div class="conteudo">
        <?php echo isset($mensagem) ? $mensagem : $conteudos; ?>
    </div>
    <br>
</div>

<nav id="slide-menu">
    <ul>
        <li><a href="home.php"><img class="navb" src="img/home.png"></a></li>
        <li><a href="linhadtempo.php"><img class="navb" src="img/ltd.png"></a></li>
        <li><a href="cursos.php"><img class="navb" src="img/curso.png"></a></li>
        <li><a href="calen.php"><img class="navb" src="img/calen.png"></a></li>
        <li><a href="index.php"><img class="navb" src="img/rem.png"></a></li>
    </ul>
</nav>

<!-- Content -->
<div id="content">
    <div class="menu-trigger"></div>
</div>

<script src="curD.js"></script>

</body>
</html>
