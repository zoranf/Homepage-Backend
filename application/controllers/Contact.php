<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Services for admin control purposes
 */
class Contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->_checkAuthentication(); // Kontrola prometa
        $this->config->load("siteconfig");
    }
    
    // User sends mail to admin
    public function sendMail()
    {
        $this->_access("post");
        $data = $this->input->post();
        
        // form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("message", "Message", "required");

        if ($this->form_validation->run() === false) {
            $this->_returnAjax(false, "Izpolni vsa polja");
        }

        // load email configuration
        $emailConfiguration = $this->config->item("email_configuration");
        $this->load->library("email", $emailConfiguration);

        // Email data
        $subject = "Spletna stran - povpraševanje";
        $message = $this->load->view("emailTemplate", $data, true);

        // Sending mail
        $this->email->from($emailConfiguration["smtp_user"]);
        $this->email->to($emailConfiguration["smtp_user"]);
        $this->email->subject($subject);
        $this->email->message($message);	
        if ($this->email->send() === true) {
            $this->_returnAjax(true, "Email uspesno poslan.");
        }
        $this->_returnAjax(false, "Email ni uspešno poslan.");
    } 
}
