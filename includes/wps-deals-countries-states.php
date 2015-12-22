<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Country / State Functions
 *
 * @package Social Deals Engine
 * @since 1.0.0
 *
 */  

/**
 * Returns All Countries
 * 
 * Handles to return all countries list
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_get_allowed_countries() {
	
	//insert all countries
	$wps_deal_countries = array(
										'1'	=>	array(
														'country_code'	=>	'AX',
														'country_name'	=>	__('Aland Islands','wpsdeals')
														),
										'2'	=>	array(
														'country_code'	=>	'AL',
														'country_name'	=>	__('Albania','wpsdeals')
														),
										'3'	=>	array(
														'country_code'	=>	'DZ',
														'country_name'	=>	__('Algeria','wpsdeals')
														),
										'4'	=>	array(
														'country_code'	=>	'AS',
														'country_name'	=>	__('American Samoa','wpsdeals')
														),
										'5'	=>	array(
														'country_code'	=>	'AD',
														'country_name'	=>	__('Andorra','wpsdeals')
														),
										'6'	=>	array(
														'country_code'	=>	'AO',
														'country_name'	=>	__('Angola','wpsdeals')
														),
										'7'	=>	array(
														'country_code'	=>	'AI',
														'country_name'	=>	__('Anguilla','wpsdeals')
														),
										'8'	=>	array(
														'country_code'	=>	'AQ',
														'country_name'	=>	__('Antarctica','wpsdeals')
														),
										'9'	=>	array(
														'country_code'	=>	'AG',
														'country_name'	=>	__('Antigua and Barbuda','wpsdeals')
														),
										'10'	=>	array(
														'country_code'	=>	'AR',
														'country_name'	=>	__('Argentina','wpsdeals')
														),
										'11'	=>	array(
														'country_code'	=>	'AM',
														'country_name'	=>	__('Armenia','wpsdeals')
														),
										'12'	=>	array(
														'country_code'	=>	'AW',
														'country_name'	=>	__('Aruba','wpsdeals')
														),
										'13'	=>	array(
														'country_code'	=>	'AU',
														'country_name'	=>	__('Australia','wpsdeals')
														),
										'14'	=>	array(
														'country_code'	=>	'AT',
														'country_name'	=>	__('Austria','wpsdeals')
														),
										'15'	=>	array(
														'country_code'	=>	'AZ',
														'country_name'	=>	__('Azerbaijan','wpsdeals')
														),
										'16'	=>	array(
														'country_code'	=>	'BS',
														'country_name'	=>	__('Bahamas','wpsdeals')
														),
										'17'	=>	array(
														'country_code'	=>	'BH',
														'country_name'	=>	__('Bahrain','wpsdeals')
														),
										'18'	=>	array(
														'country_code'	=>	'BD',
														'country_name'	=>	__('Bangladesh','wpsdeals')
														),
										'19'	=>	array(
														'country_code'	=>	'BB',
														'country_name'	=>	__('Barbados','wpsdeals')
													),
										'20'	=>	array(
														'country_code'	=>	'BY',
														'country_name'	=>	__('Belarus','wpsdeals')
														),
										'21'	=>	array(
														'country_code'	=>	'BE',
														'country_name'	=>	__('Belgium','wpsdeals')
														),
										'22'	=>	array(
														'country_code'	=>	'BZ',
														'country_name'	=>	__('Belize','wpsdeals')
														),
										'23'	=>	array(
														'country_code'	=>	'BJ',
														'country_name'	=>	__('Benin','wpsdeals')
														),
										'24'	=>	array(
														'country_code'	=>	'BM',
														'country_name'	=>	__('Bermuda','wpsdeals')
														),
										'25'	=>	array(
														'country_code'	=>	'BT',
														'country_name'	=>	__('Bhutan','wpsdeals')
														),
										'26'	=>	array(
														'country_code'	=>	'BO',
														'country_name'	=>	__('Bolivia','wpsdeals')
														),
										'27'	=>	array(
														'country_code'	=>	'BA',
														'country_name'	=>	__('Bosnia and Herzegovina','wpsdeals')
														),
										'28'	=>	array(
														'country_code'	=>	'BW',
														'country_name'	=>	__('Botswana','wpsdeals')
														),
										'29'	=>	array(
														'country_code'	=>	'BV',
														'country_name'	=>	__('Bouvet Island','wpsdeals')
														),
										'30'	=>	array(
														'country_code'	=>	'BR',
														'country_name'	=>	__('Brazil','wpsdeals')
														),
										'31'	=>	array(
														'country_code'	=>	'IO',
														'country_name'	=>	__('British Indian Ocean Territory','wpsdeals')
														),
										'32'	=>	array(
														'country_code'	=>	'BN',
														'country_name'	=>	__('Brunei Darussalam','wpsdeals')
														),
										'33'	=>	array(
														'country_code'	=>	'BG',
														'country_name'	=>	__('Bulgaria','wpsdeals')
														),
										'34'	=>	array(
														'country_code'	=>	'BF',
														'country_name'	=>	__('Burkina Faso','wpsdeals')
														),
										'35'	=>	array(
														'country_code'	=>	'BI',
														'country_name'	=>	__('Burundi','wpsdeals')
														),
										'36'	=>	array(
														'country_code'	=>	'KH',
														'country_name'	=>	__('Cambodia','wpsdeals')
														),
										'37'	=>	array(
														'country_code'	=>	'CM',
														'country_name'	=>	__('Cameroon','wpsdeals')
														),
										'38'	=>	array(
														'country_code'	=>	'CA',
														'country_name'	=>	__('Canada','wpsdeals')
														),
										'39'	=>	array(
														'country_code'	=>	'CV',
														'country_name'	=>	__('Cape Verde','wpsdeals')
														),
										'40'	=>	array(
														'country_code'	=>	'KY',
														'country_name'	=>	__('Cayman Islands','wpsdeals')
														),
										'41'	=>	array(
														'country_code'	=>	'CF',
														'country_name'	=>	__('Central African Republic','wpsdeals')
														),
										'42'	=>	array(
														'country_code'	=>	'TD',
														'country_name'	=>	__('Chad','wpsdeals')
														),
										'43'	=>	array(
														'country_code'	=>	'CL',
														'country_name'	=>	__('Chile','wpsdeals')
														),
										'44'	=>	array(
														'country_code'	=>	'CN',
														'country_name'	=>	__('China','wpsdeals')
														),
										'45'	=>	array(
														'country_code'	=>	'CX',
														'country_name'	=>	__('Christmas Island','wpsdeals')
														),
										'46'	=>	array(
														'country_code'	=>	'CC',
														'country_name'	=>	__('Cocos (Keeling), Islands','wpsdeals')
														),
										'47'	=>	array(
														'country_code'	=>	'CO',
														'country_name'	=>	__('Colombia','wpsdeals')
														),
										'48'	=>	array(
														'country_code'	=>	'KM',
														'country_name'	=>	__('Comoros','wpsdeals')
														),
										'49'	=>	array(
														'country_code'	=>	'CG',
														'country_name'	=>	__('Congo','wpsdeals')
														),
										'50'	=>	array(
														'country_code'	=>	'CD',
														'country_name'	=>	__('Congo, The Democratic Republic of the','wpsdeals')
														),
										'51'	=>	array(
														'country_code'	=>	'CK',
														'country_name'	=>	__('Cook Islands','wpsdeals')
														),
										'52'	=>	array(
														'country_code'	=>	'CR',
														'country_name'	=>	__('Costa Rica','wpsdeals')
														),
										'53'	=>	array(
														'country_code'	=>	'CI',
														'country_name'	=>	__('Cote D\'Ivoire','wpsdeals')
														),
										'54'	=>	array(
														'country_code'	=>	'HR',
														'country_name'	=>	__('Croatia','wpsdeals')
														),
										'55'	=>	array(
														'country_code'	=>	'CU',
														'country_name'	=>	__('Cuba','wpsdeals')
														),
										'56'	=>	array(
														'country_code'	=>	'CY',
														'country_name'	=>	__('Cyprus','wpsdeals')
														),
										'57'	=>	array(
														'country_code'	=>	'CZ',
														'country_name'	=>	__('Czech Republic','wpsdeals')
														),
										'58'	=>	array(
														'country_code'	=>	'DK',
														'country_name'	=>	__('Denmark','wpsdeals')
														),
										'59'	=>	array(
														'country_code'	=>	'DJ',
														'country_name'	=>	__('Djibouti','wpsdeals')
														),
										'60'	=>	array(
														'country_code'	=>	'DM',
														'country_name'	=>	__('Dominica','wpsdeals')
														),
										'61'	=>	array(
														'country_code'	=>	'DO',
														'country_name'	=>	__('Dominican Republic','wpsdeals')
														),
										'62'	=>	array(
														'country_code'	=>	'EC',
														'country_name'	=>	__('Ecuador','wpsdeals')
														),
										'63'	=>	array(
														'country_code'	=>	'EG',
														'country_name'	=>	__('Egypt','wpsdeals')
														),
										'64'	=>	array(
														'country_code'	=>	'SV',
														'country_name'	=>	__('El Salvador','wpsdeals')
														),
										'65'	=>	array(
														'country_code'	=>	'GQ',
														'country_name'	=>	__('Equatorial Guinea','wpsdeals')
														),
										'66'	=>	array(
														'country_code'	=>	'ER',
														'country_name'	=>	__('Eritrea','wpsdeals')
														),
										'67'	=>	array(
														'country_code'	=>	'EE',
														'country_name'	=>	__('Estonia','wpsdeals')
														),
										'68'	=>	array(
														'country_code'	=>	'ET',
														'country_name'	=>	__('Ethiopia','wpsdeals')
														),
										'69'	=>	array(
														'country_code'	=>	'FK',
														'country_name'	=>	__('Falkland Islands (Malvinas)','wpsdeals')
														),
										'70'	=>	array(
														'country_code'	=>	'FO',
														'country_name'	=>	__('Faroe Islands','wpsdeals')
														),
										'71'	=>	array(
														'country_code'	=>	'FJ',
														'country_name'	=>	__('Fiji','wpsdeals')
														),
										'72'	=>	array(
														'country_code'	=>	'FI',
														'country_name'	=>	__('Finland','wpsdeals')
														),
										'73'	=>	array(
														'country_code'	=>	'FR',
														'country_name'	=>	__('France','wpsdeals')
														),
										'74'	=>	array(
														'country_code'	=>	'GF',
														'country_name'	=>	__('French Guiana','wpsdeals')
														),
										'75'	=>	array(
														'country_code'	=>	'PF',
														'country_name'	=>	__('French Polynesia','wpsdeals')
														),
										'76'	=>	array(
														'country_code'	=>	'TF',
														'country_name'	=>	__('French Southern Territories','wpsdeals')
														),
										'77'	=>	array(
														'country_code'	=>	'GA',
														'country_name'	=>	__('Gabon','wpsdeals')
														),
										'78'	=>	array(
														'country_code'	=>	'GM',
														'country_name'	=>	__('Gambia','wpsdeals')
														),
										'79'	=>	array(
														'country_code'	=>	'GE',
														'country_name'	=>	__('Georgia','wpsdeals')
														),
										'80'	=>	array(
														'country_code'	=>	'DE',
														'country_name'	=>	__('Germany','wpsdeals')
														),
										'81'	=>	array(
														'country_code'	=>	'GH',
														'country_name'	=>	__('Ghana','wpsdeals')
														),
										'82'	=>	array(
														'country_code'	=>	'GI',
														'country_name'	=>	__('Gibraltar','wpsdeals')
														),
										'83'	=>	array(
														'country_code'	=>	'GR',
														'country_name'	=>	__('Greece','wpsdeals')
														),
										'84'	=>	array(
														'country_code'	=>	'GL',
														'country_name'	=>	__('Greenland','wpsdeals')
														),
										'85'	=>	array(
														'country_code'	=>	'GD',
														'country_name'	=>	__('Grenada','wpsdeals')
														),
										'86'	=>	array(
														'country_code'	=>	'GP',
														'country_name'	=>	__('Guadeloupe','wpsdeals')
														),
										'87'	=>	array(
														'country_code'	=>	'GU',
														'country_name'	=>	__('Guam','wpsdeals')
														),
										'88'	=>	array(
														'country_code'	=>	'GT',
														'country_name'	=>	__('Guatemala','wpsdeals')
														),
										'89'	=>	array(
														'country_code'	=>	'GG',
														'country_name'	=>	__('Guernsey','wpsdeals')
														),
										'90'	=>	array(
														'country_code'	=>	'GN',
														'country_name'	=>	__('Guinea','wpsdeals')
														),
										'91'	=>	array(
														'country_code'	=>	'GW',
														'country_name'	=>	__('Guinea-Bissau','wpsdeals')
														),
										'92'	=>	array(
														'country_code'	=>	'GY',
														'country_name'	=>	__('Guyana','wpsdeals')
														),
										'93'	=>	array(
														'country_code'	=>	'HT',
														'country_name'	=>	__('Haiti','wpsdeals')
														),
										'94'	=>	array(
														'country_code'	=>	'HM',
														'country_name'	=>	__('Heard Island and McDonald Islands','wpsdeals')
														),
										'95'	=>	array(
														'country_code'	=>	'VA',
														'country_name'	=>	__('Holy See (Vatican City State)','wpsdeals')
														),
										'96'	=>	array(
														'country_code'	=>	'HN',
														'country_name'	=>	__('Honduras','wpsdeals')
														),
										'97'	=>	array(
														'country_code'	=>	'HK',
														'country_name'	=>	__('Hong Kong','wpsdeals')
														),
										'98'	=>	array(
														'country_code'	=>	'HU',
														'country_name'	=>	__('Hungary','wpsdeals')
														),
										'99'	=>	array(
														'country_code'	=>	'IS',
														'country_name'	=>	__('Iceland','wpsdeals')
														),
										'100'	=>	array(
														'country_code'	=>	'IN',
														'country_name'	=>	__('India','wpsdeals')
														),
										'101'	=>	array(
														'country_code'	=>	'ID',
														'country_name'	=>	__('Indonesia','wpsdeals')
														),
										'102'	=>	array(
														'country_code'	=>	'IR',
														'country_name'	=>	__('Iran, Islamic Republic of','wpsdeals')
														),
										'103'	=>	array(
														'country_code'	=>	'IQ',
														'country_name'	=>	__('Iraq','wpsdeals')
														),
										'104'	=>	array(
														'country_code'	=>	'IE',
														'country_name'	=>	__('Ireland','wpsdeals')
														),
										'105'	=>	array(
														'country_code'	=>	'IM',
														'country_name'	=>	__('Isle of Man','wpsdeals')
														),
										'100'	=>	array(
														'country_code'	=>	'IN',
														'country_name'	=>	__('India','wpsdeals')
														),
										'106'	=>	array(
														'country_code'	=>	'IL',
														'country_name'	=>	__('Israel','wpsdeals')
														),
										'107'	=>	array(
														'country_code'	=>	'IT',
														'country_name'	=>	__('Italy','wpsdeals')
														),
										'108'	=>	array(
														'country_code'	=>	'JM',
														'country_name'	=>	__('Jamaica','wpsdeals')
														),
										'109'	=>	array(
														'country_code'	=>	'JP',
														'country_name'	=>	__('Japan','wpsdeals')
														),
										'110'	=>	array(
														'country_code'	=>	'JE',
														'country_name'	=>	__('Jersey','wpsdeals')
														),
										'111'	=>	array(
														'country_code'	=>	'JO',
														'country_name'	=>	__('Jordan','wpsdeals')
														),
										'112'	=>	array(
														'country_code'	=>	'KZ',
														'country_name'	=>	__('Kazakhstan','wpsdeals')
														),
										'113'	=>	array(
														'country_code'	=>	'KE',
														'country_name'	=>	__('Kenya','wpsdeals')
														),
										'114'	=>	array(
														'country_code'	=>	'KI',
														'country_name'	=>	__('Kiribati','wpsdeals')
														),
										'115'	=>	array(
														'country_code'	=>	'KP',
														'country_name'	=>	__('Korea, Democratic People\'s Republic of','wpsdeals')
														),
										'116'	=>	array(
														'country_code'	=>	'KR',
														'country_name'	=>	__('Korea, Republic of','wpsdeals')
														),
										'117'	=>	array(
														'country_code'	=>	'KW',
														'country_name'	=>	__('Kuwait','wpsdeals')
														),
										'118'	=>	array(
														'country_code'	=>	'KG',
														'country_name'	=>	__('Kyrgyzstan','wpsdeals')
														),
										'119'	=>	array(
														'country_code'	=>	'LA',
														'country_name'	=>	__('Lao People\'s Democratic Republic','wpsdeals')
														),
										'120'	=>	array(
														'country_code'	=>	'LV',
														'country_name'	=>	__('Latvia','wpsdeals')
														),
										'121'	=>	array(
														'country_code'	=>	'LB',
														'country_name'	=>	__('Lebanon','wpsdeals')
														),
										'122'	=>	array(
														'country_code'	=>	'LS',
														'country_name'	=>	__('Lesotho','wpsdeals')
														),
										'123'	=>	array(
														'country_code'	=>	'LR',
														'country_name'	=>	__('Liberia','wpsdeals')
														),
										'124'	=>	array(
														'country_code'	=>	'LY',
														'country_name'	=>	__('Libyan Arab Jamahiriya','wpsdeals')
														),
										'125'	=>	array(
														'country_code'	=>	'LI',
														'country_name'	=>	__('Liechtenstein','wpsdeals')
														),
										'126'	=>	array(
														'country_code'	=>	'LT',
														'country_name'	=>	__('Lithuania','wpsdeals')
														),
										'127'	=>	array(
														'country_code'	=>	'LU',
														'country_name'	=>	__('Luxembourg','wpsdeals')
														),
										'128'	=>	array(
														'country_code'	=>	'MO',
														'country_name'	=>	__('Macao','wpsdeals')
														),
										'129'	=>	array(
														'country_code'	=>	'MK',
														'country_name'	=>	__('Macedonia, The Former Yugoslav Republic of','wpsdeals')
														),
										'130'	=>	array(
														'country_code'	=>	'MG',
														'country_name'	=>	__('Madagascar','wpsdeals')
														),
										'131'	=>	array(
														'country_code'	=>	'MW',
														'country_name'	=>	__('Malawi','wpsdeals')
														),
										'132'	=>	array(
														'country_code'	=>	'MY',
														'country_name'	=>	__('Malaysia','wpsdeals')
														),
										'133'	=>	array(
														'country_code'	=>	'MV',
														'country_name'	=>	__('Maldives','wpsdeals')
														),
										'134'	=>	array(
														'country_code'	=>	'ML',
														'country_name'	=>	__('Mali','wpsdeals')
														),
										'135'	=>	array(
														'country_code'	=>	'MT',
														'country_name'	=>	__('Malta','wpsdeals')
														),
										'136'	=>	array(
														'country_code'	=>	'MH',
														'country_name'	=>	__('Marshall Islands','wpsdeals')
														),
										'137'	=>	array(
														'country_code'	=>	'MQ',
														'country_name'	=>	__('Martinique','wpsdeals')
														),
										'138'	=>	array(
														'country_code'	=>	'MR',
														'country_name'	=>	__('Mauritania','wpsdeals')
														),
										'139'	=>	array(
														'country_code'	=>	'MU',
														'country_name'	=>	__('Mauritius','wpsdeals')
														),
										'140'	=>	array(
														'country_code'	=>	'YT',
														'country_name'	=>	__('Mayotte','wpsdeals')
														),
										'141'	=>	array(
														'country_code'	=>	'MX',
														'country_name'	=>	__('Mexico','wpsdeals')
														),
										'142'	=>	array(
														'country_code'	=>	'FM',
														'country_name'	=>	__('Micronesia, Federated States of','wpsdeals')
														),
										'143'	=>	array(
														'country_code'	=>	'MD',
														'country_name'	=>	__('Moldova, Republic of','wpsdeals')
														),
										'144'	=>	array(
														'country_code'	=>	'MC',
														'country_name'	=>	__('Monaco','wpsdeals')
														),
										'145'	=>	array(
														'country_code'	=>	'MN',
														'country_name'	=>	__('Mongolia','wpsdeals')
														),
										'146'	=>	array(
														'country_code'	=>	'ME',
														'country_name'	=>	__('Montenegro','wpsdeals')
														),
										'147'	=>	array(
														'country_code'	=>	'MS',
														'country_name'	=>	__('Montserrat','wpsdeals')
														),
										'148'	=>	array(
														'country_code'	=>	'MA',
														'country_name'	=>	__('Morocco','wpsdeals')
														),
										'149'	=>	array(
														'country_code'	=>	'MZ',
														'country_name'	=>	__('Mozambique','wpsdeals')
														),
										'150'	=>	array(
														'country_code'	=>	'MM',
														'country_name'	=>	__('Myanmar','wpsdeals')
														),
										'151'	=>	array(
														'country_code'	=>	'NA',
														'country_name'	=>	__('Namibia','wpsdeals')
														),
										'152'	=>	array(
														'country_code'	=>	'NR',
														'country_name'	=>	__('Nauru','wpsdeals')
														),
										'153'	=>	array(
														'country_code'	=>	'NP',
														'country_name'	=>	__('Nepal','wpsdeals')
														),
										'154'	=>	array(
														'country_code'	=>	'NL',
														'country_name'	=>	__('Netherlands','wpsdeals')
														),
										'155'	=>	array(
														'country_code'	=>	'AN',
														'country_name'	=>	__('Netherlands Antilles','wpsdeals')
														),
										'156'	=>	array(
														'country_code'	=>	'NC',
														'country_name'	=>	__('New Caledonia','wpsdeals')
														),
										'157'	=>	array(
														'country_code'	=>	'NZ',
														'country_name'	=>	__('New Zealand','wpsdeals')
														),
										'158'	=>	array(
														'country_code'	=>	'NI',
														'country_name'	=>	__('Nicaragua','wpsdeals')
														),
										'159'	=>	array(
														'country_code'	=>	'NE',
														'country_name'	=>	__('Niger','wpsdeals')
														),
										'160'	=>	array(
														'country_code'	=>	'NG',
														'country_name'	=>	__('Nigeria','wpsdeals')
														),
										'161'	=>	array(
														'country_code'	=>	'NU',
														'country_name'	=>	__('Niue','wpsdeals')
														),
										'162'	=>	array(
														'country_code'	=>	'NF',
														'country_name'	=>	__('Norfolk Island','wpsdeals')
														),
										'163'	=>	array(
														'country_code'	=>	'MP',
														'country_name'	=>	__('Northern Mariana Islands','wpsdeals')
														),
										'164'	=>	array(
														'country_code'	=>	'NO',
														'country_name'	=>	__('Norway','wpsdeals')
														),
										'165'	=>	array(
														'country_code'	=>	'OM',
														'country_name'	=>	__('Oman','wpsdeals')
														),
										'166'	=>	array(
														'country_code'	=>	'PK',
														'country_name'	=>	__('Pakistan','wpsdeals')
														),
										'167'	=>	array(
														'country_code'	=>	'PW',
														'country_name'	=>	__('Palau','wpsdeals')
														),
										'168'	=>	array(
														'country_code'	=>	'PS',
														'country_name'	=>	__('Palestinian Territory, Occupied','wpsdeals')
														),
										'169'	=>	array(
														'country_code'	=>	'PA',
														'country_name'	=>	__('Panama','wpsdeals')
														),
										'170'	=>	array(
														'country_code'	=>	'PG',
														'country_name'	=>	__('Papua New Guinea','wpsdeals')
														),
										'171'	=>	array(
														'country_code'	=>	'PY',
														'country_name'	=>	__('Paraguay','wpsdeals')
														),
										'172'	=>	array(
														'country_code'	=>	'PE',
														'country_name'	=>	__('Peru','wpsdeals')
														),
										'173'	=>	array(
														'country_code'	=>	'PH',
														'country_name'	=>	__('Philippines','wpsdeals')
														),
										'174'	=>	array(
														'country_code'	=>	'PN',
														'country_name'	=>	__('Pitcairn','wpsdeals')
														),
										'175'	=>	array(
														'country_code'	=>	'PL',
														'country_name'	=>	__('Poland','wpsdeals')
														),
										'176'	=>	array(
														'country_code'	=>	'PT',
														'country_name'	=>	__('Portugal','wpsdeals')
														),
										'177'	=>	array(
														'country_code'	=>	'PR',
														'country_name'	=>	__('Puerto Rico','wpsdeals')
														),
										'178'	=>	array(
														'country_code'	=>	'QA',
														'country_name'	=>	__('Qatar','wpsdeals')
														),
										'179'	=>	array(
														'country_code'	=>	'RE',
														'country_name'	=>	__('Reunion','wpsdeals')
														),
										'180'	=>	array(
														'country_code'	=>	'RO',
														'country_name'	=>	__('Romania','wpsdeals')
														),
										'181'	=>	array(
														'country_code'	=>	'RU',
														'country_name'	=>	__('Russian Federation','wpsdeals')
														),
										'182'	=>	array(
														'country_code'	=>	'RW',
														'country_name'	=>	__('Rwanda','wpsdeals')
														),
										'183'	=>	array(
														'country_code'	=>	'BL',
														'country_name'	=>	__('Saint Barthelemy','wpsdeals')
														),
										'184'	=>	array(
														'country_code'	=>	'SH',
														'country_name'	=>	__('Saint Helena','wpsdeals')
														),
										'185'	=>	array(
														'country_code'	=>	'KN',
														'country_name'	=>	__('Saint Kitts and Nevis','wpsdeals')
														),
										'186'	=>	array(
														'country_code'	=>	'LC',
														'country_name'	=>	__('Saint Lucia','wpsdeals')
														),
										'187'	=>	array(
														'country_code'	=>	'MF',
														'country_name'	=>	__('Saint Martin','wpsdeals')
														),
										'188'	=>	array(
														'country_code'	=>	'PM',
														'country_name'	=>	__('Saint Pierre and Miquelon','wpsdeals')
														),
										'189'	=>	array(
														'country_code'	=>	'VC',
														'country_name'	=>	__('Saint Vincent and the Grenadines','wpsdeals')
														),
										'190'	=>	array(
														'country_code'	=>	'WS',
														'country_name'	=>	__('Samoa','wpsdeals')
														),
										'191'	=>	array(
														'country_code'	=>	'SM',
														'country_name'	=>	__('San Marino','wpsdeals')
														),
										'192'	=>	array(
														'country_code'	=>	'ST',
														'country_name'	=>	__('Sao Tome and Principe','wpsdeals')
														),
										'193'	=>	array(
														'country_code'	=>	'SA',
														'country_name'	=>	__('Saudi Arabia','wpsdeals')
														),
										'194'	=>	array(
														'country_code'	=>	'SN',
														'country_name'	=>	__('Senegal','wpsdeals')
														),
										'195'	=>	array(
														'country_code'	=>	'RS',
														'country_name'	=>	__('Serbia','wpsdeals')
														),
										'196'	=>	array(
														'country_code'	=>	'SC',
														'country_name'	=>	__('Seychelles','wpsdeals')
														),
										'197'	=>	array(
														'country_code'	=>	'SL',
														'country_name'	=>	__('Sierra Leone','wpsdeals')
														),
										'198'	=>	array(
														'country_code'	=>	'SG',
														'country_name'	=>	__('Singapore','wpsdeals')
														),
										'199'	=>	array(
														'country_code'	=>	'SK',
														'country_name'	=>	__('Slovakia','wpsdeals')
														),
										'200'	=>	array(
														'country_code'	=>	'SI',
														'country_name'	=>	__('Slovenia','wpsdeals')
														),
										'201'	=>	array(
														'country_code'	=>	'SB',
														'country_name'	=>	__('Solomon Islands','wpsdeals')
														),
										'202'	=>	array(
														'country_code'	=>	'SO',
														'country_name'	=>	__('Somalia','wpsdeals')
														),
										'203'	=>	array(
														'country_code'	=>	'ZA',
														'country_name'	=>	__('South Africa','wpsdeals')
														),
										'204'	=>	array(
														'country_code'	=>	'GS',
														'country_name'	=>	__('South Georgia and the South Sandwich Islands','wpsdeals')
														),
										'205'	=>	array(
														'country_code'	=>	'ES',
														'country_name'	=>	__('Spain','wpsdeals')
														),
										'206'	=>	array(
														'country_code'	=>	'LK',
														'country_name'	=>	__('Sri Lanka','wpsdeals')
														),
										'207'	=>	array(
														'country_code'	=>	'SD',
														'country_name'	=>	__('Sudan','wpsdeals')
														),
										'208'	=>	array(
														'country_code'	=>	'SR',
														'country_name'	=>	__('Suriname','wpsdeals')
														),
										'209'	=>	array(
														'country_code'	=>	'SJ',
														'country_name'	=>	__('Svalbard and Jan Mayen','wpsdeals')
														),
										'210'	=>	array(
														'country_code'	=>	'SZ',
														'country_name'	=>	__('Swaziland','wpsdeals')
														),
										'211'	=>	array(
														'country_code'	=>	'SE',
														'country_name'	=>	__('Sweden','wpsdeals')
														),
										'212'	=>	array(
														'country_code'	=>	'CH',
														'country_name'	=>	__('Switzerland','wpsdeals')
														),
										'213'	=>	array(
														'country_code'	=>	'SY',
														'country_name'	=>	__('Syrian Arab Republic','wpsdeals')
														),
										'214'	=>	array(
														'country_code'	=>	'TW',
														'country_name'	=>	__('Taiwan, Province Of China','wpsdeals')
														),
										'215'	=>	array(
														'country_code'	=>	'TJ',
														'country_name'	=>	__('Tajikistan','wpsdeals')
														),
										'216'	=>	array(
														'country_code'	=>	'TZ',
														'country_name'	=>	__('Tanzania, United Republic of','wpsdeals')
														),
										'217'	=>	array(
														'country_code'	=>	'TH',
														'country_name'	=>	__('Thailand','wpsdeals')
														),
										'218'	=>	array(
														'country_code'	=>	'TL',
														'country_name'	=>	__('Timor-Leste','wpsdeals')
														),
										'219'	=>	array(
														'country_code'	=>	'TG',
														'country_name'	=>	__('Togo','wpsdeals')
														),
										'220'	=>	array(
														'country_code'	=>	'TK',
														'country_name'	=>	__('Tokelau','wpsdeals')
														),
										'221'	=>	array(
														'country_code'	=>	'TO',
														'country_name'	=>	__('Tonga','wpsdeals')
														),
										'222'	=>	array(
														'country_code'	=>	'TT',
														'country_name'	=>	__('Trinidad and Tobago','wpsdeals')
														),
										'223'	=>	array(
														'country_code'	=>	'TN',
														'country_name'	=>	__('Tunisia','wpsdeals')
														),
										'224'	=>	array(
														'country_code'	=>	'TR',
														'country_name'	=>	__('Turkey','wpsdeals')
														),
										'225'	=>	array(
														'country_code'	=>	'TM',
														'country_name'	=>	__('Turkmenistan','wpsdeals')
														),
										'226'	=>	array(
														'country_code'	=>	'TC',
														'country_name'	=>	__('Turks and Caicos Islands','wpsdeals')
														),
										'227'	=>	array(
														'country_code'	=>	'TV',
														'country_name'	=>	__('Tuvalu','wpsdeals')
														),
										'228'	=>	array(
														'country_code'	=>	'UG',
														'country_name'	=>	__('Uganda','wpsdeals')
														),
										'229'	=>	array(
														'country_code'	=>	'UA',
														'country_name'	=>	__('Ukraine','wpsdeals')
														),
										'230'	=>	array(
														'country_code'	=>	'AE',
														'country_name'	=>	__('United Arab Emirates','wpsdeals')
														),
										'231'	=>	array(
														'country_code'	=>	'GB',
														'country_name'	=>	__('United Kingdom','wpsdeals')
														),
										'232'	=>	array(
														'country_code'	=>	'US',
														'country_name'	=>	__('United States','wpsdeals')
														),
										'233'	=>	array(
														'country_code'	=>	'UM',
														'country_name'	=>	__('United States Minor Outlying Islands','wpsdeals')
														),
										'234'	=>	array(
														'country_code'	=>	'UY',
														'country_name'	=>	__('Uruguay','wpsdeals')
														),
										'235'	=>	array(
														'country_code'	=>	'UZ',
														'country_name'	=>	__('Uzbekistan','wpsdeals')
														),
										'236'	=>	array(
														'country_code'	=>	'VU',
														'country_name'	=>	__('Vanuatu','wpsdeals')
														),
										'237'	=>	array(
														'country_code'	=>	'VE',
														'country_name'	=>	__('Venezuela','wpsdeals')
														),
										'238'	=>	array(
														'country_code'	=>	'VN',
														'country_name'	=>	__('Viet Nam','wpsdeals')
														),
										'239'	=>	array(
														'country_code'	=>	'VG',
														'country_name'	=>	__('Virgin Islands, British','wpsdeals')
														),
										'240'	=>	array(
														'country_code'	=>	'VI',
														'country_name'	=>	__('Virgin Islands, U.S.','wpsdeals')
														),
										'241'	=>	array(
														'country_code'	=>	'WF',
														'country_name'	=>	__('Wallis And Futuna','wpsdeals')
														),
										'242'	=>	array(
														'country_code'	=>	'EH',
														'country_name'	=>	__('Western Sahara','wpsdeals')
														),
										'243'	=>	array(
														'country_code'	=>	'YE',
														'country_name'	=>	__('Yemen','wpsdeals')
														),
										'244'	=>	array(
														'country_code'	=>	'ZM',
														'country_name'	=>	__('Zambia','wpsdeals')
														),
										'245'	=>	array(
														'country_code'	=>	'ZW',
														'country_name'	=>	__('Zimbabwe','wpsdeals')
														)
									);
									
	return apply_filters( 'wps_deals_countries', $wps_deal_countries );

}

/**
 * Get all countries list
 * 
 * Handles to return all contries list
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_country_list() { 
	
	$countries = get_option('wps_deals_countries');
	if(!empty($countries)) {
		$countries = unserialize( $countries );
	} else {
		$countries = array();
	}
	return $countries;
}
/**
 * Get States From Country
 * 
 * Handles to return states/provience list 
 * from country code
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_get_states_from_country( $country = '' ) {
	
	$states = array();
	
	switch ( $country ) {
		
		case 'AU'	:	
						//Austratlian ( AU ) states
						$states = wps_deals_get_au_states();
						break;
		case 'BR'	:	
						//Brazil ( BR ) states
						$states = wps_deals_get_br_states();
						break;
		case 'CA'	:	
						//Canada ( CA ) states
						$states = wps_deals_get_ca_states();
						break;
		case 'CN'	:	
						//Chinese ( CN ) states
						$states = wps_deals_get_cn_states();
						break;
		case 'ES'	:	
						//Spain ( ES ) states
						$states = wps_deals_get_es_states();
						break;
		case 'HK'	:	
						//Hong Kong states ( HK ) states
						$states = wps_deals_get_hk_states();
						break;
		case 'HU'	:	
						//Hungary states ( HU ) states
						$states = wps_deals_get_hu_states();
						break;
		case 'ID'	:	
						//Indonesia ( ID ) Provinces
						$states = wps_deals_get_id_states();
						break;
		case 'IN'	:	
						//India ( IN ) States
						$states = wps_deals_get_in_states();
						break;
		case 'MY'	:	
						//Malaysian ( MY ) States
						$states = wps_deals_get_my_states();
						break;
		case 'NZ'	:	
						//New Zealand ( HZ ) states
						$states = wps_deals_get_nz_states();
						break;
		case 'TH'	:	
						//Thailand ( TH ) states
						$states = wps_deals_get_th_states();
						break;
		case 'TH'	:	
						//Thailand ( TH ) states
						$states = wps_deals_get_th_states();
						break;
		case 'US'	:	
						//United States ( US ) states
						$states = wps_deals_get_us_states();
						break;
		case 'ZA'	:	
						//South African ( ZA ) states
						$states = wps_deals_get_za_states();
						break;
		default		:	
						//if there is no states get
						$states = array();
						break; 
	}
	
	return $states;
	
}
/**
 * Get Australian states
 * 
 * Handles to return australian states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_au_states() {
	
	$austates = array(
		'ACT' => __( 'Australian Capital Territory', 'wpsdeals' ),
		'NSW' => __( 'New South Wales', 'wpsdeals' ),
		'NT'  => __( 'Northern Territory', 'wpsdeals' ),
		'QLD' => __( 'Queensland', 'wpsdeals' ),
		'SA'  => __( 'South Australia', 'wpsdeals' ),
		'TAS' => __( 'Tasmania', 'wpsdeals' ),
		'VIC' => __( 'Victoria', 'wpsdeals' ),
		'WA'  => __( 'Western Australia', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_au_states', $austates );
}
/**
 * Get Brazillian states
 * 
 * Handles to return brazillian states
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_get_br_states() {
	
	$brstates = array(
		'AC' => __( 'Acre', 'wpsdeals' ),
		'AL' => __( 'Alagoas', 'wpsdeals' ),
		'AP' => __( 'Amap&aacute;', 'wpsdeals' ),
		'AM' => __( 'Amazonas', 'wpsdeals' ),
		'BA' => __( 'Bahia', 'wpsdeals' ),
		'CE' => __( 'Cear&aacute;', 'wpsdeals' ),
		'DF' => __( 'Distrito Federal', 'wpsdeals' ),
		'ES' => __( 'Esp&iacute;rito Santo', 'wpsdeals' ),
		'GO' => __( 'Goi&aacute;s', 'wpsdeals' ),
		'MA' => __( 'Maranh&atilde;o', 'wpsdeals' ),
		'MT' => __( 'Mato Grosso', 'wpsdeals' ),
		'MS' => __( 'Mato Grosso do Sul', 'wpsdeals' ),
		'MG' => __( 'Minas Gerais', 'wpsdeals' ),
		'PA' => __( 'Par&aacute;', 'wpsdeals' ),
		'PB' => __( 'Para&iacute;ba', 'wpsdeals' ),
		'PR' => __( 'Paran&aacute;', 'wpsdeals' ),
		'PE' => __( 'Pernambuco', 'wpsdeals' ),
		'PI' => __( 'Piau&iacute;', 'wpsdeals' ),
		'RJ' => __( 'Rio de Janeiro', 'wpsdeals' ),
		'RN' => __( 'Rio Grande do Norte', 'wpsdeals' ),
		'RS' => __( 'Rio Grande do Sul', 'wpsdeals' ),
		'RO' => __( 'Rond&ocirc;nia', 'wpsdeals' ),
		'RR' => __( 'Roraima', 'wpsdeals' ),
		'SC' => __( 'Santa Catarina', 'wpsdeals' ),
		'SP' => __( 'S&atilde;o Paulo', 'wpsdeals' ),
		'SE' => __( 'Sergipe', 'wpsdeals' ),
		'TO' => __( 'Tocantins', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_br_states', $brstates );
}
/**
 * Get Canada Proviences List
 * 
 * Handles to return canada proviences
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_ca_states() {
	
	$castates = array(
		'AB' => __( 'Alberta', 'wpsdeals' ),
		'BC' => __( 'British Columbia', 'wpsdeals' ),
		'MB' => __( 'Manitoba', 'wpsdeals' ),
		'NB' => __( 'New Brunswick', 'wpsdeals' ),
		'NL' => __( 'Newfoundland and Labrador', 'wpsdeals' ),
		'NS' => __( 'Nova Scotia', 'wpsdeals' ),
		'NT' => __( 'Northwest Territories', 'wpsdeals' ),
		'NU' => __( 'Nunavut', 'wpsdeals' ),
		'ON' => __( 'Ontario', 'wpsdeals' ),
		'PE' => __( 'Prince Edward Island', 'wpsdeals' ),
		'QC' => __( 'Quebec', 'wpsdeals' ),
		'SK' => __( 'Saskatchewan', 'wpsdeals' ),
		'YT' => __( 'Yukon', 'wpsdeals' ),
	);

	return apply_filters( 'wps_deals_ca_states', $castates );
}
/**
 * Get Chinese States
 * 
 * Handles to return Chinese States
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_cn_states() {
	
	$cnstates = array(
	    'CN1'  => __( 'Yunnan / &#20113;&#21335;', 'wpsdeals' ),
	    'CN2'  => __( 'Beijing / &#21271;&#20140;', 'wpsdeals' ),
	    'CN3'  => __( 'Tianjin / &#22825;&#27941;', 'wpsdeals' ),
	    'CN4'  => __( 'Hebei / &#27827;&#21271;', 'wpsdeals' ),
	    'CN5'  => __( 'Shanxi / &#23665;&#35199;', 'wpsdeals' ),
	    'CN6'  => __( 'Inner Mongolia / &#20839;&#33945;&#21476;', 'wpsdeals' ),
	    'CN7'  => __( 'Liaoning / &#36797;&#23425;', 'wpsdeals' ),
	    'CN8'  => __( 'Jilin / &#21513;&#26519;', 'wpsdeals' ),
	    'CN9'  => __( 'Heilongjiang / &#40657;&#40857;&#27743;', 'wpsdeals' ),
	    'CN10' => __( 'Shanghai / &#19978;&#28023;', 'wpsdeals' ),
	    'CN11' => __( 'Jiangsu / &#27743;&#33487;', 'wpsdeals' ),
	    'CN12' => __( 'Zhejiang / &#27993;&#27743;', 'wpsdeals' ),
	    'CN13' => __( 'Anhui / &#23433;&#24509;', 'wpsdeals' ),
	    'CN14' => __( 'Fujian / &#31119;&#24314;', 'wpsdeals' ),
	    'CN15' => __( 'Jiangxi / &#27743;&#35199;', 'wpsdeals' ),
	    'CN16' => __( 'Shandong / &#23665;&#19996;', 'wpsdeals' ),
	    'CN17' => __( 'Henan / &#27827;&#21335;', 'wpsdeals' ),
	    'CN18' => __( 'Hubei / &#28246;&#21271;', 'wpsdeals' ),
	    'CN19' => __( 'Hunan / &#28246;&#21335;', 'wpsdeals' ),
	    'CN20' => __( 'Guangdong / &#24191;&#19996;', 'wpsdeals' ),
	    'CN21' => __( 'Guangxi Zhuang / &#24191;&#35199;&#22766;&#26063;', 'wpsdeals' ),
	    'CN22' => __( 'Hainan / &#28023;&#21335;', 'wpsdeals' ),
	    'CN23' => __( 'Chongqing / &#37325;&#24198;', 'wpsdeals' ),
	    'CN24' => __( 'Sichuan / &#22235;&#24029;', 'wpsdeals' ),
	    'CN25' => __( 'Guizhou / &#36149;&#24030;', 'wpsdeals' ),
	    'CN26' => __( 'Shaanxi / &#38485;&#35199;', 'wpsdeals' ),
	    'CN27' => __( 'Gansu / &#29976;&#32899;', 'wpsdeals' ),
	    'CN28' => __( 'Qinghai / &#38738;&#28023;', 'wpsdeals' ),
	    'CN29' => __( 'Ningxia Hui / &#23425;&#22799;', 'wpsdeals' ),
	    'CN30' => __( 'Macau / &#28595;&#38376;', 'wpsdeals' ),
	    'CN31' => __( 'Tibet / &#35199;&#34255;', 'wpsdeals' ),
	    'CN32' => __( 'Xinjiang / &#26032;&#30086;', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_cn_states', $cnstates );
}
/**
 * Get Spain states
 * 
 * Handles to return Spain states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_es_states() {

	$esstates = array(
		'C' => __('A Coru&ntilde;a', 'wpsdeals'),
	    'VI' => __('&Aacute;lava', 'wpsdeals'),
	    'AB' => __('Albacete', 'wpsdeals'),
	    'A' => __('Alicante', 'wpsdeals'),
	    'AL' => __('Almer&iacute;a', 'wpsdeals'),
	    'O' => __('Asturias', 'wpsdeals'),
	    'AV' => __('&Aacute;vila', 'wpsdeals'),
	    'BA' => __('Badajoz', 'wpsdeals'),
	    'PM' => __('Baleares', 'wpsdeals'),
	    'B' => __('Barcelona', 'wpsdeals'),
	    'BU' => __('Burgos', 'wpsdeals'),
	    'CC' => __('C&aacute;ceres', 'wpsdeals'),
	    'CA' => __('C&aacute;diz', 'wpsdeals'),
	    'S' => __('Cantabria', 'wpsdeals'),
	    'CS' => __('Castell&oacute;n', 'wpsdeals'),
	    'CE' => __('Ceuta', 'wpsdeals'),
	    'CR' => __('Ciudad Real', 'wpsdeals'),
	    'CO' => __('C&oacute;rdoba', 'wpsdeals'),
	    'CU' => __('Cuenca', 'wpsdeals'),
	    'GI' => __('Girona', 'wpsdeals'),
	    'GR' => __('Granada', 'wpsdeals'),
	    'GU' => __('Guadalajara', 'wpsdeals'),
	    'SS' => __('Guip&uacute;zcoa', 'wpsdeals'),
	    'H' => __('Huelva', 'wpsdeals'),
	    'HU' => __('Huesca', 'wpsdeals'),
	    'J' => __('Ja&eacute;n', 'wpsdeals'),
	    'LO' => __('La Rioja', 'wpsdeals'),
	    'GC' => __('Las Palmas', 'wpsdeals'),
	    'LE' => __('Le&oacute;n', 'wpsdeals'),
	    'L' => __('Lleida', 'wpsdeals'),
	    'LU' => __('Lugo', 'wpsdeals'),
	    'M' => __('Madrid', 'wpsdeals'),
	    'MA' => __('M&aacute;laga', 'wpsdeals'),
	    'ML' => __('Melilla', 'wpsdeals'),
	    'MU' => __('Murcia', 'wpsdeals'),
	    'NA' => __('Navarra', 'wpsdeals'),
	    'OR' => __('Ourense', 'wpsdeals'),
	    'P' => __('Palencia', 'wpsdeals'),
	    'PO' => __('Pontevedra', 'wpsdeals'),
	    'SA' => __('Salamanca', 'wpsdeals'),
	    'TF' => __('Santa Cruz de Tenerife', 'wpsdeals'),
	    'SG' => __('Segovia', 'wpsdeals'),
	    'SE' => __('Sevilla', 'wpsdeals'),
	    'SO' => __('Soria', 'wpsdeals'),
	    'T' => __('Tarragona', 'wpsdeals'),
	    'TE' => __('Teruel', 'wpsdeals'),
	    'TO' => __('Toledo', 'wpsdeals'),
	    'V' => __('Valencia', 'wpsdeals'),
	    'VA' => __('Valladolid', 'wpsdeals'),
	    'BI' => __('Vizcaya', 'wpsdeals'),
	    'ZA' => __('Zamora', 'wpsdeals'),
	    'Z' => __('Zaragoza', 'wpsdeals')		
	);
	return apply_filters( 'wps_deals_es_states', $esstates );
}
/**
 * Get Hong Kong states
 * 
 * Handles to return Hong Kong states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_hk_states() {

	$hkstates = array(
		'HONG KONG'       => __( 'Hong Kong Island', 'wpsdeals' ),
		'KOWLOON'         => __( 'Kowloon', 'wpsdeals' ),
		'NEW TERRITORIES' => __( 'New Territories', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_hk_states', $hkstates );
}
/**
 * Get Hungary states
 * 
 * Handles to return Hungary states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_hu_states() {

	$hustates = array(
		'BK' => __( 'Bács-Kiskun', 'wpsdeals' ),
		'BE' => __( 'Békés', 'wpsdeals' ),
		'BA' => __( 'Baranya', 'wpsdeals' ),
		'BZ' => __( 'Borsod-Abaúj-Zemplén', 'wpsdeals' ),
		'BU' => __( 'Budapest', 'wpsdeals' ),
		'CS' => __( 'Csongrád', 'wpsdeals' ),
		'FE' => __( 'Fejér', 'wpsdeals' ),
		'GS' => __( 'Győr-Moson-Sopron', 'wpsdeals' ),
		'HB' => __( 'Hajdú-Bihar', 'wpsdeals' ),
		'HE' => __( 'Heves', 'wpsdeals' ),
		'JN' => __( 'Jász-Nagykun-Szolnok', 'wpsdeals' ),
		'KE' => __( 'Komárom-Esztergom', 'wpsdeals' ),
		'NO' => __( 'Nógrád', 'wpsdeals' ),
		'PE' => __( 'Pest', 'wpsdeals' ),
		'SO' => __( 'Somogy', 'wpsdeals' ),
		'SZ' => __( 'Szabolcs-Szatmár-Bereg', 'wpsdeals' ),
		'TO' => __( 'Tolna', 'wpsdeals' ),
		'VA' => __( 'Vas', 'wpsdeals' ),
		'VE' => __( 'Veszprém', 'wpsdeals' ),
		'ZA' => __( 'Zala', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_hu_states', $hustates );
}
/**
 * Get New Zealand states
 * 
 * Handles to return Hungary states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_nz_states() {
	
	$nzstates = array(
		'AK' => __( 'Auckland', 'wpsdeals' ),
		'BP' => __( 'Bay of Plenty', 'wpsdeals' ),
		'CT' => __( 'Canterbury', 'wpsdeals' ),
		'HB' => __( 'Hawke&rsquo;s Bay', 'wpsdeals' ),
		'MW' => __( 'Manawatu-Wanganui', 'wpsdeals' ),
		'MB' => __( 'Marlborough', 'wpsdeals' ),
		'NS' => __( 'Nelson', 'wpsdeals' ),
		'NL' => __( 'Northland', 'wpsdeals' ),
		'OT' => __( 'Otago', 'wpsdeals' ),
		'SL' => __( 'Southland', 'wpsdeals' ),
		'TK' => __( 'Taranaki', 'wpsdeals' ),
		'TM' => __( 'Tasman', 'wpsdeals' ),
		'WA' => __( 'Waikato', 'wpsdeals' ),
		'WE' => __( 'Wellington', 'wpsdeals' ),
		'WC' => __( 'West Coast', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_nz_states', $nzstates );
}
/**
 * Get Indonesia Provinces
 * 
 * Handles to return Indonesia Provinces
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_id_states() {

	$idstates = array(
		'AC'    => __( 'Daerah Istimewa Aceh', 'wpsdeals' ),
	    'SU' => __( 'Sumatera Utara', 'wpsdeals' ),
	    'SB' => __( 'Sumatera Barat', 'wpsdeals' ),
	    'RI' => __( 'Riau', 'wpsdeals' ),
	    'KR' => __( 'Kepulauan Riau', 'wpsdeals' ),
	    'JA' => __( 'Jambi', 'wpsdeals' ),
	    'SS' => __( 'Sumatera Selatan', 'wpsdeals' ),
	    'BB' => __( 'Bangka Belitung', 'wpsdeals' ),
	    'BE' => __( 'Bengkulu', 'wpsdeals' ),
	    'LA' => __( 'Lampung', 'wpsdeals' ),
	    'JK' => __( 'DKI Jakarta', 'wpsdeals' ),
	    'JB' => __( 'Jawa Barat', 'wpsdeals' ),
	    'BT' => __( 'Banten', 'wpsdeals' ),
	    'JT' => __( 'Jawa Tengah', 'wpsdeals' ),
	    'JI' => __( 'Jawa Timur', 'wpsdeals' ),
	    'YO' => __( 'Daerah Istimewa Yogyakarta', 'wpsdeals' ),
	    'BA' => __( 'Bali', 'wpsdeals' ),
	    'NB' => __( 'Nusa Tenggara Barat', 'wpsdeals' ),
	    'NT' => __( 'Nusa Tenggara Timur', 'wpsdeals' ),
	    'KB' => __( 'Kalimantan Barat', 'wpsdeals' ),
	    'KT' => __( 'Kalimantan Tengah', 'wpsdeals' ),
	    'KI' => __( 'Kalimantan Timur', 'wpsdeals' ),
	    'KS' => __( 'Kalimantan Selatan', 'wpsdeals' ),
	    'KU' => __( 'Kalimantan Utara', 'wpsdeals' ),
	    'SA' => __( 'Sulawesi Utara', 'wpsdeals' ),
	    'ST' => __( 'Sulawesi Tengah', 'wpsdeals' ),
	    'SG' => __( 'Sulawesi Tenggara', 'wpsdeals' ),
	    'SR' => __( 'Sulawesi Barat', 'wpsdeals' ),
	    'SN' => __( 'Sulawesi Selatan', 'wpsdeals' ),
	    'GO' => __( 'Gorontalo', 'wpsdeals' ),
	    'MA' => __( 'Maluku', 'wpsdeals' ),
	    'MU' => __( 'Maluku Utara', 'wpsdeals' ),
	    'PA' => __( 'Papua', 'wpsdeals' ),
	    'PB' => __( 'Papua Barat', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_id_states', $idstates );
}
/**
 * Get India States
 * 
 * Handles to return India States
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_in_states() {
	
	$instates = array(
		'AP' => __( 'Andra Pradesh', 'wpsdeals' ),
		'AR' => __( 'Arunachal Pradesh', 'wpsdeals' ),
		'AS' => __( 'Assam', 'wpsdeals' ),
		'BR' => __( 'Bihar', 'wpsdeals' ),
		'CT' => __( 'Chhattisgarh', 'wpsdeals' ),
		'GA' => __( 'Goa', 'wpsdeals' ),
		'GJ' => __( 'Gujarat', 'wpsdeals' ),
		'HR' => __( 'Haryana', 'wpsdeals' ),
		'HP' => __( 'Himachal Pradesh', 'wpsdeals' ),
		'JK' => __( 'Jammu and Kashmir', 'wpsdeals' ),
		'JH' => __( 'Jharkhand', 'wpsdeals' ),
		'KA' => __( 'Karnataka', 'wpsdeals' ),
		'KL' => __( 'Kerala', 'wpsdeals' ),
		'MP' => __( 'Madhya Pradesh', 'wpsdeals' ),
		'MH' => __( 'Maharashtra', 'wpsdeals' ),
		'MN' => __( 'Manipur', 'wpsdeals' ),
		'ML' => __( 'Meghalaya', 'wpsdeals' ),
		'MZ' => __( 'Mizoram', 'wpsdeals' ),
		'NL' => __( 'Nagaland', 'wpsdeals' ),
		'OR' => __( 'Orissa', 'wpsdeals' ),
		'PB' => __( 'Punjab', 'wpsdeals' ),
		'RJ' => __( 'Rajasthan', 'wpsdeals' ),
		'SK' => __( 'Sikkim', 'wpsdeals' ),
		'TN' => __( 'Tamil Nadu', 'wpsdeals' ),
		'TR' => __( 'Tripura', 'wpsdeals' ),
		'UT' => __( 'Uttaranchal', 'wpsdeals' ),
		'UP' => __( 'Uttar Pradesh', 'wpsdeals' ),
		'WB' => __( 'West Bengal', 'wpsdeals' ),
		'AN' => __( 'Andaman and Nicobar Islands', 'wpsdeals' ),
		'CH' => __( 'Chandigarh', 'wpsdeals' ),
		'DN' => __( 'Dadar and Nagar Haveli', 'wpsdeals' ),
		'DD' => __( 'Daman and Diu', 'wpsdeals' ),
		'DL' => __( 'Delhi', 'wpsdeals' ),
		'LD' => __( 'Lakshadeep', 'wpsdeals' ),
		'PY' => __( 'Pondicherry (Puducherry)', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_in_states', $instates );
}
/**
 * Get Malaysian States
 * 
 * Handles to return Malaysian States
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_my_states() {
	
	$mystates =  array(
		'JHR' => __( 'Johor', 'wpsdeals' ),
		'KDH' => __( 'Kedah', 'wpsdeals' ),
		'KTN' => __( 'Kelantan', 'wpsdeals' ),
		'MLK' => __( 'Melaka', 'wpsdeals' ),
		'NSN' => __( 'Negeri Sembilan', 'wpsdeals' ),
		'PHG' => __( 'Pahang', 'wpsdeals' ),
		'PRK' => __( 'Perak', 'wpsdeals' ),
		'PLS' => __( 'Perlis', 'wpsdeals' ),
		'PNG' => __( 'Pulau Pinang', 'wpsdeals' ),
		'SBH' => __( 'Sabah', 'wpsdeals' ),
		'SWK' => __( 'Sarawak', 'wpsdeals' ),
		'SGR' => __( 'Selangor', 'wpsdeals' ),
		'TRG' => __( 'Terengganu', 'wpsdeals' ),
		'KUL' => __( 'W.P. Kuala Lumpur', 'wpsdeals' ),
		'LBN' => __( 'W.P. Labuan', 'wpsdeals' ),
		'PJY' => __( 'W.P. Putrajaya', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_my_states', $mystates );
}
/**
 * Get Thailand States
 * 
 * Handles to return Thailand States
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_th_states() {

	$thstates = array(
		'TH-37' => __( 'Amnat Charoen (&#3629;&#3635;&#3609;&#3634;&#3592;&#3648;&#3592;&#3619;&#3636;&#3597;)', 'wpsdeals' ),
		'TH-15' => __( 'Ang Thong (&#3629;&#3656;&#3634;&#3591;&#3607;&#3629;&#3591;)', 'wpsdeals' ),
		'TH-14' => __( 'Ayutthaya (&#3614;&#3619;&#3632;&#3609;&#3588;&#3619;&#3624;&#3619;&#3637;&#3629;&#3618;&#3640;&#3608;&#3618;&#3634;)', 'wpsdeals' ),
		'TH-10' => __( 'Bangkok (&#3585;&#3619;&#3640;&#3591;&#3648;&#3607;&#3614;&#3617;&#3627;&#3634;&#3609;&#3588;&#3619;)', 'wpsdeals' ),
		'TH-38' => __( 'Bueng Kan (&#3610;&#3638;&#3591;&#3585;&#3634;&#3628;)', 'wpsdeals' ),
		'TH-31' => __( 'Buri Ram (&#3610;&#3640;&#3619;&#3637;&#3619;&#3633;&#3617;&#3618;&#3660;)', 'wpsdeals' ),
		'TH-24' => __( 'Chachoengsao (&#3593;&#3632;&#3648;&#3594;&#3636;&#3591;&#3648;&#3607;&#3619;&#3634;)', 'wpsdeals' ),
		'TH-18' => __( 'Chai Nat (&#3594;&#3633;&#3618;&#3609;&#3634;&#3607;)', 'wpsdeals' ),
		'TH-36' => __( 'Chaiyaphum (&#3594;&#3633;&#3618;&#3616;&#3641;&#3617;&#3636;)', 'wpsdeals' ),
		'TH-22' => __( 'Chanthaburi (&#3592;&#3633;&#3609;&#3607;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-50' => __( 'Chiang Mai (&#3648;&#3594;&#3637;&#3618;&#3591;&#3651;&#3627;&#3617;&#3656;)', 'wpsdeals' ),
		'TH-57' => __( 'Chiang Rai (&#3648;&#3594;&#3637;&#3618;&#3591;&#3619;&#3634;&#3618;)', 'wpsdeals' ),
		'TH-20' => __( 'Chonburi (&#3594;&#3621;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-86' => __( 'Chumphon (&#3594;&#3640;&#3617;&#3614;&#3619;)', 'wpsdeals' ),
		'TH-46' => __( 'Kalasin (&#3585;&#3634;&#3628;&#3626;&#3636;&#3609;&#3608;&#3640;&#3660;)', 'wpsdeals' ),
		'TH-62' => __( 'Kamphaeng Phet (&#3585;&#3635;&#3649;&#3614;&#3591;&#3648;&#3614;&#3594;&#3619;)', 'wpsdeals' ),
		'TH-71' => __( 'Kanchanaburi (&#3585;&#3634;&#3597;&#3592;&#3609;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-40' => __( 'Khon Kaen (&#3586;&#3629;&#3609;&#3649;&#3585;&#3656;&#3609;)', 'wpsdeals' ),
		'TH-81' => __( 'Krabi (&#3585;&#3619;&#3632;&#3610;&#3637;&#3656;)', 'wpsdeals' ),
		'TH-52' => __( 'Lampang (&#3621;&#3635;&#3611;&#3634;&#3591;)', 'wpsdeals' ),
		'TH-51' => __( 'Lamphun (&#3621;&#3635;&#3614;&#3641;&#3609;)', 'wpsdeals' ),
		'TH-42' => __( 'Loei (&#3648;&#3621;&#3618;)', 'wpsdeals' ),
		'TH-16' => __( 'Lopburi (&#3621;&#3614;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-58' => __( 'Mae Hong Son (&#3649;&#3617;&#3656;&#3630;&#3656;&#3629;&#3591;&#3626;&#3629;&#3609;)', 'wpsdeals' ),
		'TH-44' => __( 'Maha Sarakham (&#3617;&#3627;&#3634;&#3626;&#3634;&#3619;&#3588;&#3634;&#3617;)', 'wpsdeals' ),
		'TH-49' => __( 'Mukdahan (&#3617;&#3640;&#3585;&#3604;&#3634;&#3627;&#3634;&#3619;)', 'wpsdeals' ),
		'TH-26' => __( 'Nakhon Nayok (&#3609;&#3588;&#3619;&#3609;&#3634;&#3618;&#3585;)', 'wpsdeals' ),
		'TH-73' => __( 'Nakhon Pathom (&#3609;&#3588;&#3619;&#3611;&#3600;&#3617;)', 'wpsdeals' ),
		'TH-48' => __( 'Nakhon Phanom (&#3609;&#3588;&#3619;&#3614;&#3609;&#3617;)', 'wpsdeals' ),
		'TH-30' => __( 'Nakhon Ratchasima (&#3609;&#3588;&#3619;&#3619;&#3634;&#3594;&#3626;&#3637;&#3617;&#3634;)', 'wpsdeals' ),
		'TH-60' => __( 'Nakhon Sawan (&#3609;&#3588;&#3619;&#3626;&#3623;&#3619;&#3619;&#3588;&#3660;)', 'wpsdeals' ),
		'TH-80' => __( 'Nakhon Si Thammarat (&#3609;&#3588;&#3619;&#3624;&#3619;&#3637;&#3608;&#3619;&#3619;&#3617;&#3619;&#3634;&#3594;)', 'wpsdeals' ),
		'TH-55' => __( 'Nan (&#3609;&#3656;&#3634;&#3609;)', 'wpsdeals' ),
		'TH-96' => __( 'Narathiwat (&#3609;&#3619;&#3634;&#3608;&#3636;&#3623;&#3634;&#3626;)', 'wpsdeals' ),
		'TH-39' => __( 'Nong Bua Lam Phu (&#3627;&#3609;&#3629;&#3591;&#3610;&#3633;&#3623;&#3621;&#3635;&#3616;&#3641;)', 'wpsdeals' ),
		'TH-43' => __( 'Nong Khai (&#3627;&#3609;&#3629;&#3591;&#3588;&#3634;&#3618;)', 'wpsdeals' ),
		'TH-12' => __( 'Nonthaburi (&#3609;&#3609;&#3607;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-13' => __( 'Pathum Thani (&#3611;&#3607;&#3640;&#3617;&#3608;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-94' => __( 'Pattani (&#3611;&#3633;&#3605;&#3605;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-82' => __( 'Phang Nga (&#3614;&#3633;&#3591;&#3591;&#3634;)', 'wpsdeals' ),
		'TH-93' => __( 'Phatthalung (&#3614;&#3633;&#3607;&#3621;&#3640;&#3591;)', 'wpsdeals' ),
		'TH-56' => __( 'Phayao (&#3614;&#3632;&#3648;&#3618;&#3634;)', 'wpsdeals' ),
		'TH-67' => __( 'Phetchabun (&#3648;&#3614;&#3594;&#3619;&#3610;&#3641;&#3619;&#3603;&#3660;)', 'wpsdeals' ),
		'TH-76' => __( 'Phetchaburi (&#3648;&#3614;&#3594;&#3619;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-66' => __( 'Phichit (&#3614;&#3636;&#3592;&#3636;&#3605;&#3619;)', 'wpsdeals' ),
		'TH-65' => __( 'Phitsanulok (&#3614;&#3636;&#3625;&#3603;&#3640;&#3650;&#3621;&#3585;)', 'wpsdeals' ),
		'TH-54' => __( 'Phrae (&#3649;&#3614;&#3619;&#3656;)', 'wpsdeals' ),
		'TH-83' => __( 'Phuket (&#3616;&#3641;&#3648;&#3585;&#3655;&#3605;)', 'wpsdeals' ),
		'TH-25' => __( 'Prachin Buri (&#3611;&#3619;&#3634;&#3592;&#3637;&#3609;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-77' => __( 'Prachuap Khiri Khan (&#3611;&#3619;&#3632;&#3592;&#3623;&#3610;&#3588;&#3637;&#3619;&#3637;&#3586;&#3633;&#3609;&#3608;&#3660;)', 'wpsdeals' ),
		'TH-85' => __( 'Ranong (&#3619;&#3632;&#3609;&#3629;&#3591;)', 'wpsdeals' ),
		'TH-70' => __( 'Ratchaburi (&#3619;&#3634;&#3594;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-21' => __( 'Rayong (&#3619;&#3632;&#3618;&#3629;&#3591;)', 'wpsdeals' ),
		'TH-45' => __( 'Roi Et (&#3619;&#3657;&#3629;&#3618;&#3648;&#3629;&#3655;&#3604;)', 'wpsdeals' ),
		'TH-27' => __( 'Sa Kaeo (&#3626;&#3619;&#3632;&#3649;&#3585;&#3657;&#3623;)', 'wpsdeals' ),
		'TH-47' => __( 'Sakon Nakhon (&#3626;&#3585;&#3621;&#3609;&#3588;&#3619;)', 'wpsdeals' ),
		'TH-11' => __( 'Samut Prakan (&#3626;&#3617;&#3640;&#3607;&#3619;&#3611;&#3619;&#3634;&#3585;&#3634;&#3619;)', 'wpsdeals' ),
		'TH-74' => __( 'Samut Sakhon (&#3626;&#3617;&#3640;&#3607;&#3619;&#3626;&#3634;&#3588;&#3619;)', 'wpsdeals' ),
		'TH-75' => __( 'Samut Songkhram (&#3626;&#3617;&#3640;&#3607;&#3619;&#3626;&#3591;&#3588;&#3619;&#3634;&#3617;)', 'wpsdeals' ),
		'TH-19' => __( 'Saraburi (&#3626;&#3619;&#3632;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-91' => __( 'Satun (&#3626;&#3605;&#3641;&#3621;)', 'wpsdeals' ),
		'TH-17' => __( 'Sing Buri (&#3626;&#3636;&#3591;&#3627;&#3660;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-33' => __( 'Sisaket (&#3624;&#3619;&#3637;&#3626;&#3632;&#3648;&#3585;&#3625;)', 'wpsdeals' ),
		'TH-90' => __( 'Songkhla (&#3626;&#3591;&#3586;&#3621;&#3634;)', 'wpsdeals' ),
		'TH-64' => __( 'Sukhothai (&#3626;&#3640;&#3650;&#3586;&#3607;&#3633;&#3618;)', 'wpsdeals' ),
		'TH-72' => __( 'Suphan Buri (&#3626;&#3640;&#3614;&#3619;&#3619;&#3603;&#3610;&#3640;&#3619;&#3637;)', 'wpsdeals' ),
		'TH-84' => __( 'Surat Thani (&#3626;&#3640;&#3619;&#3634;&#3625;&#3598;&#3619;&#3660;&#3608;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-32' => __( 'Surin (&#3626;&#3640;&#3619;&#3636;&#3609;&#3607;&#3619;&#3660;)', 'wpsdeals' ),
		'TH-63' => __( 'Tak (&#3605;&#3634;&#3585;)', 'wpsdeals' ),
		'TH-92' => __( 'Trang (&#3605;&#3619;&#3633;&#3591;)', 'wpsdeals' ),
		'TH-23' => __( 'Trat (&#3605;&#3619;&#3634;&#3604;)', 'wpsdeals' ),
		'TH-34' => __( 'Ubon Ratchathani (&#3629;&#3640;&#3610;&#3621;&#3619;&#3634;&#3594;&#3608;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-41' => __( 'Udon Thani (&#3629;&#3640;&#3604;&#3619;&#3608;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-61' => __( 'Uthai Thani (&#3629;&#3640;&#3607;&#3633;&#3618;&#3608;&#3634;&#3609;&#3637;)', 'wpsdeals' ),
		'TH-53' => __( 'Uttaradit (&#3629;&#3640;&#3605;&#3619;&#3604;&#3636;&#3605;&#3606;&#3660;)', 'wpsdeals' ),
		'TH-95' => __( 'Yala (&#3618;&#3632;&#3621;&#3634;)', 'wpsdeals' ),
		'TH-35' => __( 'Yasothon (&#3618;&#3650;&#3626;&#3608;&#3619;)', 'wpsdeals' )
	);
	
	return apply_filters( 'wps_deals_th_states', $thstates );
}
/**
 * Get United States States
 * 
 * Handles to return United States States
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_us_states() {
	
	$usstates = array(
		'AL' => __( 'Alabama', 'wpsdeals' ),
		'AK' => __( 'Alaska', 'wpsdeals' ),
		'AZ' => __( 'Arizona', 'wpsdeals' ),
		'AR' => __( 'Arkansas', 'wpsdeals' ),
		'CA' => __( 'California', 'wpsdeals' ),
		'CO' => __( 'Colorado', 'wpsdeals' ),
		'CT' => __( 'Connecticut', 'wpsdeals' ),
		'DE' => __( 'Delaware', 'wpsdeals' ),
		'DC' => __( 'District Of Columbia', 'wpsdeals' ),
		'FL' => __( 'Florida', 'wpsdeals' ),
		'GA' => __( 'Georgia', 'wpsdeals' ),
		'HI' => __( 'Hawaii', 'wpsdeals' ),
		'ID' => __( 'Idaho', 'wpsdeals' ),
		'IL' => __( 'Illinois', 'wpsdeals' ),
		'IN' => __( 'Indiana', 'wpsdeals' ),
		'IA' => __( 'Iowa', 'wpsdeals' ),
		'KS' => __( 'Kansas', 'wpsdeals' ),
		'KY' => __( 'Kentucky', 'wpsdeals' ),
		'LA' => __( 'Louisiana', 'wpsdeals' ),
		'ME' => __( 'Maine', 'wpsdeals' ),
		'MD' => __( 'Maryland', 'wpsdeals' ),
		'MA' => __( 'Massachusetts', 'wpsdeals' ),
		'MI' => __( 'Michigan', 'wpsdeals' ),
		'MN' => __( 'Minnesota', 'wpsdeals' ),
		'MS' => __( 'Mississippi', 'wpsdeals' ),
		'MO' => __( 'Missouri', 'wpsdeals' ),
		'MT' => __( 'Montana', 'wpsdeals' ),
		'NE' => __( 'Nebraska', 'wpsdeals' ),
		'NV' => __( 'Nevada', 'wpsdeals' ),
		'NH' => __( 'New Hampshire', 'wpsdeals' ),
		'NJ' => __( 'New Jersey', 'wpsdeals' ),
		'NM' => __( 'New Mexico', 'wpsdeals' ),
		'NY' => __( 'New York', 'wpsdeals' ),
		'NC' => __( 'North Carolina', 'wpsdeals' ),
		'ND' => __( 'North Dakota', 'wpsdeals' ),
		'OH' => __( 'Ohio', 'wpsdeals' ),
		'OK' => __( 'Oklahoma', 'wpsdeals' ),
		'OR' => __( 'Oregon', 'wpsdeals' ),
		'PA' => __( 'Pennsylvania', 'wpsdeals' ),
		'RI' => __( 'Rhode Island', 'wpsdeals' ),
		'SC' => __( 'South Carolina', 'wpsdeals' ),
		'SD' => __( 'South Dakota', 'wpsdeals' ),
		'TN' => __( 'Tennessee', 'wpsdeals' ),
		'TX' => __( 'Texas', 'wpsdeals' ),
		'UT' => __( 'Utah', 'wpsdeals' ),
		'VT' => __( 'Vermont', 'wpsdeals' ),
		'VA' => __( 'Virginia', 'wpsdeals' ),
		'WA' => __( 'Washington', 'wpsdeals' ),
		'WV' => __( 'West Virginia', 'wpsdeals' ),
		'WI' => __( 'Wisconsin', 'wpsdeals' ),
		'WY' => __( 'Wyoming', 'wpsdeals' ),
		'AA' => __( 'Armed Forces (AA)', 'wpsdeals' ),
		'AE' => __( 'Armed Forces (AE)', 'wpsdeals' ),
		'AP' => __( 'Armed Forces (AP)', 'wpsdeals' ),
		'AS' => __( 'American Samoa', 'wpsdeals' ),
		'GU' => __( 'Guam', 'wpsdeals' ),
		'MP' => __( 'Northern Mariana Islands', 'wpsdeals' ),
		'PR' => __( 'Puerto Rico', 'wpsdeals' ),
		'UM' => __( 'US Minor Outlying Islands', 'wpsdeals' ),
		'VI' => __( 'US Virgin Islands', 'wpsdeals' ),
	);

	return apply_filters( 'wps_deals_us_states', $usstates );
}
/**
 * Get South African states
 * 
 * Handles to return South African states
 *
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_za_states() {

	$zastates = array(
		'EC'  => __( 'Eastern Cape', 'wpsdeals' ) ,
		'FS'  => __( 'Free State', 'wpsdeals' ) ,
		'GP'  => __( 'Gauteng', 'wpsdeals' ) ,
		'KZN' => __( 'KwaZulu-Natal', 'wpsdeals' ) ,
		'LP'  => __( 'Limpopo', 'wpsdeals' ) ,
		'MP'  => __( 'Mpumalanga', 'wpsdeals' ) ,
		'NC'  => __( 'Northern Cape', 'wpsdeals' ) ,
		'NW'  => __( 'North West', 'wpsdeals' ) ,
		'WC'  => __( 'Western Cape', 'wpsdeals' )
	);
	return apply_filters( 'wps_deals_za_states', $zastates );
}
/**
 * Get State From State Key 
 * 
 * Handles to return state value from state key
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_get_country_name( $country ) {
	
	$countries = wps_deals_get_country_list();
	$resultcountry = '';
	if( !empty( $countries ) ) {
		foreach ( $countries as $key => $rescountry ) {
			if( $rescountry['country_code'] == $country ) {
				$resultcountry = $rescountry['country_name'] ;
				break;
			} //end if
		}//end forloop
	}
	$resultcountry = !empty( $resultcountry ) ? $resultcountry : $country;
	return $resultcountry;
}
/**
 * Get State From State Key 
 * 
 * Handles to return state value from state key
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 **/
function wps_deals_get_state_name( $state, $country ) {
	
	if( empty( $state ) || empty( $country ) ){
		return '';
	}
	$resultstate = '';
	$stateslist = wps_deals_get_states_from_country( $country );
	
	//check is there any inbuilt states available for this country or not
	if( !empty( $stateslist ) && is_array( $stateslist ) ){
		$resultstate = isset( $stateslist[$state] ) ? $stateslist[$state] : $state;
	} else {
		//else return which is passed
		$resultstate = $state;
	}
	return $resultstate;
}
?>