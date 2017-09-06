<h1>Produtos</h1>

<a href="<?php echo BASE_URL; ?>produtos/add" class="btn btn-default">Adicionar Produto</a>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="110">Imagem</th>
			<th>Nome</th>
			<th width="100">Categoria</th>
			<th width="80">Quantidade</th>
			<th width="80">Preço</th>
			<th width="200">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($produtos as $produto){ ?>
			<tr>
				<td width="110"><img src="<?php echo "../assets/images/".$produto['imagem']; ?>" width="60"></td>
				<td><?php echo $produto['nome']; ?></td>
				<td width="100"><?php echo $produto['titulo_categoria']; ?></td>
				<td width="80"><?php echo $produto['quantidade']; ?></td>
				<td width="80"><?php echo $produto['preco']; ?></td>
				<td>
					<a href="produtos/editar/<?php echo $produto['id']; ?>" class="btn btn-default">Editar</a>
					<a href="produtos/excluir/<?php echo $produto['id']; ?>" class="btn btn-default">Excluir</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php 
	for($i=1; $i<=$quantidade_paginas; $i++){
 ?>
	<a href="<?php echo BASE_URL; ?>produtos?p=<?php echo $i; ?>"><?php echo $i; ?></a>
 <?php } ?>