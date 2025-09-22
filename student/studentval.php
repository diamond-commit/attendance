    <?php

    require_once __DIR__ . "/../conn.php";
     //bring in the student class with the methods needed

   require_once  __DIR__ . "/../classes/student.php";

    // SIGNIN STUDENT
     if($_SERVER["REQUEST_METHOD"] === "POST"){
     
     $name = $_POST["name"];
     $lastname = $_POST["lastname"];
     $middlename = $_POST["middlename"];
     $course = $_POST["course"];
     $device = $_POST["device"];
     $number = $_POST["number"];
       $student = new student($conn);
       $signIn = $student->signIn($name,$lastname, $middlename,  $course, $device, $number);
       if($signIn["success"]){
        echo json_encode(["success"=> true, "message"=> $signIn["message"]]);
       }else{
        echo json_encode(["success"=> false, "message"=> $signIn["message"]]);
       }
      }
       // signout student
       if($_SERVER["REQUEST_METHOD"] === "GET"){
        $id = $_GET["id"];
        $student = new student($conn);
        $signout = $student->signOut($id);
         if($signout["success"]){
        echo json_encode(["success"=> true, "message"=> $signout["message"], "redirect"=> "student.php"]);
        
        exit;
       }else{
        echo json_encode(["success"=> false, "message"=> $signout["message"]]);
       }
       }
    ?>