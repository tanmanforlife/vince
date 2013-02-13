    <?php
    /**
     * Template Name: News Landing Page
     * @package WordPress
     * @subpackage The Crest - News Landing Page
     */

    get_header(); ?>

    		<div id="primary">
    			<div id="content">
                  
                <?php                  
                
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $the_query = query_posts(array('post_type' => 'newspost', 'posts_per_page' => 2, 'paged'=>$paged));
                ?>                    
                        
                        <?php //query_posts(array('post_type'=>'news','posts_per_page'=>6,'paged'=>get_query_var('paged'))); ?> 
                        

                         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
    
                        <div class="news-post post clear">
                            
                            <div class="news-thumb left">
                                <a href="<? the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                            
                            <div class="news-article left">
                            <?php //Display Parent Category 
                            $parentscategory ="";
                            foreach((get_the_category()) as $category) {
                                $parentscategory .= ' <span class="cat" title="' . $category->name . '"><a href="'.  site_url('/category/') . $category->slug . '">' . $category->name . '</a></span>, ';
                            }
                            echo substr($parentscategory,0,-2); 
                            ?>
                            
                            <h2 class="entry-title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
                            <span class="date"><? the_time('l, F jS, Y') ?> </span>
                            <p><?php echo limit_words(get_the_excerpt(), '40'); ?> </p>
                            <a class="read-more" href="<? the_permalink(); ?>">Read More</a>
                        </div>
                        </div>
                                            
                    <?php endwhile; ?>
                <?php endif; ?>
    			</div><!-- #content -->
                
                <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <nav class="pagination">
                    <?php previous_posts_link(' '); ?>
                    <?php next_posts_link(' '); ?>
                </nav>
                <?php endif; ?> 
                
<!--                 <a class="more">MORE</a> 
 -->
    		</div><!-- #primary -->
            <div class="push"></div>
    <?php get_footer(); ?>

