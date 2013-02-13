<?php
/**
 * @package WordPress
 * @subpackage The Crest - Homepage Sidebar
 */
?>

<div class="home sidebar right">
	<ul>
		<li>
			<?php
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-sb') ) :
				endif; 
			?>
		</li>
	</ul>
</div>
<!-- #home sidebar ends -->
		
	