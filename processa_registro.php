<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_curso = $_POST['titulo_curso'];
    $descricao_curso = $_POST['descricao_curso'];
    $dataInicio = $_POST['dataInicio'];
    $dataFim = $_POST['dataFim'];
    $professor_responsavel = $_POST['professor_responsavel'];
    $usuarios = $_POST['usuarios'];

    try {
        // Inicia uma transação
        $conn->beginTransaction();

        // Insere o curso na tabela Curso
        $sql = "INSERT INTO Curso (titulo_curso, descricao_curso, dataInicio, dataFim, id_professor_responsavel) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo_curso, $descricao_curso, $dataInicio, $dataFim, $professor_responsavel]);

        // Obtém o ID do curso recém-inserido
        $id_curso = $conn->lastInsertId();

        // Insere o professor responsável na tabela Inscricao
        $sql = "INSERT INTO Inscricao (id_curso, id_usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_curso, $professor_responsavel]);

        // Insere os alunos na tabela Inscricao
        $sql = "INSERT INTO Inscricao (id_curso, id_usuario) VALUES ";
        $params = [];

        foreach ($usuarios as $id_usuario) {
            $params[] = "($id_curso, $id_usuario)";
        }

        $sql .= implode(',', $params);
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Confirma a transação
        $conn->commit();

        echo "Curso registrado com sucesso!";
    } catch (PDOException $e) {
        // Reverte a transação em caso de erro
        $conn->rollBack();
        echo "Erro ao registrar o curso: " . $e->getMessage();
    }
}
?>
