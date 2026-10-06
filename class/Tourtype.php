<?php
class Tourtype {
    // Class implementation

    public $id;
    public $type_name;
    public $description;
    public $created_at;
    
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'tourtype' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->type_name = $result['setting_key'];
               $this->description = $result['setting_value'];
               $this->created_at = $result['created_at'];
              
            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `tourtype` (`type_name`, `description`, `created_at`) VALUES ('" .
         $this->type_name . "', '" . $this->description . "', '" . $this->created_at . "')";
        
        $db = Database::getInstance();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    //get all
      public function all()
    {

        $query = "SELECT * FROM `tourtype` ORDER BY name ASC";
        $db = Database::getInstance();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }



 // Delete a bank record by ID
    public function delete()
    {
        $query = "DELETE FROM `tourtype` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `tourtype` SET
            `type_name` = '$this->type_name',
            `description` = '$this->description'
            `created_at` = '$this->created_at'
            WHERE `id` = '$this->id'";
 

        $db = Database::getInstance();
        $result = $db->readQuery($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
?>