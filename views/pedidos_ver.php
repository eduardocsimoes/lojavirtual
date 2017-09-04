<?php

	global $config;

?>

<h1>Pedido <?php echo $pedido['id']; ?></h1>

<a href="<?php echo BASE_URL ?>login/logout">Sair</a>

<table border="0" width="100%">
	<tr>
		<th>Pedido</th>
		<th>Valor Pago</th>
		<th>Forma de Pgto</th>
		<th>Status do Pedido</th>
		<th>Ações</th>
	</tr>
	<tr>
		<td><?php echo $pedido['id']; ?></td>
		<td><?php echo $pedido['valor']; ?></td>
		<td><?php echo $pedido['desc_forma_pgto']; ?></td>
		<td><?php echo $config['status_pgto'][$pedido['status_pg']]; ?></td>
	</tr>
</table>

<?php foreach($pedido['produtos'] as $produto){ ?>
	<div class="pedido_produto">
		<img src="<?php echo BASE_URL ?>assets/images/<?php echo $produto['imagem']; ?>" border="0" width="100">
		<?php echo $produto['nome']; ?><br>
		R$ <?php echo $produto['preco']; ?><br>
		Quantidade: <?php echo $produto['quantidade']; ?><br>
	</div>
<?php } ?>

<div style="clear:both"></div>