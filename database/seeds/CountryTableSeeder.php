<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $countryArray = array(
                            array('Albania', NULL, NULL, 'Leke', 'ALL', 'Lek', NULL, 'inactive', NULL, '2020-01-30 23:16:27'),
							array('America', NULL, NULL, 'Dollars', 'USD', '$', NULL, 'inactive', NULL, NULL),
							array('Afghanistan', NULL, NULL, 'Afghanis', 'AFN', '؋', NULL, 'inactive', NULL, NULL),
							array('Argentina', NULL, NULL, 'Pesos', 'ARS', '$', NULL, 'inactive', NULL, NULL),
							array('Aruba', NULL, NULL, 'Guilders', 'AWG', 'ƒ', NULL, 'inactive', NULL, NULL),
							array('Australia', NULL, NULL, 'Dollars', 'AUD', '$', NULL, 'inactive', NULL, NULL),
							array('Azerbaijan', NULL, NULL, 'New Manats', 'AZN', 'ман', NULL, 'inactive', NULL, NULL),
							array('Bahamas', NULL, NULL, 'Dollars', 'BSD', '$', NULL, 'inactive', NULL, NULL),
							array('Barbados', NULL, NULL, 'Dollars', 'BBD', '$', NULL, 'inactive', NULL, NULL),
							array('Belarus', NULL, NULL, 'Rubles', 'BYR', 'p.', NULL, 'inactive', NULL, NULL),
							array('Belgium', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Beliz', NULL, NULL, 'Dollars', 'BZD', 'BZ$', NULL, 'inactive', NULL, NULL),
							array('Bermuda', NULL, NULL, 'Dollars', 'BMD', '$', NULL, 'inactive', NULL, NULL),
							array('Bolivia', NULL, NULL, 'Bolivianos', 'BOB', '$b', NULL, 'inactive', NULL, NULL),
							array('Bosnia and Herzegovina', NULL, NULL, 'Convertible Marka', 'BAM', 'KM', NULL, 'inactive', NULL, NULL),
							array('Botswana', NULL, NULL, 'Pula', 'BWP', 'P', NULL, 'inactive', NULL, NULL),
							array('Bulgaria', NULL, NULL, 'Leva', 'BGN', 'лв', NULL, 'inactive', NULL, NULL),
							array('Brazil', NULL, NULL, 'Reais', 'BRL', 'R$', NULL, 'inactive', NULL, NULL),
							array('Britain (United Kingdom)', NULL, NULL, 'Pounds', 'GBP', '£', NULL, 'inactive', NULL, NULL),
							array('Brunei Darussalam', NULL, NULL, 'Dollars', 'BND', '$', NULL, 'inactive', NULL, NULL),
							array('Cambodia', NULL, NULL, 'Riels', 'KHR', '៛', NULL, 'inactive', NULL, NULL),
							array('Canada', NULL, NULL, 'Dollars', 'CAD', '$', NULL, 'inactive', NULL, NULL),
							array('Cayman Islands', NULL, NULL, 'Dollars', 'KYD', '$', NULL, 'inactive', NULL, NULL),
							array('Chile', NULL, NULL, 'Pesos', 'CLP', '$', NULL, 'inactive', NULL, NULL),
							array('China', NULL, NULL, 'Yuan Renminbi', 'CNY', '¥', NULL, 'inactive', NULL, NULL),
							array('Colombia', NULL, NULL, 'Pesos', 'COP', '$', NULL, 'inactive', NULL, NULL),
							array('Costa Rica', NULL, NULL, 'Colón', 'CRC', '₡', NULL, 'inactive', NULL, NULL),
							array('Croatia', NULL, NULL, 'Kuna', 'HRK', 'kn', NULL, 'inactive', NULL, NULL),
							array('Cuba', NULL, NULL, 'Pesos', 'CUP', '₱', NULL, 'inactive', NULL, NULL),
							array('Cyprus', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Czech Republic', NULL, NULL, 'Koruny', 'CZK', 'Kč', NULL, 'inactive', NULL, NULL),
							array('Denmark', NULL, NULL, 'Kroner', 'DKK', 'kr', NULL, 'inactive', NULL, NULL),
							array('Dominican Republic', NULL, NULL, 'Pesos', 'DOP ', 'RD$', NULL, 'inactive', NULL, NULL),
							array('East Caribbean', NULL, NULL, 'Dollars', 'XCD', '$', NULL, 'inactive', NULL, NULL),
							array('Egypt', NULL, NULL, 'Pounds', 'EGP', '£', NULL, 'inactive', NULL, NULL),
							array('El Salvador', NULL, NULL, 'Colones', 'SVC', '$', NULL, 'inactive', NULL, NULL),
							array('England (United Kingdom)', NULL, NULL, 'Pounds', 'GBP', '£', NULL, 'inactive', NULL, NULL),
							array('Euro', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Falkland Islands', NULL, NULL, 'Pounds', 'FKP', '£', NULL, 'inactive', NULL, NULL),
							array('Fiji', NULL, NULL, 'Dollars', 'FJD', '$', NULL, 'inactive', NULL, NULL),
							array('France', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Ghana', NULL, NULL, 'Cedis', 'GHC', '¢', NULL, 'inactive', NULL, NULL),
							array('Gibraltar', NULL, NULL, 'Pounds', 'GIP', '£', NULL, 'inactive', NULL, NULL),
							array('Greece', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Guatemala', NULL, NULL, 'Quetzales', 'GTQ', 'Q', NULL, 'inactive', NULL, NULL),
							array('Guernsey', NULL, NULL, 'Pounds', 'GGP', '£', NULL, 'inactive', NULL, NULL),
							array('Guyana', NULL, NULL, 'Dollars', 'GYD', '$', NULL, 'inactive', NULL, NULL),
							array('Holland (Netherlands)', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Honduras', NULL, NULL, 'Lempiras', 'HNL', 'L', NULL, 'inactive', NULL, NULL),
							array('Hong Kong', NULL, NULL, 'Dollars', 'HKD', '$', NULL, 'inactive', NULL, NULL),
							array('Hungary', NULL, NULL, 'Forint', 'HUF', 'Ft', NULL, 'inactive', NULL, NULL),
							array('Iceland', NULL, NULL, 'Kronur', 'ISK', 'kr', NULL, 'inactive', NULL, NULL),
							array('India', 'IN', '+91', 'Rupees', 'INR', 'Rp', NULL, 'active', NULL, '2020-01-07 06:56:01'),
							array('Indonesia', NULL, NULL, 'Rupiahs', 'IDR', 'Rp', NULL, 'inactive', NULL, NULL),
							array('Iran', NULL, NULL, 'Rials', 'IRR', '﷼', NULL, 'inactive', NULL, NULL),
							array('Ireland', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Isle of Man', NULL, NULL, 'Pounds', 'IMP', '£', NULL, 'inactive', NULL, NULL),
							array('Israel', NULL, NULL, 'New Shekels', 'ILS', '₪', NULL, 'inactive', NULL, NULL),
							array('Italy', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Jamaica', NULL, NULL, 'Dollars', 'JMD', 'J$', NULL, 'inactive', NULL, NULL),
							array('Japan', NULL, NULL, 'Yen', 'JPY', '¥', NULL, 'inactive', NULL, NULL),
							array('Jersey', NULL, NULL, 'Pounds', 'JEP', '£', NULL, 'inactive', NULL, NULL),
							array('Kazakhstan', NULL, NULL, 'Tenge', 'KZT', 'лв', NULL, 'inactive', NULL, NULL),
							array('Korea (North)', NULL, NULL, 'Won', 'KPW', '₩', NULL, 'inactive', NULL, NULL),
							array('Korea (South)', NULL, NULL, 'Won', 'KRW', '₩', NULL, 'inactive', NULL, NULL),
							array('Kyrgyzstan', NULL, NULL, 'Soms', 'KGS', 'лв', NULL, 'inactive', NULL, NULL),
							array('Laos', NULL, NULL, 'Kips', 'LAK', '₭', NULL, 'inactive', NULL, NULL),
							array('Latvia', NULL, NULL, 'Lati', 'LVL', 'Ls', NULL, 'inactive', NULL, NULL),
							array('Lebanon', NULL, NULL, 'Pounds', 'LBP', '£', NULL, 'inactive', NULL, NULL),
							array('Liberia', NULL, NULL, 'Dollars', 'LRD', '$', NULL, 'inactive', NULL, NULL),
							array('Liechtenstein', NULL, NULL, 'Switzerland Francs', 'CHF', 'CHF', NULL, 'inactive', NULL, NULL),
							array('Lithuania', NULL, NULL, 'Litai', 'LTL', 'Lt', NULL, 'inactive', NULL, NULL),
							array('Luxembourg', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Macedonia', NULL, NULL, 'Denars', 'MKD', 'ден', NULL, 'inactive', NULL, NULL),
							array('Malaysia', NULL, NULL, 'Ringgits', 'MYR', 'RM', NULL, 'inactive', NULL, NULL),
							array('Malta', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Mauritius', NULL, NULL, 'Rupees', 'MUR', '₨', NULL, 'inactive', NULL, NULL),
							array('Mexico', NULL, NULL, 'Pesos', 'MXN', '$', NULL, 'inactive', NULL, NULL),
							array('Mongolia', NULL, NULL, 'Tugriks', 'MNT', '₮', NULL, 'inactive', NULL, NULL),
							array('Mozambique', NULL, NULL, 'Meticais', 'MZN', 'MT', NULL, 'inactive', NULL, NULL),
							array('Namibia', NULL, NULL, 'Dollars', 'NAD', '$', NULL, 'inactive', NULL, NULL),
							array('Nepal', NULL, NULL, 'Rupees', 'NPR', '₨', NULL, 'inactive', NULL, NULL),
							array('Netherlands Antilles', NULL, NULL, 'Guilders', 'ANG', 'ƒ', NULL, 'inactive', NULL, NULL),
							array('Netherlands', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('New Zealand', NULL, NULL, 'Dollars', 'NZD', '$', NULL, 'inactive', NULL, NULL),
							array('Nicaragua', NULL, NULL, 'Cordobas', 'NIO', 'C$', NULL, 'inactive', NULL, NULL),
							array('Nigeria', NULL, NULL, 'Nairas', 'NGN', '₦', NULL, 'inactive', NULL, NULL),
							array('North Korea', NULL, NULL, 'Won', 'KPW', '₩', NULL, 'inactive', NULL, NULL),
							array('Norway', NULL, NULL, 'Krone', 'NOK', 'kr', NULL, 'inactive', NULL, NULL),
							array('Oman', NULL, NULL, 'Rials', 'OMR', '﷼', NULL, 'inactive', NULL, NULL),
							array('Pakistan', NULL, NULL, 'Rupees', 'PKR', '₨', NULL, 'inactive', NULL, NULL),
							array('Panama', NULL, NULL, 'Balboa', 'PAB', 'B/.', NULL, 'inactive', NULL, NULL),
							array('Paraguay', NULL, NULL, 'Guarani', 'PYG', 'Gs', NULL, 'inactive', NULL, NULL),
							array('Peru', NULL, NULL, 'Nuevos Soles', 'PEN', 'S/.', NULL, 'inactive', NULL, NULL),
							array('Philippines', NULL, NULL, 'Pesos', 'PHP', 'Php', NULL, 'inactive', NULL, NULL),
							array('Poland', NULL, NULL, 'Zlotych', 'PLN', 'zł', NULL, 'inactive', NULL, NULL),
							array('Qatar', NULL, NULL, 'Rials', 'QAR', '﷼', NULL, 'inactive', NULL, NULL),
							array('Romania', NULL, NULL, 'New Lei', 'RON', 'lei', NULL, 'inactive', NULL, NULL),
							array('Russia', NULL, NULL, 'Rubles', 'RUB', 'руб', NULL, 'inactive', NULL, NULL),
							array('Saint Helena', NULL, NULL, 'Pounds', 'SHP', '£', NULL, 'inactive', NULL, NULL),
							array('Saudi Arabia', NULL, NULL, 'Riyals', 'SAR', '﷼', NULL, 'inactive', NULL, NULL),
							array('Serbia', NULL, NULL, 'Dinars', 'RSD', 'Дин.', NULL, 'inactive', NULL, NULL),
							array('Seychelles', NULL, NULL, 'Rupees', 'SCR', '₨', NULL, 'inactive', NULL, NULL),
							array('Singapore', NULL, NULL, 'Dollars', 'SGD', '$', NULL, 'inactive', NULL, NULL),
							array('Slovenia', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Solomon Islands', NULL, NULL, 'Dollars', 'SBD', '$', NULL, 'inactive', NULL, NULL),
							array('Somalia', NULL, NULL, 'Shillings', 'SOS', 'S', NULL, 'inactive', NULL, NULL),
							array('South Africa', NULL, NULL, 'Rand', 'ZAR', 'R', NULL, 'inactive', NULL, NULL),
							array('South Korea', NULL, NULL, 'Won', 'KRW', '₩', NULL, 'inactive', NULL, NULL),
							array('Spain', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Sri Lanka', NULL, NULL, 'Rupees', 'LKR', '₨', NULL, 'inactive', NULL, NULL),
							array('Sweden', NULL, NULL, 'Kronor', 'SEK', 'kr', NULL, 'inactive', NULL, NULL),
							array('Switzerland', NULL, NULL, 'Francs', 'CHF', 'CHF', NULL, 'inactive', NULL, NULL),
							array('Suriname', NULL, NULL, 'Dollars', 'SRD', '$', NULL, 'inactive', NULL, NULL),
							array('Syria', NULL, NULL, 'Pounds', 'SYP', '£', NULL, 'inactive', NULL, NULL),
							array('Taiwan', NULL, NULL, 'New Dollars', 'TWD', 'NT$', NULL, 'inactive', NULL, NULL),
							array('Thailand', NULL, NULL, 'Baht', 'THB', '฿', NULL, 'inactive', NULL, NULL),
							array('Trinidad and Tobago', NULL, NULL, 'Dollars', 'TTD', 'TT$', NULL, 'inactive', NULL, NULL),
							array('Turkey', NULL, NULL, 'Lira', 'TRY', 'TL', NULL, 'inactive', NULL, NULL),
							array('Turkey', NULL, NULL, 'Liras', 'TRL', '£', NULL, 'inactive', NULL, NULL),
							array('Tuvalu', NULL, NULL, 'Dollars', 'TVD', '$', NULL, 'inactive', NULL, NULL),
							array('Ukraine', NULL, NULL, 'Hryvnia', 'UAH', '₴', NULL, 'inactive', NULL, NULL),
							array('United Kingdom', NULL, NULL, 'Pounds', 'GBP', '£', NULL, 'inactive', NULL, NULL),
							array('United States of America', NULL, NULL, 'Dollars', 'USD', '$', NULL, 'inactive', NULL, NULL),
							array('Uruguay', NULL, NULL, 'Pesos', 'UYU', '$U', NULL, 'inactive', NULL, NULL),
							array('Uzbekistan', NULL, NULL, 'Sums', 'UZS', 'лв', NULL, 'inactive', NULL, NULL),
							array('Vatican City', NULL, NULL, 'Euro', 'EUR', '€', NULL, 'inactive', NULL, NULL),
							array('Venezuela', NULL, NULL, 'Bolivares Fuertes', 'VEF', 'Bs', NULL, 'inactive', NULL, NULL),
							array('Vietnam', NULL, NULL, 'Dong', 'VND', '₫', NULL, 'inactive', NULL, NULL),
							array('Yemen', NULL, NULL, 'Rials', 'YER', '﷼', NULL, 'inactive', NULL, NULL),
							array('Zimbabwe', NULL, NULL, 'Zimbabwe Dollars', 'ZWD', 'Z$', NULL, 'inactive', NULL, NULL),
							array('Kuwait', 'KW', '+965', 'Kuwait Dianr', 'KWD', 'KD', NULL, 'active', '2020-01-07 06:57:48', '2020-01-07 06:57:48'),
                		);
		foreach ($countryArray as $key => $value) {
            $createArray = array();
            $createArray['country_name']      = $value[0];
            $createArray['country_code']      = $value[1];
            $createArray['dial_code']         = $value[2];
            $createArray['currency']          = $value[3];
            $createArray['currency_code']     = $value[4];
            $createArray['currency_symbol']   = $value[5];
            $createArray['slug']              = $value[6];
            $createArray['status']            = $value[7];

            /*$createArray['sortname']      = $value[1];
            $createArray['name']            = $value[2];
            $createArray['phonecode']      = $value[3];
            $createArray['status']          = 'inactive';*/

            Country::create($createArray);
        }
    }
}
