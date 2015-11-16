<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shipeu extends MY_Controller
{
    function __construct()
    {
        // Stock Manager Advance initialization
        parent::__construct();
        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            redirect('login');
        }
        $this->bc = array(); // Breadcrumbs;
        $this->lang->load('products', $this->Settings->language);
        $this->load->library('form_validation');
        $this->load->model('products_model');
        $this->digital_upload_path = 'files/';
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
        $this->popup_attributes = array('width' => '900', 'height' => '600', 'window_name' => 'sma_popup', 'menubar' => 'yes', 'scrollbars' => 'yes', 'status' => 'no', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0');

        // Grocery Crud initialization
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }

    public function continents()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Continents';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('continent');
            $crud->set_subject($pageTitle);
            $crud->columns('code', 'name');
            $crud->required_fields('code', 'name');
            $crud->unique_fields('code','name');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function countries()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Countries';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('country');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code', 'name', 'continent_id');
            $crud->columns('code', 'name', 'continent_id');
            $crud->unique_fields('code','name');

            $crud->set_relation('continent_id','continent','{name}', null, 'name ASC');
            $crud->display_as('continent_id','Continent');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function states()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'States';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('state');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code', 'name', 'country_id');
            $crud->columns('code', 'name', 'country_id');
            $crud->unique_fields('code','name');

            $crud->set_relation('country_id','country','{code} - {name}', null, 'code ASC');
            $crud->display_as('country_id','Country');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function cities()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Cities';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('city');
            $crud->set_subject($pageTitle);
            $crud->required_fields('name', 'state_id');
            $crud->columns('name', 'state_id');

            $crud->set_relation('state_id','vw_state', '{countryName} - {name}', null, 'countryName, name ASC');
            $crud->display_as('state_id', 'State');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function couriers()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Couriers';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('courier');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code', 'name');
            $crud->columns('code', 'name', 'website');
            $crud->unique_fields('code','name');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function services()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Services';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('service');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code', 'name', 'courier_id');
            $crud->columns('courier_id', 'code', 'name', 'delivery_days_min', 'delivery_days_max', 'description');
            $crud->unique_fields('code','name');

            $crud->set_rules('delivery_days_min','Delivery Days Min',['integer', 'required']);
            $crud->set_rules('delivery_days_max','Delivery Days Max',['integer', 'required']);

            // On version 1, fee_method is not used, all spreadsheets use total-price method (not listed here)
            $crud->fields('code', 'name', 'courier_id', 'delivery_days_min', 'delivery_days_max', 'description');

            $crud->set_relation('courier_id','courier','{name}', null, 'name ASC');
            $crud->display_as('courier_id','Courier');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function sellers()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Sellers';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('seller');
            $crud->set_subject($pageTitle);
            $crud->required_fields('name', 'contact_name', 'address', 'phone', 'country_id');
            $crud->columns('name', 'contact_name', 'address', 'phone', 'country_id', 'email', 'website', 'notes');
            $crud->unique_fields('name', 'contact_name', 'email', 'website');

            $crud->field_type('biller_company_id', 'hidden');
            $crud->field_type('supplier_company_id', 'hidden');

            $crud->set_relation('country_id','country','{code} - {name}', null, 'code ASC');
            $crud->display_as('country_id','Country');

            $crud->callback_after_insert(array($this,'seller_after_insert'));

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function seller_after_insert($post_array, $primary_key)
    {
        $country = $this->db->query('SELECT * FROM country WHERE id = ' . $post_array['country_id'])->result();

        // Create company for Biller related to new Seller
        $groupName = 'biller';
        $this->db->insert('companies', [
            'group_name' => $groupName,
            'name' => $post_array['contact_name'],
            'company' => $post_array['name'],
            'address' => $post_array['address'],
            'phone' => $post_array['phone'],
            'email' => $post_array['email'],
            'country' => $country->name,
        ]);
        $billerCompanyId = $this->db->insert_id();
        $this->db->query('UPDATE seller SET biller_company_id = ' . $billerCompanyId . ' WHERE id = ' . $primary_key);

        // Create company for Supplier related to new Seller
        $groupName = 'supplier';
        $this->db->insert('companies', [
            'group_name' => $groupName,
            'name' => $post_array['contact_name'],
            'company' => $post_array['name'],
            'address' => $post_array['address'],
            'phone' => $post_array['phone'],
            'email' => $post_array['email'],
            'country' => $country->name,
        ]);
        $supplierCompanyId = $this->db->insert_id();
        $this->db->query('UPDATE seller SET supplier_company_id = ' . $supplierCompanyId . ' WHERE id = ' . $primary_key);

        return $post_array;
    }

    public function servicesSelections()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Services Selections';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('service_selection');
            $crud->set_subject($pageTitle);
            $crud->required_fields('seller_id', 'service_selection_method_id','service_id');
            $crud->columns('seller_id', 'priority', 'service_selection_method_id', 'country_id', 'range_start', 'range_end', 'service_id');

            $crud->set_rules('priority','Priority Number', ['integer', 'required']);

            $crud->set_relation('seller_id','seller','name', null, 'name ASC');
            $crud->display_as('seller_id','Seller');

            $crud->set_relation('service_selection_method_id','service_selection_method','{sequence} - {name}', null, 'sequence');
            $crud->display_as('service_selection_method_id','Selection Method');

            $crud->set_relation('country_id','country','{code} - {name}', null, 'code ASC');
            $crud->display_as('country_id','Country');

            $crud->set_relation('service_id','service','{name}', null, 'name ASC');
            $crud->display_as('service_id','Service');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function zones()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Zones';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code', 'name', 'service_id');
            $crud->columns('code', 'name', 'service_id');

            $crud->set_relation('service_id','service','{name}', null, 'name ASC');
            $crud->display_as('service_id','Service');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function zoneItems()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Zone Items';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone_item');
            $crud->set_subject($pageTitle);
            $crud->required_fields('zone_id');
            $crud->columns('zone_id', 'country_id', 'state_id', 'postcode_from', 'postcode_to');

            $crud->set_relation('zone_id','vw_zone','{serviceCode} | {name}', null, 'serviceCode ASC, name ASC');
            $crud->display_as('zone_id','Zone');

            $crud->set_relation('country_id','country','{name}', null, 'code ASC');
            $crud->display_as('country_id','Country');

            $crud->set_relation('state_id','state','{code} - {name}', null, 'code ASC');
            $crud->display_as('state_id','State');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function deliveryCosts()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Delivery Costs';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('vwDeliveryCosts');

            $crud->set_subject($pageTitle);
            $crud->columns('courier', 'service', 'zone', 'weight_from', 'weight_to', 'price', 'spreadsheet');

            // Data is read-only (imported/updated via spreadsheets)
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_edit();
            $crud->unset_read();

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function packages()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Packages';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('package');
            $crud->set_subject($pageTitle);
            $crud->columns('package_type_id', 'code_1', 'code_2', 'cost_price', 'inner_width_cm', 'inner_height_cm', 'inner_large_cm', 'outer_width_cm', 'outer_height_cm', 'outer_large_cm');
            $crud->unique_fields('code_1','code_2');

            $crud->set_relation('package_type_id','package_type','{name}');
            $crud->display_as('package_type_id','Type');

            $crud->set_rules('code_1','Code 1',['required']);
            $crud->set_rules('cost_price','Cost Price',['decimal', 'required']);
            $crud->set_rules('inner_width_cm','Inner Width Cm',['integer', 'required']);
            $crud->set_rules('inner_height_cm','Inner Height Cm',['integer', 'required']);
            $crud->set_rules('inner_large_cm','Inner Large Cm',['integer', 'required']);
            $crud->set_rules('outer_width_cm','Inner Width Cm',['integer', 'required']);
            $crud->set_rules('outer_height_cm','Inner Height Cm',['integer', 'required']);
            $crud->set_rules('outer_large_cm','Inner Large Cm',['integer', 'required']);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    public function feeTypes()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Fee Types';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('fee_type');
            $crud->set_subject($pageTitle);
            $crud->required_fields('name', 'description', 'fee_factor_id', 'fee_price_type_id', 'fee_granularity_id', 'fee_ranges', 'apply');
            $crud->columns('name', 'description', 'fee_factor_id', 'fee_price_type_id', 'fee_granularity_id', 'fee_ranges', 'apply', 'custom_field1_label', 'custom_field2_label');
            $crud->unique_fields('name');

            $crud->set_relation('fee_factor_id', 'fee_factor', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_factor_id', 'Fee Factor');

            $crud->set_relation('fee_price_type_id', 'fee_price_type', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_price_type_id', 'Price Type');

            $crud->set_relation('fee_granularity_id', 'fee_granularity', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_granularity_id', 'Fee Granularity');

            $crud->field_type('fee_ranges', 'dropdown', [ '1' => 'No - Unique Price', '2' => 'Yes - Prices by Ranges']);
            $crud->display_as('fee_ranges', 'Use Fee Ranges');

            $crud->field_type('apply', 'dropdown', [ '1' => 'Automatically', '2' => 'Manually - Enabled by default', '3' => 'Manually - Disabled by default', '4' => 'Never (inactive)']);
            $crud->display_as('apply', 'Apply');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function fees()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('fee');
            $crud->set_subject($pageTitle);
            $crud->required_fields('fee_type_id', 'courier_cost', 'minimal_fee');
            $crud->columns('fee_type_id', 'courier_cost', 'seller_id', 'courier_id', 'service_id', 'zone_id', 'country_id', 'minimal_fee', 'custom_field1_value', 'custom_field2_value');
            $crud->add_action('Ranges', '', '','ui-icon-info', array($this,'redirectFeeRanges'));

            $unsetColumns = array();

            // We changed the Grocery_CRUD.php file so every time that the Fee Type dropdown
            // is changed, the form is resubmitted so we can customize which dropdowns should be shown
            $granularitySequence = 0;
            if (isset($_GET)) {
                if (isset($_GET['feeTypeId'])) {
                    $feeTypeId = $_GET['feeTypeId'];
                    $feeType = $this->db->query("SELECT * FROM fee_type WHERE id =" . $feeTypeId)->row();
                    $granularitySequence = $this->db->query("SELECT sequence FROM fee_granularity WHERE id =" . $feeType->fee_granularity_id)->row()->sequence;
                }
            }
            $crud->set_relation('fee_type_id', 'fee_type', '{name} - {description}', null, 'name ASC');
            $crud->display_as('fee_type_id', 'Fee Type');

            $crud->field_type('courier_cost', 'dropdown', [ '1' => 'No (our fee)', '2' => 'Yes (courier fee)']);
            $crud->display_as('courier_cost', 'Is Courier Cost');

            // Granularity Dropdowns (1 is General)
            $crud->display_as('seller_id', 'Seller');
            if ($granularitySequence >= 2) {
                $crud->set_relation('seller_id', 'seller', 'name', null, 'name ASC');
            } else {
                $unsetColumns[] = 'seller_id';
            }

            $crud->display_as('courier_id', 'Courier');
            if ($granularitySequence >= 3) {
                $crud->set_relation('courier_id', 'courier', '{name}', null, 'name ASC');
            } else {
                $unsetColumns[] = 'courier_id';
            }

            // Sequence 4 is not included because is Seller+Courier (and both dropdown were already shown)

            $crud->display_as('service_id', 'Service');
            if ($granularitySequence >= 5) {
                $crud->set_relation('service_id', 'service', '{name}', null, 'name ASC');
            } else {
                $unsetColumns[] = 'service_id';
            }

            $crud->display_as('zone_id', 'Zone');
            if ($granularitySequence >= 6) {
                $crud->set_relation('zone_id', 'zone', '{name}', null, 'name ASC');
            } else {
                $unsetColumns[] = 'zone_id';
            }

            $crud->display_as('country_id', 'Country');
            if ($granularitySequence >= 7) {
                $crud->set_relation('country_id', 'country', '{code} - {name}', null, 'code ASC');

            } else {
                $unsetColumns[] = 'country_id';
            }

            // Fee textbox is shown only if prices are not configured by ranges
            $crud->display_as('fee', 'Fee');
            if (isset($feeType)) {
                if ($feeType->fee_ranges == 1) {
                    $unsetColumns[] = 'fee';
                }
            }

            if (empty($feeType->custom_field1_label)) {
                $unsetColumns[] = 'custom_field1_value';
            } else {
                $crud->display_as('custom_field1_value', $feeType->custom_field1_label);
            }

            if (empty($feeType->custom_field2_label)) {
                $unsetColumns[] = 'custom_field2_value';
            } else {
                $crud->display_as('custom_field2_value', $feeType->custom_field2_label);
            }

            // Set columns to display
            $crud->unset_fields($unsetColumns);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function redirectFeeRanges($primary_key , $row)
    {
        return site_url('shipeu/feeRanges').'?fee_id=' . $primary_key;
    }

    public function feeRanges()
    {
        $this->load->library('session');

        $this->sma->checkPermissions();

        $pageTitle = 'Fee Ranges';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('fee_range');
            $crud->set_subject($pageTitle);
            $crud->columns('units_from', 'units_to', 'fee');
            $crud->unset_fields('spreadsheet_id');

            if (isset($_GET)) {
                if (isset($_GET['fee_id'])) {
                    // Store fee_id (provided via url) in session
                    $feeId = $_GET['fee_id'];
                    $this->session->set_userdata(['fee_id' => $feeId]);
                }
            }

            // Set fee_id as hidden field (from session)
            $userData = $this->session->get_userdata();
            $feeId = $userData['fee_id'];
            $crud->field_type('fee_id', 'hidden', $feeId);

            // Filter by current fee_id
            $crud->where('fee_id', $feeId);

            $crud->set_rules('units_from','Units From',['decimal', 'required']);
            $crud->set_rules('units_to','Units To',['decimal', 'required']);
            $crud->set_rules('fee','Fee',['decimal', 'required']);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    public function spreadsheetProfiles()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Spreadsheet Configurations';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('spreadsheet_profile');
            $crud->set_subject($pageTitle);
            $crud->columns('spreadsheet_type_id', 'courier_id', 'service_id', 'seller_id', 'ignore_first_row', 'fields_delimiter', 'decimals_delimiter');

            // Customize actions
            $crud->add_action('Columns', '', '','ui-icon-info', array($this,'redirectSpreadsheetProfileColumns'));

            $crud->set_relation('spreadsheet_type_id','spreadsheet_type','{name}');
            $crud->display_as('spreadsheet_type_id','Type');

            $crud->set_relation('courier_id','courier','{name}', null, 'name ASC');
            $crud->display_as('courier_id','Courier');

            $crud->set_relation('service_id','service','{name}', null, 'name ASC');
            $crud->display_as('service_id','Service');

            $crud->set_relation('seller_id','seller','{name}', null, 'name ASC');
            $crud->display_as('seller_id','Seller');

            $crud->field_type('ignore_first_row', 'dropdown', [0 => 'No', 1=>'Yes']);
            $crud->display_as('ignore_first_row', 'Ignore First Row');

            $characters = [
                'comma' => ', (Comma)',
                'semicolon' => '; (Semicolon)',
                'dot' => '. (Dot)',
                'whitespace' => '_ (Whitespace)',
                'tab' => '\t (Tabulator)',
            ];

            $crud->field_type('fields_delimiter', 'dropdown', $characters);
            $crud->display_as('fields_delimiter', 'Fields Separator');

            $crud->field_type('decimals_delimiter', 'dropdown', $characters);
            $crud->display_as('decimals_delimiter', 'Decimals Separator');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    public function spreadsheetProfileColumns()
    {
        $this->sma->checkPermissions();

        $this->load->library('session');

        if (isset($_GET)) {
            if (isset($_GET['spreadsheetProfileId'])) {
                // Store fee_id (provided via url) in session
                $spreadsheetProfileId = $_GET['spreadsheetProfileId'];
                $this->session->set_userdata(['spreadsheetProfileId' => $spreadsheetProfileId]);
            }
        }

        // Set spreadsheet_profile_id as hidden field (from session)
        $userData = $this->session->get_userdata();
        $spreadsheetProfileId = $userData['spreadsheetProfileId'];

        // To make the edition/configuration of the columns simpler,
        // we will create a flat, denormalyzed and temporary table
        // named spreadsheet_profile_columns_temp. This is because
        // some columns should be configured "per service" or "per zone",
        // so just 1 column type record on spreadsheet_type_column
        // should be "expanded" to several columns (one per each service
        // or zone). That's why we create this temp table

        // Create temporary table spreadsheet_profile_temp
        $this->db->query("DROP TABLE IF EXISTS spreadsheet_profile_temp");
        $createTable = "CREATE TABLE spreadsheet_profile_temp (id int NOT NULL AUTO_INCREMENT, spreadsheet_profile_id int NOT NULL, ";
        $insertRecord = "INSERT INTO spreadsheet_profile_temp SELECT NULL, " . $spreadsheetProfileId;

        $spreadsheetProfile = $this->db->query("SELECT * FROM spreadsheet_profile WHERE id =" . $spreadsheetProfileId)->row();
        $spreadsheetTypeId = $spreadsheetProfile->spreadsheet_type_id;
        $spreadsheetTypeColumns = $this->db->query("SELECT * FROM spreadsheet_type_column WHERE spreadsheet_type_id =" . $spreadsheetTypeId)->result();

        $fields = array();
        foreach ($spreadsheetTypeColumns as $spreadsheetTypeColumn) {
            if ($spreadsheetTypeColumn->per_service == 0 and $spreadsheetTypeColumn->per_zone == 0) {
                $fieldName = 'column_' . $spreadsheetTypeColumn->id . '_unique';
                $fieldLabel = $spreadsheetTypeColumn->name;
                $fields[$fieldName] = $fieldLabel;

                $fieldValue = '';
                $spreadsheetProfileColumn = $this->db->query("SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfileId . " AND spreadsheet_type_column_id = " . $spreadsheetTypeColumn->id)->row();
                if (!empty($spreadsheetProfileColumn)) {
                    $fieldValue = $spreadsheetProfileColumn->spreadsheet_column_name;
                }

                $createTable .= $fieldName . " char(1) NOT NULL, ";
                $insertRecord .= ", '" . $fieldValue . "'";
            } elseif ($spreadsheetTypeColumn->per_zone == 1) {
                $zones = $this->db->query("SELECT * FROM zone WHERE service_id = " . $spreadsheetProfile->service_id . " ORDER BY name")->result();;
                foreach ($zones as $zone) {
                    $fieldName = 'column_' . $spreadsheetTypeColumn->id . '_zone_' . $zone->id;
                    $fieldLabel = 'Zone ' . $zone->name;
                    $fields[$fieldName] = $fieldLabel;

                    $fieldValue = '';
                    $spreadsheetProfileColumn = $this->db->query("SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfileId . " AND spreadsheet_type_column_id = " . $spreadsheetTypeColumn->id . " AND zone_id = " . $zone->id)->row();
                    if (!empty($spreadsheetProfileColumn)) {
                        $fieldValue = $spreadsheetProfileColumn->spreadsheet_column_name;
                    }

                    $createTable .= $fieldName . " char(1) NOT NULL, ";
                    $insertRecord .= ", '" . $fieldValue . "'";
                }
            } else {
                $services = $this->db->query("SELECT * FROM service WHERE courier_id = " . $spreadsheetProfile->courier_id . " ORDER BY name")->result();
                foreach ($services as $service) {
                    $fieldName = 'column_' . $spreadsheetTypeColumn->id . '_service_' . $service->id;
                    $fieldLabel = 'Service ' . $service->name;
                    $fields[$fieldName] = $fieldLabel;

                    $fieldValue = '';
                    $spreadsheetProfileColumn = $this->db->query("SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfileId . " AND spreadsheet_type_column_id = " . $spreadsheetTypeColumn->id . " AND service_id = " . $service->id)->row();
                    if (!empty($spreadsheetProfileColumn)) {
                        $fieldValue = $spreadsheetProfileColumn->spreadsheet_column_name;
                    }

                    $createTable .= $fieldName . " char(1) NOT NULL, ";
                    $insertRecord .= ", '" . $fieldValue . "'";
                }
            }
        }

        // Close SQL statements and execute
        $createTable .= ' PRIMARY KEY (id));';
        $insertRecord .= ';';
        $this->db->query($createTable);
        $this->db->query($insertRecord);

        $fieldNames = array();
        foreach ($fields as $fieldName => $fieldLabel) {
            if ($fieldName != 'spreadsheet_profile_id') {
                $fieldNames[] = $fieldName;
            }
        }

        // Load GroceryCrud configuration
        $pageTitle = 'Spreadsheet Columns';

        // Prepare breadcrumbs
        $this->bc = array();
        $this->bc[] = [
            'link' => '',
            'page' => 'Home',
        ];
        $this->bc[] = [
            'link' => 'shipeu/spreadsheetProfiles',
            'page' => 'Spreadsheet Configurations',
        ];
        $this->bc[] = [
            'link' => 'shipeu/' . __FUNCTION__,
            'page' => $pageTitle,
        ];

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('spreadsheet_profile_temp');
            $crud->set_subject($pageTitle);
            $crud->columns($fieldNames);

            $crud->unset_add();
            $crud->unset_delete();

            $crud->callback_after_update(array($this,'spreadsheet_profile_column_after_update'));

            $crud->unset_fields('spreadsheet_profile_id');
            $crud->field_type('spreadsheetProfileId', 'hidden', $spreadsheetProfileId);

            // Filter by current spreadsheet_profile_id
            $crud->where('spreadsheet_profile_id', $spreadsheetProfileId);

            $columns = [
                'a' => 'Column A',
                'b' => 'Column B',
                'c' => 'Column C',
                'd' => 'Column D',
                'e' => 'Column E',
                'f' => 'Column F',
                'g' => 'Column G',
                'h' => 'Column H',
                'i' => 'Column I',
                'j' => 'Column J',
                'k' => 'Column K',
                'l' => 'Column L',
                'm' => 'Column M',
                'n' => 'Column N',
                'o' => 'Column O',
                'p' => 'Column P',
                'q' => 'Column Q',
                'r' => 'Column R',
                's' => 'Column S',
                't' => 'Column T',
                'u' => 'Column U',
                'v' => 'Column V',
                'w' => 'Column W',
                'x' => 'Column X',
                'y' => 'Column Y',
                'z' => 'Column Z',
                'aa' => 'Column AA',
                'ab' => 'Column AB',
                'ac' => 'Column AC',
                'ad' => 'Column AD',
                'ae' => 'Column AE',
            ];

            foreach ($fields as $fieldName => $fieldLabel) {
                $crud->field_type($fieldName, 'dropdown', $columns);
                $crud->display_as($fieldName, $fieldLabel);
            }

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    function spreadsheet_profile_column_after_update($post_array, $primary_key)
    {
        $sessionData = $this->session->get_userdata();
        $spreadsheetProfileId = $sessionData['spreadsheetProfileId'];

        foreach ($post_array as $fieldName => $fieldValue) {
            $fieldNameParts = explode('_', $fieldName);
            $spreadsheetTypeColumnId = $fieldNameParts[1];
            $delete = "DELETE FROM spreadsheet_profile_column WHERE spreadsheet_type_column_id = " . $spreadsheetTypeColumnId;
            $insert = "INSERT INTO spreadsheet_profile_column SELECT NULL, " . $spreadsheetProfileId . ", " . $spreadsheetTypeColumnId . ", '" . $fieldValue . "'";

            if ($fieldNameParts[2] == 'unique') {
                $insert .= ", NULL, NULL";
            }

            if ($fieldNameParts[2] == 'service') {
                $serviceId = $fieldNameParts[3];
                $delete .= ' AND service_id = ' . $serviceId;
                $insert .= ", $serviceId, NULL";
            }

            if ($fieldNameParts[2] == 'zone') {
                $zoneId = $fieldNameParts[3];
                $delete .= ' AND zone_id = ' . $zoneId;
                $insert .= ", NULL, $zoneId";
            }

            $this->db->query($delete);
            $this->db->query($insert);
        }

    }

    // Redirect to see spreadsheet profile columns
    function redirectSpreadsheetProfileColumns($primary_key , $row)
    {
        return site_url('shipeu/spreadsheetProfileColumns?spreadsheetProfileId='.$primary_key);
    }

    public function spreadsheets()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Spreadsheet';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('spreadsheet');
            $crud->set_subject($pageTitle);
            $crud->columns('spreadsheet_type_id', 'name', 'courier_id', 'service_id', 'seller_id', 'year', 'imported');

            // Customize actions
            $crud->unset_edit();
            $crud->add_action('Rows', '', '','ui-icon-info', array($this,'redirectSpreadsheetRows'));
            $crud->add_action('Import', '', '','ui-icon-info', array($this,'redirectSpreadsheetImport'));

            $crud->change_field_type('name','invisible');
            $crud->change_field_type('updated_date','invisible');

            $crud->callback_before_insert(array($this,'spreadsheet_before_insert'));
            $crud->callback_after_insert(array($this,'spreadsheet_after_insert'));

            $crud->set_relation('spreadsheet_type_id','spreadsheet_type','{name}');
            $crud->display_as('spreadsheet_type_id','Type');

            $crud->unset_fields('name', 'imported', 'last_column', 'updated_date');

            /// Upload field
            $crud->set_field_upload('path','assets/uploads/csv', 'csv');
            $crud->display_as('path','Upload csv');
            $crud->set_rules('path','Upload csv',['required']);
            $crud->callback_after_upload(array($this,'spreadsheet_after_upload'));

            $crud->field_type('imported', 'dropdown', [0 => 'No', 1=>'Yes']);
            $crud->display_as('imported', 'Imported');

            $crud->set_relation('courier_id','courier','{name}', null, 'name ASC');
            $crud->display_as('courier_id','Courier');

            $crud->set_relation('service_id','service','{name}', null, 'name ASC');
            $crud->display_as('service_id','Service');

            $crud->set_relation('seller_id','seller','{name}', null, 'name ASC');
            $crud->display_as('seller_id','Seller');

            $crud->set_rules('spreadsheet_type_id','Spreadsheet Type',['integer', 'required']);
            $crud->set_rules('year','Spreadsheet Year',['integer', 'required']);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    // Redirect to see spreadsheet rows
    function redirectSpreadsheetRows($primary_key , $row)
    {
        return site_url('shipeu/spreadsheetRows?spreadsheetId='.$primary_key);
    }

    // Redirect to import rows
    function redirectSpreadsheetImport($primary_key , $row)
    {
        return site_url('shipeu/spreadsheetImport?spreadsheetId='.$primary_key);
    }

    function spreadsheet_after_upload($uploader_response, $field_info, $files_to_upload)
    {
        $fileName = $uploader_response[0]->name;
        $filePath = $field_info->upload_path.'/'. $fileName;

        $this->session->set_userdata('uploaded_file_name', $fileName);
        $this->session->set_userdata('uploaded_file_path', $filePath);

        return true;
    }

    function spreadsheet_before_insert($post_array)
    {
        $sessionData = $this->session->get_userdata();

        // Validate if there are a profile defined for this spreadsheet (with this configuration)
        $spreadsheetProfile = $this->getSpreadsheetProfile($post_array);
        if (empty($spreadsheetProfile)) {
            return false;
        }

        $post_array['imported'] = 0;
        $post_array['name'] = $sessionData['uploaded_file_name'];
        $post_array['path'] = $sessionData['uploaded_file_path'];
        $post_array['updated_date'] = date('Y-d-m');

        return $post_array;
    }

    function spreadsheet_after_insert($post_array, $primary_key)
    {
        $sessionData = $this->session->get_userdata();
        $filePath = $sessionData['uploaded_file_path'];
        $fileName = $post_array['name'];
        $fileName = strtoupper(substr($fileName, strpos($fileName, "-") + 1));
        $this->db->query("UPDATE spreadsheet SET name = '$fileName' WHERE id = $primary_key");

        $handle = fopen($filePath, "r");

        $spreadsheetProfile = $this->getSpreadsheetProfile($primary_key);

        // Configure first line/row to read
        if ($spreadsheetProfile->ignore_first_row == 0) {
            $initialLine = 1;
        } else {
            $initialLine = 2;
        }

        // Configure delimiter
        switch ($spreadsheetProfile->fields_delimiter) {
            case 'comma':
                $fieldsDelimiter = ',';
                break;
            case 'semicolon':
                $fieldsDelimiter = ';';
                break;
            case 'dot':
                $fieldsDelimiter = '.';
                break;
            case 'whitespace':
                $fieldsDelimiter = ' ';
                break;
            case 'tab':
                $fieldsDelimiter = "\t";
                break;
        }

        $row = 1;

        while (($data = fgetcsv($handle, 0, $fieldsDelimiter)) !== FALSE)
        {
            if($row < $initialLine)
            {
                $row++;
                continue;
            }

            $fields = [
                'spreadsheet_id' => $primary_key,
                'row_number' => $row,
            ];

            $columnName = 'a';
            foreach($data as $index => $value) // assumes there are as many columns as their are title columns
            {
                // We will store numeric data using dot as decimal separator
                $standardDecimalSeparator = '.';
                switch ($spreadsheetProfile->decimals_delimiter) {
                    case 'comma':
                        $value = str_replace(',', $standardDecimalSeparator, $value);
                        break;
                    case 'semicolon':
                        $value = str_replace(';', $standardDecimalSeparator, $value);
                        break;
                    case 'dot':
                        $value = str_replace('.', $standardDecimalSeparator, $value);
                        break;
                    case 'whitespace':
                        $value = str_replace(' ', $standardDecimalSeparator, $value);
                        break;
                    case 'tab':
                        $value = str_replace("\t", $standardDecimalSeparator, $value);
                        break;
                }

                $fields['column_'.$columnName] = $value;
                $columnName = chr(ord($columnName)+1);
            }

            // Insert row
            $this->db->insert('spreadsheet_row', $fields);

            $row++;
        }

        fclose($handle);

        return $post_array;
    }

    public function spreadsheetRows()
    {
        $this->load->library('session');

        $this->sma->checkPermissions();

        if (isset($_GET)) {
            if (isset($_GET['spreadsheetId'])) {
                // Store fee_id (provided via url) in session
                $spreadsheetId = $_GET['spreadsheetId'];
                $this->session->set_userdata(['spreadsheetId' => $spreadsheetId]);
            }
        }

        // Set fee_id as hidden field (from session)
        $userData = $this->session->get_userdata();
        $spreadsheetId = $userData['spreadsheetId'];

        $pageTitle = 'Spreadsheet Content';

        // Prepare breadcrumbs
        $this->bc = array();
        $this->bc[] = [
            'link' => '',
            'page' => 'Home',
        ];
        $this->bc[] = [
            'link' => 'shipeu/spreadsheets',
            'page' => 'Spreadsheets',
        ];
        $this->bc[] = [
            'link' => 'shipeu/' . __FUNCTION__,
            'page' => $pageTitle,
        ];

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('spreadsheet_row');
            $crud->set_subject($pageTitle);

            $crud->columns('row_number', 'column_a', 'column_b', 'column_c', 'column_d', 'column_e', 'column_f', 'column_g', 'column_h', 'column_i', 'column_j', 'column_k', 'column_l', 'column_m');

            $spreadsheetProfile = $this->getSpreadsheetProfile($spreadsheetId);
            $spreadsheetProfileColumns = $this->db->query("SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfile->id)->result();

            foreach ($spreadsheetProfileColumns as $spreadsheetProfileColumn) {
                if (empty($spreadsheetProfileColumn->service_id) && empty($spreadsheetProfileColumn->zone_id)) {
                    $spreadsheetTypeColumnId = $spreadsheetProfileColumn->spreadsheet_type_column_id;
                    $spreadsheetTypeColumn = $this->db->query("SELECT * FROM spreadsheet_type_column WHERE id = " . $spreadsheetTypeColumnId)->row();
                    $columnLabel = $spreadsheetTypeColumn->name;
                } elseif (!empty($spreadsheetProfileColumn->service_id)) {
                    $service = $this->db->query("SELECT * FROM service WHERE id = " . $spreadsheetProfileColumn->service_id)->row();
                    $columnLabel = $service->name;
                } elseif (!empty($spreadsheetProfileColumn->zone_id)) {
                    $zone = $this->db->query("SELECT * FROM zone WHERE id = " . $spreadsheetProfileColumn->zone_id)->row();
                    $columnLabel = $zone->name;
                }

                $crud->display_as('column_' . $spreadsheetProfileColumn->spreadsheet_column_name, $columnLabel);
            }

            // Read only page
            $crud->unset_edit();
            $crud->unset_delete();
            $crud->unset_add();

            $crud->unset_fields('spreadsheet_id');
            $crud->field_type('spreadsheetId', 'hidden', $spreadsheetId);

            // Filter by current fee_id
            $crud->where('spreadsheet_id', $spreadsheetId);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    private function getSpreadsheetProfile($spreadsheetId)
    {
        if (is_array($spreadsheetId)) {
            $post_array = $spreadsheetId;
            $spreadsheetTypeId = $post_array['spreadsheet_type_id'];

            $courierId = empty($post_array['courier_id']) ? 0 : $post_array['courier_id'];
            $serviceId = empty($post_array['service_id']) ? 0 : $post_array['service_id'];
            $sellerId = empty($post_array['seller_id']) ? 0 : $post_array['seller_id'];
        } else {
            $spreadsheet = $this->db->query("SELECT * FROM spreadsheet WHERE id = " . $spreadsheetId)->row();
            $spreadsheetTypeId = $spreadsheet->spreadsheet_type_id;

            $courierId = empty($spreadsheet->courier_id) ? 0 : $spreadsheet->courier_id;
            $serviceId = empty($spreadsheet->service_id) ? 0 : $spreadsheet->service_id;
            $sellerId = empty($spreadsheet->seller_id) ? 0 : $spreadsheet->seller_id;
        }

        $spreadsheetProfile = $this->db->query("SELECT * FROM spreadsheet_profile WHERE spreadsheet_type_id = " . $spreadsheetTypeId .
            " AND IFNULL(courier_id, 0) = " . $courierId .
            " AND IFNULL(service_id, 0) = " . $serviceId .
            " AND IFNULL(seller_id, 0) = " . $sellerId)->row();

        return $spreadsheetProfile;
    }

    public function spreadsheetImport()
    {
        $this->load->library('session');

        $this->sma->checkPermissions();

        if (isset($_GET)) {
            if (isset($_GET['spreadsheetId'])) {
                // Store fee_id (provided via url) in session
                $spreadsheetId = $_GET['spreadsheetId'];
                $this->session->set_userdata(['spreadsheetId' => $spreadsheetId]);
            }
        }

        // Set fee_id as hidden field (from session)
        $userData = $this->session->get_userdata();
        $spreadsheetId = $userData['spreadsheetId'];

        $spreadsheet = $this->db->query("SELECT * FROM spreadsheet WHERE id = " . $spreadsheetId)->row();
        $spreadsheetType = $this->db->query("SELECT * FROM spreadsheet_type WHERE id = " . $spreadsheet->spreadsheet_type_id)->row();

        if ($spreadsheetType->code = 'fee') {
            $this->importSpreadsheetFees($spreadsheetId);
        } else {
            throw new Exception('Spreadsheet Type Import not supported for ' . $spreadsheetType->code);
        }

    }

    private function importSpreadsheetFees($spreadsheetId)
    {
        // Delete previously imported data
        $this->db->query("DELETE FROM fee WHERE id IN (SELECT fee_id FROM fee_range WHERE spreadsheet_id = $spreadsheetId)");
        $this->db->query("DELETE FROM fee_range WHERE spreadsheet_id = $spreadsheetId)");

        $spreadsheet = $this->db->query("SELECT * FROM spreadsheet WHERE id = " . $spreadsheetId)->row();

        $spreadsheetTypeColumnWeight = $this->db->query("SELECT * FROM spreadsheet_type_column WHERE spreadsheet_type_id = " . $spreadsheet->spreadsheet_type_id . " AND code = 'weight'")->row();
        $spreadsheetTypeColumnFee = $this->db->query("SELECT * FROM spreadsheet_type_column WHERE spreadsheet_type_id = " . $spreadsheet->spreadsheet_type_id . " AND code = 'fee'")->row();

        $spreadsheetProfile = $this->getSpreadsheetProfile($spreadsheetId);
        $spreadsheetProfileColumnWeightSql = "SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfile->id . " AND spreadsheet_type_column_id = " . $spreadsheetTypeColumnWeight->id;
        $spreadsheetProfileColumnWeight = $this->db->query($spreadsheetProfileColumnWeightSql)->row();
        $weightColumn = $spreadsheetProfileColumnWeight->spreadsheet_column_name;
        $weightColumnName = 'column_'.$weightColumn;

        $feeTypeShippingFee =  $this->db->query("SELECT * FROM fee_type WHERE name = 'Shipping Fee'")->row();

        $spreadsheetProfileColumns = $this->db->query("SELECT * FROM spreadsheet_profile_column WHERE spreadsheet_profile_id = " . $spreadsheetProfile->id . " AND spreadsheet_type_column_id = " . $spreadsheetTypeColumnFee->id . " ORDER BY zone_id")->result();
        foreach ($spreadsheetProfileColumns as $spreadsheetProfileColumn) {
            $zoneId = $spreadsheetProfileColumn->zone_id;
            $insertFee = 'INSERT INTO fee (fee_type_id, courier_cost, service_id, zone_id) VALUES (' . $feeTypeShippingFee->id . ', 1, ' . $spreadsheet->service_id . ', ' . $zoneId . ')';
            $this->db->query($insertFee);
            $feeId = $this->db->insert_id();
            $zoneColumn = $spreadsheetProfileColumn->spreadsheet_column_name;
            $zoneColumnName = 'column_'.$zoneColumn;

            $spreadsheetRows = $this->db->query("SELECT * FROM spreadsheet_row WHERE spreadsheet_id = " . $spreadsheetId . " ORDER BY row_number")->result();
            $minWeight = 0;
            foreach ($spreadsheetRows as $spreadsheetRow) {
                $maxWeight = $spreadsheetRow->$weightColumnName;
                $fee = $spreadsheetRow->$zoneColumnName;
                $insertFeeRange = "INSERT INTO fee_range (fee_id, units_from, units_to, fee, spreadsheet_id) VALUES ($feeId, '$minWeight', '$maxWeight', '$fee', $spreadsheetId)";
                $this->db->query($insertFeeRange);
                $minWeight = $maxWeight;
            }
        }

        $this->db->query("UPDATE spreadsheet SET imported = 1 WHERE id = " . $spreadsheetId);

        redirect('shipeu/deliveryCosts');
    }

    public function shipments()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Shipments';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('purchases');
            $crud->set_subject($pageTitle);
            $crud->columns('date', 'supplier_id', 'total', 'shipping', 'grand_total', 'status');

            // Read only
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_edit();

            $crud->add_action('Config Fees', '', '','ui-icon-info', array($this,'redirectShipmentFees'));
            $crud->add_action('Packages', '', '','ui-icon-info', array($this,'redirectShipmentPackages'));

            $crud->set_relation('supplier_id', 'companies', '{name}');
            $crud->display_as('supplier_id', 'Seller');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function redirectShipmentFees($primary_key , $row)
    {
        return site_url('shipeu/shipmentFees').'?purchaseId=' . $primary_key;
    }

    function redirectShipmentPackages($primary_key , $row)
    {
        return site_url('shipeu/shipmentPackages').'?purchaseId=' . $primary_key;
    }

    public function shipmentFees()
    {
        $this->load->library('session');

        $this->sma->checkPermissions();

        $pageTitle = 'Shipment Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('shipment_fee');
            $crud->set_subject($pageTitle);
            $crud->columns('fee_type_id', 'apply');

            $crud->field_type('purchase_id', 'hidden');
            $crud->field_type('fee', 'hidden');

            $crud->set_relation('fee_type_id','fee_type','{name}', null, 'name ASC');
            $crud->display_as('fee_type_id','Fee Type');

            $crud->field_type('apply', 'dropdown', [ '1' => 'Yes', '2' => 'No' ]);
            $crud->display_as('apply', 'Apply');

            $crud->callback_before_insert(array($this,'shipment_fee_before_insert'));

            if (isset($_GET)) {
                if (isset($_GET['purchaseId'])) {
                    // Store fee_id (provided via url) in session
                    $purchaseId = $_GET['purchaseId'];
                    $this->session->set_userdata(['purchaseId' => $purchaseId]);
                }
            }

            // Set fee_id as hidden field (from session)
            $userData = $this->session->get_userdata();
            $purchaseId = $userData['purchaseId'];
            $crud->field_type('purchaseId', 'hidden', $purchaseId);

            // Check if there are shipment fees added. If not, add defaults
            // TO-DO: The injection of records should be performed once a purchase is created,
            //        so an user is not forced to enter to this page
            $shipmentFees = $this->db->query("SELECT * FROM shipment_fee WHERE purchase_id = " . $purchaseId)->result();
            if (empty($shipmentFees)) {
                // Codes 2 and 3 are used for "manual" configuration: these are the only fee types
                // that can be manually selected on a per-shipment basis
                $feeTypes = $this->db->query("SELECT * FROM fee_type WHERE apply = 2 OR apply = 3")->result();
                foreach ($feeTypes as $feeType) {
                    $this->db->insert('shipment_fee', [
                            'purchase_id' => $purchaseId,
                            'fee_type_id' => $feeType->id,
                            'apply' => ($feeType->apply - 1),    // Code 2 (Manually Enabled) became 1 (Enabled) and code 3 (Manually Disabled) became 2 (Disabled)
                            'fee' => 0,    // Will be calculated later. This field is kept for history queries because fees can change over time, so we have a snapshot of the fee at this moment.
                        ]
                    );
                }
            }

            // Filter by current purchase/shipment
            $crud->where('purchase_id', $purchaseId);

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function shipment_fee_before_insert($post_array)
    {
        $sessionData = $this->session->get_userdata();
        $post_array['purchase_id'] = $sessionData['purchaseId'];

        return $post_array;
    }

    public function shipmentPackages()
    {
        $this->load->library('session');

        $this->sma->checkPermissions();

        $pageTitle = 'Shipment Packages';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        if (isset($_GET)) {
            if (isset($_GET['purchaseId'])) {
                // Store fee_id (provided via url) in session
                $purchaseId = $_GET['purchaseId'];
                $this->session->set_userdata(['purchaseId' => $purchaseId]);
            }
        }

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('shipment_package');
            $crud->set_subject($pageTitle);
            $crud->columns('package_id', 'quantity');

            $crud->field_type('purchase_id', 'hidden');
            $crud->field_type('unit_cost', 'hidden');
            $crud->field_type('total_cost', 'hidden');

            $crud->set_relation('package_id','package','{code_1}', null, 'code_1 ASC');
            $crud->display_as('package_id','Package');

            $crud->set_rules('quantity','Quantity',['integer', 'required']);
            $crud->display_as('quantity', 'Quantity');

            $crud->callback_before_insert(array($this,'shipment_package_before_insert'));

            // Set purchaseId as hidden field (from session)
            $userData = $this->session->get_userdata();
            $purchaseId = $userData['purchaseId'];
            $crud->field_type('purchaseId', 'hidden', $purchaseId);

            // Filter by current purchase/shipment
            $crud->where('purchase_id', $purchaseId);

            // Check if there are packages added. If not, use BoxPacker
            // to calculate and fill the suggested packages (can be changed by user)
            // TO-DO: The injection of records should be performed once a purchase is created,
            //        so an user is not forced to enter to this page
            $shipmentPackages = $this->db->query("SELECT * FROM shipment_package WHERE purchase_id = " . $purchaseId)->result();
            if (empty($shipmentPackages)) {
                // TO-DO: Make BoxPacker works
                //$packer = $this->load->library('BoxPacker/Packer');
                //foreach ($boxes as $box) {
                //    $this->db->insert('shipment_package', [
                //            'purchase_id' => $purchaseId,
                //            'package_id' => $box->id,
                //            'unit_cost' => $package->cost_price,
                //            'quantity' => $quantity,
                //            'total_cost' => $package->cost_price * $quantity,
                //        ]
                //    );
                //}
            }

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function shipment_package_before_insert($post_array)
    {
        $sessionData = $this->session->get_userdata();
        $post_array['purchase_id'] = $sessionData['purchaseId'];

        return $post_array;
    }

    private function prepareBreadcrumbs($actionName, $linkName)
    {
        $this->bc = array();
        $this->bc[] = [
            'link' => '',
            'page' => 'Home',
        ];
        $this->bc[] = [
            'link' => 'shipeu/' . $actionName,
            'page' => $linkName,
        ];
    }

    public function renderView($pageName, $output = null)
    {
        // NOTE: $this->data is a construct of Stock Manager Advance
        //       I'm injecting variables required by Grosery CRUD here
        $this->data['grosery_output'] = $output->output;
        $this->data['grosery_js_files'] = $output->js_files;
        $this->data['grosery_js_lib_files'] = $output->js_lib_files;
        $this->data['grosery_js_config_files'] = $output->js_config_files;
        $this->data['grosery_css_files'] = $output->css_files;
        $this->data['bc'] = $this->bc; // SMA Breadcrumb

        $meta = array('page_title' => $pageName);
        $this->page_construct('shipeu/index', $meta, $this->data);
    }

}
