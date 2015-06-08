<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
    }

    protected function _returnAjax($success, $data = [])
    {
        $return = [
            "success"   =>  $success,
            "data"      =>  $data
        ];
        print json_encode($return);
        die();
    }

    protected function _access($allowedMethod)
    {
        if ($this->input->server("REQUEST_METHOD") !== $allowedMethod) {
            $this->_returnAjax(false, ["message" => "Access restricted due to wrong request method."]);
        }
    }
}
