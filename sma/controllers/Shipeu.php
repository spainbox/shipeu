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

            $crud->callback_after_insert(array($this, 'states_after_insert'));
            $crud->callback_after_update(array($this, 'states_after_update'));

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function states_after_insert($post_array, $primary_key)
    {
        $this->states_copy_country_name($primary_key);
        return true;
    }

    public function states_after_update($post_array, $primary_key)
    {
        $this->states_copy_country_name($primary_key);
        return true;
    }

    private function states_copy_country_name($stateId)
    {
        $countryId = $this->db->query("SELECT country_id FROM state WHERE id =" . $stateId)->row()->country_id;

        $countryName = $this->db->query("SELECT name FROM country WHERE id =" . $countryId)->row()->name;

        $this->db->update('state', ['copy_country_name' => $countryName], ['id' => $stateId]);

        return true;
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

            $crud->set_relation('state_id','state', '{copy_country_name} - {name}', null, 'copy_country_name, name ASC');
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
            $crud->columns('name', 'contact_name', 'address', 'phone', 'country_id', 'website', 'notes');
            $crud->unique_fields('name');

            $crud->set_relation('country_id','country','{code} - {name}', null, 'code ASC');
            $crud->display_as('country_id','Country');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
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
            $crud->columns('zone_id', 'country_id', 'state_id');

            $crud->set_relation('zone_id','zone','{name}', null, 'name ASC');
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
            $crud->columns('courier', 'service', 'zone', 'weight_from', 'weight_to', 'price');

            // Data is read-only (imported/updated via spreadsheets)
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_edit();

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
            $crud->columns('package_type_id', 'code_1', 'code_2', 'cost_price', 'sell_price', 'inner_width_cm', 'inner_height_cm', 'inner_large_cm', 'outer_width_cm', 'outer_height_cm', 'outer_large_cm');
            $crud->unique_fields('code_1','code_2');

            $crud->set_relation('package_type_id','package_type','{name}');
            $crud->display_as('package_type_id','Type');

            $crud->set_rules('code_1','Code 1',['required']);
            $crud->set_rules('cost_price','Cost Price',['decimal', 'required']);
            $crud->set_rules('sell_price','Sell Price',['decimal', 'required']);
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
            $crud->required_fields('name', 'description', 'fee_factor_id', 'fee_price_type_id', 'fee_granularity_id', 'fee_ranges');
            $crud->columns('name', 'description', 'fee_factor_id', 'fee_price_type_id', 'fee_granularity_id', 'fee_ranges', 'custom_field1_label', 'custom_field2_label');
            $crud->unique_fields('name');

            $crud->set_relation('fee_factor_id', 'fee_factor', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_factor_id', 'Fee Factor');

            $crud->set_relation('fee_price_type_id', 'fee_price_type', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_price_type_id', 'Price Type');

            $crud->set_relation('fee_granularity_id', 'fee_granularity', '{name} - {description}', null, 'sequence ASC');
            $crud->display_as('fee_granularity_id', 'Fee Granularity');

            $crud->field_type('fee_ranges', 'dropdown', [ '1' => 'No - Unique Price', '2' => 'Yes - Prices by Ranges']);
            $crud->display_as('fee_ranges', 'Use Fee Ranges');

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
            $crud->required_fields('fee_type_id', 'courier_cost', 'minimal_fee', 'apply');
            $crud->columns('fee_type_id', 'courier_cost', 'seller_id', 'courier_id', 'service_id', 'zone_id', 'country_id', 'minimal_fee', 'apply', 'custom_field1_value', 'custom_field2_value');
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
            if ($granularitySequence >= 2) {
                $crud->set_relation('seller_id', 'seller', 'name', null, 'name ASC');
                $crud->display_as('seller_id', 'Seller');
            } else {
                $unsetColumns[] = 'seller_id';
            }

            if ($granularitySequence >= 3) {
                $crud->set_relation('courier_id', 'courier', '{name}', null, 'name ASC');
                $crud->display_as('courier_id', 'Courier');
            } else {
                $unsetColumns[] = 'courier_id';
            }

            // Sequence 4 is not included because is Seller+Courier (and both dropdown were already shown)

            if ($granularitySequence >= 5) {
                $crud->set_relation('service_id', 'service', '{name}', null, 'name ASC');
                $crud->display_as('service_id', 'Service');
            } else {
                $unsetColumns[] = 'service_id';
            }

            if ($granularitySequence >= 6) {
                $crud->set_relation('zone_id', 'zone', '{name}', null, 'name ASC');
                $crud->display_as('zone_id', 'Zone');
            } else {
                $unsetColumns[] = 'zone_id';
            }

            if ($granularitySequence >= 7) {
                $crud->set_relation('country_id', 'country', '{code} - {name}', null, 'code ASC');
                $crud->display_as('country_id', 'Country');
            } else {
                $unsetColumns[] = 'country_id';
            }

            // Fee textbox is shown only if prices are not configured by ranges
            if (isset($feeType)) {
                if (empty($feeType->fee_ranges == 1)) {
                    $unsetColumns[] = 'fee';
                } else {
                    $crud->display_as('fee', 'Fee');
                }
            }

            $crud->field_type('apply', 'dropdown', [ '1' => 'Automatically', '2' => 'Manually - Enabled by default', '3' => 'Manually - Disabled by default', '4' => 'Never (inactive)']);
            $crud->display_as('apply', 'Apply');

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
            $crud->unset_fields('spreadsheet_value_id');

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
