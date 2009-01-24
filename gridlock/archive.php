<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="main_content">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. From Kubrick. ?>
	
	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="subhead"><?php bloginfo('name'); ?> Archives: <?php echo single_cat_title(); ?></h3>

	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="subhead"><?php bloginfo('name'); ?> Archives: <?php the_time('F Y'); ?></h2>
	
	<?php /* If this is a search */ } elseif (is_search()) { ?>
		<h3 class="subhead">Search Results for <?php echo($_GET['s']); ?></h3>
	
	<?php } // end dynamic header ?>
	
	<h4 class="comment"><?php next_posts_link('next page'); ?>  &middot;
		<?php previous_posts_link('previous page'); ?></h4>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
	
	 <?php while (have_posts()) : the_post(); ?>
	<div class="excerpt">
		<h3 class="substory_subhead"><?php the_time('j F Y'); ?></h3>
		<h3 class="substory_head"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php the_title(); ?>
		</a></h3>
		
		<?php the_excerpt(); ?>
		
		<h4 class="comment"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<strong>continue reading...</strong></a> &raquo; 
		<?php comments_popup_link('0 Comments', 'One Comment', '% Comments', '', 'Comments Locked'); ?>
		</h4>
	
	</div>
	<?php endwhile; ?>
	
	<h4 class="comment"><?php next_posts_link('next page');  ?>  &middot;
		<?php previous_posts_link('previous page'); ?></h4>
		
	<?php else: ?>
	
	<p><em>No posts were found with this query. If you think you've reached this 
	in error, <a href="mailto:<?php bloginfo('admin_email'); ?>">e-mail the administrator(s)</a> of this site.</em></p>
	
	<?php endif; ?>
	
</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>