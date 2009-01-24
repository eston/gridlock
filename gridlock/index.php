<?php get_header(); ?>
<div id="main_content">

	<!-- first loop for featured article -->
	<?php $my_query = new WP_Query('cat='.get_option('gridlock_featured_cat').'&showposts=1');
	  while ($my_query->have_posts()) : $my_query->the_post();
	  $do_not_duplicate = array();
	  $do_not_duplicate[1] = $post->ID; // get one post from the "Features" category ?>

	<h3 class="subhead"><?php echo(stripslashes(get_option('gridlock_currentfeature_caption'))); ?></h3>
	<!-- get title -->
	<h2 id="headline"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
	
	<!-- post content -->
	<?php the_content('<em><strong>continue reading... &raquo;</strong></em>'); ?>

	<h4 class="comment">posted <?php the_time('j F Y'); ?> @ <?php the_time('G:i'); ?> by <?php the_author() ?>  
	 &raquo; <?php comments_popup_link('0 Comments', 'One Comment', '% Comments', '', 'Comments Locked'); ?> </h4>
	
	<!-- end first loop -->
	<?php endwhile; ?>
	
	<!-- begin second feature loop -->
	<?php 
	query_posts('cat='.get_option('gridlock_featured_cat').'&showposts=2');
 	?>
	
	<?php while (have_posts()) : the_post();
	if($post->ID == $do_not_duplicate[1]) continue;
	$do_not_duplicate[2] = $post->ID;
	
	 /* if (have_posts()) : while (have_posts()) : the_post(); 
	  if( $post->ID == $do_not_duplicate ) continue; */ ?>
	<div class="substory_frame">  
	<div class="substory" id="left">
				<h3 class="substory_subhead"><?php echo(stripslashes(get_option('gridlock_pastfeature_caption'))); ?></h3>
				<h3 class="substory_head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<h4 class="substory_comment"><?php the_time('j F Y'); ?>
				 &raquo; <a href="<?php the_permalink(); ?>">read</a> &raquo; 
				 <?php comments_popup_link('0 Comments', 'One Comment', '% Comments', '', 'Comments Locked'); ?></h4>
	</div>
	<?php endwhile;?>
	
	<div class="substory" id="right">
	
	<?php if(get_option('gridlock_use_secondary') == 'true') { 
			query_posts('cat='.get_option('gridlock_secondary_cat').'&showposts=1'); 
		} else {
			rewind_posts();
			query_posts('cat='.get_option('gridlock_featured_cat').'&showposts=3');
		}
	
		while (have_posts()) : the_post(); 
	
	?> 
	<?php	
		if(get_option('gridlock_use_secondary') != 'true') {
			if($post->ID == $do_not_duplicate[1] || $post->ID == $do_not_duplicate[2]) continue;
			$do_not_duplicate[3] = $post->ID;
		}
	 ?>
				<h3 class="substory_subhead"><?php echo(stripslashes(get_option('gridlock_secondary_caption'))); ?></h3>
				<h3 class="substory_head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<h4 class="substory_comment"><?php the_time('j F Y'); ?>
				 &raquo; <a href="<?php the_permalink(); ?>">read</a> &raquo; 
				 <?php comments_popup_link('0 Comments', 'One Comment', '% Comments', '', 'Comments Locked'); ?></h4>
	
		<?php endwhile; $do_not_duplicate = array(); ?>
		
	</div>
	</div>
		
        <div id="linkblog">
            <?php if(get_option('gridlock_delicious_username') != '') { ?> 

			<h3 class="substory_subhead"><?php echo(stripslashes(get_option('gridlock_delicious_caption'))); ?></h3>
             <h4 class="linkblog_caption">from <a href="http://del.icio.us/<?php echo(get_option('gridlock_delicious_username')); ?>">del.icio.us</a> 
             <a href="http://del.icio.us/rss/<?php echo(get_option('gridlock_delicious_username')); ?>" title="RSS 2.0" class="linkblog_rss_link"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed_small.gif" alt="RSS 2.0 Feed" title="RSS Feed" class="tinyfeed" /></a></h4>
             
			<script type="text/javascript" src="http://del.icio.us/feeds/js/<?php echo(get_option('gridlock_delicious_username')); ?>?extended;count=5"></script>
			<?php } ?>
        </div>
</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>