<?php
/**
 * Template Name: Events Page
 * @package WordPress
 * @subpackage The Crest - Events Page
 */

get_header(); ?>

		<div id="primary">
			<div id="content">
			
			<!-- Main Event Header -->
			<div class="event-header">
				<a href="#">
					<img src="#"/>
				</a>
				<!-- IMAGE HERE -->
			</div>
			<!-- // -->
			                  
			<?php query_posts(array('post_type'=>'events')); ?> 
			
               <?php if ( have_posts()) : $i = 0; while ( have_posts() && $i < 1 ) : the_post(); ?>
			
				<div class="event-description">
					<?php the_content(); ?>
				</div>
			
			<?php $i++; endwhile; else: ?>
            	<p><?php _e('Sorry, no events listed'); ?></p>
            <?php endif; ?>       

			</div><!-- #content -->
		</div><!-- #primary -->
		<div class="push"></div>

<?php get_footer(); ?>