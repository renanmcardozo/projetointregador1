<?php
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

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resposta = intval($_POST['id_resposta']);
    $nota = floatval($_POST['nota']);

    // Atualizar a nota na tabela Respostas
    $sql = "UPDATE Respostas SET nota = ?, status = 'Corrigido' WHERE id_resposta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $nota, $id_resposta);

    if ($stmt->execute()) {
        // Redirecionar de volta para a lista de respostas
        header("Location: listar_respostas.php");
        exit;
    } else {
        echo "Erro ao atualizar a nota: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
