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
    function add($title, $picture, $enabled) {

        $sql = "INSERT INTO advertisement (title, picture, enabled)
        		VALUES (?, ?, ?)";


        return $this->db->query($sql, array($title, $picture, $enabled));
    }

    // Delete advertisement
    function delete($id) {

        $sql = "DELETE FROM advertisement
                WHERE id = ?";

        return $this->db->query($sql, $id);
    }

    // Enable advertisement
    function enable($id, $enabled) {

        $sql = "UPDATE advertisement
                SET enabled = ?
                WHERE id = ?";

        return $this->db->query($sql, array($enabled, $id));
    }
}
