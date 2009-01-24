<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="main_content">
	<h3 class="subhead"><?php bloginfo('name'); ?> Archives</h3>
	<p>Find what you're looking for.</p>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
<div class="substory" id="left">
			<h3 class="substory_subhead">Monthly Archives</h3>
            <p>
            <?php get_archives('monthly','','custom','','<br/>'); ?>
            </p>
</div>
<div class="substory" id="right">
			<h3 class="substory_subhead">Archives by Category</h3>
			<p>
			<?php wp_list_categories('orderby=name&style=none&title_li='); ?>
			</p>
</div>
		
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>