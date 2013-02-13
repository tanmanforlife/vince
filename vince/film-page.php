<?php
/**
 * Template Name: Film Landing Page
 * @package WordPress
 * @subpackage The Crest - Film Landing Page
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="film clear">
                
                <?php query_posts(array('post_type'=>'film', 'showposts' => '1')); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div id="hero-container" class="clear">
                    <div id="hero" class="left">
                        <div class="yt-embed"><?php the_field('youtube_embed'); ?></div>
                    </div>
                    
                    <div id="hero-content" class="left">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <span class="date"><? the_time('l, F jS, Y') ?> </span>
                        <? the_excerpt(); ?>
                    </div>
                </div>
                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>  
                
                <ul id="secondary" class="clear">
                    <!-- Next 3 Posts -->
                    <?php query_posts(array('post_type'=>'film', 'showposts' => '3', 'offset' => '1')); ?>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <li class="left">
                            <div class="video">
                                <a title="<?php the_title(); ?>" class="video-thumb" href="http://www.youtube.com/watch?v=<?php the_field('youtube_url'); ?>&amp;autoplay=1">
                                    <img src="<?php the_field('thumbnail'); ?>"/>
                                    <span class="duration"><?php the_field('duration'); ?></span>
                                    <h2 class="entry-title"><?php the_title(); ?></h2>
                                </a>
                                <span class="date"><? the_time('l, F jS, Y') ?> </span>
                            </div>
                        </li>
                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>              
                </ul>
			</div><!-- #content -->
		</div><!-- #primary -->
        <div class="push"></div>

<?php get_footer(); ?>