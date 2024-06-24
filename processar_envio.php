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

// Obter os dados enviados pelo formulário
$id_conteudo = isset($_POST['id_conteudo']) ? intval($_POST['id_conteudo']) : 0;
$id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0; // Assumindo que o id_usuario será enviado também
$envio_atividade = isset($_POST['envio_atividade']) ? $_POST['envio_atividade'] : '';
$envio_arquivo = isset($_FILES['envio_arquivo']) ? $_FILES['envio_arquivo'] : null;

// Preparar o arquivo para ser salvo no banco de dados
$arquivo_blob = null;
if ($envio_arquivo && $envio_arquivo['error'] == 0) {
    $arquivo_blob = file_get_contents($envio_arquivo['tmp_name']);
}

// Obter o id_curso a partir do id_conteudo
$sql_curso = "SELECT id_curso FROM Conteudo WHERE id_conteudo = ?";
$stmt_curso = $conn->prepare($sql_curso);
$stmt_curso->bind_param("i", $id_conteudo);
$stmt_curso->execute();
$result_curso = $stmt_curso->get_result();
$id_curso = $result_curso->fetch_assoc()['id_curso'];

$stmt_curso->close();

// Inserir a resposta no banco de dados
$sql = "INSERT INTO Respostas (envio_atividade, envio_arquivo, status, id_curso, id_conteudo, id_usuario) VALUES (?, ?, 'Enviado', ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiii", $envio_atividade, $arquivo_blob, $id_curso, $id_conteudo, $id_usuario);

if ($stmt->execute()) {
    echo "<script>
    window.alert('Mensagem enviada com sucesso!');
    window.history.back();
</script>";
} else {
    echo "Erro ao enviar a resposta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
