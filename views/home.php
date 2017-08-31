<?php foreach($produtos as $produto){ ?>
	<a href="<?php echo BASE_URL; ?>produto/ver/<?php echo $produto['id']; ?>">
		<div class="produto">
			<img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produto['imagem']; ?>" width="180" height="200" border="0">
			<strong><?php echo $produto['nome']; ?></strong>
			<?php echo "R$ ".$produto['preco']; ?>
		</div>
	</a>
<?php } ?>
<div style="clear:both"></div>