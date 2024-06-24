<?php
session_start();

require_once("conexao.php");

// Verifica se o usuário está autenticado e se é um administrador
if (!isset($_SESSION['idUL']) || $_SESSION['acessoUL'] !== 'Administrador') {
    header('Location: login.php');
    exit;
}

try {
    // Consulta para obter a lista de usuários
    $sql = "SELECT id_usuario, nome, email, acesso FROM Usuario";
    $result = $conn->query($sql);

    // Verifica se a consulta retornou alguma linha
    if ($result->rowCount() > 0) {
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="website icon" type="png" href="img/d.png">
    <title>Administração de Usuários</title>
</head>
<body>
    <h1>Administração de Usuários</h1>
    <p>Bem-vindo, <?php echo $_SESSION['nomeUL']; ?>!</p>
    <hr>

    <h2>Lista de Usuários</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Acesso</th>
            <th>Ação</th>
        </tr>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_usuario'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['acesso'] . "</td>";
                echo "<td><a href='editar_usuario.php?id=" . $row['id_usuario'] . "'>Editar</a></td>";
                echo "</tr>";
            }
        ?>
    </table>

    <hr>
    <p><a href="home.php">Sair</a></p>
</body>
</html>

<?php
    } else {
        echo "Nenhum usuário encontrado.";
    }
} catch (Exception $e) {
    // Trate o erro conforme necessário
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>
