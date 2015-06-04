<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function login()
    {

        $this->config->load("siteconfig");

        $data = $this->input->post();

        if ($data["username"] == $this->config->item("admin_username") && $data["password"] == $this->config->item("admin_password")) {

            echo "SUCCESS!"
        }


        print json_encode($array);die();
    }
}
