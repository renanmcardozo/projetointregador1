<?php

try {
    if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"])){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        
        // Conexão com o banco de dados
        require_once("conexao.php");
        
        // Consulta preparada para inserir usuário
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $email, $senha]);
        
        // Redirecionamento após cadastro bem sucedido
        echo "<script>window.alert('Cadastro feito com sucesso!');
        window.location.href='index.php'</script>";
    } else {
        echo "Volte para a página de cadastro!";
    }
} catch(Exception $e) {
    // Em caso de erro, exibir mensagem
    echo "Erro ao cadastrar usuário: " . $e->getMessage();
}

// Fechar conexão com o banco de dados
$conn = null;

?>
