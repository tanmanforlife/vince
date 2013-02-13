<?php
/**
 * @package WordPress
 * @subpackage The Crest - Vince Camuto
 */


get_header(); ?>

		<div id="primary" class="letters">
			<div id="content">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="top-content">
 					<nav id="nav-above" role="article">
						<div class="nav-previous"><?php previous_post_link( '%link', ' <span class="meta-nav">' . _x( '', 'Prev', 'The Crest' ) . '</span> Prev' ); ?></div>
						<div class="nav-next"><?php next_post_link( '%link', 'Next <span class="meta-nav">' . _x( '', 'Next', 'The Crest' ) . '</span>' ); ?></div>
					</nav> <!-- #nav-above -->
                    
                    <?php //Display Parent Category 
                        $parentscategory ="";
                        foreach((get_the_category()) as $category) {
                            if ($category->category_parent == 0) {
                                $parentscategory .= ' <span class="cat" title="' . $category->name . '">' . $category->name . '</span>, ';
                            }
                        }

                        echo substr($parentscategory,0,-2); 
                        ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<span class="date center"><? the_time('l, F jS, Y') ?> </span>
				</div>
			<?php endwhile; // end of the loop. ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                
                <?php
                $rows = get_field('carousel'); 

                 if($rows) : //checking if there are any slides ?> 
				<!-- Article Carousel -->
				<div class="slider-wrapper">
                    <div id="article-carousel" class="nivoSlider">
                       <? 
                       ?> 
                       <? if($rows) : ?>
                        <?php //var_dump($rows); ?>
                            <? foreach($rows as $row) : ?>
                            <?
                                $carousel_image = $row['image'];
                                $carousel_headline = $row['headline'];
                                $the_headline = str_replace(' ', '', $carousel_headline);
                            ?>
                            <img src="<? echo $carousel_image; ?>" width="996" height="548" title="#<?php echo $the_headline; ?>"/>
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                    <!-- end -->
                </div>
                <!-- // Article Carousel -->
                
                
                <!-- Caption -->
                    <?php if( get_field('carousel') ): ?>
                        <?php while( has_sub_field('carousel') ): ?>
                            <?php if( get_sub_field('product_info') ): ?>
                            
                            <?php //$caption_rows = get_field('carousel'); ?>
                            <?php //foreach($caption_rows as $caption_row) : ?>
                            <?php 
                                //$carousel_headline = $caption_row['headline'];
                                //$the_headline = str_replace(' ', '', $carousel_headline);
                            ?>

                            <div id="<?php echo $the_headline;  ?>" class="nivo-html-caption">
                                <h3><?php echo $carousel_headline; ?></h3>
                                <hr>      
                                <ul class="product-list">
                                    <?php while( has_sub_field('product_info') ): ?>
                                    <?php 
                                        $product_name = get_sub_field('product_name');
                                        $product_price = get_sub_field('product_price');
                                        $product_url = get_sub_field('product_store_url');                                                                   
                                    ?>
                                    <li>
                                        <a href="<?php echo $product_url; ?>">
                                            <h4><?php echo $product_name; ?></h4>
                                            <span class="price"><?php echo $product_price; ?></span>
                                        </a>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <?php //endforeach; ?>
                            
                            <?php endif; ?> 
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; // end of checking slides ?> 
                <!--// Caption -->


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<div class="entry-content">
						<?php the_content(); ?>
                        
                        
                        <?php $title = get_field('title_of_section'); if($title) : ?>
						<h3 class="products-title"><?php the_field('title_of_section'); ?></h3>
                        <?php the_field('description_top'); ?>
                        <?php endif; ?>
                        
                        <!-- Product Feature Carousel -->
                        <?php $products = get_field('product'); ?>
                        <?php if($products) : ?>
                        <div class="product-slider">
                            <a class="prev browse left">left</a>
                            <a class="next browse right">right</a>
    
                            <!-- Scroller -->
                            <div class="scroller" id="scrollable">
                                <div class="products-carousel clear"> 

                                        <div class="clear"> <!-- New Section Starts -->
                                        <?php $j=0; foreach($products as $product_object) : ?>
                                            <div class="the-product">
                                                <a href="<?php the_field('product_url', $product_object->ID); ?>">
                                                    <img src="<?php the_field('product_image', $product_object->ID); ?>"/>
                                                    <h4><? the_field('product_name', $product_object->ID); ?></h4>
                                                    <span class="product-price">$<? the_field('product_price', $product_object->ID); ?></span>
                                                </a>
                                                <?php if ( (($j + 1) % 3) === 0 ) : ?>
                                                </div>
                                                </div>
                                                <div class="clear"> <!-- New Section Starts 2-->
                                                <div class="the-product">
                                                <?php endif; ?>
                                            </div>
                                        <?php $j++; endforeach; ?>
                                </div>
                            </div>
                            <!-- //Scroller -->
                        </div>
                        <!-- // Product Feature Carousel -->
                        <?php endif; ?>

                        <?php the_field('description_bottom'); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'The Crest' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
            
			<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->

		</div><!-- #primary -->
        <div class="push"></div>

<?php get_footer(); ?>