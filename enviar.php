<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUL'])) {
    header("Location: index.php");
    exit;
}

$id_usuario_logado = $_SESSION['idUL'];

// Conexão com o banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "Moodly"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter os dados enviados pelo formulário
$id_conteudo = isset($_GET['id_conteudo']) ? intval($_GET['id_conteudo']) : 0;

// Obter o id_curso a partir do id_conteudo
$sql_curso = "SELECT id_curso FROM Conteudo WHERE id_conteudo = ?";
$stmt_curso = $conn->prepare($sql_curso);
$stmt_curso->bind_param("i", $id_conteudo);
$stmt_curso->execute();
$result_curso = $stmt_curso->get_result();
$id_curso = $result_curso->fetch_assoc()['id_curso'];

$stmt_curso->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <title>Enviar Resposta</title>
    <link rel="stylesheet" href="css/enviar.css">
</head>
<body>
    <div class="borda">
        <div class="titu">Resposta</div>
        
        <div class="conteudo">
            <!-- Formulário para enviar a resposta -->
            <form action="processar_envio.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_conteudo" value="<?php echo htmlspecialchars($id_conteudo); ?>">
                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario_logado); ?>">
                <div class="input-wrapper">
                    <textarea class="texto" name="envio_atividade"></textarea><br>
                    <label for="arquivo">Enviar arquivo</label>
                    <input type="file" name="envio_arquivo" id="arquivo"><br>
                    <button class="butto" type="submit">Enviar</button>
                </div>
            </form>
        </div>
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

    <script src="env.js"></script>
</body>
</html>
