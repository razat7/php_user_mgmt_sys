<?php
require_once 'config.php';
class Auth extends Database {

    // function to registration new user
    public function register($name, $email, $password){
        $sql = "INSERT INTO users(name, email, password) VALUES (:name, :email, :pass)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);

        return true;
    }

    //function to check if user is already registered
    public function user_exist($email){
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    //Funnction for checking login user status
    public function login($email) {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }

    //function to check current users existence in Session
    public function currentUser($email){
        $sql = "SELECT * FROM users WHERE email = :email AND deleted!=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }

    //PUBLIC FUNCTION FOR FORGOT USER

    public function forgotPassword($token,$email){
        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(),
        INTERVAL 10 MINUTE) WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token'=> $token, 'email' => $email]);
        $row = $stmt->fetch (PDO:: FETCH_ASSOC);
        
    return true;
    }

    //add new note function to post data in notes table
    public function add_new_note($uid, $title, $note){
        $sql =  "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid, 'title'=> $title, 'note'=> $note ]);
       
        return true;
    }

    // displaying notes data in home table
    public function display_data($uid){
        $sql = "SELECT * FROM notes WHERE uid = :uid";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid]);

        $row = $stmt->fetchAll (PDO:: FETCH_ASSOC);

        return $row;
    }

    //editing the notes data from table
    public function edit_note($id){
        $sql = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch (PDO:: FETCH_ASSOC);

        return $result;
    }

    //updating the notes data from table
    public function update_note($id, $title, $note){
        $sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title'=> $title, 'note'=> $note, 'id'=> $id]);
        
        return true;

    }
    
    //deleting the data from notes
    public function delete_note($id){
        $sql = "DELETE FROM notes WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch(PDO:: FETCH_ASSOC);

        return $result;
    }

    //Update profile fuction
    public function update_profile($name, $gender, $dob, $phone, $photo, $id){
        $sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=> $name, 'gender'=> $gender, 'dob'=> $dob, 'phone'=> $phone, 'photo'=> $photo, 'id'=> $id ]);

        return true;
    }

    //change password function
    public function change_password($pass, $id){
        $sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass'=> $pass, 'id'=> $id]);

        return true;
    }

    //Post feedback function
    public function feedback_submit($uid, $subject, $feedback){
        $sql = "INSERT INTO feedbak (uid, subject, feedback) VALUES (:uid, :subject, :feedback)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid, 'subject'=> $subject, 'feedback'=> $feedback]);

        return true;
    }

    //Insert Notification Function
    public function notification($uid, $type, $message){
        $sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid, 'type'=>$type, 'message'=>$message]);

        return true;
    }

    //Fetch Notification Function
    public function fetchNotification($uid){
        $sql = "SELECT * FROM notification WHERE uid = :uid AND type = 'user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    //removing notification from database
    public function removeNotification($id){
        $sql = "DELETE FROM notification WHERE id = :id AND type= 'user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        return true;
    }

}   
?>