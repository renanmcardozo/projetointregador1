<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if(isset($_POST['id_usuario'], $_POST['nome'], $_POST['email'], $_POST['apelido'], $_POST['acesso'])) {
        // Obtém os dados do formulário
        $id_usuario = $_POST['id_usuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $apelido = $_POST['apelido'];
        $acesso = $_POST['acesso'];
        
        // Conexão com o banco de dados
        $conexao = new mysqli("localhost", "root", "", "Moodly");
        
        // Verifica se a conexão foi estabelecida com sucesso
        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
        }
        
        // Prepara a consulta SQL para atualizar o usuário
        $sql = "UPDATE Usuario SET nome=?, email=?, apelido=?, acesso=? WHERE id_usuario=?";
        
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);
        
        // Verifica se a declaração foi preparada com sucesso
        if ($stmt === false) {
            die("Erro na preparação da declaração: " . $conexao->error);
        }
        
        // Associa os parâmetros à declaração SQL
        $stmt->bind_param("ssssi", $nome, $email, $apelido, $acesso, $id_usuario);
        
        // Executa a declaração SQL
        if ($stmt->execute()) {
            // Redireciona de volta para a página de listagem
            header("Location: listarusuario.php");
            exit; // Termina o script após o redirecionamento
        } else {
            echo "Erro ao atualizar o usuário: " . $stmt->error;
        }
        
        // Fecha a declaração e a conexão com o banco de dados
        $stmt->close();
        $conexao->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "O formulário não foi enviado.";
}
?>
