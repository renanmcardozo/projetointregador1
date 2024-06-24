<?php
if(isset($_GET['id'])){
    try{
        $id=$_GET['id'];
        require_once("conexao.php");
        $sql = "Select * from Usuario where id=".$id;
        $dados = $conn->query($sql);
        while($registros = $dados->fetch(PDO::FETCH_ASSOC)) {       
?>
            <form action="atualizarUsuario.php" method="post">
                <input type="hidden" name="id" 
                value="<?php echo $registros['id']; ?>">
                <label for="nome">Nome</label><br>
                <input type="text" name="nome" 
                value="<?php echo $registros['nome']; ?>"><br>
                <label for="email">E-mail</label><br>
                <input type="email" name="email"
                value="<?php echo $registros['email']; ?>"><br>
                <label for="senha">Senha</label><br>
                <input type="password" name="senha"
                value="<?php echo $registros['senha']; ?>"><br>
                <input type="submit" value="Atualizar">
                <input type="reset" value="Limpar">
            </form>
    <?php
        }//FIM DO WHILE
    }catch(Exception $erro){
        echo "<p>Erro:".$erro->getMessage();
    }
}else{
echo "<p>Selecione um registro.</p>";
}

?>
</body>
</html>