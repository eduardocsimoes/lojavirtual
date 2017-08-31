<html>
	<head>
		<title>Nossa Loja</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/template.css">
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</head>
	<body>
		<div class="topo"></div>
		<div class="menu">
			<div class="menuint">
				<ul>
					<a href="<?php echo BASE_URL ?>"><li>Home</li></a>
					<a href="<?php echo BASE_URL ?>empresa"><li>Empresa</li></a>
					<?php foreach($viewData['menu'] as $menuitem){ ?>
						<a href="<?php echo BASE_URL ?>categoria/ver/<?php echo $menuitem['id']; ?>"><li><?php echo $menuitem['titulo']; ?></li></a>
					<?php } ?>
					<a href="<?php echo BASE_URL ?>contato"><li>Contato</li></a>
				</ul>
			</div>
		</div>
		<div class="container">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
		<div class="rodape"></div>
	</body>
</html>