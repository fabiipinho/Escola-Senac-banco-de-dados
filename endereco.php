<html>
    <head>
    <title>ViaCEP Webservice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Adicionando Javascript -->
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
    <!-- Inicio do formulario -->
    <center>
    <div style="width:50vh;">
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
        

        <button type="submit" >Cadastrar</button>   
      </form>
    </div>
    </body>

    </html>
    