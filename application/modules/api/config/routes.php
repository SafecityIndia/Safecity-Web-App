<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Autocomplete
$route['api/get-cities-autocomplete'] = "autocomplete/cities";
$route['api/get-organizations-autocomplete'] = "autocomplete/organizations";
$route['api/get-languages-autocomplete'] = "autocomplete/languages";

// World
$route['api/countries/all'] = "world/countries";
$route['api/cities/in-country'] = "world/countryCities";

// Organization
$route['api/organization/verify-passcode'] = "autocomplete/verifyOrganizationPasscode";

// Questions
$route['api/get-questions-options'] = "questions/getQuestionOptions";

// Incident Reports
$route['api/reported-incidents/map-coordinates'] = "incident_report/getMapCooordinates";
$route['api/reported-incidents'] = "incident_report";
$route['api/reported-incident/details'] = "incident_report/getDetailedIncidentReport";
$route['api/user-reported-incidents'] = "incident_report/getUserIncident";
$route['api/reported-incident/delete'] = "incident_report/deleteUserIncident";
$route['api/reported-incident/update'] = "incident_report/update";
$route['api/get-forms'] = "incident_report/getForms";
$route['api/get-logical-questions'] = "incident_report/getLogicalQuestions";
$route['api/save-incident'] = "incident_report/saveIncident";

// Get NGO Incidents
$route['api/ngo-reported-incidents/(:num)'] = "ngo/getNgoData/$1";

// Safety Tips
$route['api/safety-tip/map-coordinates'] = "safety_tips/getMapCooordinates";
$route['api/get-safety-tips'] = "safety_tips";
$route['api/safety-tip/details'] = "safety_tips/getDetailedSafetyTipReport";
$route['api/safety-tip/update'] = "safety_tips/updateSafetyTipReport";
$route['api/user-safety-tips'] = "safety_tips/getUserSafetyTips";
$route['api/safety-tip/delete'] = "safety_tips/deleteUserSafetyTip";

$route['api/get-categories'] = "category";

$route['api/chat-start'] = "chats";
$route['api/chat-login-update'] = "chats/getUserUpdateLogin";
$route['api/get-chat-history'] = "chats/getUsersChatHistory";
$route['api/chat-insert'] = "chats/insertUserChat";
$route['api/get-user-type-status'] = "chats/getUserTypingStatus";
$route['api/chat-sync-user-guest'] = "chats/getSyncChat";
$route['api/chat-unsync-user-guest'] = "chats/deleteSyncChat";
$route['api/chat-history-cron'] = "chats/adminchatHistoryCron";

$route['api/getHelplines'] = "faq/getHelplineNbr";

//ngo api's
//$route['api/ngo/getNgoDetails'] = "ngo/getNgoDetails";