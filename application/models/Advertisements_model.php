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

    // Insert advertisement
    function add($data) {

        $this->db->insert("advertisement", $data);
        die();
    }

    // Delete advertisement
    function delete($data) {

        $this->db->delete("advertisement", $data);
        die();
    }

    // Enable advertisement
    function enable($id, $boolean) {

        $this->db->update("advertisement", array("enabled" => $boolean), array("id" => $id));;
        die();
    }
}
