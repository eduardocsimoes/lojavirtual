<?php 
	global $config;
 ?>

<h1>Vendas</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th width="50">ID</th>
			<th>Nome do Cliente</th>
			<th>Valor</th>
			<th>Forma Pgto</th>
			<th>Status</th>
			<th width="200">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($vendas as $venda){ ?>
			<tr>
				<td><?php echo $venda['id']; ?></td>
				<td><?php echo $venda['nome_cliente']; ?></td>
				<td>R$ <?php echo $venda['valor']; ?></td>
				<td><?php echo $venda['forma_pgto']; ?></td>
				<td><?php echo $config['status_pgto'][$venda['status_pg']]; ?></td>
				<td>
					<a href="vendas/ver/<?php echo $venda['id']; ?>" class="btn btn-default">Visualizar</a>
					<a href="categorias/excluir/<?php echo $venda['id']; ?>" class="btn btn-default">Excluir</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>