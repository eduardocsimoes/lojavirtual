<?php

	global $config;

?>

<h1>Meus Pedidos</h1>

<a href="<?php echo BASE_URL ?>login/logout">Sair</a>

<table border="0" width="100%">
	<tr>
		<th>Pedido</th>
		<th>Valor Pago</th>
		<th>Forma de Pgto</th>
		<th>Status do Pedido</th>
		<th>Ações</th>
	</tr>
	<?php foreach($pedidos as $pedido){ ?>
		<tr>
			<td><?php echo $pedido['id']; ?></td>
			<td><?php echo $pedido['valor']; ?></td>
			<td><?php echo $pedido['desc_forma_pgto']; ?></td>
			<td><?php echo $config['status_pgto'][$pedido['status_pg']]; ?></td>
			<td><a href="<?php echo BASE_URL; ?>pedidos/ver/<?php echo $pedido['id']; ?>">Detalhes</a></td>
		</tr>
	<?php } ?>
</table>