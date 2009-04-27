<?php
  
  // widgetised by will docherty.
  // thanks will. -eston (9 october 2007)

?>

<div id="sidebar">
	
	<?php if(get_option('gridlock_about_blurb') != '') { ?>
  <img id="about" src="<?php bloginfo('stylesheet_directory'); ?>/images/about.gif" alt="about the author" />

	<div id="aboutAuthor">

    <p><?php echo(wptexturize(stripslashes(get_option('gridlock_about_blurb')))); ?> 
		
		<?php if(get_option('gridlock_about_slug') != '') { ?>
		<a href="<?php bloginfo('url'); ?>/<?php echo(get_option('gridlock_about_slug')); ?>">read more&hellip;</a></p>
		<?php } ?>
		
  </div> 
	<?php } ?>
  
  <ul>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : ?>
    
    <li><h2>Categories</h2>
        <ul><li>
            <?php wp_list_categories('orderby=name&title_li=&style=list'); ?>
        </li></ul>
		</li>
        
		<?php 
			// Detect links to maintain XHTML validity in case no links exist.
			// Fehler-Bericht von Florian Holzhauer (fholzhauer.de). Danke sehr, Florian.
			
			if(get_links('-1', '<li>', '</li>', '<br />', FALSE, 'name', FALSE, FALSE, -1, FALSE, FALSE)) {
		?>
    <li><h2>Links</h2>
           <ul>
				<?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'name', FALSE); ?>
           </ul>
		</li>
		<?php } ?>
        
        
        <li><h2>Meta</h2>
        <ul>
            <li><?php wp_loginout(); ?></li>

            <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
            <li><a href="http://jigsaw.w3.org/css-validator/check/referer">Valid CSS</a></li>
			<?php if(is_home()) { ?>
            <li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?Url1=<?php urlencode(bloginfo('url')); ?>">508</a></li>
            <?php } ?>
			      <li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>">WordPress</a></li>
			<?php if(get_option('gridlock_disable_sifr') == 'false') { ?>
            <li><a href="http://www.mikeindustries.com/sifr/" title="Scalable Inman Flash Replacement">sIFR</a> Rich Typography</li>
			<?php } ?>
			      <li><a href="http://socialuxe.com/labs/gridlock/" title="Gridlock 1.5 by Eston Bond">Gridlock 1.5</a> by <a href="http://socialuxe.com/">Socialuxe</a></li>

            <?php wp_meta(); ?>
        </ul>
        </li>
<?php endif; // end widgetised sidebar. ?>

    </ul>

</div>