h1>Venda</h1>

<h3>Produtos da Venda</h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Imagem</th>
			<th>Nome</th>
			<th>Qtd.</th>
			<th>Preço</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($produtos as $produto){ ?>
			<tr>
				<td><img src="<?php echo "../../../assets/images/".$produto['imagem']; ?>" width="100"></td>
				<td><?php echo $produto['nome']; ?></td>
				<td><?php echo $produto['quantidade']; ?></td>
				<td><?php echo $produto['preco']; ?></
			</tr>
		<?php } ?>
	</tbody>
</table>