<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <center>
    <title>Consultar Usuários</title>

    <!-- Funcao excluir pelo javascript -->
    <script>
        // Passa o id do usuário para a exclusão através da função javascript excluir
        function excluir(id) {
            if (confirm('deseja realmente excluir este Usuário ?')) {
                location.href = 'excluir.php?id=' + id;
                // irá para a lógica de excluir Aluno
            } // fecha o if

        } // termina a função excluir
    </script>
</head>

<body class="consulta">

    <header>
    <a href="index.php">LOGIN</a></n></n>

    <a href="consultar.php">CONSULTAR USUÁRIOS</a>
    </header>
   
    <div class= "grupo">
    <h2 class="titulo">SENAC ESCOLA</h2>

    <h3 class="titulos">Consultar Usuários</h3>

    <form action="consultar.php" method="get">

        Nome: <input type="text" required name="nome" /></br>
        <input type="submit" class="button5" value="Buscar" />
        <input type="reset" class="button5" +value="Limpar Campos" />
    </form>
    </div>
    <?php
    // Executa a conexao com o mysql e selecionar a base
    include_once 'conect.cfg';

    //pega o nome que será recebido via GET
    if (isset($_GET["nome"])) {
        if ($_GET["nome"] != "") {
            $nome = $_GET["nome"];

            // instrucao sql para selecionar somente aquele registro que inicie com a string digitada e completa o restante encontrado através do coringa %      
            $sql = "select * from  estudantes where nome like '$nome%' ";
            

            //Faz a conexao e executa a instrucao carregada na varivael $sql e os envia para o banco mysql.
            $resultado = mysqli_query($con, $sql);

            // Verifica Se existe algum registro
            if (mysqli_num_rows($resultado) > 0) {

    ?>
                <br><br>
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Disciplina cadastrada</th>

                    </tr>
                    <?php
                    // Enquanto encontrar uma linha no banco recarrega o conteúdo.
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <td><?php echo $row["nome"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <?php
                            // Verifica o perfil do usuario 0 Aluno, 1 Professor e 2 Coordenador e sera passado para variavel $p o valor correspondente
                            switch ($row["perfil"]) {
                                case 2:
                                    $p = "Coordenador";
                                    break;
                                case 1:
                                    $p = "Professor";
                                    break;
                                case 0:
                                    $p = "Aluno";
                                    break;
                            }
                            ?>

                            <td><?php echo $p; ?></td>
                            <td>
                            <?php
                        $sql_dic = "SELECT * FROM  disciplina WHERE fk_id=".$row['id'];
                        $res_dic = mysqli_query($con, $sql_dic);
                        if (mysqli_num_rows($res_dic) > 0) {
                            while ($row_dic = mysqli_fetch_array($res_dic)) {
                                    echo $row_dic['nome'].'<br/>';                               
                            }
                        }
                        ?>

                            </td>
                            <td>
                            <td>
                              
           <form method="post" action="cad-disc.php">  </br>
           <input name="id" value="<?php echo $row["id"]; ?>" hidden>                       
                                    <select name="disciplina" id="perfil" class="browser-default custom-select">
         <option value="Java" selected="selected">Java</option> 
         <option value="Php">Php</option>
         <option value="JavaScript">JavaScript</option>
         <option value="HTML">HTML</option>
         <option value="Python">Python</option>

           </select>
           <button>Adicionar Disciplina</button>
           <!-- Passa o id do usuário para a função javascript excluir-->
           <a href="#" onclick="excluir(<?php echo $row["id"]; ?>)">
                      <button>Excluir</button></a>
                                          
                        </form>
                            </td>
                        </tr>
                    <?php
                    }

                    ?>
                </table>

    <?php
            } else {
                // Exibe a menssagem nenhum registro encontrado
                echo "Nenhum registro encontrado";
            }
            // Fecha a conexao com o banco
            mysqli_close($con);
        }
    }
    ?>

    
    <footer> 
        <h5>Contatos:</h5>
        <h5>Email:senacescola123@senac.com</h5>
        <h5>Telefone:(21) 2603-1026</h5>
    </footer>
    

</body>

</html>