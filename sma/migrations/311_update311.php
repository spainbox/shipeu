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
        $this->dbforge->add_field("cost_margin float NOT NULL");
        $this->dbforge->create_table('shipping_margin');
    }

    public function down()
    {
    }

}
