<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update310 extends CI_Migration
{
    public function up()
    {
        // https://ellislab.com/codeigniter/user-guide/database/helpers.html

        // -------------------------------------------
        // Define courier services selection methods
        // -------------------------------------------

        // 1-urgent, 2-product, 3-price, 4-post code, 5-weight

        $this->db->insert('service_selection_method', ['code' => 'urgent', 'name' => 'Urgent Delivery',
            'description' => 'Delivery will be assigned to the faster courier service']);

        $this->db->insert('service_selection_method', ['code' => 'sku', 'name' => 'Product',
            'description' => 'Delivery will be assigned to the default service configured for each product']);

        $this->db->insert('service_selection_method', ['code' => 'price', 'name' => 'Price',
            'description' => 'Delivery will be assigned to the cheapest service']);

        $this->db->insert('service_selection_method', ['code' => 'postal', 'name' => 'Postal',
            'description' => 'Delivery will be assigned to the service which has indicated that postal code']);

        $this->db->insert('service_selection_method', ['code' => 'weight', 'name' => 'Weight',
            'description' => 'Delivery will be assigned to the service which supports deliveries of such weight']);

        // ----------------------------
        //  Define Package Types
        // ----------------------------

        $this->db->insert('package_type', [
            'code' => 'package',
            'name' => 'Package',
        ]);

        $this->db->insert('package_type', [
            'code' => 'envelope',
            'name' => 'Envelope',
        ]);

        // ----------------------------
        //  Define Spreadsheet types
        //      and their columns
        // ----------------------------

        $this->db->insert('spreadsheet_type', [
            'code' => 'fee',
            'name' => 'Courier Fees',
            'description' => 'Spreadsheet containing fees (general or by zone)',
            'sequence' => 1,
        ]);
        $feesSpreadsheetTypeId = $this->db->insert_id();

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'weight',
            'name' => 'Max Weight',
            'description' => 'Column indicating each max weight',
            'spreadsheet_type_id' => $feesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 1,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'fee',
            'name' => 'Fee',
            'description' => 'Column indicating the price',
            'spreadsheet_type_id' => $feesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 1,
        ]);

        // -----------------------------
        //   Define Spreadsheet Statuses
        // -----------------------------

        // 1 = "Created" (record created in spreadsheet table)
        // 2 = "Loaded" (records loaded as-is in spreadsheet_row)
        // 3 = "Configured" (records created in spreadsheet_column)
        // 4 = "Imported" (records created in related tables like fee_range, zone_item, etc)

        $this->db->insert('spreadsheet_status', [
            'code' => 'created',
            'name' => 'Created',
        ]);

        $this->db->insert('spreadsheet_status', [
            'code' => 'loaded',
            'name' => 'Loaded',
        ]);

        $this->db->insert('spreadsheet_status', [
            'code' => 'configured',
            'name' => 'Configured',
        ]);

        $this->db->insert('spreadsheet_status', [
            'code' => 'imported',
            'name' => 'Imported',
        ]);

        // --------------------
        //   Define Fee Units
        // --------------------

        // 1-Shipment
        // 2-Product (per units)
        // 3-Product Type (per SKUs)
        // 4-Weight (per real or volumetric kg)
        // 5-Volume (per volume factor)
        // 6-Shipping Price (percentage over shipping)
        // 7-Total Price (percentage over total)
        // 8-Storage (per kg per day fee)
        // 9-Formula (mixed/combined)

        // NOTE: Type 5-Volume is an "indirect" fee type. It store the volumetric factor, a number applied to
        //       size of package (height+weight+depth) to get the volumetric weight. If volumetric weight is
        //       greater than real weight (kg) it's used. But fee is alway taken from 4-Weight Fee Factor
        //       So, type 5-Volume is "mutually exclusive" with type 4-Weight

        $this->db->insert('fee_factor', [
            'code' => 'shipment',
            'name' => 'By Shipment',
            'description' => 'Fee by Shipment',
            'sequence' => 1,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'product',
            'name' => 'By Product',
            'description' => 'Fee by products quantity',
            'sequence' => 2,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'product-type',
            'name' => 'By Product Type',
            'description' => 'Fee by SKU quantity',
            'sequence' => 3,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'weight',
            'name' => 'By Weight',
            'description' => 'Fee by Kg (real or volumetric)',
            'sequence' => 4,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'volume',
            'name' => 'By Volume Factor',
            'description' => 'To get volumetric Weight',
            'sequence' => 5,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'shipping-price',
            'name' => 'By Shipping Price',
            'description' => 'Fee % of Shipping Price',
            'sequence' => 6,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'total-price',
            'name' => 'By Total Price',
            'description' => 'Fee by % of Total Price',
            'sequence' => 7,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'time',
            'name' => 'By Time',
            'description' => 'Fee by Storage (per Kg/Day)',
            'sequence' => 8,
        ]);

        $this->db->insert('fee_factor', [
            'code' => 'formula',
            'name' => 'By Formula',
            'description' => 'Fee defined by Formula',
            'sequence' => 9,
        ]);

        // -----------------------
        // Define Fee Granularity
        // -----------------------

        // 1-General (for all sellers and couriers)
        // 2-Seller (fee by seller, same fee for all couriers)
        // 3-Courier (fee by courier, same fee for all sellers)
        // 4-Seller+Courier (fee by seller and courier)
        // 5-Seller+Service (fee by seller and service)
        // 6-Seller+Zone (fee by seller and zone, used for delivery fees)
        // 7-Seller+Country (fee by seller and zone, used for delivery fees)

        $this->db->insert('fee_granularity', [
            'code' => 'general',
            'name' => 'General',
            'description' => 'Same fee for all sellers and couriers',
            'sequence' => 1,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'seller',
            'name' => 'By Seller',
            'description' => 'Same fee for all couriers',
            'sequence' => 2,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'courier',
            'name' => 'By Courier',
            'description' => 'Same fee for all sellers',
            'sequence' => 3,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'seller-courier',
            'name' => 'By Seller & Courier',
            'description' => 'Fee by seller and courier',
            'sequence' => 4,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'seller-service',
            'name' => 'By Seller & Service',
            'description' => 'Fee by seller and service',
            'sequence' => 5,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'seller-zone',
            'name' => 'By Seller & Zone',
            'description' => 'Fee by seller and zone',
            'sequence' => 6,
        ]);

        $this->db->insert('fee_granularity', [
            'code' => 'seller-country',
            'name' => 'By Seller & Country',
            'description' => 'Fee by seller and country',
            'sequence' => 7,
        ]);

        // ----------------------------------------------------------------------
        // Define fee price type used on fee spreadsheets
        // NOTE: On ShipEU version 1 (only national deliveries), only "final-price" will be used
        // ----------------------------------------------------------------------

        // 1- Final price
        // 2- Per unit price
        // 3- Surcharge percentage (over total cost)

        $this->db->insert('fee_price_type', [
            'code' => 'total-price',
            'name' => 'Total Price',
            'description' => 'Entered fee is the total price to pay',
            'sequence' => 1,
        ]);

        $this->db->insert('fee_price_type', [
            'code' => 'unit-price',
            'name' => 'Unit Price',
            'description' => 'Entered fee is per unit, total price must be multiplicated by factor units (kg, days, etc)',
            'sequence' => 2,
        ]);

        $this->db->insert('fee_price_type', [
            'code' => 'percentage',
            'name' => 'Percentage',
            'description' => 'Entered fee is per percentage, should be calculated as surcharge % of price',
            'sequence' => 3,
        ]);

        // -----------------
        // Define Fee Types
        // -----------------

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(50) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("fee_factor_id int NOT NULL");
        $this->dbforge->add_field("fee_price_type_id int NOT NULL");
        $this->dbforge->add_field("fee_granularity_id int NOT NULL");
        $this->dbforge->add_field("fee_ranges bit NOT NULL DEFAULT 0");
        $this->dbforge->add_field("custom_field_label varchar(100) NULL"); // Caso especial, por ejemplo "Limite de dinero cubierto por este seguro parcial"
        $this->dbforge->create_table('fee_type');

        // -----------------
        // Define Continents
        // -----------------

        $this->db->insert('continent', ['code' => 'a', 'name' => 'Africa']);
        $this->db->insert('continent', ['code' => 'e', 'name' => 'Europe']);
        $this->db->insert('continent', ['code' => 'i', 'name' => 'Asia']);
        $this->db->insert('continent', ['code' => 'm', 'name' => 'Medium East']);
        $this->db->insert('continent', ['code' => 'n', 'name' => 'North America']);  // Includes Center America
        $this->db->insert('continent', ['code' => 'o', 'name' => 'Oceania']);
        $this->db->insert('continent', ['code' => 's', 'name' => 'South America']);

        // ----------------------------------------------------------------
        // Define Countries, based on en.wikipedia.org/wiki/ISO_3166-1
        // ----------------------------------------------------------

        $this->createCountry('AU', 'Australia', 'o');
        $this->createCountry('AT', 'Austria', 'e');
        $this->createCountry('BH', 'Bahrain', 'm');
        $this->createCountry('BD', 'Bangladesh', 'i');
        $this->createCountry('BE', 'Belgium', 'e');
        $this->createCountry('BR', 'Brazil', 's');
        $this->createCountry('BG', 'Bulgaria', 'e');
        $this->createCountry('CA', 'Canada', 'n');
        $this->createCountry('CL', 'Chile', 's');
        $this->createCountry('CN', 'China', 'i');
        $this->createCountry('CO','Colombia', 's');
        $this->createCountry('CR','Costa Rica','s');
        $this->createCountry('HR','Croatia', 'e');
        $this->createCountry('CY','Cyprus','m');
        $this->createCountry('CZ','Czech Republic','e');
        $this->createCountry('DK','Denmark','e');
        $this->createCountry('DO','Dominican Republic','s');
        $this->createCountry('EC','Ecuador','s');
        $this->createCountry('EG','Egypt','m');
        $this->createCountry('EE','Estonia','e');
        $this->createCountry('FI','Finland','e');
        $this->createCountry('FR','France','e');
        $this->createCountry('DE','Germany','e');
        $this->createCountry('GR','Greece','e');
        $this->createCountry('GT','Guatemala','n');
        $this->createCountry('HK','Hong Kong','i');
        $this->createCountry('HU','Hungary','e');
        $this->createCountry('IN','India','i');
        $this->createCountry('ID','Indonesia','i');
        $this->createCountry('IE','Ireland','e');
        $this->createCountry('IL','Israel','m');
        $this->createCountry('IT','Italy','e');
        $this->createCountry('JP','Japan','i');
        $this->createCountry('JO','Jordan','m');
        $this->createCountry('KR','Korea, Republic of','i');
        $this->createCountry('KW','Kuwait','m');
        $this->createCountry('LV','Latvia','e');
        $this->createCountry('LT','Lithuania','e');
        $this->createCountry('LU','Luxembourg','e');
        $this->createCountry('MO','Macao','i');
        $this->createCountry('MY','Malaysia','i');
        $this->createCountry('MT','Malta','e');
        $this->createCountry('MX','Mexico','n');
        $this->createCountry('MA','Morocco','a');
        $this->createCountry('NL','Netherlands','e');
        $this->createCountry('NZ','New Zealand','o');
        $this->createCountry('NG','Nigeria','a');
        $this->createCountry('NO','Norway','e');
        $this->createCountry('OM','Oman','m');
        $this->createCountry('PK','Pakistan','m');
        $this->createCountry('PA','Panama','s');
        $this->createCountry('PE','Peru','s');
        $this->createCountry('PH','Philippines','i');
        $this->createCountry('PL','Poland','e');
        $this->createCountry('PT','Portugal','e');
        $this->createCountry('QA','Qatar','m');
        $this->createCountry('RO','Romania','e');
        $this->createCountry('SA','Saudi Arabia','m');
        $this->createCountry('SG','Singapore','i');
        $this->createCountry('SK','Slovakia','e');
        $this->createCountry('SI','Slovenia','e');
        $this->createCountry('ZA','South Africa','a');
        $this->createCountry('LK','Sri Lanka','i');
        $this->createCountry('SE','Sweden','e');
        $this->createCountry('CH','Switzerland','e');
        $this->createCountry('TW','Taiwan','i');
        $this->createCountry('TH','Thailand','i');
        $this->createCountry('TR','Turkey','i');
        $this->createCountry('AE','United Arab Emirates','m');
        $this->createCountry('GB','United Kingdom','e');
        $this->createCountry('US','United States','n');
        $this->createCountry('VE','Venezuela','s');
        $this->createCountry('AD', 'Andorra', 'e');
        $this->createCountry('AF', 'Afghanistan', 'i');
        $this->createCountry('AG', 'Antigua and Barbuda', 's');
        $this->createCountry('AI', 'Anguilla', 's');
        $this->createCountry('AL', 'Albania', 'e');
        $this->createCountry('AM', 'Armenia', 'e');
        $this->createCountry('AN', 'Antilles Netherlands', 'n');
        $this->createCountry('AO', 'Angola', 'a');
        $this->createCountry('AR', 'Argentina', 's');
        $this->createCountry('AS', 'American Samoa', 'o');
        $this->createCountry('AW', 'Aruba', 's');
        $this->createCountry('AZ', 'Azerbaijan', 'e');
        $this->createCountry('BA', 'Bosnia-Herzegovina', 'e');
        $this->createCountry('BB', 'Barbados', 's');
        $this->createCountry('BF', 'Burkina Faso', 'a');
        $this->createCountry('BI', 'Burundi', 'a');
        $this->createCountry('BJ', 'Benin', 'a');
        $this->createCountry('BM', 'Bermuda', 's');
        $this->createCountry('BN', 'Brunei', 'i');
        $this->createCountry('BO', 'Bolivia', 's');
        $this->createCountry('BQ', 'Bonaire, Sint Eustatius and Saba', 's');
        $this->createCountry('BS', 'Bahamas', 's');
        $this->createCountry('BT', 'Bhutan', 'i');
        $this->createCountry('BW', 'Botswana', 'a');
        $this->createCountry('BY', 'Belarus (Byelorussia)', 'e');
        $this->createCountry('BZ', 'Belize', 'n');
        $this->createCountry('CD', 'Democratic republic of Congo', 'a');
        $this->createCountry('CG', 'Congo (Brazzaville)', 'a');
        $this->createCountry('CF', 'Central African Republic', 'a');
        $this->createCountry('CI', 'Ivory Coast (Côte d\'Ivoire)', 'a');
        $this->createCountry('CK', 'Cook Islands', 'o');
        $this->createCountry('CM', 'Cameroon', 'a');
        $this->createCountry('CU', 'Cuba', 'n');
        $this->createCountry('CV', 'Cape Verde Islands', 'a');
        $this->createCountry('CW', 'Curazao', 's');
        $this->createCountry('DJ', 'Djibouti', 'a');
        $this->createCountry('DM', 'Dominica', 's');
        $this->createCountry('DZ', 'Algeria', 'a');
        $this->createCountry('EH', 'Western Sahara', 'a');
        $this->createCountry('ER', 'Eritrea', 'a');
        $this->createCountry('ET', 'Ethiopia', 'a');
        $this->createCountry('FJ', 'Fiji', 'o');
        $this->createCountry('FM', 'Micronesia (Federated States of)', 'o');
        $this->createCountry('FO', 'Faroe Islands', 'e');
        $this->createCountry('GA', 'Gabon', 'a');
        $this->createCountry('GD', 'Grenada', 's');
        $this->createCountry('GE', 'Georgia', 'e');
        $this->createCountry('GF', 'French Guiana', 's');
        $this->createCountry('GG', 'Channel Islands (Guernsey)', 'e');
        $this->createCountry('GH', 'Ghana', 'a');
        $this->createCountry('GI', 'Gibraltar', 'e');
        $this->createCountry('GL', 'Greenland', 'n');
        $this->createCountry('GM', 'Gambia', 'a');
        $this->createCountry('GN', 'Guinea', 'a');
        $this->createCountry('GP', 'Guadeloupe', 's');
        $this->createCountry('GQ', 'Equatorial Guinea', 'a');
        $this->createCountry('GU', 'Guam', 'o');
        $this->createCountry('GW', 'Guinea-Bissau', 'a');
        $this->createCountry('GY', 'Guyana', 's');
        $this->createCountry('HN', 'Honduras', 'n');
        $this->createCountry('HT', 'Haiti', 's');
        $this->createCountry('IQ', 'Iraq', 'm');
        $this->createCountry('IR', 'Iran (Islamic Republic Of)', 'm');
        $this->createCountry('IS', 'Iceland', 'e');
        $this->createCountry('JE', 'Channel Islands (Jersey)', 'e');
        $this->createCountry('JM', 'Jamaica', 'n');
        $this->createCountry('KE', 'Kenya', 'a');
        $this->createCountry('KG', 'Kyrgyzstan', 'i');
        $this->createCountry('KH', 'Cambodia', 'i');
        $this->createCountry('KI', 'Kiribati', 'o');
        $this->createCountry('KM', 'Comoros', 'a');
        $this->createCountry('KN', 'Nevis (St. Kitts)', 'n');
        $this->createCountry('KY', 'Cayman Islands', 'n');
        $this->createCountry('KZ', 'Kazakhstan', 'i');
        $this->createCountry('LA', 'Laos', 'i');
        $this->createCountry('LB', 'Lebanon', 'm');
        $this->createCountry('LC', 'St. Lucia', 'n');
        $this->createCountry('LI', 'Liechtenstein', 'e');
        $this->createCountry('LR', 'Liberia', 'a');
        $this->createCountry('LS', 'Lesotho', 'a');
        $this->createCountry('LY', 'Libya', 'm');
        $this->createCountry('MC', 'Monaco', 'e');
        $this->createCountry('MD', 'Moldova', 'e');
        $this->createCountry('ME', 'Montenegro', 'e');
        $this->createCountry('MF', 'Saint Martin (French part)', 's');
        $this->createCountry('MG', 'Madagascar', 'a');
        $this->createCountry('MH', 'Marshall Islands', 'o');
        $this->createCountry('MK', 'Macedonia (FYROM)', 'e');
        $this->createCountry('ML', 'Mali', 'a');
        $this->createCountry('MM', 'Myanmar', 'i');
        $this->createCountry('MN', 'Mongolia', 'i');
        $this->createCountry('MP', 'Northern Mariana Islands', 'o');
        $this->createCountry('MQ', 'Martinique', 's');
        $this->createCountry('MR', 'Mauritania', 'a');
        $this->createCountry('MS', 'Montserrat', 'n');
        $this->createCountry('MU', 'Mauritius', 'a');
        $this->createCountry('MV', 'Maldives', 'i');
        $this->createCountry('MW', 'Malawi', 'a');
        $this->createCountry('MZ', 'Mozambique', 'a');
        $this->createCountry('NA', 'Namibia', 'a');
        $this->createCountry('NC', 'New Caledonia', 'o');
        $this->createCountry('NE', 'Niger', 'a');
        $this->createCountry('NI', 'Nicaragua', 's');
        $this->createCountry('NP', 'Nepal', 'i');
        $this->createCountry('NR', 'Nauru', 'o');
        $this->createCountry('NU', 'Niue', 'o');
        $this->createCountry('PF', 'French Polynesia', 'o');
        $this->createCountry('PG', 'Papua New Guinea', 'o');
        $this->createCountry('PR', 'Puerto Rico', 'n');
        $this->createCountry('PS', 'Gaza (West Bank)', 'm');
        $this->createCountry('PW', 'Palau', 'o');
        $this->createCountry('PY', 'Paraguay', 's');
        $this->createCountry('RE', 'Reunion', 'a');
        $this->createCountry('RS', 'Serbia', 'e');
        $this->createCountry('RU', 'Russia', 'e');
        $this->createCountry('RW', 'Rwanda', 'a');
        $this->createCountry('SB', 'Solomon Islands', 'o');
        $this->createCountry('SD', 'Sudan', 'a');
        $this->createCountry('SC', 'Seychelles', 'a');
        $this->createCountry('SL', 'Sierra Leone', 'a');
        $this->createCountry('SM', 'San Marino', 'e');
        $this->createCountry('SN', 'Senegal', 'a');
        $this->createCountry('SO', 'Somalia', 'a');
        $this->createCountry('SR', 'Suriname', 's');
        $this->createCountry('SS', 'South Sudan', 'a');
        $this->createCountry('ST', 'Sao Tome and Principe', 'a');
        $this->createCountry('SV', 'El Salvador', 's');
        $this->createCountry('SY', 'Syria', 'm');
        $this->createCountry('SX', 'Sint Maarten (Dutch Part)', 'n');
        $this->createCountry('SZ', 'Swaziland', 'a');
        $this->createCountry('TC', 'Turks and Caicos Islands', 's');
        $this->createCountry('TD', 'Chad', 'a');
        $this->createCountry('TG', 'Togo', 'a');
        $this->createCountry('TJ', 'Tajikistan', 'i');
        $this->createCountry('TK', 'Tokelau', 'o');
        $this->createCountry('TL', 'East Timor', 'i');
        $this->createCountry('TM', 'Turkmenistan', 'i');
        $this->createCountry('TN', 'Tunisia', 'a');
        $this->createCountry('TO', 'Tonga', 'o');
        $this->createCountry('TT', 'Trinidad and Tobago', 's');
        $this->createCountry('TV', 'Tuvalu', 'o');
        $this->createCountry('TZ', 'Tanzania', 'a');
        $this->createCountry('UA', 'Ukraine', 'e');
        $this->createCountry('UG', 'Uganda', 'a');
        $this->createCountry('UY', 'Uruguay', 's');
        $this->createCountry('UZ', 'Uzbekistan', 'i');
        $this->createCountry('VA', 'Holy See (Vatican City State)', 'e');
        $this->createCountry('VC', 'St. Vincent and the Grenadines', 'n');
        $this->createCountry('VG', 'British Virgin Islands', 'n');
        $this->createCountry('VI', 'Virgin Islands (US)', 'n');
        $this->createCountry('VN', 'Vietnam', 'i');
        $this->createCountry('VU', 'Vanuatu', 'o');
        $this->createCountry('WF', 'Wallis and Futuna Islands', 'n');
        $this->createCountry('WS', 'Samoa', 'o');
        $this->createCountry('YE', 'Yemen Republic of', 'm');
        $this->createCountry('YT', 'Mayotte', 'a');
        $this->createCountry('ZM', 'Zambia', 'a');
        $this->createCountry('ZW', 'Zimbabwe', 'a');

        // Create Spain
        $spainCountryId = $this->createCountry('ES','Spain','e');

        // Create Spain States used for Local and Regional zones
        $this->db->insert('state', ['code' => '14', 'name' => 'Cordoba', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '29', 'name' => 'Malaga', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '11', 'name' => 'Cadiz', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '21', 'name' => 'Huelva', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '41', 'name' => 'Sevilla', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '18', 'name' => 'Granada', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '23', 'name' => 'Jaen', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '04', 'name' => 'Almeria', 'country_id' => $spainCountryId]);

        // Other Spain States used for National zone
        $this->db->insert('state', ['code' => '03', 'name' => 'Alicante', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '01', 'name' => 'Araba', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '33', 'name' => 'Asturias', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '05', 'name' => 'Ávila', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '06', 'name' => 'Badajoz', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '07', 'name' => 'Baleares, islas', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '08', 'name' => 'Barcelona', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '48', 'name' => 'Bizkaia', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '09', 'name' => 'Burgos', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '10', 'name' => 'Cáceres', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '39', 'name' => 'Cantabria', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '12', 'name' => 'Castellón', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '13', 'name' => 'Ciudad Real', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '15', 'name' => 'Coruña', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '16', 'name' => 'Cuenca', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '20', 'name' => 'Gipuzkoa', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '17', 'name' => 'Girona', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '19', 'name' => 'Guadalajara', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '22', 'name' => 'Huesca', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '24', 'name' => 'León', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '25', 'name' => 'Lleida', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '27', 'name' => 'Lugo', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '28', 'name' => 'Madrid', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '30', 'name' => 'Murcia', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '31', 'name' => 'Navarra', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '32', 'name' => 'Ourense', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '34', 'name' => 'Palencia', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '35', 'name' => 'Palmas, Las', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '36', 'name' => 'Pontevedra', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '26', 'name' => 'Rioja, La', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '37', 'name' => 'Salamanca', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '38', 'name' => 'Santa Cruz de Tenerife', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '40', 'name' => 'Segovia', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '42', 'name' => 'Soria', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '43', 'name' => 'Tarragona', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '44', 'name' => 'Teruel', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '45', 'name' => 'Toledo', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '46', 'name' => 'Valencia', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '47', 'name' => 'Valladolid', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '49', 'name' => 'Zamora', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '50', 'name' => 'Zaragoza', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '51', 'name' => 'Ceuta', 'country_id' => $spainCountryId]);
        $this->db->insert('state', ['code' => '52', 'name' => 'Melilla', 'country_id' => $spainCountryId]);

        // Configure denormalized field
        $this->db->query("UPDATE state SET copy_country_name = (SELECT name FROM country WHERE country.id = state.country_id)");
    }

    public function down()
    {
    }

    private function createCountry($code, $name, $continentCode)
    {
        $continentId = $this->db->query("SELECT id FROM continent WHERE code = '" . $continentCode . "'")->row()->id;
        $this->db->insert('country', ['code' => $code, 'name' => $name, 'continent_id' => $continentId]);

        return $this->db->insert_id();
    }

}
