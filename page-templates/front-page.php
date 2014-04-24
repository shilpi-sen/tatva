 <?php
/**
 * Template Name: Front Page Template
 *
 * Description: Displays a full-width front page. The front page template provides an optional
 * banner section that allows for highlighting a key message. It can contain up to 2 widget areas,
 * in one or two columns. These widget areas are dynamic so if only one widget is used, it will be
 * displayed in one column. If two are used, then they will be displayed over 2 columns.
 * There are also four front page only widgets displayed just beneath the main content. Like the
 * banner widgets, they will be displayed in anywhere from one to four columns, depending on
 * how many widgets are active.
 *
 * @package  Tatva
 * @since  Tatva 1.0
 */

get_header(); ?>
	<div id="bannercontainer">
		<div class="banner row">
			<?php if ( is_front_page() ) {
				// Count how many banner sidebars are active so we can work out how many containers we need
				$bannerSidebars = 0;
				for ( $x=1; $x<=2; $x++ ) {
					if ( is_active_sidebar( 'frontpage-banner' . $x ) ) {
						$bannerSidebars++;
					}
				}

				// If there's one or more one active sidebars, create a row and add them
				if ( $bannerSidebars > 0 ) { ?>
					<?php
					// Work out the container class name based on the number of active banner sidebars
					$containerClass = "grid_" . 12 / $bannerSidebars . "_of_12";

					// Display the active banner sidebars
					for ( $x=1; $x<=2; $x++ ) {
						if ( is_active_sidebar( 'frontpage-banner'. $x ) ) { ?>
							<div class="col <?php echo $containerClass?>">
								<div class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'frontpage-banner'. $x ); ?>
								</div> <!-- /.widget-area -->
							</div> <!-- /.col.<?php echo $containerClass?> -->
						<?php }
					} ?>

				<?php }
			} ?>
		</div> <!-- /.banner.row -->
	</div> <!-- /#bannercontainer -->

		<div id="home-widget-container">
		<div class="widget-content">
			<?php if ( is_front_page() ) {
				// Count how many banner sidebars are active so we can work out how many containers we need
				$homeSidebars = 0;
				for ( $x=1; $x<=4; $x++ ) {
					if ( is_active_sidebar( 'sidebar-homepage' . $x ) ) {
						$homeSidebars++;
					}
				}

				// If there's one or more one active sidebars, create a row and add them
				if ( $homeSidebars > 0 ) { ?>
					<?php
					// Work out the container class name based on the number of active banner sidebars
					$containerClass = "grid_" . 12 / $homeSidebars . "_of_12";

					// Display the active home sidebars
					for ( $x=1; $x<=4; $x++ ) {
						if ( is_active_sidebar( 'sidebar-homepage'. $x ) ) { ?>
							<div class="home-product col <?php echo $containerClass?>">
								<div class="home-widget-area" role="complementary">
									<?php dynamic_sidebar( 'sidebar-homepage'. $x ); ?>
								</div> <!-- /.widget-area -->
							</div> <!-- /.col.<?php echo $containerClass?> -->
						<?php }
					} ?>

				<?php }
			} ?>
		</div> <!-- /.widget-content-->
	</div> <!-- /#home-widget-container -->
	<div class="testimonial-container">
		<div class="testimonial">
			<?php dynamic_sidebar('testimonial'); ?>
		</div>
	</div> 
	<?php
	
			 // Display featured products on front page
            get_template_part('content', 'frontproducts');
			
            // Display featured posts on front page
            get_template_part('content', 'frontposts');
            ?>
	

<?php get_footer(); ?>

