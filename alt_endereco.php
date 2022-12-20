<?php

// Executa a conexao com o mysql e selecionar a base
include_once 'conect.cfg';

//Recupera os dados enviados via POST
// recebe o email
$email = $_POST["email"]; 
$cep = $_POST["cep"];
$rua = $_POST["rua"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];



       
        
        $sql = "update estudantes set cep='$cep', rua='$rua', bairro='$bairro', cidade='$cidade', estado='$estado' where email = '$email' ";
                

             if (mysqli_query($con,$sql)){
                     
                $msg = "Alterado com sucesso!";
                }else{
                        
                $msg = "Erro ao alterar";
                }
        mysqli_close($con);
        
               echo "<script>alert ('".$msg."');  location.href='index.php';</script>"
?>