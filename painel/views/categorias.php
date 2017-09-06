<h1>Categorias</h1>

<a href="<?php echo BASE_URL; ?>categorias/add" class="btn btn-default">Adicionar Categoria</a>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Titulo</th>
			<th width="200">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categorias as $categoria){ ?>
			<tr>
				<td><?php echo $categoria['titulo']; ?></td>
				<td>
					<a href="categorias/editar/<?php echo $categoria['id']; ?>" class="btn btn-default">Editar</a>
					<a href="categorias/excluir/<?php echo $categoria['id']; ?>" class="btn btn-default">Excluir</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>