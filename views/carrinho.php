<h1>Carrinho de compras</h1>
<table border="0" width="100%">
	<tr>
		<th align="left">Imagem</th>
		<th align="left">Nome do Produto</th>
		<th align="left">Valor</th>
		<th align="left">Ações</th>
	</tr>
	<?php $subtotal = 0; ?>
	<?php foreach($carrinho as $produtoDoCarrinho){ ?>
		<tr>
			<td><img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produtoDoCarrinho['imagem']; ?>" border="0" width="60"></td>
			<td><?php echo $produtoDoCarrinho['nome']; ?></td>
			<td><?php echo "R$ ".$produtoDoCarrinho['preco']; ?></td>
		</tr>
		<?php $subtotal += $produtoDoCarrinho['preco']; ?>
	<?php } ?>

	<tr>
		<td></td>
		<td align="left"><strong>SUBTOTAL:</strong></td>
		<td align="left"><strong><?php echo "R$ ".$subtotal; ?></strong></td>
		<td></td>
	</tr>
</table>