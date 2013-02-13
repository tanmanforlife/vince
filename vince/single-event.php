<?php
/**
 * @package WordPress
 * @subpackage The Crest - Vince Camuto - Events
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="event clear">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                
				<!-- Article Carousel -->
				<div class="slider-wrapper">
                    <img src="<?php the_field('main_image'); ?>"/>
                    <a class="cal-download" href="<?php the_field('calendar_event_download'); ?>"></a>
                </div>
                <!-- // Article Carousel -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<div class="entry-content">
						<?php the_content(); ?>

                        <?php the_field('description_bottom'); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'The Crest' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
                    
                    <!-- Socials -->
                    <?php include('social-share.php'); ?>
                    
				</article><!-- #post-<?php the_ID(); ?> -->
            
			<?php endwhile; // end of the loop. ?>
			
                <ul id="single-sidebar-event">
                    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                        <li id="headline">
                            <h3><?php the_field('headline'); ?></h3>
                        </li>
                        
                        <li>
                            <?php
                                $date = DateTime::createFromFormat('Ymd', get_field('date'));
                                
                            ?>
                            <span class="time"><?php the_field('time'); ?></span>
                            <span class="date"><?php echo $date->format('F d, Y'); ?></span>
                        </li>
                        <li>
                            <p><?php the_field('description'); ?></p>
                        </li>
                        <li id="locations">
                            <ul class="places">
                                <?php
                                    $rows = get_field('locations'); 
                                ?>
                                <?php if($rows) :?>
                                <?php foreach($rows as $row) : ?>
                                <?php 
                                    $location_name = $row['name_or_location'];
                                    $location_address = $row['address'];
                                ?>
                                    <li>
                                        <h4><?php echo $location_name; ?></h4>
                                        <span class="address"><?php echo $location_address; ?></span>
                                    </li>
                                <?php endforeach; ?>
                                <?php endif;?>
                                
                            </ul>
                        </li>
                        
                    <?php endwhile;?>
                </ul>
			</div><!-- #content -->

		</div><!-- #primary -->
        <div class="push"></div>

<?php get_footer(); ?>