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
                    <a class='botoes' href="cadastrar-reserva.php">Nova Reserva</a>
                    <?php 
                        require_once 'conecta.php';     //Importa o arquivo php para conexão
                        $con = new ConexaoSql();        //Instancia um objeto da classe ConexaoSql
                        $reservas = $con->getReservas();//Chama o metodo para buscar as reservas cadastradas
                    ?>
                    <table>
                        <th>Código</th><th>Nome</th><th>Telefone</th><th class="invisivelResposivo">Email</th><th>Quartos</th><th>Editar</th><th>Excluir</th>
                        <?php 
			    //Elabora a tabela de dados de reservas
                            foreach($reservas as $r){
                                echo "<tr>
                                        <td>{$r['codigo']}</td>
                                        <td>{$r['nome']}</td>
                                        <td>{$r['telefone']}</td>
                                        <td class='invisivelResposivo'>{$r['email']}</td>
                                        <td>{$r['quartos']}</td>
                                        <td><a href='cadastrar-reserva.php?cod={$r['codigo']}'><img class='icon' src='img/edit.png'></a></td>
                                        <td><a href='delete-reserva.php?cod={$r['codigo']}'><img class='icon' src='img/delete.png'></a></td>
                                    </tr>";
                            }
                        ?>
                    </table>
                </section>
            </article>
            <br>
            <footer class="rodape">
                    Hotéis Responsivos 2015 ® Todos os Direitos Reservados
            </footer>
        </section>
    </body>
</html>
