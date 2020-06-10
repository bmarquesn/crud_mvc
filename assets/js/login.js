function valida_login(){
	var valido=false;
	
	var usuario = $('#login').find('form').find('input[name="usuario"]');
	var senha = $('#login').find('form').find('input[name="senha"]');
	var codigo = $('#login').find('form').find('input[name="codigo"]');
	var codigo_gerado=$('div#login').find('div#codigo_gerado').text().trim();
	
	if(usuario.val().trim()==""){
		exibir_alerta_login('É necessário digitar o USUÁRIO');
		usuario.focus();
		valido=false;
	}else if(senha.val().trim()==""){
		$('#login').find('#mensagem').find('.alert-danger').text('É necessário digitar a SENHA');
		$('#login').find('#mensagem').show('fast');
		senha.focus();
		valido=false;
	}else if(codigo.val().trim()==""){
		exibir_alerta_login('É necessário digitar o CÓDIGO DE VERIFICAÇÃO');
		codigo.focus();
		valido=false;
	}else if(codigo.val().trim()!=codigo_gerado){
		exibir_alerta_login('O CÓDIGO DE VERIFICAÇÃO digitado está incorreto<br />Note que letras MAIÚSCULAS e minúsculas são diferenciadas');
		codigo.focus();
		valido=false;
	}else{
		$('#login').find('#mensagem').find('.alert-danger').text('');
		valido=true;
	}
	
	return valido;
}
function exibir_alerta_login(mensagem){
	$('#login').find('#mensagem').hide('fast');
	$('#login').find('#mensagem').find('.alert-danger').html(mensagem);
	$('#login').find('#mensagem').show('fast');
}