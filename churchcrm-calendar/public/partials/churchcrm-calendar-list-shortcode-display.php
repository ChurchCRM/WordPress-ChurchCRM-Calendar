<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       
 * @since      
 *
 * @package    ChurchCRM_Calendar
 * @subpackage  ChurchCRM_Calendar/public/partials
 */
 
 	global $crmc_sc_output;

    $atts = $this->churchcrm_calendar_list_shortcode_atts;
 
    $events = json_decode(file_get_contents("http://192.168.33.10/external/calendar/events"));

    /*
        TODO: Render the events on the page.
    */ 
    $crmc_sc_output = "<div class=\"events-list\">";

        
        foreach ($events as $Event) 
        {
            $crmc_sc_output .= "<div class=\"event-div\">";
            $crmc_sc_output .= "<div class=\"event-div-header\"><h1>$Event->Title</h1><h2>".date("M/j/y g:i A",strtotime($Event->Start))."</h2></div>";
            $crmc_sc_output .= "<div class=\"event-div-body\"><p>$Event->Desc</p></div>";
            $crmc_sc_output .= "</div>";
        }
        
    $crmc_sc_output .= "</div>";

    
    