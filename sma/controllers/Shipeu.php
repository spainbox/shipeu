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

            $crud->set_relation('continent_id','continent','{name}');
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

            $crud->set_relation('country_id','country','{code} - {name}');
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

            $crud->set_relation('state_id','state', '{code} - {name}');
            $crud->display_as('state_id', 'State');

//            $crud->callback_field('state_id', array($this, '_callback_state_name'));

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_state_name($value, $row)
    {
        return 'ESTADO ' . $value;
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
            $crud->columns('code', 'name', 'courier_id', 'delivery_days_min', 'delivery_days_max', 'description');

            $crud->set_rules('delivery_days_min','Delivery Days Min',['integer', 'required']);
            $crud->set_rules('delivery_days_max','Delivery Days Max',['integer', 'required']);

            // On version 1, fee_method is not used, all spreadsheets use total-price method (not listed here)
            $crud->fields('code', 'name', 'courier_id', 'delivery_days_min', 'delivery_days_max', 'description');

            $crud->set_relation('courier_id','courier','{name}');
            $crud->display_as('courier_id','Courier');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function pickingFees()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Picking Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('picking_fee');
            $crud->set_subject($pageTitle);
            $crud->required_fields('weight_from', 'weight_to');
            $crud->columns('weight_from', 'weight_to', 'fee');

            $crud->set_rules('fee','Fee',['decimal', 'required']);

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
            $crud->required_fields('company_id', 'selection_method_id','service_id');
            $crud->columns('company_id', 'priority', 'selection_method_id', 'country_id', 'range_start', 'range_end', 'service_id');

            $crud->set_rules('priority','Priority Number', ['integer', 'required']);

            $crud->set_relation('company_id','companies','{company}', ['group_name' => 'biller']);  // Filter by "Biller" companies
            $crud->display_as('company_id','Company');

            $crud->set_relation('selection_method_id','selection_method','{name}');
            $crud->display_as('selection_method_id','Selection Method');

            $crud->set_relation('country_id','country','{name}');
            $crud->display_as('country_id','Country');

            $crud->set_relation('service_id','service','{name}');
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

            $crud->set_relation('service_id','service','{name}');
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

            $crud->set_relation('zone_id','zone','{name}');
            $crud->display_as('zone_id','Zone');

            $crud->set_relation('country_id','country','{name}');
            $crud->display_as('country_id','Country');

            $crud->set_relation('state_id','state','{code} - {name}');
            $crud->display_as('state_id','State');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function zoneFees()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Zone Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone_fee');
            $crud->set_subject($pageTitle);
            $crud->required_fields('zone_id');
            $crud->columns('zone_id', 'weight', 'price');

            $crud->set_rules('weight','Weight',['decimal', 'required']);
            $crud->set_rules('price','Price',['decimal', 'required']);

            $crud->set_relation('zone_id','zone','{name}');
            $crud->display_as('zone_id','Zone');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function shippingMargins()
    {
        $this->sma->checkPermissions();

        $pageTitle = 'Shipping Cost Margins';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('shipping_margin');
            $crud->set_subject($pageTitle);
            $crud->required_fields('company_id', 'service_id');
            $crud->columns('company_id', 'service_id', 'cost_margin');

            $crud->set_rules('cost_margin','Cost Shipping Margin',['decimal', 'required']);

            $crud->set_relation('company_id','companies','{company}', ['group_name' => 'biller']);  // Filter by "Biller" companies
            $crud->display_as('company_id','Company');

            $crud->set_relation('service_id','service','{name}');
            $crud->display_as('service_id','Service');

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
