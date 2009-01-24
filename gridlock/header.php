<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; <?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<?php if(get_option('gridlock_disable_favicon') == 'false') { ?>
<link rel="shortcut icon" type="image/gif" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" title="Gridlock Default" />

<?php if(stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6') && get_option('gridlock_disable_ie6_warning') == 'false') { ?>
	<style type="text/css">
		#main_content { top: 157px; }
		#sidebar { top: 158px; }
	</style>
<?php } ?>

<!-- RSS Feeds -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<?php if(function_exists('delicious') && get_option('gridlock_delicious_username') != '') { ?>
<link rel="alternate" type="application/rss+xml" title="del.icio.us RSS" href="http://del.icio.us/rss/<?php get_option('gridlock_delicious_username'); ?>" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Archives -->
<?php wp_get_archives('type=monthly&format=link'); ?>

<!-- sIFR Implementation -->
<?php if(get_option('gridlock_disable_sifr') == 'false') { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/sifr/sifr.js"></script>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
if(typeof sIFR == "function"){
  /* Now with more sIFR 3. This is inline because we need dynamic URIs to flash files */
	
	
	
}
//--><!]]>
</script>
<?php } ?>

<?php wp_head(); ?>

</head>

<body>
  
<?php if(stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6') && get_option('gridlock_disable_ie6_warning') == 'false') { ?>
	
<div id="ie_warn">
It seems that you are using an obsolete version of Internet Explorer. It is highly recommended that you upgrade to 
<a href="http://www.microsoft.com/windows/ie/default.mspx" title="Internet Explorer 7">Internet Explorer 7</a> or 
<a href="http://www.mozilla.org/products/firefox/" title="Mozilla Firefox">Mozilla Firefox</a>.
</div>

<?php } ?>

<?php if(get_option('gridlock_centre_page') == 'true') { ?>
<div id="centre">
<div id="content_wrap" class="centre">
<?php } else { ?>
<div id="content_wrap">
<?php } ?>

<div id="masthead"> <h1 class="hidden"><?php bloginfo('title'); ?></h1> 
<?php if(get_option('gridlock_disable_logo') == 'false') { ?>
<a href="<?php echo get_settings('home'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.gif" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" id="logo" /></a> 
<?php } ?>
</div>
<div id="upper"> 
  <?php /*
  
    ADDING YOUR OWN LINKS TO THE HEADER
    To add your own links to the header, you will just need to copy the markup structure below.
    For example, let's say I wanted to link to Socialuxe. To do so, I'd just write this:
    
    <div class="nav"><a href="http://socialuxe.com" title="Eston's site">Socialuxe</a></div>
    
    This will create a link that says "Socialuxe" and points to "http://socialuxe.com/". When 
    you hover over the link, you'll get a tooltip that says "Eston's site" in most browsers.
  
  */ ?>
  
	<div class="nav"><a href="<?php bloginfo('home'); ?>" title="home">home</a></div>
	
	<?php /* PHOTOS LINK */ ?>
  <?php if(get_option('gridlock_photolocation') != '') { ?>
	<div class="nav" ><a href="<?php echo(get_option('gridlock_photolocation')); ?>" title="photos">photos</a></div>
	<?php } ?>
	
	<?php /* ABOUT LINK */ ?>
	<?php if(get_option('gridlock_about_slug') != '') { ?>
	<div class="nav"><a href="<?php bloginfo('url'); ?>/<?php echo(get_option('gridlock_about_slug')); ?>" title="about">about</a></div>
	<?php } ?>
	
	
	<div class="nav_right"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 Feed"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.gif" alt="Feed Icon" title="RSS 2.0 Feed" id="feedicon" /></a></div>
</div>

<div class="wrapper">