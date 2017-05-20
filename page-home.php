<?php 
	/* Template Name: Pag Home */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<?php get_header('includes'); ?>
	</head>
	<body>
		<?php get_header('topo'); ?>	
		<div class="row container">
			<div class="col s12">
				<?php
					while ( have_posts() ) : the_post();
						
					endwhile;
				?>
			</div>
		</div>
		<?php get_footer(); ?>
	</body>
</html>