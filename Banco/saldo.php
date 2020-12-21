<?php
session_start();	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Saldo</title>
		<meta charset="utf-8">
		<link rel="icon" type="imagem/png" href="./img/bank-icon1.png">
		<link rel="stylesheet" type="text/css" href="estilo_saldo.css">
	</head>
	
	<body>
		<div id="fundo">
			<?php
				//Acessando valores dentro de uma sessão:
				$user = $_SESSION['user'];
				$name = $user[0];
				$money = $user[3];

				//Gravar o novo falou feito!
				if(isset($_POST['submit-confirmar'])){
					function gravarlinha($local,$linha,$conteudo){
						$local1 = file($local);
						$local1[$linha] = $conteudo;
			
						$gravar = $local1[0].$local1[1].$local1[2].$local1[3];

						escrever($local, $gravar);
					}
					function escrever($local, $gravar){
						
						$arquivo = fopen($local,'w');
						fwrite($arquivo,$gravar);
						fclose($arquivo);
						refresh($gravar);
						
					}
	
					$diretorio = scandir("./arquivos/"); //Vejo o que tem na pasta
					$qtd = count($diretorio) - 2; //Conto quantos itens particamente tem na pasta e diminuo o "." e ".."
					
					$count = 0;    //Inicia a contagem 
					while($count < $qtd) {
						
						$count++;
						$file = file("arquivos/".$count.".txt");
											
						if(trim($file[0]) == trim($user[0])){
							$n_txt = $count;
							$local = "arquivos/".$n_txt.".txt";
							$linha = 3;
							if($_POST['new_saldo'] == ""){
								$conteudo = $user[3];
							} else {
								$conteudo = $_POST['new_saldo'];
							}
							

							gravarlinha($local,$linha,$conteudo);
						} 
					}
				}
				
			?>
			<div id=login>
				<h1><?php echo $name; ?></h1>
			</div>
			
			<div id="saldo">
				<h1>Saldo:<?php echo $money; ?>$</h1>
			</div>

			<form action="" method="POST">
				<div>
					<input
					class="atualizar"
					type="number"
					placeholder="Digite aqui seu novo saldo"
					name="new_saldo"
					/>
				</div>

				<div>
					<input
					class="botao"
					type="submit"
					value="Confirmar"
					name="submit-confirmar"
					/>
				</div>

				<div>
					<input
					class="botao"
					type="submit"
					value="Sair"
					name="submit-sair"
					/>
				</div>
			</form>
			
		</div>
		<?php

			function refresh($gravar) {
				
				$diretorio = scandir("./arquivos/"); //Vejo o que tem na pasta
				$qtd = count($diretorio) - 2; //Conto quantos itens particamente tem na pasta e diminuo o "." e ".."
				$user = explode("\n", $gravar);
				$count = 0;				//Iniciar o Contador que ficar no while
				$good = false;		//Iniciar a variavel de mudança de pagina

				while($count < $qtd) {
                
					$count++;
					$file = file("arquivos/".$count.".txt");
									 
					if(trim($file[0]) == trim($user[0])){
						if(trim($file[1]) == trim($user[1])){
							$_SESSION['user'] = $file;
							$user = $file;
							$name = $file[0];
							$money = $file[3];
							$good = true;
							
						}
					} 
				}
				echo "<scrip>alert('Foi')</script>";
				if($good){
					redirecionar("saldo.php");
				}
			}

			function redirecionar($destino){
				return header("Location: $destino");
			}

			if(isset($_POST['submit-sair'])) {
				//Apagar a sessão
				session_destroy();
				redirecionar("login.php");
			}
			
		?>
	</body>
</html>