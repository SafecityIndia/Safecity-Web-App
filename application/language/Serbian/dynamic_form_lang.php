<?php
//Select Date Form
$lang['dateform_select_date'] = 'Odaberite datum';
$lang['this_is_an_estimate'] = 'Ovo je procena';

//Select Time or Time Range Form
$lang['timeform_select_time'] = 'Odaberite vreme';
$lang['timeform_select_a_time_range'] = 'Odaberite vremenski raspon';
$lang['timeform_clear_time'] = 'OBRIŠI VREME';	
$lang['timeform_clear_time_range'] = 'OBRIŠI VREMENSKI RASPON';
$lang['timeform_time_or'] = 'ILI';

//Share Incident Form
$lang['address_locate_on_map'] = 'Odaberite adresu na mapi';
$lang['address_locate_on_map_subtext'] = 'Upišite i odaberite lokaciju/najbližu lokaciju od ponuđenih';
$lang['address_pin_exact_location'] = 'Molimo označite tačnu lokaciju';
$lang['map_start_typing'] = 'Počnite da kucate';
$lang['address_pin_exact_location_subtext'] = 'Tačna lokacija pomoći će nam da uočimo obrasce pojavljivanja nasilja u gradu';
$lang['address_pinned_on_map'] = 'Adresa označena na mapi';
$lang['address_area'] = 'Unesite područje';
$lang['address_area_subtext'] = 'Molimo unesite područje';
$lang['address_build_loc'] = 'Unesite zgradu/ulicu/kvart';
$lang['address_build_loc_subtext'] = 'Na primer: Desni ulaz, zgrada 28, Kosovska ulica';
$lang['address_i_confirm'] = 'Potvrđujem';
if($_COOKIE['country_id']==111){
	$lang['address_i_confirm_msg'] = '[ ] This information is true to my knowledge';
}else{
	$lang['address_i_confirm_msg'] = 'Informacije koje delite s nama anonimno pomažu oblikovanju politika i donošenju odluka. Molimo potvrdite da su informacije koje delite istinite i tačne. Ukoliko je potrebno, možete se vratiti i izmeniti svoje odgovore pre slanja.';
}


$lang['someone_else_popup_msg'] = 'Molimo odgovorite na sledeća pitanja u ime osobe koja je doživela napad';
$lang['someone_else_popup_ok'] = 'U REDU';

?>