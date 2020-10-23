<?php

// Class methods handling REST CRUD for application
class Education extends DbConnect {
    
    function getAllCourses() {
        $sql = "SELECT * FROM dt173g_project_education ORDER BY id DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function getCourse($id) {
        $sql = "SELECT * FROM dt173g_project_education WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    function createCourse() {
        if($this->course != "") {
            $this->course = $this->checkValue($this->course);
        } else {
            return false;
        }
        if($this->year != "") {
            $this->year = $this->checkValue($this->year);
        } else {
            return false;
        }
        if($this->school != "") {
            $this->school = $this->checkValue($this->school);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        $sql = "INSERT INTO dt173g_project_education(course, year, school, description) VALUES ('$this->course', '$this->year', '$this->school', '$this->description')";
        return $this->db->query($sql);
    }

    function editCourse($id) {
        if($this->course != "") {
            $this->course = $this->checkValue($this->course);
        } else {
            return false;
        }
        if($this->year != "") {
            $this->year = $this->checkValue($this->year);
        } else {
            return false;
        }
        if($this->school != "") {
            $this->school = $this->checkValue($this->school);
        } else {
            return false;
        }
        if($this->description != "") {
            $this->description = $this->checkValue($this->description);
        } else {
            return false;
        }
        $sql = "UPDATE dt173g_project_education SET course = '$this->course', year = '$this->year', school = '$this->school', description = '$this->description' WHERE id = $id";
        return $this->db->query($sql);
    }

    function deleteCourse($id) {
        $sql = "DELETE FROM dt173g_project_education WHERE id = $id";
        return $this->db->query($sql);
    }

    // Check if input value is set and no bad code is used
    function checkValue($value) {
        $value = strip_tags($value, "<br><p><b><i><ul><ol><li>");
        $value = $this->db->real_escape_string($value);
        return $value;           
    }
}