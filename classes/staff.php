<?php
     // file has the class student with all methods needed 
     require_once __DIR__ . "/../conn.php";
     // student class 
       class staff {
        private $conn;
        private $name;
        private $course;
        private $device;
        private $role;

        public function __construct( $conn){  
           $this->conn = $conn; 

        }
              // public method to call for sign in
         public function signIn($name,$lastname, $middlename, $course, $device, $role, $number){
          try {
           // sql query to insert sign in info 
            $sql = "INSERT INTO staff(name,lastname, middlename, course, device, role, number) VALUES (?,?,?,?, ?,?,?)";
            // sql injection 
            $stmt = $this->conn->prepare($sql);
            if(!$stmt){
              return ["success"=> false, "message"=> "Saving info failed"];
            }

            if(!$stmt->execute([$name,$lastname, $middlename, $course, $device, $role, $number])){
             return   ["success" => false, "message"=> "Saving info failed"];
                }
              // expected return if all goes well   
            return   ["success" => true, "message"=> "Info saved"];   
              }
               catch (\Throwable $th) {
       return ["success" => false, "message"=> $th->getMessage()];

          }       
         }
         // method to show all people signed in for that day
          public function attendance(){
            try {
              $sql = "SELECT id, name,lastname, middlename, course, role, device, timein ,number, timeout FROM staff WHERE DATE(timein) = CURRENT_DATE";
              $stmt = $this->conn->prepare($sql);
            if(!$stmt){
              return ["success"=> false, "message"=> "Getting info failed"];
              exit;
            }
            if(!$stmt->execute()){
             return   ["success" => false, "message"=> "Getting info failed"];
              exit;
                }
                $result = $stmt->fetchAll(pdo::FETCH_ASSOC);
                if(count($result) >0){
          return   ["success" => true, "message"=> "content has been fetched", "result"=>$result];
                }else{
  return   ["success" => false, "message"=> "content cant be fetched", "result"=>$result];
      }
            } catch (\Throwable $th) {
           return ["success" => false, "message"=> $th->getMessage()];
            }
          }

          // method to call when u wanna signOut
        public function signOut($id) {
    try {
        $sql = "UPDATE staff SET timeout = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ["success" => false, "message" => "Preparing query failed"];
        }

        if (!$stmt->execute([$id])) {
            return ["success" => false, "message" => "Updating sign-out failed"];
        }
        return ["success" => true, "message" => "Signed out successfully"];

       }catch (\Throwable $th) {
           return ["success" => false, "message"=> $th->getMessage()];
            }
      }
//  search function
      public function search($name){
          try {
    $sql = "SELECT id, name,lastname, middlename,  course, device,number, role, timein, timeout FROM staff 
            WHERE LOWER(name) LIKE LOWER(?)  AND DATE(timein) = CURRENT_DATE";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return ["success" => false, "message" => "Preparing query failed"];
        }
        if (!$stmt->execute(["%$name%"])) {
            return ["success" => false, "message" => "staff not found"];
        }
        $result = $stmt->fetchAll(pdo::FETCH_ASSOC);

      if(count($result) >0){
          return   ["success" => true, "message"=> "staff has been found", "result"=>$result];
       } else{
        return   ["success" => false, "message"=> "staff could not be found", "result"=>$result];
      }

          } catch (\Throwable $th) {
                       return ["success" => false, "message"=> $th->getMessage()];
          }
      }
      
      // function to search for staff by date 
      public function dateSearch($date){
        try {
          $sql = "SELECT id, name, lastname, middlename, course, device,number, role, timein, timeout  FROM staff where date(timein) = ?";
           $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return ["success" => false, "message" => "Preparing query failed"];
        }
        if (!$stmt->execute([$date])) {
            return ["success" => false, "message" => "staff not found"];
        }
        $result = $stmt->fetchAll(pdo::FETCH_ASSOC);

      if(count($result) >0){
          return   ["success" => true, "message"=> "staff has been found", "result"=>$result];
       } else{
        return   ["success" => false, "message"=> "staff could not be found", "result"=>$result];
      }
        } catch (\Throwable $th) {
          return ["success" => false, "message"=> $th->getMessage()];
        }
      }
    }
 ?>