<?php get_header(); ?>

<div id="main_content">
	<h3 class="subhead">404: File Not Found</h3>
	<p>
		<strong>Nothing exists at this page.</strong> Most likely, you typed in your query incorrectly or a dead link 
		was posted. Try <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">the home page</a> for 
		the file you are looking for. If you have come from somewhere and really think that a page should exist here, 
		<a href="mailto:<?php bloginfo('admin_email'); ?>" title="E-Mail Administrator">e-mail the administrator(s)</a> of this 
		site and let them know.
	</p> 
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>