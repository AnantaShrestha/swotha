<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrekkingPartners extends Model
{
    protected $table = 'trip_partners';
    protected $fillable = [
    	'user_id',
	    'tripdate_id',
	    'requirements_id',
	    'book_id',
	    'trip_id',
    ];
    
    public $timestamps = false;
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function tripdate(){
    	return $this->belongsTo(TripDates::class, 'tripdate_id','id');
    }
    
    public function requirements(){
    	return $this->hasOne(PartnerRequirements::class, 'post_id', 'id');
    }
    
    public function trip(){
    	return $this->belongsTo(Trips::class, 'trip_id', 'id');
    }
    
    public function totalTrips($trip_id){
    	return (TrekkingPartners::where('trip_id', $trip_id)->count());
    }
    
    public function bookingDetail(){
    	return $this->belongsTo(TripBookings::class, 'book_id', 'bookid');
    }
    
    public function comments(){
    	return $this->hasMany(Comments::class, 'post_id', 'id');
    }
	
	public function countryCode($country){
		$code = array(
			'AF'=>'Afghanistan',
			'AX'=>'AlandIslands',
			'AL'=>'Albania',
			'DZ'=>'Algeria',
			'AS'=>'AmericanSamoa',
			'AD'=>'Andorra',
			'AO'=>'Angola',
			'AI'=>'Anguilla',
			'AQ'=>'Antarctica',
			'AG'=>'AntiguaandBarbuda',
			'AR'=>'Argentina',
			'AM'=>'Armenia',
			'AW'=>'Aruba',
			'AU'=>'Australia',
			'AT'=>'Austria',
			'AZ'=>'Azerbaijan',
			'BS'=>'Bahamasthe',
			'BH'=>'Bahrain',
			'BD'=>'Bangladesh',
			'BB'=>'Barbados',
			'BY'=>'Belarus',
			'BE'=>'Belgium',
			'BZ'=>'Belize',
			'BJ'=>'Benin',
			'BM'=>'Bermuda',
			'BT'=>'Bhutan',
			'BO'=>'Bolivia',
			'BA'=>'BosniaandHerzegovina',
			'BW'=>'Botswana',
			'BV'=>'BouvetIslandBouvetoya',
			'BR'=>'Brazil',
			'IO'=>'BritishIndianOceanTerritoryChagosArchipelago',
			'VG'=>'BritishVirginIslands',
			'BN'=>'BruneiDarussalam',
			'BG'=>'Bulgaria',
			'BF'=>'BurkinaFaso',
			'BI'=>'Burundi',
			'KH'=>'Cambodia',
			'CM'=>'Cameroon',
			'CA'=>'Canada',
			'CV'=>'CapeVerde',
			'KY'=>'CaymanIslands',
			'CF'=>'CentralAfricanRepublic',
			'TD'=>'Chad',
			'CL'=>'Chile',
			'CN'=>'China',
			'CX'=>'ChristmasIsland',
			'CC'=>'CocosKeelingIslands',
			'CO'=>'Colombia',
			'KM'=>'Comorosthe',
			'CD'=>'Congo',
			'CG'=>'Congothe',
			'CK'=>'CookIslands',
			'CR'=>'CostaRica',
			'CI'=>'Coted\'Ivoire',
			'HR'=>'Croatia',
			'CU'=>'Cuba',
			'CY'=>'Cyprus',
			'CZ'=>'CzechRepublic',
			'DK'=>'Denmark',
			'DJ'=>'Djibouti',
			'DM'=>'Dominica',
			'DO'=>'DominicanRepublic',
			'EC'=>'Ecuador',
			'EG'=>'Egypt',
			'SV'=>'ElSalvador',
			'GQ'=>'EquatorialGuinea',
			'ER'=>'Eritrea',
			'EE'=>'Estonia',
			'ET'=>'Ethiopia',
			'FO'=>'FaroeIslands',
			'FK'=>'FalklandIslandsMalvinas',
			'FJ'=>'FijitheFijiIslands',
			'FI'=>'Finland',
			'FR'=>'FranceFrenchRepublic',
			'GF'=>'FrenchGuiana',
			'PF'=>'FrenchPolynesia',
			'TF'=>'FrenchSouthernTerritories',
			'GA'=>'Gabon',
			'GM'=>'Gambiathe',
			'GE'=>'Georgia',
			'DE'=>'Germany',
			'GH'=>'Ghana',
			'GI'=>'Gibraltar',
			'GR'=>'Greece',
			'GL'=>'Greenland',
			'GD'=>'Grenada',
			'GP'=>'Guadeloupe',
			'GU'=>'Guam',
			'GT'=>'Guatemala',
			'GG'=>'Guernsey',
			'GN'=>'Guinea',
			'GW'=>'Guinea-Bissau',
			'GY'=>'Guyana',
			'HT'=>'Haiti',
			'HM'=>'HeardIslandandMcDonaldIslands',
			'VA'=>'HolySeeVaticanCityState',
			'HN'=>'Honduras',
			'HK'=>'HongKong',
			'HU'=>'Hungary',
			'IS'=>'Iceland',
			'IN'=>'India',
			'ID'=>'Indonesia',
			'IR'=>'Iran',
			'IQ'=>'Iraq',
			'IE'=>'Ireland',
			'IM'=>'IsleofMan',
			'IL'=>'Israel',
			'IT'=>'Italy',
			'JM'=>'Jamaica',
			'JP'=>'Japan',
			'JE'=>'Jersey',
			'JO'=>'Jordan',
			'KZ'=>'Kazakhstan',
			'KE'=>'Kenya',
			'KI'=>'Kiribati',
			'KP'=>'Korea',
			'KR'=>'Korea',
			'KW'=>'Kuwait',
			'KG'=>'KyrgyzRepublic',
			'LA'=>'Lao',
			'LV'=>'Latvia',
			'LB'=>'Lebanon',
			'LS'=>'Lesotho',
			'LR'=>'Liberia',
			'LY'=>'LibyanArabJamahiriya',
			'LI'=>'Liechtenstein',
			'LT'=>'Lithuania',
			'LU'=>'Luxembourg',
			'MO'=>'Macao',
			'MK'=>'Macedonia',
			'MG'=>'Madagascar',
			'MW'=>'Malawi',
			'MY'=>'Malaysia',
			'MV'=>'Maldives',
			'ML'=>'Mali',
			'MT'=>'Malta',
			'MH'=>'MarshallIslands',
			'MQ'=>'Martinique',
			'MR'=>'Mauritania',
			'MU'=>'Mauritius',
			'YT'=>'Mayotte',
			'MX'=>'Mexico',
			'FM'=>'Micronesia',
			'MD'=>'Moldova',
			'MC'=>'Monaco',
			'MN'=>'Mongolia',
			'ME'=>'Montenegro',
			'MS'=>'Montserrat',
			'MA'=>'Morocco',
			'MZ'=>'Mozambique',
			'MM'=>'Myanmar',
			'NA'=>'Namibia',
			'NR'=>'Nauru',
			'NP'=>'Nepal',
			'AN'=>'NetherlandsAntilles',
			'NL'=>'Netherlandsthe',
			'NC'=>'NewCaledonia',
			'NZ'=>'NewZealand',
			'NI'=>'Nicaragua',
			'NE'=>'Niger',
			'NG'=>'Nigeria',
			'NU'=>'Niue',
			'NF'=>'NorfolkIsland',
			'MP'=>'NorthernMarianaIslands',
			'NO'=>'Norway',
			'OM'=>'Oman',
			'PK'=>'Pakistan',
			'PW'=>'Palau',
			'PS'=>'PalestinianTerritory',
			'PA'=>'Panama',
			'PG'=>'PapuaNewGuinea',
			'PY'=>'Paraguay',
			'PE'=>'Peru',
			'PH'=>'Philippines',
			'PN'=>'PitcairnIslands',
			'PL'=>'Poland',
			'PT'=>'PortugalPortugueseRepublic',
			'PR'=>'PuertoRico',
			'QA'=>'Qatar',
			'RE'=>'Reunion',
			'RO'=>'Romania',
			'RU'=>'RussianFederation',
			'RW'=>'Rwanda',
			'BL'=>'SaintBarthelemy',
			'SH'=>'SaintHelena',
			'KN'=>'SaintKittsandNevis',
			'LC'=>'SaintLucia',
			'MF'=>'SaintMartin',
			'PM'=>'SaintPierreandMiquelon',
			'VC'=>'SaintVincentandtheGrenadines',
			'WS'=>'Samoa',
			'SM'=>'SanMarino',
			'ST'=>'SaoTomeandPrincipe',
			'SA'=>'SaudiArabia',
			'SN'=>'Senegal',
			'RS'=>'Serbia',
			'SC'=>'Seychelles',
			'SL'=>'SierraLeone',
			'SG'=>'Singapore',
			'SK'=>'SlovakiaSlovakRepublic',
			'SI'=>'Slovenia',
			'SB'=>'SolomonIslands',
			'SO'=>'SomaliaSomaliRepublic',
			'ZA'=>'SouthAfrica',
			'GS'=>'SouthGeorgiaandtheSouthSandwichIslands',
			'ES'=>'Spain',
			'LK'=>'SriLanka',
			'SD'=>'Sudan',
			'SR'=>'Suriname',
			'SJ'=>'Svalbard&JanMayenIslands',
			'SZ'=>'Swaziland',
			'SE'=>'Sweden',
			'CH'=>'SwitzerlandSwissConfederation',
			'SY'=>'SyrianArabRepublic',
			'TW'=>'Taiwan',
			'TJ'=>'Tajikistan',
			'TZ'=>'Tanzania',
			'TH'=>'Thailand',
			'TL'=>'Timor-Leste',
			'TG'=>'Togo',
			'TK'=>'Tokelau',
			'TO'=>'Tonga',
			'TT'=>'TrinidadandTobago',
			'TN'=>'Tunisia',
			'TR'=>'Turkey',
			'TM'=>'Turkmenistan',
			'TC'=>'TurksandCaicosIslands',
			'TV'=>'Tuvalu',
			'UG'=>'Uganda',
			'UA'=>'Ukraine',
			'AE'=>'UnitedArabEmirates',
			'GB'=>'UnitedKingdom',
			'US'=>'UnitedStatesofAmerica',
			'UM'=>'UnitedStatesMinorOutlyingIslands',
			'VI'=>'UnitedStatesVirginIslands',
			'UY'=>'UruguayEasternRepublicof',
			'UZ'=>'Uzbekistan',
			'VU'=>'Vanuatu',
			'VE'=>'Venezuela',
			'VN'=>'Vietnam',
			'WF'=>'WallisandFutuna',
			'EH'=>'WesternSahara',
			'YE'=>'Yemen',
			'ZM'=>'Zambia',
			'ZW'=>'Zimbabwe'
		
		);
		
		foreach($code as $one){
			if(strtolower($country) == strtolower($one)){
				$countryCode = array_search($one,$code);
				return $countryCode;
			}
		}
	}
}