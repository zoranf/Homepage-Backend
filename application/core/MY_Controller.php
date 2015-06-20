<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // save whole request to data property
        $request = (array)json_decode(file_get_contents('php://input'));
        if (count($request) > 0) {
            $_POST = $request;
        }
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
        exit();
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

    /**
     * Check if client is authenticated
     */
    protected function _checkAuthentication()
    {
        $loggedIn = $this->session->userdata("loggedIn");
        if (isset($loggedIn) === false) {
            $this->_returnAjax(false, "Please authenticate first.");
        }
    }
}
