<?php 
require_once "../src/Models/Usuario.php";
require_once "../src/Helpers/Utils.php";

// Variável que será usada para montar mensagens de erro personalizadas
$erro = null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	// Validação do preenchimento dos campos
	if(
		empty($_POST['nome']) || empty($_POST['email']) || 
		empty($_POST['senha']) || empty($_POST['tipo'])
	){
		$erro = "Preencha todos os campos";
	} else {
		// Capturando e sanitizando os valores do formulário
		$nome = Utils::sanitizar($_POST['nome']);
		$email = Utils::sanitizar($_POST['email'], 'email');
		$tipo = Utils::sanitizar($_POST['tipo']);

		// Capturando e codificando (gerando um hash) da senha
		$senha = Utils::codificarSenha($_POST['senha']);

		// Criando um objeto para um novo usuario com seus dados
		$novoUsuario = new Usuario($nome, $email, $senha, $tipo);
		
		// Teste seu método dump AQUI passando o objeto $novoUsuario
		Utils::dump($novoUsuario);
	}

}
require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir novo usuário
		</h2>

		<!-- O parágrafo abaixo irá aparecer SOMENTE se houver
		 algum erro. E neste caso, exibirá a mensagem de erro. -->
		<?php if($erro): ?>
		<p class="alert alert-danger text-center"> <?=$erro?> </p>
		<?php endif; ?>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir" autocomplete="off">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input required value="<?=$_POST['nome'] ?? ''?>" class="form-control" type="text" id="nome" name="nome">
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input required value="<?=$_POST['email'] ?? ''?>" class="form-control" type="email" id="email" name="email">
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input required class="form-control" type="password" id="senha" name="senha">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select required class="form-select" name="tipo" id="tipo">
					<option value=""></option>
					<option value="editor">Editor</option>
					<option value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../includes/rodape-admin.php";
?>

