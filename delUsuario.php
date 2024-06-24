<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Moodly";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inicializa a variável de resposta
$response = array("success" => true, "message" => "");

// Verifica se foi passado um ID válido via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // ID do usuário a ser excluído
    $id_usuario = $_GET['id'];

    // Prepara a consulta SQL para excluir o usuário
    $sql = "DELETE FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $response["success"] = false;
        $response["message"] = "Erro na preparação da consulta: " . $conn->error;
    } else {
        $stmt->bind_param("i", $id_usuario);

        // Executa a consulta
        if ($stmt->execute()) {
            $response["message"] = "Usuário excluído com sucesso.";
        } else {
            $response["success"] = false;
            $response["message"] = "Erro ao tentar excluir o usuário: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    }
} else {
    $response["success"] = false;
    $response["message"] = "ID de usuário inválido.";
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna a resposta em formato JSON
echo json_encode($response);
?>