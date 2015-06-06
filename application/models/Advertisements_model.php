<?php

class Advertisements_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getAdList() {

        $sql = "SELECT * FROM advertisements ORDER BY enabled DESC";

        return $this->db->query($sql).result();
    }
}
