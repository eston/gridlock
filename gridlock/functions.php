<?php
	// Admin Panel and other functions for Gridlock.


define('GRIDLOCK_VERSION', 1.5);
define('GRIDLOCK_REVISION', 15);

add_action('admin_menu', 'gridlock_add_theme_page');
// set up the sidebar.
if (function_exists('register_sidebar')) register_sidebar();


function gridlock_init() {
	// initialises Gridlock upon install and activation. Sets default variables.
	add_option('gridlock_featured_cat', 1);
	add_option('gridlock_secondary_cat', 2);
	add_option('gridlock_about_slug', '');
	add_option('gridlock_about_blurb', '');
	add_option('gridlock_photolocation', '');
	add_option('gridlock_delicious_username', '');
	add_option('gridlock_centre_page', 'false');
	add_option('gridlock_disable_sifr', 'false');
	add_option('gridlock_disable_ie6_warning', 'false');
	add_option('gridlock_disable_logo', 'false');
	add_option('gridlock_disable_favicon', 'false');
	add_option('gridlock_use_secondary', 'true');
	add_option('gridlock_currentfeature_caption', 'Currently Featured');
	add_option('gridlock_pastfeature_caption', 'Previously Featured');
	add_option('gridlock_secondary_caption', 'Secondary Feature');
	add_option('gridlock_delicious_caption', 'del.icio.us Links');
	add_option('gridlock_update_time', 0);
	add_option('gridlock_check_for_updates', true);
}

function gridlock_add_theme_page() {
	// check for defaults and init if they don't exist
	if(get_option('gridlock_featured_cat') == '') {
		gridlock_init();
	}
	
	if ($_GET['page'] == basename(__FILE__)) {
		if ( 'save' == $_REQUEST['action'] ) {
			if(isset($_REQUEST['gridlock_featured_cat'])) {
				// set featured cat
				if($_REQUEST['gridlock_featured_cat'] == '')
					update_option('gridlock_featured_cat', 1);
				else
					update_option('gridlock_featured_cat', $_REQUEST['gridlock_featured_cat']);
			}
			if(isset($_REQUEST['gridlock_secondary_cat'])) {
				// set secondary cat
				if($_REQUEST['gridlock_secondary_cat'] == '')
					update_option('gridlock_secondary_cat', 1);
				else
					update_option('gridlock_secondary_cat', $_REQUEST['gridlock_secondary_cat']);
			}
			
			if(isset($_REQUEST['gridlock_about_slug'])) {
				// set about page slug
				if($_REQUEST['gridlock_about_slug'] == '')
					update_option('gridlock_about_slug', '');
				else
					update_option('gridlock_about_slug', $_REQUEST['gridlock_about_slug']);
			}
			
			if(isset($_REQUEST['gridlock_about_blurb'])) {
				// set about page slug
				if($_REQUEST['gridlock_about_blurb'] == '')
					update_option('gridlock_about_blurb', '');
				else
					update_option('gridlock_about_blurb', $_REQUEST['gridlock_about_blurb']);
			}
			
			if(isset($_REQUEST['gridlock_photolocation'])) {
				// set photo link location
				if($_REQUEST['gridlock_photolocation'] == '')
					update_option('gridlock_photolocation', '');
				else
					update_option('gridlock_photolocation', $_REQUEST['gridlock_photolocation']);
			}
			
			if(isset($_REQUEST['gridlock_delicious_username'])) {
				// del.icio.us username
				if($_REQUEST['gridlock_delicious_username'] == '')
					update_option('gridlock_delicious_username', '');
				else
					update_option('gridlock_delicious_username', $_REQUEST['gridlock_delicious_username']);
			}
			
			if(isset($_REQUEST['gridlock_delicious_caption'])) {
				// del.icio.us section head
				if($_REQUEST['gridlock_delicious_caption'] == '')
					update_option('gridlock_delicious_caption', 'del.icio.us Links');
				else
					update_option('gridlock_delicious_caption', $_REQUEST['gridlock_delicious_caption']);
			}
			
			if(isset($_REQUEST['gridlock_disable_sifr'])) {
				// disable sifr
					update_option('gridlock_disable_sifr', 'true');
			} else	update_option('gridlock_disable_sifr', 'false');
			
			if(isset($_REQUEST['gridlock_centre_page'])) {
				// disable sifr
					update_option('gridlock_centre_page', 'true');
			} else	update_option('gridlock_centre_page', 'false');
			
			if(isset($_REQUEST['gridlock_disable_ie6_warning'])) {
				// disable IE6 warning
					update_option('gridlock_disable_ie6_warning', 'true');
			} else	update_option('gridlock_disable_ie6_warning', 'false');
			
			if(isset($_REQUEST['gridlock_disable_favicon'])) {
				// disable Gridlock favicon
					update_option('gridlock_disable_favicon', 'true');
			} else	update_option('gridlock_disable_favicon', 'false');
			
			if(isset($_REQUEST['gridlock_disable_logo'])) {
				// disable Gridlock logo
					update_option('gridlock_disable_logo', 'true');
			} else	update_option('gridlock_disable_logo', 'false');
			
			if(isset($_REQUEST['gridlock_use_secondary'])) {
				// disable Gridlock logo
					update_option('gridlock_use_secondary', 'true');
			} else	update_option('gridlock_use_secondary', 'false');
			
			if(isset($_REQUEST['gridlock_currentfeature_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_currentfeature_caption'] == '')
					update_option('gridlock_currentfeature_caption', 'Currently Featured');
				else
					update_option('gridlock_currentfeature_caption', $_REQUEST['gridlock_currentfeature_caption']);
			}
			
			if(isset($_REQUEST['gridlock_pastfeature_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_pastfeature_caption'] == '')
					update_option('gridlock_pastfeature_caption', 'Previously Featured');
				else
					update_option('gridlock_pastfeature_caption', $_REQUEST['gridlock_pastfeature_caption']);
			}
			
			if(isset($_REQUEST['gridlock_secondary_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_secondary_caption'] == '')
					update_option('gridlock_secondary_caption', 'Secondary Feature');
				else
					update_option('gridlock_secondary_caption', $_REQUEST['gridlock_secondary_caption']);
			}
			
			header("Location: themes.php?page=functions.php&saved=true");
			die;			
		}
		add_action('admin_head', 'gridlock_theme_page_head');
	}
	add_theme_page('Gridlock Options', 'Gridlock Options', 'edit_themes', basename(__FILE__), 'gridlock_theme_page');
} // done with initial request handling

function gridlock_theme_page_head() {
	// header stuff, css and the like
?>

	<style type="text/css">
		div#gridlock-div {
			display: block;
		}
		div#gridlockCaption {
			border-top: 1px solid #0d324f;
			margin: 10px 20px 0px 10px;
			padding: 10px;
			text-align: center;
		}
		div#gridlockCaption p {
			text-align: center;
		}
		img#gridlockLogo {
			border: 0; margin: 0; padding: 0;
			display: block;
			width: 174px; height: 51px;
			text-decoration: none;
		}
	</style>

<?php
} // end gridlock theme page head

function gridlock_theme_page() {
  // check the update server once a week
  $update_message = null;
  
  if(get_option('gridlock_check_for_updates') == 'true') {   
    if(get_option('gridlock_update_time') < (time() - (60 * 60 * 24 * 7))) {
      $update_message = ping_updateserver();
      update_option('gridlock_update_time', time());
    }
  }
    
	if ( $_REQUEST['saved'] || $update_message ) {
	   echo '<div id="message" class="updated fade">';
	   
	   if ($_REQUEST['saved']) echo '<p><strong>Options saved.</strong></p>';
	   if ($update_message)    echo '<p>' . $update_message . '</p>';
	   
	   echo '</div>';
  }
?>
<div class="wrap">
	<div id="gridlock-div">
		<h2>Gridlock Options</h2>
		<p>Leaving a text field blank will disable the functionality for that option. Section heads will revert to 
			default values. HTML is not currently allowed in the About Page Sidebar blurb.</p>
		<form name="gridlock" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
			<input type="hidden" name="action" value="save" />
			<table class="optiontable">
				<tbody>
					<tr>
						<th>Featured Category:</th>
						<td>
						  <?php
							 	$selected_cat = get_option('gridlock_featured_cat');

							  if (get_bloginfo('version') < 2.3) { 
							    echo('<select name="gridlock_featured_cat">');
						      gridlock_dropdown_cats(true, 'All Categories', 'ID', 'asc', false, false, true, false, $selected_cat); 
						      echo('</select>');
						    } else {
						      wp_dropdown_categories('orderby=ID&order=ASC&hide_empty=0&name=gridlock_featured_cat&selected=' . $selected_cat);
						    }
							?>
							</select>
						</td>
					</tr>
						<tr>
							<th>Featured Section Head:</th>
							<td><input name="gridlock_currentfeature_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_currentfeature_caption'))); ?>" /></td>
						</tr>
						<tr>
							<th>Past Feature Section Head:</th>
							<td><input name="gridlock_pastfeature_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_pastfeature_caption'))); ?>" /></td>
						</tr>
					<tr>
						<th>Secondary Category <br />(Webzine-style) Options:</th>
						<td>
							<label for="gridlock_use_secondary">
							<input type="checkbox" name="gridlock_use_secondary" id="gridlock_use_secondary" <?php if(get_option('gridlock_use_secondary') == 'true') { ?> checked="checked" <?php } ?>	/>
							Use secondary category for third post
							</label>
						</td>
					</tr>
					<tr>
						<th>Secondary Category:</th>
						<td>
							<?php
							 	$selected_cat = get_option('gridlock_secondary_cat');

							  if (get_bloginfo('version') < 2.3) { 
							    echo('<select name="gridlock_secondary_cat">');
						      gridlock_dropdown_cats(true, 'All Categories', 'ID', 'asc', false, false, true, false, $selected_cat); 
						      echo('</select>');
						    } else {
						      wp_dropdown_categories('orderby=ID&order=ASC&hide_empty=0&name=gridlock_secondary_cat&selected=' . $selected_cat);
						    }
							?>
						</td>
					</tr>
					<tr>
						<th>Secondary/Tertiary Section Head:</th>
						<td><input name="gridlock_secondary_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_secondary_caption'))); ?>" /></td>
					</tr>
					<tr>
						<th>About Page Post Slug:</th>
						<td><input name="gridlock_about_slug" type="text" class="code" value="<?php echo(get_option('gridlock_about_slug')); ?>" /></td>
					</tr>
					<tr>
							<th>About Page Sidebar Blurb:</th>
							<td><textarea name="gridlock_about_blurb" class="code" rows="5" cols="25"><?php echo(html_entity_decode(stripslashes(get_option('gridlock_about_blurb')))); ?></textarea></td>
						</tr>
					<tr>
						<th>Photos Link URI:</th>
						<td><input name="gridlock_photolocation" type="text" class="code" value="<?php echo(get_option('gridlock_photolocation')); ?>" /></td>
					</tr>
					<tr>
						<th><a href="http://del.icio.us/" title="del.icio.us">del.icio.us</a> Username:</th>
						<td><input name="gridlock_delicious_username" type="text" class="code" value="<?php echo(get_option('gridlock_delicious_username')); ?>" /></td>
					</tr>
					<tr>
						<th>del.icio.us Section Head:</th>
						<td><input name="gridlock_delicious_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_delicious_caption'))); ?>" /></td>
					</tr>
					<tr>
						<th>Display Options:</th>
						<td>
						  <label for="gridlock_centre_page">
						  <input type="checkbox" name="gridlock_centre_page" id="gridlock_centre_page" <?php if(get_option('gridlock_centre_page') == 'true') { ?> checked="checked" <?php } ?> />
						  Centre Page
						  </label><br />
							<label for="gridlock_disable_sifr">
							<input type="checkbox" name="gridlock_disable_sifr" id="gridlock_disable_sifr" <?php if(get_option('gridlock_disable_sifr') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable sIFR Typography
							</label><br />
							<label for="gridlock_disable_ie6_warning">
							<input type="checkbox" name="gridlock_disable_ie6_warning" id="gridlock_disable_ie6_warning" <?php if(get_option('gridlock_disable_ie6_warning') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable Internet Explorer 6 Warning
							</label><br />
							<label for="gridlock_disable_favicon">
							<input type="checkbox" name="gridlock_disable_favicon" id="gridlock_disable_favicon" <?php if(get_option('gridlock_disable_favicon') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable integrated favicon
							</label><br />
							<label for="gridlock_disable_logo">
							<input type="checkbox" name="gridlock_disable_logo" id="gridlock_disable_logo" <?php if(get_option('gridlock_disable_logo') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable logo
							</label><br />
						</td>
					</tr>
				</tbody>
			</table>
		<p class="submit">
			<input type="submit" name="Save" value="Update Options &raquo;" />
		</p>
		</form>
		<div id="gridlockCaption">
			<p><strong>Gridlock <?php echo(GRIDLOCK_VERSION); ?></strong> (Build 1) &copy; 2005-2007 Eston Bond. Some rights reserved.</p>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/themecredit.gif" alt="theme by hyalineskies" title="hyalineskies" />	
		</div>
		
	</div>
</div>	
<?php
} // end theme page


// check for updates. Return message if an update is available.
function ping_updateserver() {
  $message = false;
  
  $ch = curl_init();
  
  if ($ch) {
  // set curl options.
  $res = curl_setopt_array(
                      array(
                          CURLOPT_URL => 'http://update.hyalineskies.com/?theme=gridlock',
                          CURLOPT_RETURNTRANSFER => true
                            )
                          );                 
  
    if($res) { 
      $result = curl_exec();
      if ($result) {
        // cool, we got a result from the server with the version.
        $version_info = json_decode($result, true);
        if($version_info['revision_number'] > GRIDLOCK_REVISION) {
          $message = 'Your version of Gridlock is out of date. Gridlock is now at version ' . $version_info['version'] . '.'
                   . '<a href="' . $version_info['url'] . '" title="Download new version">Download New Version</a>';
        }
      }
    }
  }
  
  return $message;
}
  

// maintaining this old function for <2.3 reverse compatibility.
function gridlock_dropdown_cats($optionall = 1, $all = 'All', $sort_column = 'ID', $sort_order = 'asc',
		$optiondates = 0, $optioncount = 0, $hide_empty = 1, $optionnone=FALSE,
		$selected=0, $hide=0) {
			
		global $wpdb;
		if ( ($file == 'blah') || ($file == '') )
			$file = get_settings('home') . '/';
		if ( !$selected )
			$selected=$cat;
		$sort_column = 'cat_'.$sort_column;

		$query = "
			SELECT cat_ID, cat_name, category_nicename,category_parent,
			COUNT($wpdb->post2cat.post_id) AS cat_count,
			DAYOFMONTH(MAX(post_date)) AS lastday, MONTH(MAX(post_date)) AS lastmonth
			FROM $wpdb->categories LEFT JOIN $wpdb->post2cat ON (cat_ID = category_id)
			LEFT JOIN $wpdb->posts ON (ID = post_id)
			WHERE cat_ID > 0
			";
		if ( $hide ) {
			$query .= " AND cat_ID != $hide";
			$query .= get_category_children($hide, " AND cat_ID != ");
		}
		$query .=" GROUP BY cat_ID";
		if ( intval($hide_empty) == 1 )
			$query .= " HAVING cat_count > 0";
		$query .= " ORDER BY $sort_column $sort_order, post_date DESC";

		$categories = $wpdb->get_results($query);
		if ( intval($optionall) == 1 ) {
			$all = apply_filters('list_cats', $all);
			echo "\t<option value='0'>$all</option>\n";
		}
		if ( intval($optionnone) == 1 )
			echo "\t<option value='-1'>".__('None')."</option>\n";
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$cat_name = apply_filters('list_cats', $category->cat_name, $category);
				echo "\t<option value=\"".$category->cat_ID."\"";
				if ( $category->cat_ID == $selected )
					echo ' selected="selected"';
				echo '>';
				echo $cat_name;
				if ( intval($optioncount) == 1 )
					echo '&nbsp;&nbsp;('.$category->cat_count.')';
				if ( intval($optiondates) == 1 )
					echo '&nbsp;&nbsp;'.$category->lastday.'/'.$category->lastmonth;
				echo "</option>\n";
			}
		}
}
?>