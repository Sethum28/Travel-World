<?php
class Settings {
    // Class implementation

    public $id;
    public $setting_key;
    public $setting_value;
    public $updated_at;
    
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'settings' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->setting_key = $result['setting_key'];
               $this->setting_value = $result['setting_value'];
               $this->updated_at = $result['updated_at'];
              
            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `settings` (`setting_key`, `setting_value`, `updated_at`) VALUES ('" .
         $this->setting_key . "', '" . $this->setting_value . "', '" . $this->updated_at . "')";
        
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

        $query = "SELECT * FROM `settings` ORDER BY name ASC";
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
        $query = "DELETE FROM `settings` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `settings` SET
            `setting_key` = '$this->setting_key',
            `setting_value` = '$this->setting_value'
            `updated_at` = '$this->updated_at'
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