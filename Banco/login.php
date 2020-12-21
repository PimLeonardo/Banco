<?php
			//Apagar a sessão
			session_start();
		?>
<!DOCTYPE html>
<html>
  <head>
    <title>Banco</title>
    <meta charset="utf-8" />
    <link rel="icon" type="imagem/png" href="./img/bank-icon1.png">
    <link rel="stylesheet" type="text/css" href="estilo.css" />
  </head>

  <body>
    <div id="fundo">
      <img src="img/perfil.png"/>

      <form action="" method="POST">
        <div>
          <input
            class="login"
            type="text"
            name="txt_user"
            id="login"
            placeholder="Digite aqui seu login"
          />
        </div>

        <div>
          <input
            class="senha"
            type="password"
            name="txt_pass"
            id="senha"
            placeholder="Digite aqui sua senha"
          />
        </div>

        <div>
          <input
            class="botao"
            type="submit"
            value="Entrar"
            name="submit-login"
          />
        </div>

        <div>
          <input
            class="botao"
            type="submit"
            value="Inscreva-se"
            name="submit-signin"
          />
        </div>
      </form>
      <?php
        function dataNascimento($dt) {
          $mes_atual = date('m');
          $ano_atual = date('Y');
          $dia_atual = date('d');
          $ano_cal = intval($ano_atual)-intval($dt[2]);

          
          if(intval($ano_cal) < 18){
            return true;
          }

          if(intval($ano_cal) == 18){

            if(intval($mes_atual) < intval($dt[1])){

              return true;

            } else if(intval($mes_atual) == intval($dt[1])){

              if(intval($dia_atual) < intval($dt[0])){

                return true;

              }
            }
          }
          
        }

        function redirecionar($destino){
          return header("Location: $destino");
        }

        if(isset($_POST['submit-login']))	 {
          /* Declaração de Variáveis */
          $user = $_POST['txt_user'];
          $pass = $_POST['txt_pass'];
          $good=false;
            
            /* Se o campo usuário ou senha estiverem vazios geramos um alerta */
            if ((empty($user)) && (empty($pass))) { 
              echo "<script>alert('Por favor, preencha todos os campos!');</script>";
              Exit; 
            } 
            if (empty($user)){ 
              echo "<script>alert('Campo Nome Vazio');</script>";
              Exit; 
            } 
            if (empty($pass)){ 
              echo "<script>alert('Campo senha Vazio');</script>";
              Exit; 
            } 
            if (($user) && ($pass)) {
              //VERIFICAÇÃO DOS DADOS NO TXT

              $diretorio = scandir("./arquivos/"); //Vejo o que tem na pasta
              $qtd = count($diretorio) - 2; //Conto quantos itens particamente tem na pasta e diminuo o "." e ".."
              
              $count = 0;    //Inicia a contagem 
              while($count < $qtd) {
                
                $count++;
                $file = file("arquivos/".$count.".txt");

                $dt = explode("/", $file[2]);

                //Trim ???          
                if(trim($file[0]) == $user){
                  if(trim($file[1]) == $pass){
                    if(dataNascimento($dt)){
                      redirecionar("https://www.toddynho.com.br/");
                    }else{
                      $_SESSION['user'] = $file;
                      $good=true;
                    }
                  }
                } 
              }

              if($good){
                redirecionar("saldo.php");
              } else {
                echo "<script>alert('Usuario ou/a senha errada!');</script>";
              }
            }
          
        }
        
        if(isset($_POST['submit-signin'])) {
          redirecionar("cadastroUsuario.php");
        }
      ?>
    </div>
  </body>
</html>