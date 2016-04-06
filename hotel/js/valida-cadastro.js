/*
Função para verificar se o valor digitado já está com a mascara
*/
function mascara(elemento) {
    setTimeout(function () { //setTimeout faz com que a validação demore 1 milésimo de segundo para ocorrer
			     //para garantir que seja executada quando o usuário tenha terminado de digitar
        var valorFormatado = formataTelefone(elemento.value); //chama a função para formatar o numero digitado
        if (valorFormatado != elemento.value) { //caso o valor formatado seja diferente do valor digitado
            elemento.value = valorFormatado;    //atualiza o valor do campo de telefone com o novo valor formatado
        }
    }, 1);
}

/*
Função para formatar o numero de telefone utilizando expressões regulares
*/
function formataTelefone(valor) {
    var novoValor = valor.replace(/\D/g,""); //retorna apenas numeros do que for digitado no campo
    novoValor = novoValor.replace(/^0/,""); //nao permite que seja preenchido um codigo de area com digito 0

    if (novoValor.length > 10) {
        // em numeros com mais de 11 digitos e interpretado que o prefixo 
	//do numero contem 5 digitos (caso de cidades como Sao Paulo)
        novoValor = novoValor.replace(/^(\d\d)(\d{5})(\d{4}).*/,"($1) $2-$3");
    }
    else if (novoValor.length > 5) {
        // de 6 a 10 digitos e interpretado como a forma mais comum de numeros de telefone
	// com prefixos de 4 digitos
        novoValor = novoValor.replace(/^(\d\d)(\d{4})(\d{0,4}).*/,"($1) $2-$3");
    }
    else if (novoValor.length > 2) {
        // 3 a 5 digitos sao adicionados o segundo parenteses do codigo de area e o espaço entre ele e o nuemero
        novoValor = novoValor.replace(/^(\d\d)(\d{0,5})/,"($1) $2");
    }
    else {
        // quando digitado apenas o codigo de area adiciona o primeiro parenteses
        novoValor = novoValor.replace(/^(\d*)/, "($1");
    }
    return novoValor;
}

/*
Função que valida todos os campos do formulário
*/
function msgInvalido(elemento){
    if (elemento.value == '') {
        elemento.setCustomValidity('Obrigatório preencher este campo.');
    }
    else if (elemento.validity.typeMismatch){
	elemento.setCustomValidity('Informação digitada não é válida.');

    }else {
       elemento.setCustomValidity('');
    }
    return true;
}

