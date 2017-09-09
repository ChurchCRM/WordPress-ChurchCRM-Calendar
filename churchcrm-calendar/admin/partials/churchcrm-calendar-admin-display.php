<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       
 * @since      1.00
 *
 * @package    ChurchCRM_Calendar
 * @subpackage ChurchCRM_Calendar/admin/partials
 */


// Check Nonce and then update options
if ( !empty($_POST) && check_admin_referer( 'churchcrm-calendar-options', 'churchcrm-calendar-options' ) ) {
	update_option( '_curchcrm_server_url', $_POST[ "curchcrm_server_url"] );
	update_option( '_events_count_max', $_POST[ "events_count_max"]);
	
	$churchcrm_server_url = stripslashes_deep( get_option('_curchcrm_server_url') );
	$events_count_max = stripslashes_deep( get_option('_events_count_max') );
	// We've updated the options, send off an AJAX request to flush the rewrite rules
	#TODO# Should move these options to use the Settings API instead of our own custom thing - or maybe just make it all AJAX - no need for a page refresh
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var data = {
				'action': 'sslp_flush_rewrite_rules',
			}
			
			$.post( "<?php echo admin_url( 'admin-ajax.php' ); ?>", data, function(response){});
		});
	</script>
<?php

} else {
	$churchcrm_server_url = stripslashes_deep( get_option('_curchcrm_server_url') );
	$events_count_max = stripslashes_deep( get_option('_events_count_max') );
}


$output = '<div class="wrap sslp-options">';
	$output .= '<div id="icon-edit" class="icon32 icon32-posts-staff-member"><br></div>';
	$output .= '<h2>' . __( 'ChurchCRM Calendar' , 'churchcrm-calendar' ) . '</h2>';
	$output .= '<h2>' . __( 'Options', 'churchcrm-calendar' ) . '</h2>';
	
	$output .= '<div class="sslp-content sslp-column">';
		$output .= '<form method="post" action="">';
			$output .= '<fieldset id="curchcrm_server_url" class="sslp-fieldset">';
			$output .= '<legend class="sslp-field-label">' . __( 'ChurchCRM Server URL' , 'churchcrm-calendar' ) . '</legend>';
			$output .= '<input type="text" name="curchcrm_server_url" value="' . $churchcrm_server_url . '"></fieldset>';
			
			$output .= '<fieldset id="events_count_max" class="sslp-fieldset">';
			$output .= '<legend class="sslp-field-label">' . __( 'Max Events to display (Default)' , 'churchcrm-calendar' ) . '</legend>';
			$output .= '<input type="text" name="events_count_max" value="' . $events_count_max . '"></fieldset>';
			$output .= '<p><input type="submit" value="' . __( 'Save ALL Changes' , 'churchcrm-calendar' ) . '" class="button button-primary button-large"></p>';
			
			$output .= wp_nonce_field('churchcrm-calendar-options', 'churchcrm-calendar-options');
		$output .= '</form>';
	$output .= '</div>';
	$output .= '<div class="sslp-sidebar sslp-column last">';
		// Get the sidebar
		ob_start();
		include_once( 'churchcrm-calendar-admin-sidebar.php' );
		$output .= ob_get_clean();
	$output .= '</div>';
$output .= '</div>';
    
echo $output;
