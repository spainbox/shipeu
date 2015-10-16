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

        // =============
        // companies
        // =============

        /**
         * No new fields will be added. The following custom fields will be used:
         * cf1 - cash_on_delivery_fee	(COD=Pago por contrareembolso)
         * cf2 - storage_per_kg_day_fee
         * cf3 - multiple_shipment_per_sku_fee
         * cf4 - shipping_margin
         */

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
         */

        // =========
        // sales
        // =========

        $add = array(
            'service_id' => array('type' => 'int', 'constraint' => '11'),  // Indicate courier service to deliver that sale
        );
        $this->dbforge->add_column('sales', $add);


        // ##################################
        //       Add new ShipEU tables
        // ##################################

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
        $this->dbforge->add_field("delivery_days_min int NOT NULL");  // Example: If delivery time is 1 to 3 days, 1 will be added here
        $this->dbforge->add_field("delivery_days_max int NOT NULL");  // Example: If delivery time is 1 to 3 days, 3 will be added here
        $this->dbforge->add_field("fee_method_id int NOT NULL");  // indicates the meaning of the data entered to the zone_fee table
        $this->dbforge->add_field("courier_id int NOT NULL");
        $this->dbforge->create_table('service');

        // ==========
        // fee_method
        // ==========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->create_table('fee_method');

        // ================
        // selection_method
        // ================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(250) NOT NULL");
        $this->dbforge->create_table('selection_method');

        // ===============
        // spreadsheet
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("type int NOT NULL");  // 1=Fees, 2=Zones, 3=Transit Times
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->add_field("year int NOT NULL");
        $this->dbforge->add_field("import_date timestamp NOT NULL DEFAULT 0");
        $this->dbforge->create_table('spreadsheet');

        // ===================
        // spreadsheet_row
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

        // ===============
        // picking_fee
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("weight_from int NOT NULL");
        $this->dbforge->add_field("weight_to int NOT NULL");
        $this->dbforge->add_field("fee decimal NOT NULL");
        $this->dbforge->create_table('picking_fee');

        // =====================
        // service_selection
        // =====================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("company_id int NOT NULL");
        $this->dbforge->add_field("selection_method_id int NOT NULL");
        $this->dbforge->add_field("priority int NOT NULL");
        $this->dbforge->add_field("country_id int NULL");  // Only used on type 5 - Postal Code
        $this->dbforge->add_field("range_start VARCHAR(50) NULL");  // For Weight, Price and Postal Code
        $this->dbforge->add_field("range_end VARCHAR(50) NULL"); // For Weight, Price and Postal Code
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->create_table('service_selection');

        // ========
        // zone
        // ========

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

        // ============
        // zone_fee
        // ============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("zone_id int NOT NULL");
        $this->dbforge->add_field("weight int NULL"); // See notes for details
        $this->dbforge->add_field("price int NULL");  // See notes for details
        $this->dbforge->create_table('zone_fee');

        // NOTE: The meaning of "weight" and "price" depends on the "service.fee_method_id" selected (see fee_method table for details)
    }

    public function down()
    {
    }

}
