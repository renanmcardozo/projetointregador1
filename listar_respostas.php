<?php
session_start();

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

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idUL'])) {
    header("Location: index.php");
    exit;
}

$id_usuario = $_SESSION['idUL'];

// Consulta para obter as respostas enviadas
$sql = "SELECT r.id_resposta, r.envio_atividade, r.data_envio, r.status, r.nota, c.titulo_conteudo, r.envio_arquivo
        FROM Respostas r
        INNER JOIN Conteudo c ON r.id_conteudo = c.id_conteudo
        INNER JOIN Curso cur ON c.id_curso = cur.id_curso
        WHERE cur.id_professor_responsavel = ?
        ORDER BY r.data_envio DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Erro na execução da consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Respostas</title>
    <link rel="stylesheet" href="css/listarrespostas.css">
</head>
<body>
    <div class="borda">
        <div class="nomerespostas">Respostas Enviadas</div>
        
        <div class="conteudo">
            <?php
            // Verificar se há resultados da consulta
            if ($result->num_rows > 0) {
                // Loop através de cada linha de resultado
                while($row = $result->fetch_assoc()) {
                    ?>
                    <!-- Exibir cada resposta -->
                    <div class="resposta-inner">
                        <div class="resposta-left">
                            <div class="titulo_conteudo"><?php echo htmlspecialchars($row["titulo_conteudo"]); ?></div>
                            <?php
                            if ($row['envio_arquivo']) {
                                // Exibir a imagem
                                $imagem = base64_encode($row['envio_arquivo']);
                                echo '<img src="data:image/jpeg;base64,' . $imagem . '" alt="Imagem da atividade" class="imagem-atividade">';
                            } else {
                                echo '<div class="sem-imagem">Sem imagem</div>';
                            }
                            ?>
                        </div>
                        <div class="resposta-right">
                            <div class="envio_atividade"><?php echo nl2br(htmlspecialchars($row["envio_atividade"])); ?></div>
                            <div class="data_envio"><?php echo htmlspecialchars($row["data_envio"]); ?></div>
                            <div class="status"><?php echo htmlspecialchars($row["status"]); ?></div>
                            <div class="nota"><?php echo htmlspecialchars($row["nota"]); ?></div>
                            <!-- Formulário para adicionar a nota -->
                            <form action="adicionar_nota.php" method="POST">
                                <input type="hidden" name="id_resposta" value="<?php echo htmlspecialchars($row['id_resposta']); ?>">
                                <label for="nota">Nota:</label>
                                <input type="number" name="nota" min="0" max="10" step="0.01" required>
                                <button type="submit">Adicionar Nota</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Nenhuma resposta encontrada.";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
