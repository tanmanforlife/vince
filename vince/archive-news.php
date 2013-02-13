<?php
/**
 * Template Name: News Landing Page
 * @package WordPress
 * @subpackage The Crest - News Landing Page Archive
 */

get_header(); ?>

		<div id="primary">
			<div id="content">
                    <?php query_posts(array('post_type'=>'news','posts_per_page'=>6,'paged'=>get_query_var('paged'))); 

                     if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                ?>
                
                    <div class="news-post post clear">
                        
                        <div class="news-thumb left">
                            <a href="<? the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        </div>
                        
                        <div class="news-article left">
                        <?php //Display Parent Category 
                        $parentscategory ="";
                        foreach((get_the_category()) as $category) {
                            if ($category->category_parent == 0) {
                                $parentscategory .= ' <a class="cat" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
                            }
                        }
                        echo substr($parentscategory,0,-2); 
                        ?>
                        
                        <h2 class="entry-title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
                        <span class="date"><? the_time('l, F jS, Y') ?> </span>
                        <p><? the_excerpt(); ?> </p>
                        <a class="read-more" href="<? the_permalink(); ?>">Read More</a>
                    </div>
                    </div>
                                        
                <?php endwhile; ?>
            <?php endif; ?>
			</div><!-- #content -->
            
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <nav>
                <?//php previous_posts_link('&laquo; Newer') ?>
                <?//php next_posts_link('Older &raquo;') ?>
                
                <?php wp_pagenavi(); ?>
            </nav>
            <?php endif; ?> 
                        
            <a class="more">MORE</a>                  

		</div><!-- #primary -->

<?php get_footer(); ?>

