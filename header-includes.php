<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<?php endif; ?>
<?php wp_head(); ?>
<script>
	jQuery(document).ready(function(){
		var altura = jQuery(window).height();
		
		/*variaveis para scroll*/
		var offset = jQuery('#topo').offset().top;
		var $meuMenu = jQuery('#topo'); 
		
		/*		Habilitar Megamenu	 	*/
		jQuery("#container-menu-topo nav ul li").hover(
			function(){
				jQuery(".mega-menu").addClass("hide");
				menu_text = jQuery(this).find('a').html();
				jQuery("#mega-menu-"+menu_text).removeClass("hide");
			}
		)
		/* Funcao para desabilitar mega menu */
		jQuery(".mega-menu").mouseleave(function(){
			jQuery(".mega-menu").addClass("hide");
		});
		
		
		jQuery(document).on('scroll', function () {
			if (offset <= jQuery(window).scrollTop()) {
				$meuMenu.addClass('fixo');
			} else {
				$meuMenu.removeClass('fixo');
			}
		});
		
		/* funcao menu mobile */
		jQuery("#mobile-menu").css("height", altura);
		jQuery("#mobile-ico-menu").toggle(
			function(){
				jQuery("#mobile-menu").removeClass("hide");	
			},
			function(){
				jQuery("#mobile-menu").addClass("hide");	
			}
		);
	});
	
</script>