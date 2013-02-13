<?php
/**
 * @package WordPress
 * @subpackage The Crest - Category Page
 */

get_header(); ?>
    <div id="primary">
        <div id="content">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                $current_cat = get_query_var('cat');
                $temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query();
                    $wp_query->query(array(
                    'post_type'=>'newspost',
                    'paged' => $paged,
                    'posts_per_page' => 6,
                    'cat'=> $current_cat                
                ));
                
            ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <!-- Do special_cat stuff... -->
            <div class="news-post post clear">
                <div class="news-thumb left">
                    <a href="<? the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                
                <div class="news-article left">                    
                               
                    <?php foreach((get_the_category()) as $childcat) : ?>
                        <?php $parent_catid = $childcat->category_parent; ?>
                        <?php if(cat_is_ancestor_of($parent_catid, $childcat)) : ?>
                            <span class="cat"><a href="<?php echo get_category_link($childcat->cat_ID)?>"> <?php echo $childcat->cat_name; ?></a> </span>                                
                        <?php else : ?>
                            <span class="cat"><a href="<?php echo get_category_link($childcat->cat_ID)?>"> <?php echo $childcat->name; ?></a> </span>                                
                        <?php ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                    <h2 class="entry-title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h2>
                    <span class="date"><? the_time('l, F jS, Y') ?> </span>
                    <p><? the_excerpt(); ?> </p>
                    <a class="read-more" href="<? the_permalink(); ?>">Read More</a>
                </div>
            </div>
                        
            <?php endwhile;?>
        </div><!-- #content -->
                <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                <nav class="pagination">
                    <?php previous_posts_link('hello'); ?>
                    <?php next_posts_link('hello'); ?>
                </nav>
                <?php endif; ?> 
    </div>
    <div class="push"></div>
<?php get_footer(); ?>