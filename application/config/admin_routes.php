<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Dashboard
$route['admin']									= "dashboard";
$route['admin/dashboard']						= "dashboard";

// Incidents
$route['admin/incidents']                       = "incident";
$route['admin/incident_reports']                = "incident/incident_reports";
$route['admin/volunteer_incidents']             = "incident/volunteer_incidents";
$route['admin/incidents/datatable']             = "incident/getDataTable";
$route['admin/incidents/report_datatable']      = "incident/getreportDataTable";
$route['admin/incidents/volunteer_datatable']   = "incident/getVolunteerDataTable";
$route['admin/incidents/update-status']         = "incident/updateStatus";
$route['admin/incidents/update-incident']       = "incident/updateIncident";
$route['admin/incidents/create']                = "incident/createIncidentIndex";
$route['admin/incidents/old-data-set-location'] = "incident/setLocationOldData";
$route['admin/incidents/import-old-data']       = "incident/importOldData";
$route['admin/incident/export']              = "incident/export";
$route['admin/incident/exportReport']              = "incident/exportReport";
$route['admin/incident/get-import-csv']      = "incident/downloadSampleImportCSV";
$route['admin/incident/import']              = "incident/import";

// Forms
$route['admin/forms']                           = "form";
$route['admin/form/datatable']                  = "form/getDataTable";
$route['admin/forms/get-details']               = "form/getDetails";

// Safety Tips
$route['admin/safety-tips']                     = "safetytip";
$route['admin/safety-tips/datatable']           = "safetytip/getDataTable";
$route['admin/safety-tips/update-status']       = "safetytip/updateStatus";
$route['admin/safety-tips/create']              = "safetytip/store";
$route['admin/safety-tips/update']              = "safetytip/update";
$route['admin/safety-tips/export']              = "safetytip/export";
$route['admin/safety-tips/get-import-csv']      = "safetytip/downloadSampleImportCSV";
$route['admin/safety-tips/import']              = "safetytip/import";

// Clients
$route['admin/clients']                         = "client";
$route['admin/clients/datatable']               = "client/getDataTable";
$route['admin/clients/manage-client']           = "client/manageClient";
//$route['admin/client/incidents']                = "client/incidents";
$route['admin/clients/incidents']               = "incident";
$route['admin/clients/safety-tips']             = "safetytip";
$route['admin/clients/chats']                   = "chat";
$route['admin/clients/pages']                   = "page";
$route['admin/clients/user-profiles']           = "admin_user";

// Pages
$route['admin/pages']                           = "page";
$route['admin/legal_resources']                 = "page/legal_view";
$route['admin/add_new_language']          		= "page/add_new_language";
$route['admin/pages/get-language-details']      = "page/getlanguageDetails";
$route['admin/pages/get-legal-details']         = "page/getlegalDetails";
$route['admin/pages/addlanguage']               = "page/addLanguage";
$route['admin/pages/datatable']                 = "page/getDataTable";
$route['admin/pages/legal_datatable']           = "page/getlegalDataTable";
$route['admin/pages/get-details']               = "page/getDetails";
$route['admin/pages/upload-image']              = "page/uploadEditorImage";
$route['admin/pages/update']                    = "page/update";
$route['admin/pages/updatelegal']               = "page/updatelegal";

$route['admin/options']                           = "options";
$route['admin/options/update']               = "options/updateTitle";
$route['admin/options/getform']               = "options/getForm";

// Chats
$route['admin/chats']                           = "chat";
$route['admin/chat/datatable']                  = "chat/getDataTable";
$route['admin/chat/guest-details']              = "chat/getGuestDetails";
$route['admin/chat/sync-guest-user']            = "chat/syncGuestUser";
$route['admin/chat/chat-history']               = "chat/chatHistory";
$route['admin/chat/chat-trash']                 = "chat/chatTrash";
$route['admin/chat/chat-delete']                = "chat/chatDelete";
$route['admin/chat/chat-restore']               = "chat/chatRestore";

// users
$route['admin/user-profiles']                   = "admin_user";
$route['admin/user-profiles/datatable']         = "admin_user/getDataTable";
$route['admin/user-profiles/get-details']       = "admin_user/getDetails";
$route['admin/user-profiles/create']            = "admin_user/store";
$route['admin/user-profiles/update']   	        = "admin_user/update";
$route['admin/user-profiles/delete']            = "admin_user/delete";

$route['admin/my-profile']                      = "myprofile";
$route['admin/my-profile/edit']                 = "myprofile/editProfile";
$route['admin/my-profile/update']               = "myprofile/updateProfile";
$route['admin/my-profile/update_password']      = "myprofile/update_password";

// language
$route['admin/import-languages/(:num)']         = "language/importLanguages/$1";
$route['admin/export-languages/(:num)']         = "language/exportLanguages/$1";


// helplines
$route['admin/helplines']                   = "helplines";
$route['admin/helplines/datatable']         = "helplines/getDataTable";
$route['admin/helplines/get-language-details']      = "helplines/getlanguageDetails";
$route['admin/helplines/addhelpline']         = "helplines/addHelpline";
$route['admin/helplines/get-details']       = "helplines/getDetails";
$route['admin/helplines/getCategory']       = "helplines/getCategory";
$route['admin/helplines/create']            = "helplines/store";
$route['admin/helplines/update']   	        = "helplines/update";
$route['admin/helplines/delete']            = "helplines/delete";