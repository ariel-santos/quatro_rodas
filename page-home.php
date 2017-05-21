<?php 
	/* Template Name: Pag Home */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<?php get_header('includes'); ?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/mansory.js"></script>
		<script>
			jQuery(document).ready(function(){
				x = jQuery(document).width() - 30;  
				
				if( x < 600){
					modulo = x;
					modulo2 = x;
				}else{
					modulo = x / 4;
					modulo2 = x / 2;
				}
				
				jQuery(".m1x1").css({"width": modulo });
				jQuery(".m2x2").css({"width": modulo2 });
				
				jQuery('#container-mansory').masonry({
					itemSelector: '.modulo',
					columnWidth: modulo,
					horizontalOrder: false
				});
			});
		</script>
	</head>
	<body>
		<?php get_header('topo'); ?>	
		<div class="row">
			<div class="col s12" id="container-mansory">
				<?php 
					global $wpdb;
					$destaques = $wpdb->get_results("
						SELECT wpp.ID, wpp.post_title, qrn.* 
						FROM qr_noticias qrn, wp_posts wpp
						WHERE wpp.post_type = 'noticia'
						AND post_status = 'publish'
						AND wpp.ID = qrn.noticia_id
						AND qrn.destaque = 1
					");
					$categoria = array("Carros Grandes", "Fabricantes", "Promovido por volkswagem", "Comparativos", "Impressões", "Auto-serviço	");
					foreach( $destaques as $d ){
						$url = get_the_post_thumbnail_url($d->ID, 'medium');
						?>
							<div class="modulo m<?php echo $d->modulo; ?>">
								
									<img src="<?php echo $url; ?>" class="responsive-img">
									<div class="modulo-text">
										<p>
											<span class="icone"></span>
											<span><?php echo $categoria[$d->categoria]; ?></span>
										</p>	
										<h1><?php echo $d->post_title; ?></h1>
									</div>	
									
							</div>
						<?php 
					}
				?>
			</div>
		</div>
		<div class="row" id="container-novos">
			<?php 
				$novos = $wpdb->get_results("
					SELECT wpp.ID, wpp.post_title, qrn.* 
					FROM wp_posts wpp, qr_noticias qrn
					WHERE wpp.post_type = 'noticia'
					AND wpp.post_status = 'publish'
					AND wpp.ID = qrn.noticia_id
					ORDER BY wpp.ID DESC 
					LIMIT 4
				");
				foreach($novos as $n){
					$url = get_the_post_thumbnail_url($n->ID, 'medium');
					?>
						<div class="col s12 m6 l3">
							<a href="#!">
								<img src="<?php echo $url; ?>" class="responsive-img">
								<p>
									<span class="icone"></span>
									<span><?php echo $categoria[$n->categoria]; ?></span>
								</p>
							</a>
							<a href="#!">
								<h1><?php echo $n->post_title; ?></h1>
							</a>	
							<?php the_excerpt(); ?>
						</div>
					<?php
				}
			?>
		</div>
		<?php get_footer(); ?>
	</body>
</html>