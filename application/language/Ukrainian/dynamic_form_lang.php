<?php
//Select Date Form
$lang['dateform_select_date'] = 'Виберіть дату';
$lang['this_is_an_estimate'] = 'Це оцінка';

//Select Time or Time Range Form
$lang['timeform_select_time'] = 'Виберіть час';
$lang['timeform_select_a_time_range'] = 'Виберіть часовий діапазон';
$lang['timeform_clear_time'] = 'ЯСНИЙ ЧАС';
$lang['timeform_clear_time_range'] = 'ЧІТКИЙ ЧАСОВИЙ ДІАПАЗОН';
$lang['timeform_time_or'] = 'АБО';

//Share Incident Form
$lang['address_locate_on_map'] = 'Знайти адресу на карті';
$lang['address_locate_on_map_subtext'] = 'Почніть вводити текст і виберіть своє місцезнаходження/найближче місцезнаходження з пропозицій';
$lang['address_pin_exact_location'] = 'Будь ласка, перемістіть шпильку в точне місце';
$lang['map_start_typing'] = 'Почніть друкувати';
$lang['address_pin_exact_location_subtext'] = 'Точне місце розташування допоможе нам визначити моделі насильства по всьому місту';
$lang['address_pinned_on_map'] = 'Адреса закріплена на карті';
$lang['address_area'] = 'Вхід в зону';
$lang['address_area_subtext'] = 'Будь ласка, зайдіть у зону';
$lang['address_build_loc'] = 'Увійти в будинок/вулицю/населений пункт';
$lang['address_build_loc_subtext'] = 'Приклад: Крило, Апартаменти Пратап, Курла Роуд';
$lang['address_i_confirm'] = 'Я підтверджую';
if($_COOKIE['country_id']==111){
	$lang['address_i_confirm_msg'] = '[ ] This information is true to my knowledge';
}else{
	$lang['address_i_confirm_msg'] = 'Інформація, якою ви ділитеся з нами анонімно, допомагає формувати політику та приймати рішення. Будь ласка, підтвердьте, що ви надсилаєте інформацію, яка відповідає вашим знанням. Ви можете повернутися назад і відредагувати свої відповіді перед подачею, якщо це необхідно.';
}


$lang['someone_else_popup_msg'] = 'Будь ласка, переконайтеся, що ви відповіли на наступні запитання від імені потерпілого';
$lang['someone_else_popup_ok'] = 'окей';

?>