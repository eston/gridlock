<?php // Do not delete these lines. Taken from Kubrick.
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Hey! You\'re not supposed to be here. Go someplace else.');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p>This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<a name="comments"></a>
<?php if ('open' == $post->comment_status) : ?> 
	<!-- If comments are open. -->
	<h3 class="substory_subhead"><?php comments_number('No Comments', 'One Comment', '% Comments' ); ?> currently posted.</h3> 
 <?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<h3 class="substory_subhead">Comments are locked.</h3>
<?php endif; ?>

<?php if ($comments) : ?>
	
	<?php foreach ($comments as $comment) : ?>
	<h3 class="comment_title"><?php comment_author_link(); ?> says:</h3>
	<div class="comment_box">
	<?php if ($comment->comment_approved == '0') : ?>
			<strong><em>Your comment is awaiting moderation.</em></strong>
	<?php endif; ?>
	
	<?php comment_text(); ?>
	</div>
	
<?php endforeach; /* end for each comment */ ?>
<?php endif; ?>

<?php /* Time for the comment form */ ?>

<?php if ('open' == $post->comment_status) : ?>
<h3 class="substory_head">Post a comment on this entry:</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> 
	to post a comment on this entry.</p>
	
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>
	
		<p>You are currently logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
		<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout</a></p>
	
	<?php else : ?>
	
		<!-- comment form -->
		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author">Name <?php if ($req) echo "<strong>required</strong>"; ?></label></p>
		
		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email">Mail (will not be published) <?php if ($req) echo "<strong>required</strong>"; ?></label></p>
		
		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
	   <label for="url">Website</label></p>
	
	<?php endif; ?>
	
		<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

		<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		</p>
		<?php  do_action('comment_form', $post->ID);  ?>

</form>

<?php endif; ?>
<?php endif; ?>