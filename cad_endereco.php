<?php

include 'conect.cfg';

$cep = $_POST["cep"];
$rua = $_POST["rua"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];


echo $cep ,$rua,$bairro,$cidade,$estado;


$sql = "insert into endereco values ('null','$cep','$rua','$bairro','$cidade','$estado')";


if(mysqli_query($con,$sql)){
    $msg = "Cadastrado com sucesso!";

}else{
    $msg = "Erro ao Cadastrar";
}

mysqli_close($con);

echo"<script>alert ('".$msg."'); location.href='index.php';</script>"




?>