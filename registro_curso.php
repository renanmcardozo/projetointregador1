<!DOCTYPE html>
<html>
<head>
    <title>Registro de Curso</title>
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" type="text/css" href="css/registrocurso.css">
</head>
<body>
    <div class="container1">
        <h2>Registrar um novo curso</h2>
        <form action="processa_registro.php" method="post">
            <label  for="titulo_curso">Título do Curso:</label>
            <input class="texto" type="text" id="titulo_curso" name="titulo_curso" required><br><br>
            
            <label class="espaco" for="descricao_curso">Descrição do Curso:</label>
            <textarea class="texto" id="descricao_curso" name="descricao_curso" required></textarea><br><br>
            
            <label class="espaco" for="dataInicio">Data de Início:</label>
            <input class="texto" type="date" id="dataInicio" name="dataInicio" required><br><br>
            
            <label class="espaco" for="dataFim">Data de Fim:</label>
            <input class="texto" type="date" id="dataFim" name="dataFim" required><br><br>
            
            <label class="espaco" for="professor_responsavel">Professor Responsável:</label>
            <select class="texto" id="professor_responsavel" name="professor_responsavel" required>
                <option value=""> - - - - - </option>
                <?php
                include 'conexao.php';

                try {
                    $sql = "SELECT id_usuario, nome FROM Usuario WHERE acesso = 'Professor'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($professores) {
                        foreach ($professores as $professor) {
                            echo "<option value='".$professor['id_usuario']."'>".$professor['nome']."</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum professor encontrado</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>
            </select><br><br>
            
            <label class="teste" for="usuarios">Alunos:</label><br>
            <?php
            try {
                $sql = "SELECT id_usuario, nome FROM Usuario WHERE acesso = 'Aluno'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($alunos) {
                    foreach ($alunos as $aluno) {
                        echo "<input type='checkbox' name='usuarios[]' value='".$aluno['id_usuario']."'>".$aluno['nome']."<br>";
                    }
                } else {
                    echo "Nenhum aluno encontrado.";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
            <br>
            <input class="doido" type="submit" value="Registrar Curso">
            <a href="cursos.php">Voltar</a>
        </form>
    </div>

</body>
</html>
