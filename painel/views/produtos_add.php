<h1>Produtos - Adicionar</h1>

<form method="POST" enctype="multipart/form-data">
	<input type="text" name="nome" placeholder="Nome do Produto" class="form-control"><br>

	<textarea name="descricao" placeholder="Descricao do Produto" class="form-control"></textarea><br>

	<select name="categoria" class="form-control">
		<?php foreach($categorias as $categoria){ ?>
			<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['titulo']; ?></option>
		<?php } ?>
	</select><br>

	<input type="text" name="preco" placeholder="Preco do Produto" class="form-control"><br>

	<input type="text" name="quantidade" placeholder="Quantidade do Produto" class="form-control"><br>

	<input type="file" name="imagem"><br>

	<input type="submit" value="Salvar" class="btn btn-default">
</form>