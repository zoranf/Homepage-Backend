<?php

class Advertisements_model extends CI_Model {

    function __construct() {

        // Call the Model constructor
        parent::__construct();
    }

    // Get all entries from advertisement
    function getAdList() {

        $sql = "SELECT * FROM advertisement ORDER BY enabled DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }
}
