<!DOCTYPE HTML> <!-- Declaracao do documento HTML5 -->
<html>
    <head>
	<meta charset="UTF-8">
        <title>Hotel Responsivo</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
	<script src="js/valida-cadastro.js"></script>
    </head>
    <body>
        <section class="main">
            <header>      
                <span class="logo">
                    <img src="img/logo.png">
                </span>          
                <section id="slide">
                    <figure>
                        <img src="img/capa.jpg" alt="">
                        <img src="img/capa1.jpg" alt="">
                        <img src="img/capa2.jpg" alt="">
                        <img src="img/capa3.jpg" alt="">
                        <img src="img/capa4.jpg" alt="">
                    </figure>
                </section>
            </header>
            <nav class="menu">
                <ul>
                    <li> <a href="index.php"> Início </a> </li>
                    <li> <a href="reservas.php"> Reservas </a> </li>
                    <li> <a href="#"> Promoções </a> </li>
                    <li> <a href="#"> Contato </a> </li>
                </ul>
            </nav>
            <article class="conteudo">
                <section class="conteudo-interno">
                    <h2>Cadastro de Reservas</h2>
					<?php 

						if(isset($_POST['nome'])){ 		//Se receber dados por POST 
						    require_once 'conecta.php';		//requisita o arquivo de conexao
						    $con = new ConexaoSql();		//Instancia um objeto da classe criada para conectar ao banco
							if($_POST['codigo'] == ''){	//Se nao tiver um valor para o codigo significa que é um cadastro novo
								$result = $con->cadastraReserva(//Chama o metodo para cadastro e envia os dados para o mesmo
									Array(
										'nome' => strip_tags($_POST['nome']),//funcao strip_tags evita que seja enviada tags html para segurança
										'telefone' => strip_tags($_POST['telefone']),
										'email' => strip_tags($_POST['email']),
										'quartos' => strip_tags($_POST['quartos'])
									)
								);

								if($result){//Se resultar true o cadastro foi efetuado com sucesso
									echo '<span class="msgSucesso">Reserva feita com sucesso!</span>';
								}
							}else{					//Caso exista um valor de codigo significa que está editando um registro
								$result = $con->editaReserva(	//Chama a função para editar o registro
									Array(
										'codigo' => strip_tags($_POST['codigo']),
										'nome' => strip_tags($_POST['nome']),
										'telefone' => strip_tags($_POST['telefone']),
										'email' => strip_tags($_POST['email']),
										'quartos' => strip_tags($_POST['quartos'])
									)
								);

								if($result){//Se resultar true a edição foi efetuada com sucesso
									echo '<span class="msgSucesso">Reserva editada com sucesso!</span>';
								}

							}
						}else if(isset($_GET['cod'])){//Caso receba um codigo por GET no parametro da URL significa que deve carregar os dados para edição  
		                    			require_once 'conecta.php';
		                   			 $con = new ConexaoSql();
							$dados = $con->getReserva(strip_tags($_GET['cod']));//Busca os dados de uma reservar para popular os campos na edição

						}
					?>
		    <!-- Formulario de cadastro de reservas -->
                    <form name="cadastro-reserva" action="" method="POST">
			<!-- Campo do tipo hidden para controle do sistema do codigo -->
			<input type="hidden" name="codigo" id="codigo" value="<?php if(isset($dados)) echo $dados['codigo']; //Se Tiver a variavel dados entao será uma edição e preenchera os valores nos campos?>">

                        <label>Nome completo:</label>
                        <input type="text" name="nome" value="<?php if(isset($dados)) echo $dados['nome']; ?>" id="nome" placeholder="João da Silva"  title="Apenas letras neste campo." oninvalid="msgInvalido(this);" required>

                        <label>Telefone:</label>
                        <input type="text" name="telefone" value="<?php if(isset($dados)) echo $dados['telefone']; ?>" id="telefone" placeholder="(49) 3366-8833" title="Digite o número do seu telefone com DDD." oninvalid="msgInvalido(this);" onkeypress="mascara(this);" onblur="mascara(this);" required >

                        <label>Email:</label>
                        <input type="email" name="email" value="<?php if(isset($dados)) echo $dados['email']; ?>" id="email" placeholder="joaodasilva@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Digite um e-mail válido." oninvalid="msgInvalido(this);" required>

                        <label>Quartos</label>
                        <input type="number" name="quartos" value="<?php if(isset($dados)) echo $dados['quartos']; ?>" id="quartos" placeholder="2" pattern="[0-9]" title="Digite número de quartos." oninvalid="msgInvalido(this);" required>

                        <input type="submit" value="Enviar Reserva" class="botoes" id="enviarBtn">
                    </form>
                </section>
            </article>
            <br>
            <footer class="rodape">
                    Hotéis Responsivos 2015 ® Todos os Direitos Reservados
            </footer>
        </section>
    </body>
</html>
