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
						<a href="<?php echo BASE_URL ?>categoria/ver/<?php echo $menuitem['id']; ?>"><li><?php echo utf8_encode($menuitem['titulo']); ?></li></a>
					<?php } ?>
					<a href="<?php echo BASE_URL ?>contato"><li>Contato</li></a>
					<a href="<?php echo BASE_URL ?>pedidos"><li>Pedidos</li></a>
				</ul>
				<a href="<?php echo BASE_URL ?>carrinho">
					<div class="carrinho">
						Carrinho:<br>
						<?php echo (isset($_SESSION['carrinho'])?count($_SESSION['carrinho']):'0') . ' itens'; ?>
					</div>
				</a>
			</div>
		</div>
		<div class="container">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
		<div class="rodape"></div>
	</body>
</html>