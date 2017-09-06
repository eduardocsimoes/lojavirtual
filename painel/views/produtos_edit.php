<h1>Produtos - Editar</h1>

<form method="POST" enctype="multipart/form-data">
	<input type="text" name="nome" value="<?php echo $produto['nome']; ?>" placeholder="Nome do Produto" class="form-control"><br>

	<textarea name="descricao" placeholder="Descricao do Produto" class="form-control"> <?php echo $produto['descricao']; ?></textarea><br>

	<select name="categoria" class="form-control">
		<?php foreach($categorias as $categoria){ ?>
			<option value="<?php echo $categoria['id']; ?>" <?php echo ($produto['id_categoria'] == $categoria['id']) ? "selected='selected'" : ''; ?>><?php echo $categoria['titulo']; ?></option>
		<?php } ?>
	</select><br>

	<input type="text" name="preco" value="<?php echo $produto['preco']; ?>" placeholder="Preco do Produto" class="form-control"><br>

	<input type="text" name="quantidade" value="<?php echo $produto['quantidade']; ?>" placeholder="Quantidade do Produto" class="form-control"><br>

	<input type="file" name="imagem"><br>
	<img src="<?php echo "../../../assets/images/".$produto['imagem']; ?>" height="100"><br><br>

	<input type="submit" value="Salvar" class="btn btn-default">
</form>