
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

		<a href="<?=base_url()?>" class="logo d-flex align-items-center">
			<img src="<?=base_url(); ?>assets/img/logo.png" alt="">
		</a>

		<nav id="navbar" class="navbar">
			<ul>
				<li><a class="nav-link scrollto active" href="#about">MyThreePi</a></li>
				<li><a class="nav-link scrollto" href="#produtos">Produtos</a></li>
				<!-- <li><a class="nav-link scrollto" href="#conteudo">Conteúdo</a></li> -->
				<li><a class="nav-link scrollto" target="_blank" href="https://www.tmlt.co.uk">Trace Me UK</a></li>
				<li><a class="nav-link scrollto" href="#contact">Fale com a gente</a></li>
				<?php if(!isset($_SESSION['backend']['id'])){?>
					<li><a class="getstarted scrollto" href="customers">Login</a></li>
				<?php }else{ ?>
					<li><a class="getstarted scrollto" href="customers/dashboard">Minha Conta</a></li>
				<?php } ?>
				<li>
					<a style="padding: 0px;float:left" href="<?=base_url()?>carrinho">
						<i style="padding-left: 5px;font-size: 25px" class="bi bi-cart-fill"></i>
					</a> 
					<?php 
						if($qtd_carrinho == 0){
							$qtd_carrinho = "display:none";
						}
					?>
					<div style="<?=$qtd_carrinho?>" id="qtd_cart"><?=$qtd_carrinho?></div>
				</li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav>
    </div>
</header>