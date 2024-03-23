<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['404_override'] = 'errors/notFound';

// Admin Routes
include 'admin_routes.php';

// User Routes
$route['default_controller'] = "home";
$route['home'] = "home"; 
$route['getCountry'] = "home/getCountryAutocomplete";
$route['getHelpCountry'] = "home/getHelpCountryAutocomplete";
$route['getCity'] = "home/getCityAutocomplete";
$route['getIncDesc'] = "home/getIncidentDesc";
$route['getSafetyDesc'] = "home/getSafetyTipDesc";

$route['viewIncidents'] = "home/viewIncidents";
$route['viewIncidents/(:any)'] = "home/viewIncidents/$1";
$route['viewIncidents/(:any)/(:any)'] = "home/viewIncidents/$1/$2";
$route['viewIncidents/(:any)/(:any)/(:any)'] = "home/viewIncidents/$1/$2/$3";

$route['onboarding'] = "report_incident/onboarding";
$route['brazilonboarding'] = "report_incident/brazilonboarding";
$route['kuwait'] = "report_incident/kuwaitonboarding";
$route['emergency_helpline'] = "menu/emergency_helpline";
$route['Welcome'] = "report_incident/welcome";
$route['Experience'] = "report_incident/experience";
$route['protection_policy'] = "report_incident/protection_policy";
$route['shareIncident'] = "report_incident/consent";
$route['shareIncident-form'] = "report_incident";
$route['category_data'] = "home/category_data";
//new route by puru
$route['ngo'] = "report_incident/ngo";

$route['viewSafetyTips'] = "safety_tips/viewSafetyTips";
$route['viewSafetyTips/(:any)'] = "safety_tips/viewSafetyTips/$1";
$route['shareSafetyTips'] = "safety_tips/SafetyLocation";
$route['shareSafetyMap'] = "safety_tips/SafetyMap";
$route['shareSafetyTip'] = "safety_tips/SafetyTip";
$route['safetyTipTitle'] = "safety_tips/safetyTipTitle";
$route['thankYou'] = "safety_tips/thankYou";
$route['storeTips'] = "safety_tips/storeTips";

$route['hospital_loc'] = "hospital/find_loc"; 
$route['hospital_map'] = "hospital/get_map";
$route['hospital_listing'] = "hospital/map_listing";

$route['policestation_loc'] = "policestation/find_loc";
$route['policestation_map'] = "policestation/get_map";
$route['policestation_listing'] = "policestation/map_listing";

$route['form_p1'] = "primary_form/getFormView";
$route['form_p2'] = "primary_form/getFormView2";
$route['form_p3'] = "primary_form/getFormView3";
$route['form_p4'] = "primary_form/getFormView4";
$route['form_p5'] = "primary_form/getFormView5";
$route['form_p6'] = "primary_form/getFormView6";
$route['form_p7'] = "primary_form/getFormView7";
$route['form_p8'] = "primary_form/getFormView8";
$route['form_p9'] = "primary_form/getFormView9";
$route['form_p10'] = "primary_form/getFormView10"; 
$route['form_pa'] = "primary_form/getFormViewa";
$route['form_pb'] = "primary_form/getFormViewb";
$route['form_pc'] = "primary_form/getFormViewc";
// $route['help_after_form'] = "primary_form/help_after_form";

$route['incident_location'] = "primary_form/incident_location";
$route['incident_map'] = "primary_form/incident_map";
$route['thank_you'] = "primary_form/thank_you";
// $route['storeData'] = "primary_form/storeData";

$route['privacy_policy'] = "menu/privacy_policy";
$route['terms_of_use'] = "menu/terms_of_use";
$route['about_safecity'] = "menu/about_safecity";
$route['contact_us'] = "menu/contact_us";
$route['volunteer_with_us'] = "menu/volunteer_with_us";
$route['donate'] = "menu/donate";
$route['faqs'] = "menu/faqs";
$route['filling_fir'] = "menu/filling_fir";
$route['legal_resources'] = "menu/legal_resources";
$route['getHelplines'] = "menu/getHelplineNbr";
$route['help'] = "menu/help";
$route['help_pf'] = "menu/help_after_form";
$route['help_pf/(:any)'] = "menu/help_after_form/$1";
$route['wellness-resources'] = "menu/wellness_resources";

$route['help_chat'] = "chat";
$route['view-data'] = "view_data";