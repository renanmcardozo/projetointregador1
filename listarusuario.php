<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="img/d.png">
    <link rel="stylesheet" href="css/admin.css">
    <title>Listagem de Usuários</title>
</head>
<body>
    <!-- <h1>Listagem de Usuários</h1> -->
    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Apelido</th>
                    <th>Acesso</th>
                    <th >Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados
                $conexao = new mysqli("localhost", "root", "", "Moodly");
                
                // Verifica se a conexão foi estabelecida com sucesso
                if ($conexao->connect_error) {
                    die("Erro de conexão: " . $conexao->connect_error);
                }
                
                // Consulta SQL para selecionar todos os usuários
                $sql = "SELECT id_usuario, nome, email, apelido, acesso FROM Usuario";
                $resultado = $conexao->query($sql);
                
                // Verifica se a consulta retornou algum resultado
                if ($resultado->num_rows > 0) {
                    // Itera sobre os resultados e exibe cada usuário na tabela
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_usuario"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        if (!empty($row["apelido"])) {
                            echo "<td>" . $row["apelido"] . "</td>";
                        } else {
                            echo "<td class='empty-field'>Vazio</td>";
                        }
                        echo "<td>" . $row["acesso"] . "</td>";
                        // Adiciona um link para a página de edição com o ID do usuário como parâmetro na URL
                        echo "<td class='teste'><a href='admin.php?id=" . $row["id_usuario"] . "'>Editar</a><a> /</a><a href='delUsuario.php?id=" . $row["id_usuario"] . "' class='excluir-link'> Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
                }
                
                // Fecha a conexão com o banco de dados
                $conexao->close();
                ?>
            </tbody>
        </table>
        <div class="alert"></div>
        <div class="alert-success"></div>
    </div>

    <nav id="slide-menu">
	<ul>
		<li><a href="home.php"><img class="navb" src="img/home.png"></a></li>
		<li><a href="linhadtempo.php"><img class="navb" src="img/ltd.png"></a></li>
		<li><a href="cursos.php"><img class="navb" src="img/curso.png"></a></li>
		<li><a href="calen.php"><img class="navb" src="img/calen.png"></a></li>
		<li><a href="index.php"><img class="navb" src="img/rem.png"></a></li>
	</ul>
    </nav>
<!-- Content -->
<div id="content">
	<div class="menu-trigger"></div>
</div>

    <script src="del.js"></script>
</body>
</html>
