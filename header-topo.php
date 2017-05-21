<div id="topo">
	<div class="row center" id="container-anuncio">
		<div class="col s12 m8 offset-m2">
			<a href="#!"><img src="<?php echo get_template_directory_uri(); ?>/media/anuncio.jpg" alt=""></a>
		</div>
	</div>
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<div class="row no-margin red" id="container-menu-topo">
		<nav class="vermelho">
			<div class="col s12 m10 nav-wrapper">
				<a href="#" class="brand-logo"><img src="<?php echo get_template_directory_uri(); ?>/media/logo.png" alt=""></a>
				<?php 
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_id' => 'nav-mobile',
						'menu_class'     => 'right hide-on-med-and-down',

					 ) );
				?>
			</div>
			<div class="col m2 hide-small-only">
				pesqusa	
			</div>
		</nav>
		<div class="col s12 mega-menu hide" id="mega-menu-Carros">
			<div class="col s12 m2"><button>Ver todos os carros</button></div>
			<div class="col s12 m10">
				<?php 
					wp_nav_menu( array(
						'menu' => 'mega_menu_carros'
					 ) );
				?>
			</div>
		</div>
		<div class="col s12 mega-menu preto hide" id="mega-menu-Testes">
			<div class="col m2 sub-menu">
				<ul>
					<li><a href="#tudo">Ver tudo de testes</a></li>
					<li><a href="#comparativos">Comparativos</a></li>
					<li><a href="#impressoes">Impressões</a></li>
					<li><a href="#longa-duracao">Longa duração</a></li>
					<li><a href="#teste-pista">Teste de pista</a></li>
				</ul>	
			</div>
			<div class="col m2 item">
				<img class="responsive-img" src="<?php echo get_template_directory_uri(); ?>/media/mega-menu1.jpg" alt="">
				<h1>Ford Focus Fastback Titanium Plus</h1>
			</div>
			<div class="col m2 item">
				<img class="responsive-img" src="<?php echo get_template_directory_uri(); ?>/media/mega-menu2.jpg" alt="">
				<h1>Audi A6 2.0 TFSI</h1>
			</div>
			<div class="col m2 item">
				<h1>Ford EcoSport .6 Powershift</h1>
				<p>EcoSport ganha motor 1.6 atrelado à transmissão automatizada de 6... </p>
			</div>
			<div class="col m2 item">
				<img class="responsive-img" src="<?php echo get_template_directory_uri(); ?>/media/mega-menu3.jpg" alt="">
				<h1>Audi Q3 1.4</h1>
			</div>
			<div class="col m2 item">
				<img class="responsive-img" src="<?php echo get_template_directory_uri(); ?>/media/mega-menu4.jpg" alt="">
				<h1>BMW 420i Cabriolet</h1>
			</div>
		</div>
		</div>
		<div class="row no-margin" id="container-mais-acessados">
			<ul>
				<li><a href="#!">+ACESSADOS</a>	<span><img src="<?php echo get_template_directory_uri();?>/media/menu-detalhe.png" alt=""></span></li>
				<li><a href="#!">SALÃO DO AUTOMÓVEL</a></li>
				<li><a href="#!">RENEGADE</a></li>
				<li><a href="#!">NOVO SANDERO</a></li>
				<li><a href="#!">NOVO FOX</a></li>
				<li><a href="#!">NOVO KA</a></li>
				<li><a href="#!">HB 20</a></li>
				<li><a href="#!">DUSTER</a></li>
				<li><a href="#!">GOLF</a></li>
				<li><a href="#!">COROLLA</a></li>
				<li><a href="#!">CIVIC</a></li>
				<li><a href="#!">IA-ZI</a></li>
			</ul>
		</div>
		
		<?php endif; ?>	
</div>