<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firstpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("angjs/index.html");
    }
}
