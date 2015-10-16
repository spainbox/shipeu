<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grosery extends MY_Controller
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
        $pageTitle = 'Continents';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('continent');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name');
            $crud->columns('code', 'name');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function countries()
    {
        $pageTitle = 'Countries';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('country');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name, continent_id');
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
        $pageTitle = 'States';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('state');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name, country_id');
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
        $pageTitle = 'Cities';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('city');
            $crud->set_subject($pageTitle);
            $crud->required_fields('name, state_id');
            $crud->columns('name', 'state_id');

            $crud->set_relation('state_id','state','{code} - {name}');
            $crud->display_as('state_id','State');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function couriers()
    {
        $pageTitle = 'Couriers';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('courier');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name, website');
            $crud->columns('code', 'name', 'website');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function services()
    {
        $pageTitle = 'Services';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('service');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name, courier_id');
            $crud->columns('code', 'name', 'courier_id', 'delivery_days_min', 'delivery_days_max', 'fee_method_id', 'description');

            $crud->set_relation('courier_id','courier','{name}');
            $crud->display_as('courier_id','Courier');

            $crud->set_relation('fee_method_id','fee_method','{name}');
            $crud->display_as('fee_method_id','Fee Method');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function pickingFees()
    {
        $pageTitle = 'Picking Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('picking_fee');
            $crud->set_subject($pageTitle);
            $crud->required_fields('weight_from, weight_to, fee');
            $crud->columns('weight_from', 'weight_to', 'fee');

            $output = $crud->render();

            $this->renderView($pageTitle, $output);

        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function servicesSelections()
    {
        $pageTitle = 'Services Selections';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('service_selection');
            $crud->set_subject($pageTitle);
            $crud->required_fields('company_id, priority, selection_method_id, country_id, range_start, range_end, service_id');
            $crud->columns('company_id', 'priority', 'selection_method_id', 'country_id', 'range_start', 'range_end', 'service_id');

            $crud->set_relation('company_id','companies','{company}', ['group_name' => 'biller']);  // Filtramos compañias "Biller"
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
        $pageTitle = 'Zones';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone');
            $crud->set_subject($pageTitle);
            $crud->required_fields('code, name, service_id');
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
        $pageTitle = 'Zone Items';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone_item');
            $crud->set_subject($pageTitle);
            $crud->required_fields('zone_id, country_id, state_id');
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
        $pageTitle = 'Zone Fees';
        $this->prepareBreadcrumbs(__FUNCTION__, $pageTitle);

        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('zone_fee');
            $crud->set_subject($pageTitle);
            $crud->required_fields('zone_id, weight, price');
            $crud->columns('zone_id', 'weight', 'price');

            $crud->set_relation('zone_id','zone','{name}');
            $crud->display_as('zone_id','Zone');

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
            'link' => 'grosery/' . $actionName,
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
        $this->page_construct('grosery/index', $meta, $this->data);
    }

}