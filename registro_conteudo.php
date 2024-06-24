<?php
session_start();

if (!isset($_SESSION['acessoUL']) || $_SESSION['acessoUL'] !== 'Professor') {
    // Redirecionar para página de login ou mostrar mensagem de erro
    header("Location: index.php");
    exit;
}

$id_professor = $_SESSION['idUL'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/registrocurso.css">
    <title>Registrar Conteúdo</title>
</head>
<body>
    
    <form class="container2" action="" method="post">
    <h2>Registrar um novo conteúdo</h2>
        <label for="titulo_conteudo">Título do Conteúdo:</label>
        <input class="texto" type="text" id="titulo_conteudo" name="titulo_conteudo" required><br><br>
        
        <label class="espaco" for="descricao">Descrição:</label>
        <textarea class="texto" id="descricao" name="descricao" required></textarea><br><br>
        
        <!-- <label for="status">Status:</label>
        <input type="text" id="status" name="status"><br><br> -->
        
        <!-- <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Atividade">Atividade</option>
        </select><br><br> -->
        
        <label class="espaco" for="data_final">Data Final:</label>
        <input class="texto" type="date" id="data_final" name="data_final"><br><br>
        
        <label class="teste">ID do Curso:</label><br>
        <?php
        require_once("conexao.php");

        // Consulta para selecionar apenas os cursos do professor logado
        $sql = "SELECT id_curso, titulo_curso FROM Curso WHERE id_professor_responsavel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_professor]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            foreach ($result as $row) {
                echo '<input class="teste" type="checkbox" name="id_curso[]" value="' . $row['id_curso'] . '"> ' . $row['titulo_curso'] . '<br>';
            }
        } else {
            echo "Nenhum curso encontrado.";
        }
        ?>
        <br><br>
        
        <input class="doido2" type="submit" name="submit" value="Registrar">
        <a href="cursos.php">Voltar</a>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("conexao.php");

        // Dados do formulário
        $titulo_conteudo = $_POST['titulo_conteudo'];
        $descricao = $_POST['descricao'];
        // $status = $_POST['status'];
        // $tipo = $_POST['tipo'];
        $status = 'Ativo';
        $tipo = 'Atividade';
        $data_final = $_POST['data_final'];
        $id_cursos = $_POST['id_curso'];

        foreach ($id_cursos as $id_curso) {
            // SQL para inserir os dados
            $sql = "INSERT INTO Conteudo (titulo_conteudo, descricao, status, tipo, data_final, id_curso)
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$titulo_conteudo, $descricao, $status, $tipo, $data_final, $id_curso]);
            
            // Executar a inserção
            if ($stmt->rowCount() > 0) {
               echo "<script>window.alert('Conteúdo registrado com sucesso!');
        window.location.href='cursos.php'</script>";
            } else {
                echo "Erro ao registrar conteúdo para o curso $id_curso: " . $stmt->errorInfo()[2] . "<br>";
            }
        }

        // Fechar a conexão
        $conn = null;
    }
    ?>
</body>
</html>