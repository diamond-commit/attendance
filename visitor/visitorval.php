    <?php

    require_once __DIR__ . "/../conn.php";
     //bring in the student class with the methods needed

   require_once  __DIR__ . "/../classes/visitor.php";

    // SIGNIN STUDENT
     if($_SERVER["REQUEST_METHOD"] === "POST"){
        // searching 
        

       // signing in visitor
     $name = $_POST["name"];
     $lastname = $_POST["lastname"];
     $middlename = $_POST["middlename"];
     $number = $_POST["number"];
     $purpose = $_POST["purpose"];
     $address = $_POST["address"];
       $visitor = new visitor($conn );
       $signIn = $visitor->signIn($name,$lastname, $middlename,  $number, $purpose, $address);
       if($signIn["success"]){
        echo json_encode(["success"=> true, "message"=> $signIn["message"]]);
       }else{
        echo json_encode(["success"=> false, "message"=> $signIn["message"]]);
       }
      }
       // signout student

       if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $visitor = new visitor($conn);

    if (isset($_GET["id"]) && isset($_GET["name"])) {
        // Counsellor insert/update
        $id   = $_GET["id"];
        $name = $_GET["name"];
        $result = $visitor->counsellor($id, $name);
        echo json_encode(["success" => true, "message" => "counsellor saved"]);
    } if (isset($_GET["id"])) {
        // Signout only
        $id = $_GET["id"];
        $result = $visitor->signOut($id);
        if($result["success"]){
    echo json_encode(["success" => true, "message" => "Signout successful ","redirect"=> "visitor.php"]);
        }
      
    } 
    
}

       ?>