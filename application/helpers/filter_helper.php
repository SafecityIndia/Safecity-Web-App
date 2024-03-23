<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This function used to generate the date as per date filter text
 * @param {string} $result_from : today/week/month/year/all
 */
if(!function_exists('calculateDateFilter'))
{
    
    function calculateDateFilter($result_from)
    {
    	switch ($result_from) {
    	    case 'today':
    	        $start_date = date('Y-m-d 00:00:00');
    	        $end_date = date('Y-m-d 23:59:59');
    	        break;

    	    case 'week':
    	        $start_date = date("Y-m-d 00:00:00", strtotime('monday this week'));
    	        $end_date = date("Y-m-d 23:59:59");
    	        break;

    	    case 'month':
    	        $start_date = date('Y-m-01 00:00:00');
    	        $end_date = date("Y-m-d 23:59:59");
    	        break;

    	    case 'year':
    	        $start_date = date('Y-01-01 00:00:00');
    	        $end_date = date("Y-m-d 23:59:59");
    	        break;

    	    case 'all':
    	    default:
    	        $start_date = '';
    	        $end_date = '';
    	        break;
    	}
    	return compact('start_date', 'end_date');
    }

}

/**
 * This function used to generate the time as per time filter text
 * @param {string} $result_from : morning/afternoon/evening/night/post_midnight
 */
if(!function_exists('calculateTimeFilter'))
{
    
    function calculateTimeFilter($result_from)
    {
    	switch (trim($result_from)) {
    	    case 'morning':
    	        $start_time = '05:00:00';
    	        $end_time = '11:59:59';
    	        break;

    	    case 'afternoon':
    	        $start_time = '12:00:00';
    	        $end_time = '18:00:00';
    	        break;

    	    case 'evening':
    	        $start_time = '17:00:00';
    	        $end_time = '19:59:59';
    	        break;

    	    case 'night':
    	        $start_time = '20:00:00';
    	        $end_time = '23:59:59';
    	        break;

    	    case 'post_midnight':
    	        $start_time = '00:00:00';
    	        $end_time = '04:59:59';
    	        break;
    	    
    	    default:
    	        $start_time = '';
    	        $end_time = '';
    	        break;
    	}
    	return compact('start_time', 'end_time');
    }

}