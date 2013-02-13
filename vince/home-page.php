<?php
/**
 * Template Name: Home Page
 * @package WordPress
 * @subpackage The Crest - Home Page
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="clear">
                
                <!-- Home Page Carousel -->
                <div class="slider-wrapper">
                    <div id="home-carousel" class="nivoSlider">
                       <? $rows = get_field('carousel'); ?> 
                       <? if($rows) : ?>
                            <? foreach($rows as $row) : ?>
                            <?
                                $carousel_image = $row['carousel_image'];
                                $image_url = $row['carousel_url'];
                            ?>
                                                                
                                <a href="<? echo $image_url; ?>"><img src="<? echo $carousel_image; ?>" width="996" height="447" /></a>
                            
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
                <!-- // -->
                            
                
                <!-- Featured Post - Pulling 4 Latest from Featured Post Type-->
                <ul id="featured-grid" class="left">
                    
                    <?php $the_query = new WP_Query( array('post_type'=>'featurepost') ); ?>
                
                    <?php if ( $the_query->have_posts()) : $i = 0; while ( $the_query->have_posts() && $i < 4 ) : $the_query->the_post(); ?>
                        <li>
                            <h2 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2> 
                            <a href="<? the_permalink(); ?>"><img src="<?php the_field('small_thumb'); ?>" alt="<?php the_title(); ?>"/></a>
                            <?php the_excerpt(); ?>
                        </li>
                    <?php $i++; endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?> 
                    <? wp_reset_postdata(); ?>
                    
                </ul>
                <!-- // -->
                
                <?php get_sidebar('homepage'); ?>
                
                <!-- Recently Featured Products -->
                <div class="recently-featured-products">
                    <h3>Recently Featured</h3>
                    <!-- "previous page" action -->
                    <a class="prev browse left">left</a>
                    <a class="next browse right">right</a>

                    <div class="scroller" id="scrollable">
                        <div class="products-carousel clear"> 
                        <?php $posts = get_field('recently_featured'); ?>
                        <? if($posts): ?>
                            <div class="clear"> <!-- New Section Starts -->
                            <? for ($j = 1; $j <= count($posts); ++$j): ?>
                                
                                <?php $post_object = $posts[$j-1]; ?>
                                <?php $status = $post_object->post_status; if($status === "publish") : ?> 
                                    <?php if($post_object->ID) : ?>
                                <div class="the-product">
                                <a href="<? the_field('store_link', $post_object->ID); ?>">
                                    <img src="<? the_field('product_image', $post_object->ID); ?>"/>
                                    <h4><? the_field('product_name', $post_object->ID); ?></h4>
                                    <span class="product-price">$<? the_field('product_price', $post_object->ID); ?></span>
                                </a>
                                </div>
                                    <? if (0 == $j % 5): ?>
                                <!-- end of section -->
                            </div>
                            <div class="clear"> <!-- New Section Starts 2 -->
                                    <? endif; ?>
                                    <? endif; ?>
                                <? endif; ?>
                            <? endfor; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <!-- #recently-featured  -->
                
                
                <div id="test-featured">
                                        
                </div>

			</div><!-- #content -->
            
		</div><!-- #primary -->
    

<?php get_footer(); ?>