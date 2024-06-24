<?php
session_start();

if (!isset($_SESSION['idUL'])) {
    header("Location: login.php");
    exit();
}

$required_access_level = 'Administrador';
$required_access_level2 = 'Professor';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Moodly');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prevent SQL injection using prepared statements
$sql = "SELECT id_curso, titulo_curso, descricao_curso FROM Curso";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/cursos.css">
    <title>Cursos</title>
</head>
<body>
    <div class="cursos">
        <?php
        if ($result->num_rows > 0) {
            echo "<h2>Cursos</h2>";
            echo "<div class='linha'></div>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='curso' onclick='location.href=\"listaratividades.php?id_curso=" . htmlspecialchars($row["id_curso"]) . "\";'>";
                echo "<h3>" . htmlspecialchars($row["titulo_curso"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["descricao_curso"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum curso encontrado.</p>";
        }
        ?>
    </div>

    <nav id="slide-menu">
	<ul>
		<li><a href="home.php"><img class="navb" src="img/home.png"></a></li>
		<li><a href="linhadtempo.php"><img class="navb" src="img/ltd.png"></a></li>
		<li><img class="navbO" src="img/curso.png"></li>
		<li><a href="calen.php"><img class="navb" src="img/calen.png"></a></li>
		<li><a href="index.php"><img class="navb" src="img/rem.png"></a></li>
	</ul>
    </nav>
<!-- Content -->
<div id="content">
	<div class="menu-trigger"></div>
</div>

    <script src="cur.js"></script>

    <?php
// Verifique se o usuário NÃO tem o nível de acesso necessário
if (!isset($_SESSION['acessoUL']) || $_SESSION['acessoUL'] !== $required_access_level) {
    // Exiba uma mensagem ou nada se o usuário não tiver o nível de acesso necessário
    echo '';
} else {
    // Exiba o botão se o usuário tiver o nível de acesso necessário
    echo '<a href="registro_curso.php" tabindex="0" class="plusButton">
  <svg class="plusIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
    <g mask="url(#mask0_21_345)">
      <path d="M13.75 23.75V16.25H6.25V13.75H13.75V6.25H16.25V13.75H23.75V16.25H16.25V23.75H13.75Z"></path>
    </g>
  </svg>
</a>';
}
?>

<?php
if (!isset($_SESSION['acessoUL']) || $_SESSION['acessoUL'] !== $required_access_level2) {
    // Exiba uma mensagem ou nada se o usuário não tiver o nível de acesso necessário
    echo '';
} else {
    // Exiba o botão se o usuário tiver o nível de acesso necessário
    echo '<a href="registro_conteudo.php" tabindex="0" class="plusButton">
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
<?php
$stmt->close();
$conn->close();
?>
