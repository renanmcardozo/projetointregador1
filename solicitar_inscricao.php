<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUL'])) {
    header("Location: index.php");
    exit;
}

// Obtenha o ID do usuário e o ID do curso do formulário
$id_usuario = $_POST['id_usuario'];
$id_curso = $_POST['id_curso'];

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Moodly";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Insira a solicitação de inscrição no banco de dados
$sql = "INSERT INTO SolicitarInscricao (id_usuario, id_curso, data_solicitacao) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_usuario, $id_curso);

if ($stmt->execute()) {
    echo "<script>
            window.alert('Solicitação de inscrição enviada com sucesso!');
            window.location.href = document.referrer; // Redireciona para a página anterior
          </script>";
} else {
    echo "<script>
            window.alert('Erro ao enviar a solicitação de inscrição.');
            window.history.back();
          </script>";
}

$stmt->close();
$conn->close();
?>
