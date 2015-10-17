<?php defined('BASEPATH') OR exit('No direct script access allowed');

// See https://ellislab.com/codeigniter/user-guide/libraries/migration.html
class Migration_Update311 extends CI_Migration
{
    public function up()
    {
        // ##################################
        // Add new table to indicate margins
        // for each biller on each service
        // ##################################

        $this->dbforge->add_field('id');
        $this->dbforge->add_field("company_id int NOT NULL");
        $this->dbforge->add_field("service_id int NOT NULL");
        $this->dbforge->add_field("cost_margin decimal(10,2) NOT NULL");
        $this->dbforge->create_table('shipping_margin');

        // Alter some fields
        $fields = array(
            'price' => array(
                'type' => 'decimal(10,2)',
            ),
        );
        $this->dbforge->modify_column('zone_fee', $fields);

        $fields = array(
            'fee' => array(
                'type' => 'decimal(10,2)',
            ),
        );
        $this->dbforge->modify_column('picking_fee', $fields);
    }

    public function down()
    {
    }

}
