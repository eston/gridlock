<?php
/*
Template Name: Search Results
*/
?>

<?php get_header(); ?>

<div id="main_content">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. From Kubrick. ?>
	
		<h3 class="subhead">Search Results</h3>
	
	<h4 class="comment"><?php next_posts_link('next page'); ?> &middot; 
		<?php previous_posts_link('previous page'); ?></h4>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
	
	 <?php while (have_posts()) : the_post(); ?>
	<div class="excerpt">
		<h3 class="substory_subhead"><?php the_time('F j Y'); ?></h3>
		<h3 class="substory_head"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php the_title(); ?>
		</a></h2>
		
		<?php the_excerpt(); ?>
		
		<h4 class="comment"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<strong>continue reading...</strong></a> &raquo; 
		<?php comments_popup_link('0 Comments', 'One Comment', '% Comments', '', 'Comments Locked'); ?>
		</h4>
	
	</div>
	<?php endwhile; ?>
	
	<h4 class="comment"><?php next_posts_link('next page');  ?> &middot; 
		<?php previous_posts_link('previous page'); ?></h4>
		
	<?php else: ?>
	
	<p><em>No entries were found with this query. If you think you've reached this 
	in error, <a href="mailto:<?php bloginfo('admin_email'); ?>">e-mail the administrator(s)</a> of this site.</em></p>
	
	<?php endif; ?>
	
</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>