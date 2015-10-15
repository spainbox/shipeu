<?php defined('BASEPATH') OR exit('No direct script access allowed');

// See https://ellislab.com/codeigniter/user-guide/libraries/migration.html
class Migration_Update309 extends CI_Migration
{

    public function up()
    {
        // ##################################
        // Add fields to current sma tables
        // ##################################

        // =============
        // sma_companies
        // =============

        /**
         * No new fields will be added. The following custom fields will be used:
         * cf1 - cash_on_delivery_fee	(COD=Pago por contrareembolso)
         * cf2 - storage_per_kg_day_fee
         * cf3 - multiple_shipment_per_sku_fee
         * cf4 - shipping_margin
         */

        // ============
        // sma_products
        // ============

        /**
         * No new fields will be added. The following custom fields will be used:
         * cf1 = weight  (peso)
         * cf2 = width   (ancho)
         * cf3 = height  (alto)
         * cf4 = depth   (profundidad)
         * cf5 = service_id (default service to use when sma_service_selection.criteria_code = 2 (SKU)
         */

        // =========
        // sma_sales
        // =========

        $add = array(
            'service_id' => array('type' => 'int', 'constraint' => '11'),  // Indicate courier service to deliver that sale
        );
        $this->dbforge->add_column('sales', $add);


        // ##################################
        //       Add new ShipEU tables
        // ##################################

        // =============
        // sma_continent
        // =============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->create_table('continent');

        // ===========
        // sma_country
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("continent_id int NOT NULL");
        $this->dbforge->create_table('country');

        // =========
        // sma_state
        // =========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("country_id int NOT NULL");
        $this->dbforge->create_table('state');

        // ========
        // sma_city
        // ========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("state_id int not NULL");  // We should define a "Unknown" state on every country, sometimes we don't know the state
        $this->dbforge->create_table('city');

        // ===========
        // sma_courier
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("website varchar(100) NULL");
        $this->dbforge->create_table('courier');

        // ===========
        // sma_service
        // ===========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("description varchar(255) NULL");
        $this->dbforge->add_field("delivery_days_min int NOT NULL");  // Example: If delivery time is 1 to 3 days, 1 will be added here
        $this->dbforge->add_field("delivery_days_max int NOT NULL");  // Example: If delivery time is 1 to 3 days, 3 will be added here
        $this->dbforge->add_field("fee_method int NOT NULL");  // indicates the meaning of the data entered to the zone_fee table
        $this->dbforge->add_field("courier_id int NOT NULL");
        $this->dbforge->create_table('service');

        // ===============
        // sma_spreadsheet
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("type int NOT NULL");  // 1=Fees, 2=Zones, 3=Transit Times
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->add_field("year int NOT NULL");
        $this->dbforge->add_field("import_date timestamp NOT NULL DEFAULT 0");
        $this->dbforge->create_table('spreadsheet');

        // ===================
        // sma_spreadsheet_row
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
        // sma_picking_fee
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("weight_from int NOT NULL");
        $this->dbforge->add_field("weight_to int NOT NULL");
        $this->dbforge->add_field("fee decimal NOT NULL");
        $this->dbforge->create_table('picking_fee');

        // =====================
        // sma_service_selection
        // =====================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("company_id int NOT NULL");
        $this->dbforge->add_field("criteria_type int NOT NULL"); // 1=Urgent 2= SKU 3=Weight 4=Price 5=Postal Code
        $this->dbforge->add_field("priority int NOT NULL");
        $this->dbforge->add_field("country_id int NULL");  // Only used on type 5 - Postal Code
        $this->dbforge->add_field("range_start VARCHAR(50) NULL");  // For Weight, Price and Postal Code
        $this->dbforge->add_field("range_end VARCHAR(50) NULL"); // For Weight, Price and Postal Code
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->create_table('service_selection');

        // ========
        // sma_zone
        // ========

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("code varchar(100) NOT NULL");
        $this->dbforge->add_field("name varchar(100) NOT NULL");
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->create_table('zone');

        // =============
        // sma_zone_item
        // =============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("zone_id int NOT NULL");
        $this->dbforge->add_field("state_id int NULL");   // Any state of any country can be added to a zone
        $this->dbforge->add_field("country_id int NULL"); // Any country can be added to a zone
        $this->dbforge->create_table('zone_item');

        // ============
        // sma_zone_fee
        // ============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("zone_id int NOT NULL");
        $this->dbforge->add_field("weight int NULL"); // See notes for details
        $this->dbforge->add_field("price int NULL");  // See notes for details
        $this->dbforge->create_table('zone_fee');

        // NOTE: The meaning of "weight" and "price" depends on the "fee_method" configured on sma_service table.
        // Supported methods are:
        //     "1-FinalPrice" - zone_fee.weight is the maximum weight allowed to apply the whole zone_fee.price value
        //     "2-PerKgPrice" - zone_fee.weight is the maximum weight allowed to apply the zone_fee.price value *per each kg*
        //     "3-ChunkWeight" - zone_fee.weight is the "chunk" weight ("to each 100 kg") to sum the zone_fee.price value.
        // In any case, the special value 99999 is used on weight for "unlimited"
    }

    public function down()
    {
    }

}
