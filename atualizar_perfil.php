<?php

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["nomeUL"])) {
    // Redireciona para a página de login, por exemplo
    header("Location: index.php");
    exit();
}

// Conexão com o banco de dados (substitua pelos seus detalhes de conexão)
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

// Inicializa as variáveis
$response = array("success" => true, "message" => "Perfil atualizado com sucesso!");

$img_src = isset($_POST['img_src']) ? $_POST['img_src'] : '';
$apelido = isset($_POST['apelido']) ? $_POST['apelido'] : '';
$nome_usuario = isset($_SESSION['nomeUL']) ? $_SESSION['nomeUL'] : '';

if (empty($nome_usuario)) {
    $response["success"] = false;
    $response["message"] = "Usuário não autenticado.";
    echo json_encode($response);
    exit();
}

if (!empty($img_src)) {
    $stmt = $conn->prepare("UPDATE usuario SET imagem_usuario = ? WHERE nome = ?");
    if ($stmt === false) {
        $response["success"] = false;
        $response["message"] = "Erro na preparação da consulta: " . $conn->error;
    } else {
        $stmt->bind_param("ss", $img_src, $nome_usuario);
        if (!$stmt->execute()) {
            $response["success"] = false;
            $response["message"] = "Erro ao atualizar a imagem do perfil: " . $stmt->error;
        } else {
            $_SESSION['imagemUL'] = $img_src;
        }
        $stmt->close();
    }
}

if (!empty($apelido)) {
    $stmt = $conn->prepare("UPDATE usuario SET apelido = ? WHERE nome = ?");
    if ($stmt === false) {
        $response["success"] = false;
        $response["message"] = "Erro na preparação da consulta: " . $conn->error;
    } else {
        $stmt->bind_param("ss", $apelido, $nome_usuario);
        if (!$stmt->execute()) {
            $response["success"] = false;
            $response["message"] = "Erro ao atualizar o apelido do perfil: " . $stmt->error;
        } else {
            $_SESSION['apelidoUL'] = $apelido;
        }
        $stmt->close();
    }
}

$conn->close();
echo json_encode($response);
?>