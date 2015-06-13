<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     * Property which takes whole request sent from the client
     */
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        // save whole request to data property
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
    }

    /**
     * Universal method to return JSON object in response
     * 
     * @param boolean
     * @param mixed array | string
     * @return string (json)
     */
    protected function _returnAjax($success, $data = [])
    {
        $return["success"] = $success;
        if ($success === false) {
            // data should be string now
            $return["error"] = ["message" => $data];
        } else {
            $return["data"] = $data;
        }
        print json_encode($return);
        die();
    }

    /**
     * Check if request is sent over proper request method
     * @param string ("get" | "post" | "put" | "delete")
     */
    protected function _access($allowedMethod)
    {
        if ($this->input->method() !== $allowedMethod) {
            $this->_returnAjax(false, "Access restricted due to wrong request method.");
        }
    }
}
