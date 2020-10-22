<?php

// Class methods handling REST CRUD for application
class Portfolio extends DbConnect {
    protected $header;
    protected $description;
    protected $link;
    protected $image;
    protected $alt;
    
    function getAllReferences() {
        $sql = "SELECT * FROM dt173g_project_portfolio ORDER BY id DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function getReference($id) {
        $sql = "SELECT * FROM dt173g_project_portfolio WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    function createReference() {
        if($this->header != "") {
            $this->header = $this->checkValue($this->header);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        if($this->link != "") {
            $this->link = $this->checkValue($this->link);
        } else {
            return false;
        }
        if($this->image != "") {
            $this->image = $this->checkValue($this->image);
        } else {
            return false;
        }
        if($this->alt != "") {
            $this->alt = $this->checkValue($this->alt);
        } else {
            return false;
        }
        $sql = "INSERT INTO dt173g_project_portfolio(header, description, link, image, alt) VALUES ('$this->header', '$this->description', '$this->link', '$this->image', '$this->alt')";
        return $this->db->query($sql);
    }

    function editReference($id) {
        if($this->header != "") {
            $this->header = $this->checkValue($this->header);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        if($this->link != "") {
            $this->link = $this->checkValue($this->link);
        } else {
            return false;
        }
        if($this->alt != "") {
            $this->alt = $this->checkValue($this->alt);
        } else {
            return false;
        }
        if($this->image != ""){
            if($this->image != "") {
                $this->image = $this->checkValue($this->image);
            } else {
                return false;
            }
            $sql = "UPDATE dt173g_project_portfolio SET header = '$this->header', description = '$this->description', link = '$this->link', image = '$this->image', alt = '$this->alt' WHERE id = $id";
        } else {
            $sql = "UPDATE dt173g_project_portfolio SET header = '$this->header', description = '$this->description', link = '$this->link', alt = '$this->alt' WHERE id = $id";
        }
        return $this->db->query($sql);
    }

    function deleteReference($id) {
        $sql = "DELETE FROM dt173g_project_portfolio WHERE id = $id";
        return $this->db->query($sql);
    }

    // Check if input value is set and no bad code is used
    function checkValue($value) {
        $value = strip_tags($value, "<br><p><b><i><ul><ol><li>");
        $value = $this->db->real_escape_string($value);
        return $value;           
    }
}