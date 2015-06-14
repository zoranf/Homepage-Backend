<?php

class Advertisements_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // Get all entries from advertisement
    function getAdList()
    {
        $sql = "SELECT * FROM advertisements ORDER BY enabled DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }

    // Insert advertisement
    function add($data)
    {
        $sql = "INSERT INTO advertisements (title, picture, time)
        		VALUES (?, ?, ?)";

        $insertArr = [
            "title"     =>  $data["title"],
            "picture"   =>  $data["picture"],
            "time"      =>  time()
        ];

        $status = $this->db->query($sql, $insertArr);

        if ($status === true) {

            return $this->db->insert_id();
        }

        return false;
    }

    // Delete advertisement
    function delete($id)
    {
        $sql = "DELETE FROM advertisements
                WHERE id = ?";

        return $this->db->query($sql, $id);
    }

    // Enable advertisement
    function enable($data)
    {

        $sql = "UPDATE advertisements
                SET enabled = ?
                WHERE id = ?";

        $insertArr = [
            "enabled"   => $data["enabled"],
            "id"        => $data["id"]
        ];

        $this->db->query($sql, $insertArr);

        return $data["id"];
    }
}
