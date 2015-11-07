<?php defined('BASEPATH') OR exit('No direct script access allowed');

// See https://ellislab.com/codeigniter/user-guide/libraries/migration.html
class Migration_Update309 extends CI_Migration
{

    public function up()
    {
        // ##################################
        //       Add fields to current
        //   Stock Advanced Manager tables
        // ##################################

        // ============
        // products
        // ============

        /**
         * No new fields will be added. The following custom fields will be used:
         * cf1 = weight  (peso)
         * cf2 = width   (ancho)
         * cf3 = height  (alto)
         * cf4 = depth   (profundidad)
         * cf5 = service_id (default service to use when service_selection.criteria_code = 2 (SKU)
         * cf6 = extra handling cost
         */

        // =========
        // sales
        // =========

        $add = array(
            'service_id' => array('type' => 'int', 'constraint' => '11'),  // Indicate courier service to deliver that sale
        );
        $this->dbforge->add_column('sales', $add);


        // #################################################################
        //                     Add new ShipEU tables
        //
        // NOTE: Fields started with "copy_" are denormalized ("copied")
        //       fields used because Grocery CRUD only support show values
        //       from directly related tables. So, since the list of States
        //       should by shown on the Cities page, we add a new field
        //       named "copy_country_name" on the "state" table.
        // #################################################################

        // =============
        // continent
        // =============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->create_table('continent');

        // ===========
        // country
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("continent_id int NOT NULL");
        $this->dbforge->create_table('country');

        // =========
        // state
        // =========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("country_id int NOT NULL");
        $this->dbforge->add_field("copy_country_name varchar(100) NOT NULL");
        $this->dbforge->create_table('state');

        // ========
        // city
        // ========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("state_id int not NULL");  // We should define a "Unknown" state on every country, sometimes we don't know the state
        $this->dbforge->create_table('city');

        // ===========
        // courier
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("website varchar(100) NULL");
        $this->dbforge->create_table('courier');

        // ===========
        // service
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(255) NULL");
        $this->dbforge->add_field("courier_id int NOT NULL");
        $this->dbforge->add_field("delivery_days_min int NOT NULL");  // Example: If delivery time is 1 to 3 days, 1 will be added here
        $this->dbforge->add_field("delivery_days_max int NOT NULL");  // Example: If delivery time is 1 to 3 days, 3 will be added here
        // NOTE: On version1, service spreadsheet fees prices are "total price", later we should indicate the meaning of the price (total, per-unit or chunk)
        $this->dbforge->create_table('service');

        // ======
        // seller
        // ======

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("contact_name varchar(250) NOT NULL");
        $this->dbforge->add_field("address varchar(250) NOT NULL");
        $this->dbforge->add_field("phone varchar(250) NOT NULL");
        $this->dbforge->add_field("country_id int NOT NULL");
        $this->dbforge->add_field("website varchar(100) NULL");
        $this->dbforge->add_field("notes text NULL");
        $this->dbforge->create_table('seller');

        // ========================
        // service_selection_method
        // ========================

        // 1-urgent, 2-product, 3-price, 4-post code, 5-weight

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("sequence int NOT NULL");    // Order options from most used to less used
        $this->dbforge->create_table('service_selection_method');

        // ================
        // spreadsheet_type
        // ================

        // 1-Fees, 2-Zones, 3-TransitTimes etc

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("sequence int NOT NULL");    // Order options from most used to less used
        $this->dbforge->create_table('spreadsheet_type');

        // =======================
        // spreadsheet_type_column
        // =======================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("spreadsheet_type_id int NOT NULL");
        $this->dbforge->add_field("is_country bit NOT NULL DEFAULT 0");
        $this->dbforge->add_field("is_weight bit NOT NULL DEFAULT 0");
        $this->dbforge->add_field("per_service bit NOT NULL DEFAULT 0");
        $this->dbforge->add_field("per_zone bit NOT NULL DEFAULT 0");
        $this->dbforge->create_table('spreadsheet_type_column');

        // ==================
        // spreadsheet_status
        // ==================

        // 1 = "Created" (record created in spreadsheet table)
        // 2 = "Loaded" (records loaded as-is in spreadsheet_row)
        // 3 = "Configured" (records created in spreadsheet_column)
        // 4 = "Imported" (records created in related tables like fee_range, zone_item, etc)

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->create_table('spreadsheet_status');

        // ===============
        //   spreadsheet
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("path varchar(250) NOT NULL");
        $this->dbforge->add_field("spreadsheet_type_id int NOT NULL");
        $this->dbforge->add_field("spreadsheet_status_id int NOT NULL");
        $this->dbforge->add_field("courier_id int NULL");
        $this->dbforge->add_field("service_id int NULL");
        $this->dbforge->add_field("year int NOT NULL");
        $this->dbforge->add_field("ignore_first_row bit NOT NULL DEFAULT 0");
        $this->dbforge->add_field("fields_delimiter varchar(20) NOT NULL DEFAULT 'semicolon'");
        $this->dbforge->add_field("decimals_delimiter varchar(20) NOT NULL DEFAULT 'comma'");
        $this->dbforge->add_field("last_column char(1) NULL");
        $this->dbforge->add_field("updated_date timestamp NOT NULL DEFAULT 0");
        $this->dbforge->create_table('spreadsheet');

        // ===================
        //  spreadsheet_row
        // ===================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("spreadsheet_id int NOT NULL");
        $this->dbforge->add_field("row_number int NOT NULL");
        $this->dbforge->add_field("column_a VARCHAR(100) NULL");
        $this->dbforge->add_field("column_b VARCHAR(100) NULL");
        $this->dbforge->add_field("column_c VARCHAR(100) NULL");
        $this->dbforge->add_field("column_d VARCHAR(100) NULL");
        $this->dbforge->add_field("column_e VARCHAR(100) NULL");
        $this->dbforge->add_field("column_f VARCHAR(100) NULL");
        $this->dbforge->add_field("column_g VARCHAR(100) NULL");
        $this->dbforge->add_field("column_h VARCHAR(100) NULL");
        $this->dbforge->add_field("column_i VARCHAR(100) NULL");
        $this->dbforge->add_field("column_j VARCHAR(100) NULL");
        $this->dbforge->add_field("column_k VARCHAR(100) NULL");
        $this->dbforge->add_field("column_l VARCHAR(100) NULL");
        $this->dbforge->add_field("column_m VARCHAR(100) NULL");
        $this->dbforge->add_field("column_n VARCHAR(100) NULL");
        $this->dbforge->add_field("column_o VARCHAR(100) NULL");
        $this->dbforge->add_field("column_p VARCHAR(100) NULL");
        $this->dbforge->add_field("column_q VARCHAR(100) NULL");
        $this->dbforge->add_field("column_r VARCHAR(100) NULL");
        $this->dbforge->add_field("column_s VARCHAR(100) NULL");
        $this->dbforge->add_field("column_t VARCHAR(100) NULL");
        $this->dbforge->add_field("column_u VARCHAR(100) NULL");
        $this->dbforge->add_field("column_v VARCHAR(100) NULL");
        $this->dbforge->add_field("column_w VARCHAR(100) NULL");
        $this->dbforge->add_field("column_x VARCHAR(100) NULL");
        $this->dbforge->add_field("column_y VARCHAR(100) NULL");
        $this->dbforge->add_field("column_z VARCHAR(100) NULL");
        $this->dbforge->create_table('spreadsheet_row');

        // ==================
        // spreadsheet_column
        // ==================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("spreadsheet_id int NOT NULL");
        $this->dbforge->add_field("spreadsheet_type_column_id int NOT NULL");
        $this->dbforge->add_field("column_name char(1) NOT NULL");
        $this->dbforge->add_field("service_id int NULL");
        $this->dbforge->add_field("zone_id int NULL");
        $this->dbforge->create_table('spreadsheet_column');

        // =====================
        // service_selection
        // =====================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("seller_id int NOT NULL");
        $this->dbforge->add_field("service_selection_method_id int NOT NULL");
        $this->dbforge->add_field("priority int NOT NULL");
        $this->dbforge->add_field("country_id int NULL");  // Only used on type 5 - Postal Code
        $this->dbforge->add_field("range_start VARCHAR(50) NULL");  // For Weight, Price and Postal Code
        $this->dbforge->add_field("range_end VARCHAR(50) NULL"); // For Weight, Price and Postal Code
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->create_table('service_selection');

        // =====
        // zone
        // =====

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->create_table('zone');

        // =============
        // zone_item
        // =============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("zone_id int NOT NULL");
        $this->dbforge->add_field("state_id int NULL");   // Any state of any country can be added to a zone
        $this->dbforge->add_field("country_id int NULL"); // Any country can be added to a zone
        $this->dbforge->create_table('zone_item');

        // ==========
        // fee_factor
        // ==========

        // 1-Shipment
        // 2-Product (per unit)
        // 3-Weight (per kg)
        // 4-Price (percentage over total)
        // 5-Volume (per m3)
        // 6-Storage (per kg per day fee)
        // 7-Formula (mixed/combined)

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(50) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("sequence int NOT NULL");    // Order criteria from most used to less used
        $this->dbforge->create_table('fee_factor');

        // ===============
        // fee_granularity
        // ===============

        // 1-General
        // 2-Seller (fee by seller, same fee for all couriers)
        // 3-Courier (fee by courier, same fee for all sellers)
        // 4-Seller+Courier (fee by seller and courier)
        // 5-Seller+Service (fee by seller and service)
        // 6-Seller+Zone (fee by seller and zone, used for delivery fees)
        // 7-Seller+Country (fee by seller and zone, used for delivery fees)

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(50) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("sequence int NOT NULL");    // 1=More general ... X=More specific
        $this->dbforge->create_table('fee_granularity');

        // ==============
        // fee_price_type
        // ==============

        // 1- Final price
        // 2- Per unit price
        // 3- Additional percentage of total cost

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(50) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("sequence int NOT NULL");    // Order criteria from most used to less used
        $this->dbforge->create_table('fee_price_type');

        // ========
        // fee_type
        // ========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->add_field("fee_factor_id int NOT NULL");
        $this->dbforge->add_field("fee_price_type_id int NOT NULL");
        $this->dbforge->add_field("fee_granularity_id int NOT NULL");
        $this->dbforge->add_field("fee_ranges int NOT NULL DEFAULT 0");  // 1=Unique price 2=Ranges
        $this->dbforge->add_field("custom_field1_label varchar(100) NULL"); // Etiqueta de campo extra informativo, por ejemplo "Limite de dinero cubierto por este seguro parcial"
        $this->dbforge->add_field("custom_field2_label varchar(100) NULL"); // Etiqueta de campo extra informativo, por ejemplo "Limite de dinero cubierto por este seguro parcial"
        $this->dbforge->create_table('fee_type');

        // ===
        // fee
        // ===

        $this->dbforge->add_field('id');
        $this->dbforge->add_field('fee_type_id int NOT NULL');
        $this->dbforge->add_field('courier_cost int NOT NULL');  // 1=Our Fee, 2=Courier Fee
        $this->dbforge->add_field('seller_id int NULL');
        $this->dbforge->add_field('courier_id int NULL');
        $this->dbforge->add_field('service_id int NULL');
        $this->dbforge->add_field('zone_id int NULL');
        $this->dbforge->add_field('country_id int NULL');
        $this->dbforge->add_field('minimal_fee decimal(10,2) NULL');
        $this->dbforge->add_field('fee decimal(10,2) NULL');  // Can be null if fee is per range (see fee_range)
        $this->dbforge->add_field('apply int NOT NULL');  // 1=automatic, 2=optional-enabled, 3=optional-disabled, 4=disabled
        $this->dbforge->add_field("custom_field1_value varchar(100) NULL"); // Valor para campo custom_field1_label
        $this->dbforge->add_field("custom_field2_value varchar(100) NULL"); // Valor para campo custom_field2_label
        $this->dbforge->create_table('fee');

        // =========
        // fee_range
        // =========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field('fee_id int NOT NULL');
        $this->dbforge->add_field('units_from int NULL');
        $this->dbforge->add_field('units_to int NULL');
        $this->dbforge->add_field('fee decimal(10,2) NOT NULL');
        $this->dbforge->add_field("spreadsheet_id int NULL"); // Si el dato fue importado por una planilla
        $this->dbforge->create_table('fee_range');

        // ============
        // package_type
        // ============

        // 1=Package, 2=Envelope

        $this->dbforge->add_field('id');
        $this->dbforge->add_field('code varchar(100) NOT NULL');
        $this->dbforge->add_field('name varchar(100) NOT NULL');
        $this->dbforge->create_table('package_type');

        // ========
        // package
        // ========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field('package_type_id int NOT NULL');
        $this->dbforge->add_field('code_1 varchar(100) NOT NULL');
        $this->dbforge->add_field('code_2 varchar(100) NOT NULL');
        $this->dbforge->add_field('cost_price decimal(10,2) NULL');
        $this->dbforge->add_field('sell_price decimal(10,2) NULL');
        $this->dbforge->add_field('inner_width_cm int NULL');
        $this->dbforge->add_field('inner_height_cm int NULL');
        $this->dbforge->add_field('inner_large_cm int NULL');
        $this->dbforge->add_field('outer_width_cm int NULL');
        $this->dbforge->add_field('outer_height_cm int NULL');
        $this->dbforge->add_field('outer_large_cm int NULL');
        $this->dbforge->create_table('package');

        // ===============
        // vwDeliveryCosts
        // ===============

        // This view is used on the Delivery Costs page to show all the imported
        // fees of couriers via the different imported spreadsheets (by zone)
        $this->db->query('
            CREATE VIEW vwDeliveryCosts AS
            SELECT courier.name as courier,
                service.name as service,
                zone.name as zone,
                units_from as weight_from,
                units_to as weight_to,
                fee.fee as price
            FROM fee_range
            INNER JOIN fee ON fee_range.fee_id = fee.id
            INNER JOIN zone ON fee.zone_id = zone.id
            INNER JOIN service ON zone.service_id = service.id
            INNER JOIN courier ON service.courier_id = courier.id
            WHERE spreadsheet_id IS NOT NULL
        ');
    }

    public function down()
    {
    }

}
