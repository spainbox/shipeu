<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update312 extends CI_Migration
{
    public function up()
    {
        // Courier Zones spreadsheet type

        $this->db->insert('spreadsheet_type', [
            'code' => 'zone',
            'name' => 'Courier Zones',
            'description' => 'Spreadsheet containing zones definition',
            'sequence' => 1,
        ]);
        $zonesSpreadsheetTypeId = $this->db->insert_id();

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'zone',
            'name' => 'Zone Name',
            'description' => 'Column indicating the Zone name',
            'spreadsheet_type_id' => $zonesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'country',
            'name' => 'Country',
            'description' => 'Column indicating country code',
            'spreadsheet_type_id' => $zonesSpreadsheetTypeId,
            'is_country' => 1,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'postcodes',
            'name' => 'Postal Codes',
            'description' => 'Column indicating range of postal codes',
            'spreadsheet_type_id' => $zonesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'state',
            'name' => 'State',
            'description' => 'Column indicating State names',
            'spreadsheet_type_id' => $zonesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'city',
            'name' => 'City',
            'description' => 'Column indicating city names',
            'spreadsheet_type_id' => $zonesSpreadsheetTypeId,
            'is_country' => 0,
            'is_weight' => 0,
            'per_service' => 0,
            'per_zone' => 0,
        ]);

        // Amazon sells spreadsheet type

        $this->db->insert('spreadsheet_type', [
            'code' => 'amazon-sells',
            'name' => 'Amazon Sells',
            'description' => 'Spreadsheet containing sells made in Amazon',
            'sequence' => 1,
        ]);
        $amazonSpreadsheetTypeId = $this->db->insert_id();

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'order-id',
            'name' => 'Order',
            'description' => 'Column indicating the Order id',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'order-item-id',
            'name' => 'Order Item',
            'description' => 'Column indicating Order Item id',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'purchase-date',
            'name' => 'Purchase Date',
            'description' => 'Column indicating purchase date',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'payments-date',
            'name' => 'Payments Date',
            'description' => 'Column indicating Payments Date',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'buyer-email',
            'name' => 'Buyer Email',
            'description' => 'Column indicating Buyer Email',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'buyer-name',
            'name' => 'Buyer Name',
            'description' => 'Column indicating Buyer Name',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'buyer-phone-number',
            'name' => 'Buyer Phone Number',
            'description' => 'Column indicating Buyer Phone Number',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'sku',
            'name' => 'SKU',
            'description' => 'Column indicating Product Code',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'product-name',
            'name' => 'Product Name',
            'description' => 'Column indicating Product Name',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'quantity-purchased',
            'name' => 'Quantity Purchased',
            'description' => 'Column indicating Quantity Purchased',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'quantity-shipped',
            'name' => 'Quantity Shipped',
            'description' => 'Column indicating Quantity Shipped',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-service-level',
            'name' => 'Ship Service Level',
            'description' => 'Column indicating Ship Service Level',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'recipient-name',
            'name' => 'Recipient Name',
            'description' => 'Column indicating Recipient Name',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-address-1',
            'name' => 'Ship Address 1',
            'description' => 'Column indicating Ship Address 1',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-address-2',
            'name' => 'Ship Address 2',
            'description' => 'Column indicating Ship Address 2',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-address-3',
            'name' => 'Ship Address 3',
            'description' => 'Column indicating Ship Address 3',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-city',
            'name' => 'Ship City',
            'description' => 'Column indicating Ship City',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-state',
            'name' => 'Ship State',
            'description' => 'Column indicating Ship State',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-postal-code',
            'name' => 'Ship Postal Code',
            'description' => 'Column indicating Ship Postal Code',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'ship-country',
            'name' => 'Ship Country',
            'description' => 'Column indicating Ship Country',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'gift-wrap-type',
            'name' => 'Gift Wrap Type',
            'description' => 'Column indicating Gift Wrap Type',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'gift-message-text',
            'name' => 'Gift Message Text',
            'description' => 'Column indicating Gift Message Text',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->db->insert('spreadsheet_type_column', [
            'code' => 'sales-channel',
            'name' => 'Sales ',
            'description' => 'Column indicating Payments Date',
            'spreadsheet_type_id' => $amazonSpreadsheetTypeId,
        ]);

        $this->dbforge->add_column('spreadsheet_row', ["column_aa varchar(100) NULL", "column_ab varchar(100) NULL", "column_ac varchar(100) NULL", "column_ad varchar(100) NULL", "column_ae varchar(100) NULL"]);

        //  ALTER TABLE spreadsheet_column MODIFY COLUMN column_name CHAR(2) NULL;
    }

    public function down()
    {
    }
}
