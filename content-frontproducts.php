<?php
/**
 * The template for displaying featured products on Front Page 
 *
 * @package tatva
 * @since tatva 1.0
 */
?>

<?php
if (class_exists('Easy_Digital_Downloads')) {

    // check if user has enabled featured products for front page
    if (get_theme_mod('tatva_edd_front_featured_products')) {  ?>
<div class="product-widget">
	<div class="product-wrap">
        <div class="store-info">
            <?php if (get_theme_mod('tatva_edd_store_archives_title')) : ?>
                <h2 class="store-title"><?php echo get_theme_mod('tatva_edd_store_archives_title'); ?></h2>
                <?php endif; ?>
                <?php if (get_theme_mod('tatva_edd_store_archives_description')) : ?>
                <div class="store-description">
                <?php echo wpautop(get_theme_mod('tatva_edd_store_archives_description')); ?>
                </div>
        <?php endif; ?>
        </div>

        <div class="row" id="home-featured">
            <div class="col grid_12_of_12" id="featured-products">

                <?php
                if (class_exists('Easy_Digital_Downloads')) {
                    $per_page = intval(get_theme_mod('tatva_store_front_featured_count'));
                    $product_args = array(
                        'post_type' => 'download',
                        'posts_per_page' => $per_page
                    );
                    $products = new WP_Query($product_args);
                    ?>
            <?php if ($products->have_posts()) : $i = 1; ?>
                <?php while ($products->have_posts()) : $products->the_post(); ?>
                            <div class="col grid_4_of_12 product<?php if ($i % 3 == 0) { echo ' last'; } ?>">

                                <h3 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                         <?php the_post_thumbnail('product-image'); ?>
                                    </a>
                                           

                                        <div class="product-info">
                                        
                                        <?php if (function_exists('edd_price')) { ?>
                                            <div class="product-buttons">
                                                <?php if (get_theme_mod('tatva_product_view_details')) : ?>
                                                      <a class="view-details" href="<?php the_permalink(); ?>">
                                                          <?php echo get_theme_mod('tatva_product_view_details'); ?>
                                                      </a>
                                                <?php endif; ?>
                                            </div><!--end .product-buttons-->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!--end .product-->
                            <?php $i+=1; ?>
                        <?php endwhile; ?>
                    <?php else : ?>

                        <h2 class="title"><?php _e('Not Found','tatva'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','tatva'); ?></p>
                    <?php get_search_form(); ?>
            <?php endif; ?>
        <?php } ?>
            </div> <!--end #featured-products -->
        </div> <!-- end #home-featured -->
		<div class="browse-products">
			<div class="productbutton">
					<form>
						<input type="button" id="button" value="Browse all products">
					</form>
			</div>
			</div>
	</div>
</div>
    <?php
    } // end EDD enabled check
} // end EDD Plugin activation check 
?>