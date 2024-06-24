<?php
session_start();

if (!isset($_SESSION['idUL'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit(); // Stop further execution
}

// Database connection (replace with your own connection details)
$conn = new mysqli('localhost', 'root', '', 'Moodly');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for timeline contents
$sql_timeline = "
    SELECT c.titulo_conteudo, c.descricao, c.data_final, cr.titulo_curso 
    FROM Conteudo c
    JOIN Curso cr ON c.id_curso = cr.id_curso
    JOIN Inscricao i ON i.id_curso = cr.id_curso
    WHERE i.id_usuario = ?
";

$stmt_timeline = $conn->prepare($sql_timeline);
$stmt_timeline->bind_param("i", $_SESSION['idUL']);
$stmt_timeline->execute();
$result_timeline = $stmt_timeline->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/linhadtempo.css">
    <title>Linha do Tempo</title>
</head>
<body>
    <div class="timeline">
        <h4 class="titulotm">Linha do Tempo</h4>
        <div class="linha"></div>
        <?php
        if ($result_timeline->num_rows > 0) {
            while ($row = $result_timeline->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h3 class='titulo-conteudo'>" . htmlspecialchars($row["titulo_conteudo"]) . "</h3>";
                echo "<p class='data-conteudo'><a>Data final:</a> " . htmlspecialchars($row["data_final"]) . "</p>";
                echo "<p class='titulocurso-conteudo'><a>Curso:</a> " . htmlspecialchars($row["titulo_curso"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhuma atividade requer atenção...</p>";
        }
        $stmt_timeline->close();
        $conn->close();
        ?>
    </div>
    
    <nav id="slide-menu">
	<ul>
		<li><a href="home.php"><img class="navb" src="img/home.png"></a></li>
		<li><img class="navbO" src="img/ltd.png"></li>
		<li><a href="cursos.php"><img class="navb" src="img/curso.png"></a></li>
		<li><a href="calen.php"><img class="navb" src="img/calen.png"></a></li>
		<li><a href="index.php"><img class="navb" src="img/rem.png"></a></li>
	</ul>
    </nav>
<!-- Content -->
<div id="content">
	<div class="menu-trigger"></div>
</div>

    <script src="tempo.js"></script>

</body>
</html>
