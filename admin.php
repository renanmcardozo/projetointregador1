<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/admin.css">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="intro"><h1>Editar Usuário</h1></div>
    <div class="espaco"></div>
    <?php
    // Verifica se o ID do usuário foi fornecido na URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Conexão com o banco de dados
        $conexao = new mysqli("localhost", "root", "", "Moodly");
        
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }
        
        // Consulta SQL para selecionar o usuário com o ID fornecido
        $sql = "SELECT id_usuario, nome, email, apelido, acesso FROM Usuario WHERE id_usuario = $id";
        $resultado = $conexao->query($sql);
        
        // Verifica se a consulta retornou algum resultado
        if ($resultado->num_rows > 0) {
            // Exibe o formulário de edição com os detalhes do usuário
            $row = $resultado->fetch_assoc();
            ?>
            <form action="atualizar_usuario.php" method="post">
                <div class="formt">
                <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" class="inputs" value="<?php echo $row['nome']; ?>"><br>
                <label for="email">Email:</label><br>
                <input type="text" name="email" id="email" class="inputs" value="<?php echo $row['email']; ?>"><br>
                <label for="apelido">Apelido:</label><br>
                <input type="text" name="apelido" id="apelido" class="inputs" value="<?php echo $row['apelido']; ?>"><br>
                <label for="acesso">Acesso:</label><br>
                <select class="inputs" id="acesso" name="acesso">
                    <option value="Aluno" <?php if($row['acesso'] == 'Aluno') echo 'selected'; ?>>Aluno</option>
                    <option value="Professor" <?php if($row['acesso'] == 'Professor') echo 'selected'; ?>>Professor</option>
                    <option value="Administrador" <?php if($row['acesso'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                </select><br><br>
                <div class="botoes">
                    <input class="butto" type="submit" value="Salvar">
                    <button class="butto"><a class="dude" href="listarusuario.php">Voltar</a></button>
                </div>
                </div>
            </form>
            <?php
        } else {
            echo "Usuário não encontrado.";
        }
        
        // Fecha a conexão com o banco de dados
        $conexao->close();
    } else {
        echo "ID do usuário não fornecido.";
    }
    ?>
</body>
</html>
