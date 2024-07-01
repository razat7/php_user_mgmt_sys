<?php
require_once 'config.php';

class Admin extends Database{
    //admin login
    public function admin_login($username, $password){
        $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
        $stmt =$this->conn->prepare($sql);
        $stmt->execute(['username'=>$username, 'password'=>$password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Count Total no.of Rows
    public function totalCount($tablename){
        $sql = "SELECT * FROM $tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
       
        return $count;
    }

    //count total no.of verified users
    public function verified_users($status){
        $sql = "SELECT * FROM users WHERE verified = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status'=>$status]);
        $count = $stmt->rowCount();
        return $count;
    }

    //Gender percentage function
    public function genderPer(){
        $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //USers Verifed or Unverified count function

    public function verifiedPer(){
        $sql = "SELECT verified, count(*) AS number FROM users GROUP BY verified";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    //hits count
    public function hitsCount(){
        $sql = "SELECT hits FROM visitors";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        return $count;
    }

    //fetch all registered users
    public function fetchAllUsers($val){
        $sql = "SELECT * FROM users WHERE deleted != $val";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        
    }

    //Select the users data from table
    public function showUserDetails($id){
        $sql = "SELECT * FROM users WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch(PDO:: FETCH_ASSOC);

        return $result;
    }
    //delete the users from table
    public function userAction($id, $val){
        $sql = "UPDATE users SET deleted = $val WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
    
        return true;
        }
    //Select all notes
    public function fetchAllNotes(){
        $sql = "SELECT notes.id, notes.title, notes.note, notes.created_at, notes.updated_at, users.name,
                 users.email FROM  notes INNER JOIN users on notes.uid = users.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //delete notes from the admin table
    public function deleteNotes($id){
        $sql = "DELETE FROM notes WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch(PDO:: FETCH_ASSOC);

        return $result;
    }

    //function to fetch all feedback
    public function fetchAllFeedback(){
        $sql = "SELECT feedbak.id, feedbak.subject, feedbak.feedback, feedbak.created_at, feedbak.uid, feedbak.replied, users.name, users.email FROM feedbak
                INNER JOIN users on feedbak.uid = users.id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
    }

    //function to delete feedback
    public function deleteFeed($id){
        $sql = "DELETE FROM feedbak WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch(PDO:: FETCH_ASSOC);

        return $result;

    }

    //Function To reply to user 
    public function replyFeedback($uid, $message){
        $sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=> $uid, 'message'=> $message]);

        return true;
    }

    //SET FEEDBACK REPLIED
    public function feedbackReplied($fid){
        $sql = "UPDATE feedbak SET replied = 1 WHERE id = :fid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['fid'=> $fid ]);

        return true;
    }

    //function to fetch all Notification
    public function fetchAllNotifications(){
        $sql = "SELECT notification.id, notification.type, notification.message, notification.created_at, users.name, users.email FROM notification
                INNER JOIN users on notification.uid = users.id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
    }
   
    //removing notification from database
    public function removeNotification($id){
        $sql = "DELETE FROM notification WHERE id = :id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        return true;
    }

     //fetch all user from db
     public function exportAllusers(){
        $sql = "SELECT * FROM users";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        
    }

    
}
?>