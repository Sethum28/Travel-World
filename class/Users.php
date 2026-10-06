<?php
class Users {
    // Class implementation

    public $id;
    public $username;
    public $email;
    public $password;
    public $role;
    public $created_at;

    

// constructor to initialize the Admin object with data from the database if an ID is provided
    public function __construct($id = null)
    {
        if ($id) {

           $query = "SELECT * FROM 'users' WHERE id = " . (int)$id;
        
           $db = Database::getInstance();
           $result = mysqli_fetch_array($db->readQuery($query));

           if ($result) {
               $this->id = $result['id'];
               $this->username = $result['username'];
               $this->email = $result['email'];
               $this->password = $result['password'];
               $this->role = $result['role'];
               $this->created_at = $result['created_at'];
              
            }
        }
    }

    //create funtion
    public function create() {
        $query = "INSERT INTO `users` (`username`, `email`, `password`, `role`, `created_at`) VALUES ('" .
         $this->username . "', '" . $this->email . "', '" . $this->password . "', '" . $this->role . "', '" . $this->created_at . "')";
        
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

        $query = "SELECT * FROM `users` ORDER BY name ASC";
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
        $query = "DELETE FROM `users` WHERE `id` = '" . $this->id . "'";
        $db = Database::getInstance();
        return $db->readQuery($query);
    }

     // Update an existing bank record
    public function update()
    {
        $query = "UPDATE `users` SET
            `username` = '$this->username',
            `email` = '$this->email'
            `password` = '$this->password'
            `role` = '$this->role'
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