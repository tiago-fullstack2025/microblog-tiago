<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

// Captura o valor do id via URL e sanitiza para garantir que é valor inteiro
$id = Utils::sanitizar($_GET['id'], 'inteiro');

// Ao tentar abrir usuario-exclui.php sem o parâmetro id, redirecionamos.
if(!$id) Utils::redirecionarPara("usuarios.php");

// Inicialização de variável de erro e do objeto de serviço
$erro = null;
$usuarioServico = new UsuarioServico();

// Tente....
try {
	// Executar o método de excluir passando o id de quem será excluído
	$usuarioServico->excluir($id);
} catch (Throwable $e) {
	// Deu ruim/erro? Dispare um erro e monte uma mensagem com os detalhes
	$erro = "Erro ao excluir usuário. <br>".$e->getMessage();
}

require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir usuário
		</h2>

		<?php if($erro): ?>
			<p class="alert alert-danger text-center"><?=$erro?></p>
		<?php else: ?>
			<p class="alert alert-success text-center">Usuário excluído com sucesso</p>
		<?php endif; ?>
			
		<!-- Link/Botão voltar -->
		<p class="text-center">
			<a href="usuarios.php" class="btn btn-secondary">Voltar</a>
		</p>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>