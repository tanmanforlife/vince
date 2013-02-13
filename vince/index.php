<?php
/**
 * @package WordPress
 * @subpackage The Crest
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

				<?php get_template_part( 'loop', 'index' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>