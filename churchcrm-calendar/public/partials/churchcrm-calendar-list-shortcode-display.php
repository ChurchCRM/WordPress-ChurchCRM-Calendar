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
    
    $events_count_max = $this->churchcrm_calendar_list_shortcode_atts['max'];
    $request_string = get_option('_curchcrm_server_url')."/api/public/calendar/events?start=".date('Y-m-d')."&max=".$events_count_max."&r=".mt_rand();
    $events = json_decode(file_get_contents($request_string));
    date_default_timezone_set(get_option('timezone_string'));
    
    $ICSCalendar = get_option('_curchcrm_server_url')."/api/public/calendar/ics?r=".mt_rand();
    $crmc_sc_output = "<a target='_blank' href='$ICSCalendar'>Add to Calendar</a><div class=\"events-list\">";

        foreach ($events as $Event) 
        {
            $crmc_sc_output .= "<div class=\"event-div\">";
            $crmc_sc_output .= "<div class=\"event-div-header\"><h1>$Event->Title</h1><h2>".date("M/j/y g:i A",strtotime($Event->Start))."</h2></div>";
            $crmc_sc_output .= "<div class=\"event-div-body\"><p>$Event->Desc</p></div>";
            $crmc_sc_output .= "</div>";
            $events_count_current ++;
        }
        
    $crmc_sc_output .= "</div>";