<!DOCTYPE HTML> <!-- Declaracao do documento HTML5 -->
<html>	
    <head>
	<meta charset="UTF-8">
        <title>Hotel Responsivo</title>
        <link rel="stylesheet" type="text/css" href="estilo.css">
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
			<h2>Reservas</h2>
			<?php 
				if(isset($_GET['cod'])){ //se a url tiver parametro cod com o codigo para deletar
					require_once 'conecta.php'; //requisita o arquivo de conexao
					$con = new ConexaoSql();    //Instancia o objeto
					$result = $con->deleteReserva(strip_tags($_GET['cod']));//chama metodo para deletar a reserva pelo codigo

					if($result){//se retornar um resultado == true exibe mensagem de exito
						echo '<span class="msgSucesso">Reserva deletada com sucesso!</span>';
					}
				}
			?>
			<a class='botoes' href="reservas.php">Voltar</a>
                </section>
            </article>
            <br>
            <footer class="rodape">
                    Hotéis Responsivos 2015 ® Todos os Direitos Reservados
            </footer>
        </section>
    </body>
</html>
