<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="cadastro">

    <?php
    // Executa a conexao com o mysql e selecionar a base
    include_once 'conect.cfg';

    session_start(); //faz o arquivo iniciar a sessao com o browser

    // pega dados via POST
    // Recebe o valo do email
    $email = $_POST["email"];
    // Recebe o valo do email
    $senha = $_POST["senha"];
    // Converte a senha em um hash criptografado de MD5
    $senha = md5($senha);

    //montar a instrução para ir ao banco
    //e selecionar o usuario que tenha este email
    $sql = "select * from estudantes where email = '$email' AND senha = '$senha' ";
    

    //executar conexao e roda a query sql
    $resultado = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultado) == 1) {

        // Variavel $row recebe o conteudo do array gerado pelo banco
        $row = mysqli_fetch_array($resultado);
        //enviar dados recebidos do banco de dados para a sessão iniciada
        $_SESSION["email"] = $row["email"];
        $_SESSION["perfil"] = $row["perfil"]; 
        $_SESSION["nome"] = $row["nome"]; 
        $_SESSION["tempo"] = time();

        //econtrou
        //vou redirecionar o usuario para a pasta do sistema
        if ($_SESSION["perfil"] == "2") {
            //$logado = $conteudo_adm ;
            // Cria o formulario cadastrar e Alterar Senha
            echo '
            <header>
            <center>
            <a href="consultar.php">Consultar Usuário</a>  
             <a href="logout.php">Logout</a> </a> 
            </header>

            <center>
            <div class="titulos"><h1>Cadastrar</h1> </div>
                 <form class="form2" action="cad_usuario.php" method="post">
                 Nome:
                          <input type="text" name="nome" id="nome" required></br>
                 Email:
                          <input type="text" name="email" id="email"  required></br>
                      Senha:
                          <input type="password"  name="senha" id="senha"  required></br>
           
            
            <form method="get" action=".">
        <label class="">Cep:
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" /></label><br />
        <label>Rua:
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="estado" type="text" id="estado" size="2" /></label><br />
           
            
        <span >Perfil:</span>
        					
         <select name="perfil" id="perfil" class="browser-default custom-select">
         <option value="0" selected="selected">Aluno</option> 
         <option value="1">Professor</option>
         <option value="2">Coordenador</option>
           </select>

        </br></br><button class="button2" type="submit" >Cadastrar</button></br>   
      </form>
                   					
                    
      </form>        
                                    
                 
                 <form class="form3" action="alt_senha.php" method="post">
                 <h1 class="titulos">Alterar Senha</h1>
                 
                 Email:
                          <input type="text" name="email" id="email"   required></br>
                      Senha:
                          <input type="password"  name="senha" id="senha"  required></br>
                          		
                        <button class="button3" type="submit" >Alterar</button>                     
                </form>
                <center>            

                ';
        }
        // Verifica a seção de acordo com o perfíl
        if ($_SESSION["perfil"] == "1") {
            // Variavel $e recebe a linha contendo o email do usuario carregado pelo banco
            $e = $row["email"];
            echo '<center>
            <h1 class="titulos">Perfil de Professor</h1>
                 <form class="form6" action="alt_senha.php" method="post"> 
                     Email:';
            echo "<input type='text' name='email' id='email' readonly='true' value='$e'";
            echo "required>";
            echo '     </br>Senha:
                          <input type="password"  name="senha" id="senha"  required>
                          		
                        </br><button class="button6" type="submit" >Alterar</button>                     
                </form>';
        }
        // Verifica a seção de acordo com o perfíl
        if ($_SESSION["perfil"] == "0") {
            // Variavel $e recebe a linha contendo o email do usuario carregado pelo banco
            $e = $row["email"];
            echo '<center>
                     <form class="form5" action="alt_senha.php" method="post"> 
                     <h1 class="titulos">Perfil de Aluno</h1> 
                     Email:';
            echo "<input type='text' name='email' id='email' readonly='true' value='$e'";
            echo "required>";
            echo '     </br>Senha:
                          <input type="password"  name="senha" id="senha"  required>
                          		
                        </br><button class="button5" type="submit" >Alterar</button>                     
                </form>';
            echo '<center>
                     <form class="form4" action="alt_endereco.php" method="post">
                     <h2 class="titulos">Alterar endereço</h2>
                     Email:';
            echo "<input type='text' name='email' id='email' readonly='true' value='$e'";
            echo "required>";
            echo     '</br>Cep:
                     <input type="text" required>
                     </br>Rua: 
                     <input type="text" required>
                     </br>Bairro:
                     <input type="text" required>
                     </br>Cidade:
                     <input type="text" required>
                     </br>UF:
                     <input type="text" required>

                     </br><button class="button4" type="submit">Alterar</button>
                </form>';
        }
    } else {
        // Cria um alerta informando que o usuário ou senha é inválido
        echo "<script>alert ('Email ou Senha Invalidos!'); location.href='index.php';</script>";
    }

    ?>
     <center>
    <h1 class="titulos">Área de Gestão</h1>
    <?php
    // Carrega o conteúdo da sessão email que foi criada no login
    echo "Seja bem-vindo(a), " . $_SESSION['nome'];
  

    ?>

</body>

</html>