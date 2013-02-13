<?php
/**
 * @package WordPress
 * @subpackage The Crest - Eventpage Sidebar
 */
?>

<div class="events sidebar right">
	<ul>
		<li>
			<?php
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('events-sb') ) :
				endif; 
			?>
		</li>
	</ul>
</div>
<!-- #events sidebar ends -->
		
	