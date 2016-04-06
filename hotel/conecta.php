<?php
class ConexaoSql {
    
    private $_conexao;
    
    private function conecta(){
        
        $this->_conexao = mysql_connect('127.0.0.1:3306', 'root', '');
        if (!$this->_conexao) {
            die('Nao foi possivel conectar: ' . mysql_error());
        }        
        mysql_select_db("hotel",$this->_conexao);
        
    }
    
    private function desconecta(){
        mysql_close($this->_conexao);    
    }
    
    /*
	Função para buscar todas as reservas cadastradas na base de dados
    */
    public function getReservas(){
        
	//cria uma conexao com o banco de dados
        $this->conecta();
        
	//monta o SQL de seleção de dados
        $query = "SELECT * FROM reservas";

        // Executando a query
        $result = mysql_query($query);

        // Em caso de erro exibe a mensagem de erro do SQL na tela
        if (!$result) {
            $msg  = 'Erro: ' . mysql_error() . "\n";
            $msg .= 'SQL Executado: ' . $query;
            die($msg);
        }
        
        //Armazena o resultado do sql em um Array para retornar a funcao
        $resultado = Array();
        while ($row = mysql_fetch_assoc($result)) {
            $resultado[] = Array(
                'codigo' => $row['codigo'],
                'nome' => $row['nome'],
                'telefone' => $row['telefone'],
                'email' => $row['email'],
                'quartos' => $row['quartos']
            );
        }
        //Desconecta o banco de dados
        $this->desconecta();
        
        return $resultado;
    }

    /*
	Função para inserir uma reserva na base de dados
	@param Array $dados Dados que serão cadastrados
    */
    public function cadastraReserva($dados){
        
	//cria uma conexao com o banco de dados
        $this->conecta();
        
	//monta o SQL de inserção de dados
	$sql = "INSERT INTO reservas (nome, telefone, email, quartos)
	VALUES ('{$dados['nome']}', '{$dados['telefone']}', '{$dados['email']}', {$dados['quartos']});";

	try{
		// Executando a query
		$result = mysql_query($sql);

		// Em caso de erro exibe a mensagem de erro do SQL na tela
		if (!$result) {
		    $msg  = 'Erro: ' . mysql_error() . "\n";
		    $msg .= 'SQL Executado: ' . $query;
		    die($msg);
		}

	}catch (Exception $e) {
		echo $e->getMessage();
	}


        //Desconecta o banco de dados
        $this->desconecta();
	return true;
    }

    /*
	Função para buscar uma reservas pelo codigo
	@param Integer $cod Código da reserva
    */
    public function getReserva($cod){
        
	//cria uma conexao com o banco de dados
        $this->conecta();
        
	//monta o SQL de seleção de dados
        $query = "SELECT * FROM reservas where codigo = {$cod}";

        // Executando a query
        $result = mysql_query($query);

        // Em caso de erro exibe a mensagem de erro do SQL na tela
        if (!$result) {
            $msg  = 'Erro: ' . mysql_error() . "\n";
            $msg .= 'SQL Executado: ' . $query;
            die($msg);
        }
        
        //Armazena o resultado do sql em um Array para retornar a funcao
        while ($row = mysql_fetch_assoc($result)) {
            $resultado = Array(
                'codigo' => $row['codigo'],
                'nome' => $row['nome'],
                'telefone' => $row['telefone'],
                'email' => $row['email'],
                'quartos' => $row['quartos']
            );
        }
        //Desconecta o banco de dados
        $this->desconecta();
        
        return $resultado;
    }

    /*
	Função para editar uma reserva cadastrada na base de dados
	@param Array $dados Dados que serão cadastrados
    */
    public function editaReserva($dados){
        
	//cria uma conexao com o banco de dados
        $this->conecta();
        
	//monta o SQL de inserção de dados
	$sql = "UPDATE reservas SET 
			nome='{$dados['nome']}' ,
			telefone='{$dados['telefone']}' ,
			email='{$dados['email']}' ,
			quartos={$dados['quartos']} 
		WHERE codigo = {$dados['codigo']};";

	try{
		// Executando a query
		$result = mysql_query($sql);

		// Em caso de erro exibe a mensagem de erro do SQL na tela
		if (!$result) {
		    $msg  = 'Erro: ' . mysql_error() . "\n";
		    $msg .= 'SQL Executado: ' . $query;
		    die($msg);
		}

	}catch (Exception $e) {
		echo $e->getMessage();
	}


        //Desconecta o banco de dados
        $this->desconecta();
	return true;
    }

    /*
	Função para deletar uma reserva cadastrada na base de dados
	@param Integer $codigo Código da reserva
    */
    public function deleteReserva($codigo){
        
	//cria uma conexao com o banco de dados
        $this->conecta();
        
	//monta o SQL de inserção de dados
	$sql = "DELETE FROM reservas WHERE codigo = {$codigo};";

	try{
		// Executando a query
		$result = mysql_query($sql);

		// Em caso de erro exibe a mensagem de erro do SQL na tela
		if (!$result) {
		    $msg  = 'Erro: ' . mysql_error() . "\n";
		    $msg .= 'SQL Executado: ' . $query;
		    die($msg);
		}

	}catch (Exception $e) {
		echo $e->getMessage();
	}

        //Desconecta o banco de dados
        $this->desconecta();
	return true;
    }
    
}
?>
