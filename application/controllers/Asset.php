<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Services for user control purposes
 */
class Asset extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load Assets_model
        $this->load->model("Assets_model");
    }

    // Returns list of advertisements
    public function get()
    {
        $this->_access("get");
        $data = $this->Assets_model->getAdList();
        $this->_returnAjax(true, $data);
    }

    public function form()
    {
        $this->load->view("form");
    }
}
