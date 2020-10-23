<?php

// Class methods handling REST CRUD for application
class Experience extends DbConnect {
    
    function getAllJobs() {
        $sql = "SELECT * FROM dt173g_project_experience ORDER BY id DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function getJob($id) {
        $sql = "SELECT * FROM dt173g_project_experience WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    function createJob() {
        if($this->header != "") {
            $this->header = $this->checkValue($this->header);
        } else {
            return false;
        }
        if($this->position != "") {
            $this->position = $this->checkValue($this->position);
        } else {
            return false;
        }
        if($this->year != "") {
            $this->year = $this->checkValue($this->year);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        $sql = "INSERT INTO dt173g_project_experience(header, position, year, description) VALUES ('$this->header', '$this->position', '$this->year', '$this->description')";
        return $this->db->query($sql);
    }

    function editJob($id) {
        if($this->header != "") {
            $this->header = $this->checkValue($this->header);
        } else {
            return false;
        }
        if($this->position != "") {
            $this->position = $this->checkValue($this->position);
        } else {
            return false;
        }
        if($this->year != "") {
            $this->year = $this->checkValue($this->year);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        $sql = "UPDATE dt173g_project_experience SET header = '$this->header', position = '$this->position', year = '$this->year', description = '$this->description' WHERE id = $id";
        return $this->db->query($sql);
    }

    function deleteJob($id) {
        $sql = "DELETE FROM dt173g_project_experience WHERE id = $id";
        return $this->db->query($sql);
    }

    // Check if input value is set and no bad code is used
    function checkValue($value) {
        $value = strip_tags($value, "<br><p><b><i><ul><ol><li>");
        $value = $this->db->real_escape_string($value);
        return $value;           
    }
}