<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update311 extends CI_Migration
{
    public function up()
    {
        // https://ellislab.com/codeigniter/user-guide/database/helpers.html

        $this->db->query('UPDATE fee_factor SET sequence=sequence+1 WHERE sequence>=6');

        $this->db->insert('fee_factor', [
            'code' => 'packing-price',
            'name' => 'By Packing Price',
            'description' => 'Fee by % of Packing Price',
            'sequence' => 6,
        ]);

        // Our table seller should have relations with other SMA tables
        $this->dbforge->add_column('seller', ["email varchar(100) NULL AFTER country_id", "biller_company_id int NULL", "supplier_company_id int NULL"]);

        // We indicate from which spreadsheet a sale was loaded and the seller
        $this->dbforge->add_column('sales', ["spreadsheet_id int NULL", "seller_id int NULL"]);

        // Companies table is used by SMA to store the customers, we segment customers per seller
        $this->dbforge->add_column('companies', ["seller_id int NULL"]);

        // Products table also needs a seller_id to segment products per seller
        $this->dbforge->add_column('products', ["seller_id int NULL"]);

        $this->dbforge->drop_column('package', "sell_price");

        // Move apply field from "fee" to "fee_type"
        $this->dbforge->drop_column('fee', 'apply');
        $this->dbforge->add_column('fee_type', ['apply int null AFTER fee_ranges']);

        // ===============
        //   shipment_fee
        // ===============

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("purchase_id int NOT NULL");
        $this->dbforge->add_field("fee_type_id int NOT NULL");
        $this->dbforge->add_field("apply int NOT NULL");
        $this->dbforge->add_field("fee int NULL");
        $this->dbforge->create_table('shipment_fee');

        // ================
        // shipment_package
        // ================

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("purchase_id int NOT NULL");
        $this->dbforge->add_field("package_id int NOT NULL");
        $this->dbforge->add_field("unit_cost decimal(10,2) NULL");
        $this->dbforge->add_field("quantity int NULL");
        $this->dbforge->add_field("total_cost decimal(10,2) NULL");
        $this->dbforge->create_table('shipment_package');
    }

    public function down()
    {
    }
}
