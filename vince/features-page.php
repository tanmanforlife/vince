<?php
/**
 * Template Name: Features Landing Page
 * @package WordPress
 * @subpackage The Crest - Features Landing Page
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="clear">
                <ul id="features-list">
                <?php query_posts(array('post_type'=>'featurepost','posts_per_page'=>6,'paged'=>get_query_var('paged'))); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                    <li class="features-post post">
                        <h2 class="entry-title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
                        <a href="<? the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <p><? the_excerpt(); ?> </p>
                        <a class="read-more" href="<? the_permalink(); ?>">Read More</a>
                    </li>
                    
                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>   
                </ul>				
			</div><!-- #content -->
        
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <nav class="pagination">
                <?php previous_posts_link(' '); ?>
                <?php next_posts_link(' '); ?>
            </nav>
            <?php endif; ?> 

		</div><!-- #primary -->
        <div class="push"></div>

<?php get_footer(); ?>

