<div class="row center" id="container-anuncio">
	<div class="col s12 m8 offset-m2">
		<a href="#!"><img src="<?php echo get_template_directory_uri(); ?>/media/anuncio.jpg" alt=""></a>
	</div>
</div>
<div class="row no-margin red" id="container-menu-topo">
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav class="red">
			<div class="col s12 m10 nav-wrapper">
				
					<a href="#" class="brand-logo"><img src="<?php echo get_template_directory_uri(); ?>/media/logo.png" alt=""></a>
					<?php
						wp_nav_menu( array(
							'menu_id' => 'nav-mobile',
							'menu_class'     => 'right hide-on-med-and-down',
						 ) );
					?>
			</div>
			<div class="col m2 hide-small-only">
				pesqusa	
			</div>
			<div class="col s12 black" id="container-mais-acessados">
				+ACESSADOS	
			</div>
		</nav>
		<?php endif; ?>	
</div>