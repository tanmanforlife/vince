<?php
/**
 * @package WordPress
 * @subpackage The Crest
 */
?>

	</div><!-- #main  -->

	<footer id="colophon" role="contentinfo">
			<div id="outer-container">
				<div class="clear">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
                    <div class="email left">
                      <form class="email-form">
                      <input class="join" type="text" value="Join Our Email List" onfocus="if (this.value=='Join Our Email List') this.value='';" onblur="if (this.value=='') this.value='Join Our Email List';">
                      <input class="submit-email" type="submit" value="submit" >
                      </form>
                    </div>
                    <ul class="social-footer" class="left">
                        <li id="twitter-btn"><a target="_blank" href="http://twitter.com/vincecamuto" title="twitter">Twitter <span></span></a></li>
                        <li id="facebook-btn"><a target="_blank" href="https://www.facebook.com/vincecamutofans" title="Facebook">Facebook <span></span></a></li>
                        <li id="pinterest-btn"><a target="_blank" href="http://pinterest.com/vincecamuto" title="Pinterest">Pinterest <span></span></a></li>
                        <li id="instagram-btn"><a target="_blank" href="http://instagram.com/vincecamuto" title="Instagram">Instagram <span></span></a></li>
                        <li id="email-btn"><a href="#" title="Email">Email <span></span></a></li>
                    </ul>
                </div>
                <h1>Shop</h1>
                <?php wp_nav_menu( array( 'theme_location' => 'footer_store',   'items_wrap' => '<ul id="store-links" class="clear">%3$s</ul>'   ) ); ?>
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/thecrest.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/easing.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/nivo.slider.pack.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.js"></script>
<script type="text/javascript" src="<? echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>

<?php if(is_single()): ?>
<script type="text/javascript">
$(window).load(function() {
  $("a.fancybox").fancybox({
    prevEffect : 'fade',
    nextEffect : 'fade',
    width: 850,
    arrows     :  true,
    afterLoad : function() {
      if(this.group.length > 1 ) {
        this.title =  (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title: '');
      }
      this.outer.prepend();
    }
  });
});
</script>
<?php endif; ?>


</body>
</html>