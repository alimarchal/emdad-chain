<?php

namespace App\Models;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;
    use TwoFactorAuthenticatable;
    use LogsActivity;

//    protected $guard_name = "web";

    protected static $logAttributes = ['*'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender',
        'name',
        'middle_initial',
        'family_name',
        'email',
        'password',
        'business_id',
        'designation',
        'email_verified_at',
        'profile_photo_path',
        'registration_type',
        'profile_approved',
        'profile_approval_id',
        'mobile',
        'usertype',
        'nid_num',
        'nid_exp_date',
        'status',
        'is_active',
        'usertype',
        'driver_status',
        'added_by',
        'added_by_userId',
        'rtl',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function waitingTime()
    {
        // time in minutes
        $time_in_minute = 30;
        return $time_in_minute;
    }

    public function business()
    {
        return $this->belongsTo(Business::class)->withDefault();
    }

    public function purchase_request_forms()
    {
        return $this->hasMany(PurchaseRequestForm::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quatation::class);
    }

    public static function countries(): array
    {
        return $countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica",
            "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
    }

    public static function countries_with_code(): array
    {
        return ["Afghanistan" => 'AF',
            "Albania" => 'AL',
            "Algeria" => 'DZ',
            "American Samoa" => 'AS',
            "Andorra" => 'AD',
            "Angola" => 'AO',
            "Anguilla" => 'AI',
            "Antarctica" => 'AQ',
            "Antigua and Barbuda" => 'AG',
            "Argentina" => 'AR',
            "Armenia" => 'AM',
            "Aruba" => 'AW',
            "Australia" => 'AU',
            "Austria" => 'AT',
            "Azerbaijan" => 'AZ',
            "Bahamas" => 'BS',
            "Bahrain" => 'BH',
            "Bangladesh" => 'BD',
            "Barbados" => 'BB',
            "Belarus" => 'BY',
            "Belgium" => 'BE',
            "Belize" => 'BZ',
            "Benin" => 'BJ',
            "Bermuda" => 'BM',
            "Bhutan" => 'BT',
            "Bolivia, Plurinational State of" => 'BO',
            "Bolivia" => 'BO',
            "Bosnia and Herzegovina" => 'BA',
            "Botswana" => 'BW',
            "Bouvet Island" => 'BV',
            "Brazil" => 'BR',
            "British Indian Ocean Territory" => 'IO',
            "Brunei Darussalam" => 'BN',
            "Brunei" => 'BN',
            "Bulgaria" => 'BG',
            "Burkina Faso" => 'BF',
            "Burundi" => 'BI',
            "Cambodia" => 'KH',
            "Cameroon" => 'CM',
            "Canada" => 'CA',
            "Cape Verde" => 'CV',
            "Cayman Islands" => 'KY',
            "Central African Republic" => 'CF',
            "Chad" => 'TD',
            "Chile" => 'CL',
            "China" => 'CN',
            "Christmas Island" => 'CX',
            "Cocos (Keeling) Islands" => 'CC',
            "Colombia" => 'CO',
            "Comoros" => 'KM',
            "Congo" => 'CG',
            "Congo, the Democratic Republic of the" => 'CD',
            "Cook Islands" => 'CK',
            "Costa Rica" => 'CR',
            "Côte d'Ivoire" => 'CI',
            "Ivory Coast" => 'CI',
            "Croatia" => 'HR',
            "Cuba" => 'CU',
            "Cyprus" => 'CY',
            "Czech Republic" => 'CZ',
            "Denmark" => 'DK',
            "Djibouti" => 'DJ',
            "Dominica" => 'DM',
            "Dominican Republic" => 'DO',
            "Ecuador" => 'EC',
            "Egypt" => 'EG',
            "El Salvador" => 'SV',
            "Equatorial Guinea" => 'GQ',
            "Eritrea" => 'ER',
            "Estonia" => 'EE',
            "Ethiopia" => 'ET',
            "Falkland Islands (Malvinas)" => 'FK',
            "Faroe Islands" => 'FO',
            "Fiji" => 'FJ',
            "Finland" => 'FI',
            "France" => 'FR',
            "French Guiana" => 'GF',
            "French Polynesia" => 'PF',
            "French Southern Territories" => 'TF',
            "Gabon" => 'GA',
            "Gambia" => 'GM',
            "Georgia" => 'GE',
            "Germany" => 'DE',
            "Ghana" => 'GH',
            "Gibraltar" => 'GI',
            "Greece" => 'GR',
            "Greenland" => 'GL',
            "Grenada" => 'GD',
            "Guadeloupe" => 'GP',
            "Guam" => 'GU',
            "Guatemala" => 'GT',
            "Guernsey" => 'GG',
            "Guinea" => 'GN',
            "Guinea-Bissau" => 'GW',
            "Guyana" => 'GY',
            "Haiti" => 'HT',
            "Heard Island and McDonald Islands" => 'HM',
            "Holy See (Vatican City State)" => 'VA',
            "Honduras" => 'HN',
            "Hong Kong" => 'HK',
            "Hungary" => 'HU',
            "Iceland" => 'IS',
            "India" => 'IN',
            "Indonesia" => 'ID',
            "Iran, Islamic Republic of" => 'IR',
            "Iraq" => 'IQ',
            "Ireland" => 'IE',
            "Isle of Man" => 'IM',
            "Israel" => 'IL',
            "Italy" => 'IT',
            "Jamaica" => 'JM',
            "Japan" => 'JP',
            "Jersey" => 'JE',
            "Jordan" => 'JO',
            "Kazakhstan" => 'KZ',
            "Kenya" => 'KE',
            "Kiribati" => 'KI',
            "Korea, Democratic People's Republic of" => 'KP',
            "Korea, Republic of" => 'KR',
            "South Korea" => 'KR',
            "Kuwait" => 'KW',
            "Kyrgyzstan" => 'KG',
            "Lao People's Democratic Republic" => 'LA',
            "Latvia" => 'LV',
            "Lebanon" => 'LB',
            "Lesotho" => 'LS',
            "Liberia" => 'LR',
            "Libyan Arab Jamahiriya" => 'LY',
            "Libya" => 'LY',
            "Liechtenstein" => 'LI',
            "Lithuania" => 'LT',
            "Luxembourg" => 'LU',
            "Macao" => 'MO',
            "Macedonia, the former Yugoslav Republic of" => 'MK',
            "Madagascar" => 'MG',
            "Malawi" => 'MW',
            "Malaysia" => 'MY',
            "Maldives" => 'MV',
            "Mali" => 'ML',
            "Malta" => 'MT',
            "Marshall Islands" => 'MH',
            "Martinique" => 'MQ',
            "Mauritania" => 'MR',
            "Mauritius" => 'MU',
            "Mayotte" => 'YT',
            "Mexico" => 'MX',
            "Micronesia, Federated States of" => 'FM',
            "Moldova, Republic of" => 'MD',
            "Monaco" => 'MC',
            "Mongolia" => 'MN',
            "Montenegro" => 'ME',
            "Montserrat" => 'MS',
            "Morocco" => 'MA',
            "Mozambique" => 'MZ',
            "Myanmar" => 'MM',
            "Burma" => 'MM',
            "Namibia" => 'NA',
            "Nauru" => 'NR',
            "Nepal" => 'NP',
            "Netherlands" => 'NL',
            "Netherlands Antilles" => 'AN',
            "New Caledonia" => 'NC',
            "New Zealand" => 'NZ',
            "Nicaragua" => 'NI',
            "Niger" => 'NE',
            "Nigeria" => 'NG',
            "Niue" => 'NU',
            "Norfolk Island" => 'NF',
            "Northern Mariana Islands" => 'MP',
            "Norway" => 'NO',
            "Oman" => 'OM',
            "Pakistan" => 'PK',
            "Palau" => 'PW',
            "Palestinian Territory, Occupied" => 'PS',
            "Panama" => 'PA',
            "Papua New Guinea" => 'PG',
            "Paraguay" => 'PY',
            "Peru" => 'PE',
            "Philippines" => 'PH',
            "Pitcairn" => 'PN',
            "Poland" => 'PL',
            "Portugal" => 'PT',
            "Puerto Rico" => 'PR',
            "Qatar" => 'QA',
            "Réunion" => 'RE',
            "Romania" => 'RO',
            "Russian Federation" => 'RU',
            "Russia" => 'RU',
            "Rwanda" => 'RW',
            "Saint Helena, Ascension and Tristan da Cunha" => 'SH',
            "Saint Kitts and Nevis" => 'KN',
            "Saint Lucia" => 'LC',
            "Saint Pierre and Miquelon" => 'PM',
            "Saint Vincent and the Grenadines" => 'VC',
            "Saint Vincent & the Grenadines" => 'VC',
            "St. Vincent and the Grenadines" => 'VC',
            "Samoa" => 'WS',
            "San Marino" => 'SM',
            "Sao Tome and Principe" => 'ST',
            "Saudi Arabia" => 'SA',
            "Senegal" => 'SN',
            "Serbia" => 'RS',
            "Seychelles" => 'SC',
            "Sierra Leone" => 'SL',
            "Singapore" => 'SG',
            "Slovakia" => 'SK',
            "Slovenia" => 'SI',
            "Solomon Islands" => 'SB',
            "Somalia" => 'SO',
            "South Africa" => 'ZA',
            "South Georgia and the South Sandwich Islands" => 'GS',
            "South Sudan" => 'SS',
            "Spain" => 'ES',
            "Sri Lanka" => 'LK',
            "Sudan" => 'SD',
            "Suriname" => 'SR',
            "Svalbard and Jan Mayen" => 'SJ',
            "Swaziland" => 'SZ',
            "Sweden" => 'SE',
            "Switzerland" => 'CH',
            "Syrian Arab Republic" => 'SY',
            "Taiwan, Province of China" => 'TW',
            "Taiwan" => 'TW',
            "Tajikistan" => 'TJ',
            "Tanzania, United Republic of" => 'TZ',
            "Thailand" => 'TH',
            "Timor-Leste" => 'TL',
            "Togo" => 'TG',
            "Tokelau" => 'TK',
            "Tonga" => 'TO',
            "Trinidad and Tobago" => 'TT',
            "Tunisia" => 'TN',
            "Turkey" => 'TR',
            "Turkmenistan" => 'TM',
            "Turks and Caicos Islands" => 'TC',
            "Tuvalu" => 'TV',
            "Uganda" => 'UG',
            "Ukraine" => 'UA',
            "United Arab Emirates" => 'AE',
            "United Kingdom" => 'GB',
            "United States" => 'US',
            "United States Minor Outlying Islands" => 'UM',
            "Uruguay" => 'UY',
            "Uzbekistan" => 'UZ',
            "Vanuatu" => 'VU',
            "Venezuela, Bolivarian Republic of" => 'VE',
            "Venezuela" => 'VE',
            "Viet Nam" => 'VN',
            "Vietnam" => 'VN',
            "Virgin Islands, British" => 'VG',
            "Virgin Islands, U.S." => 'VI',
            "Wallis and Futuna" => 'WF',
            "Western Sahara" => 'EH',
            "Yemen" => 'YE',
            "Zambia" => 'ZM',
            "Zimbabwe" => 'ZW'];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function business_package()
    {
        return $this->hasOne(BusinessPackage::class);
    }
}
