<div class="produto_foto">
	<img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produto['imagem']; ?>" border="0" width="300" height="300">
</div>
<div class="produto_info">
	<h2><?php echo $produto['nome']; ?></h2>
	<?php echo utf8_encode($produto['descricao']); ?>
	<h3><?php echo "R$ ".$produto['preco']; ?></h3>
	<a href="<?php echo BASE_URL; ?>carrinho/add/<?php echo $produto['id']; ?>">Adicionar ao Carrinho</a>
</div>
<div style="clear:both"></div>