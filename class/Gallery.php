<?php
class Gallery {
    // Class implementation

    public $id;
    public $image_url;
    public $caption;
    public $category;
    public $uploaded_at;
    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'gallery' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->image_url = $result['image_url'];
               $this->caption = $result['caption'];
               $this->category = $result['category'];
               $this->uploaded_at = $result['uploaded_at'];
              
            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `gallery` (`image_url`, `caption`, `category`, `uploaded_at`) VALUES ('" .
         $this->image_url . "', '" . $this->caption . "', '" . $this->category . "', '" . $this->uploaded_at . "')";
        
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

        $query = "SELECT * FROM `gallery` ORDER BY name ASC";
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
        $query = "DELETE FROM `gallery` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `gallery` SET
            `image_url` = '$this->image_url',
            `caption` = '$this->caption'
            `category` = '$this->category'
            `uploaded_at` = '$this->uploaded_at'
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