<?php
/**
 * @package WordPress
 * @subpackage The Crest - Vince Camuto
 */

get_header(); ?>

        <div id="primary">
            <div id="content">
                
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div id="top-content">
                    <nav id="nav-above" role="article">
                        <div class="nav-previous"><?php previous_post_link( '%link', ' <span class="meta-nav">' . _x( '', 'Prev', 'The Crest' ) . '</span> Prev' ); ?></div>
                        <div class="nav-next"><?php next_post_link( '%link', 'Next <span class="meta-nav">' . _x( '', 'Next', 'The Crest' ) . '</span>' ); ?></div>
                    </nav><!-- #nav-above -->
                    
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
 
                <!-- Article Carousel -->
                <div class="slider-wrapper">
                   <img src="<?php the_field('main_header_image'); ?>"/>
                </div>
                <!-- // Article Carousel -->
                    
                <div class="article-cont clear">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

                    <div class="entry-content">
                        <?php the_content(); ?>
                        
                        <!-- Q&A -->
                        <ul class="qanda">
                        <?php 
                            $rows = get_field(qanda); 
                        ?>
                        <?php if($rows) : ?> 
                            <?php foreach($rows as $row) : ?>
                                <?php //setting up variables
                                    $question = $row['question'];
                                    $answer = $row['answer'];
                                 ?>
                                <li class="question">
                                    <span class="q">Q:</span> <?php echo $question; ?>
                                </li>
                                <li class="answer">
                                    <?php echo $answer; ?>
                                </li>
                                
                            <?php endforeach;?>
                        <?php endif; ?>
                        </ul>
                        <!-- //Q&A -->
                    
                        
                        <!-- Gallery Images -->
                        <script>
                            $(function() {
                                var fancybox_links = $('.entry-content a[rel*=gallery]:not(".fbignore")');
                                for (var i=0; i < fancybox_links.length; i++) {
                                    var t = fancybox_links[i],
                                        fbid = $(t).attr('href'),
                                        img = $(t).children('img'),
                                        rel = $(t).attr('rel'),
                                        rels = $('a[rel="'+rel+'"]'),
                                        target = $(fbid),
                                        total = rels.length;
console.log(rels);
                                    if(target.length) {
                                        var inner = '<img src="'+ img.attr('src') + '" alt="' + img.attr('title') +'" />' +
                                                    '<div class="image-info right">' +
                                                        '<h4>' + img.attr('title') + '</h4>' +
                                                        '<p>' + img.attr('alt') + '</p>' +
                                                        '<div class="btn-cont clearfix"></div>' +
                                                        '<div class="fancy-pager"> 1 of ' + total + '</div>' +
                                                    '</div>';
                                        target.html(inner);
                                    }  
                                }; 
                            });
                        </script>
                        <?php
                            $gallery_rows = get_field('gallery_images');
                            $gallery_rels = array();
                            if($gallery_rows > 0){
                                foreach($gallery_rows as $r) {
                                    $gallery_rels[] = $r['gallery_group_name'];
                                }
                            }
                            $gallery_totals = array_count_values($gallery_rels);
                            $gallery_rels = array_unique($gallery_rels);
                        ?>
                        <?php foreach($gallery_rels as $rel) { ?>
                            <div class="fancybox clear" style="display:none;" id="fancybox-<?php echo $rel; ?>" rel="rel-<?php echo $rel; ?>">
                            </div>
                        <?php } ?>
                            
                            <?php if($gallery_rows): ?>
                                <?php
                                    $current_slide = 1;
                                    $current_rel = $gallery_rows[0]['gallery_group_name'];
                                ?>
                                <?php $ticker = 0; foreach ($gallery_rows as $gallery_row): $ticker ++; ?>
                                <?php //setting up variables 
                                    $image = $gallery_row['image'];
                                    $group_name = $gallery_row['gallery_group_name'];
                                    $text = $gallery_row['text'];
                                    $image_title = $gallery_row['image_title'];
                                ?>
                                <?php if($current_rel == $group_name) {
                                    $current_slide +=1;
                                } else {
                                    $current_rel = $group_name;
                                    $current_slide = 2;
                                }?>
                                    
                                    <a href="#fancybox-extra-<?= $ticker; ?>" class="fancybox fbignore" rel="<?php echo $group_name; ?>" style="display:none;">&nbsp;</a>
                                    <div id="fancybox-extra-<?= $ticker; ?>" class="fancybox clear" style="display:none;" rel="rel-<?php echo $group_name; ?>">
                                        <img src="<?php echo $image; ?>"/>
                                        <div class="image-info right">
                                            <h4><?php echo $image_title; ?></h4>
                                            <p><?php echo $text; ?></p>
                                            <div class="btn-cont clearfix"></div>
                                            <div class="fancy-pager"><?php echo $current_slide; ?> of <?php echo $gallery_totals[$group_name] + 1; ?></div>
                                        </div>
                                    </div>
                                    
                                <?php endforeach; ?>
                            <!-- // -->
                            <?php endif; ?>
                        

                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'The Crest' ), 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
                    
                    <ul class="author clear">                        
                        <li class="writer"><span class="title">Writer</span> <span class="name"><?php the_author_meta('display_name'); ?>.</span></li>
                        
                        <? if(get_field('stylist')) : ?>
                            <li class="stylist"><span class="title">Stylist</span> <span class="name"><?php the_field('stylist'); ?>.</span></li>
                        <? endif; ?>
                        
                        <? if(get_field('photographer')) : ?>
                         <li class="photography"><span class="title">Photography</span> <span class="name"><?php the_field('photographer'); ?>.</span></li>                        
                        <? endif; ?>
                    </ul>
                    
                    <!-- Socials -->
                    <?php include('social-share.php'); ?>
                    
                </article><!-- #post-<?php the_ID(); ?> -->
            
            <?php endwhile; // end of the loop. ?>
            
                <ul id="single-sidebar">
                    <?php $the_query = new WP_Query( array('post_type'=>'featurepost') ); ?>                    
                    <?php if ( $the_query->have_posts()) : $i = 0; while ( $the_query->have_posts() && $i < 3 ) : $the_query->the_post(); ?>
                        <li>
                            <h2 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2> 
                            <a href="<? the_permalink(); ?>"><img width="295" src="<?php the_field('small_thumb'); ?>" alt="<?php the_title(); ?>"/></a>
                            <?php the_excerpt(); ?>
                        </li>
                    <?php $i++; endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?> 
                    <? wp_reset_postdata(); ?>
                </ul>
            </div><!-- .article-cont -->


            </div><!-- #content -->

        </div><!-- #primary -->
        <div class="push"></div>

<?php get_footer(); ?>