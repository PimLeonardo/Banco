<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="imagem/png" href="./img/bank-icon1.png">
    <link rel="stylesheet" type="text/css" href="estilo_cadastro.css" />
  </head>
  <body>
    <div id="fundo">
      <img src="img/cadastro.png"/>
      <form action="" method="POST">

        <input
        class="nome"
        type="text"
        name="nome"
        placeholder="Nome"
        >

        <input
        class="senha" 
        type="text" 
        name="password" 
        placeholder="Senha"
        >

        <input
        class="nascimento" 
        type="text" 
        name="dtnascimento"
        placeholder="Data Nascimento"
        >

        <input
        class="deposito" 
        type="text"
        name="money" 
        placeholder="Deposito"
        >

        <input
        class="botao"
        type="submit" 
        name="submit"
        value="Criar Usuario"
        >
        <input
        class="botao"
        type="submit" 
        name="voltar"
        value="Sair"
        >

        <?php

          if(isset($_POST['submit'])){
            // fopen(arquivo que vai escrever, 'modo: escrita, leitura, etc...')
            $name = $_POST['nome'];
            $password = $_POST['password'];
            $dtnascimento = $_POST['dtnascimento'];
            $money = $_POST['money'];
            
            if( isset($name) ) {
              if( $password && $money && $dtnascimento ) {
                $diretorio = scandir("./arquivos/");
                $qtd = count($diretorio) - 2;
                
                $numberArquivo = $qtd + 1;
      
                $arquivo = "./arquivos/$numberArquivo.txt";
      
                $data = $name."\r\n".$password."\r\n".$dtnascimento."\r\n".$money;
                $arquivoAberto = fopen($arquivo, 'w');
                fwrite($arquivoAberto, $data); 
                fclose($arquivoAberto);
                echo "<script>alert('Seu usuario foi salvo na base de dados Sr: $name');</script>";
                $good=true;
              }else {
                echo "<script>alert('Preencha todos os campos!');</script>";
              }

            }
            if($good){
              header("Location: login.php");
            } 
          }

          if(isset($_POST['voltar'])) {
            redirecionar("login.php");
          }

          function redirecionar($destino){
            return header("Location: $destino");
          }

        ?>
      </form>
    </div>
  </body>
</html>