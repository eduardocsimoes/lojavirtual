<h1>Página de Login</h1>

<?php if(!empty($erro)){ ?>
	<div class="erro"><?php echo $erro; ?></div>
<?php } ?>

<form method="POST">
	Usuario:<br>
	<input type="text" name="usuario"><br><br>

	Senha:<br>
	<input type="password" name="senha"><br><br>

	<input type="submit" value="Logar">
</form>