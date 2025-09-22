<?php 
       require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../classes/student.php";
    $rawdate = $_POST["date"];
    // just for printing purpose 
$date = new DateTime($rawdate);    
$aestheticDate = $date->format("d-m-y");  

    $student = new student($conn);
     $search = $student->dateSearch($rawdate);

     $searchResults = $search["result"];
   //  var_dump($search);     
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="student.css">
</head>
<body>
     <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
 <div style="justify-self: end;">
       <button onclick="location.href='student.php'" >Back 🔙</button>
   </div>
   <?php if (!empty($searchResults)): ?>
  <table>
    <center><h1>Student has been found...</h1></center>
    <tr>
      <th>FirstName</th>
      <th>LastName</th>
      <th>MiddleName</th>
      <th>Course</th>
      <th>Number</th>
      <th>Device</th>
      <th>Signed in</th>
      <th>Signed out</th>
    </tr>

    <?php foreach ($searchResults as $info): ?>
      <tr>
        <td><?=htmlspecialchars($info["name"]) ?></td>
        <td><?=htmlspecialchars($info["lastname"]) ?></td> 
 <td><?= !empty($info["middlename"]) ? htmlspecialchars($info["middlename"]) : "..." ?></td>              
        <td><?= !empty($info["course"]) ? htmlspecialchars($info["course"]) : "..." ?></td>
        <td><?=htmlspecialchars($info["number"]) ?></td>
        <td><?=htmlspecialchars($info["device"]) ?></td>
        <td><?= htmlspecialchars(date("h:i A", strtotime($info["timein"]))) ?></td>

        <?php if ($info["timeout"]): ?>
          <td><?=htmlspecialchars(date("h:i A", strtotime($info["timeout"]))) ?></td>
        <?php else: ?>
          <td> ... </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table><br><br>
<?php else: ?>
  <center>
    <h2>No student signed in on the <?=htmlspecialchars($aestheticDate) ?>....😴</h2> 
  </center>
<?php endif; ?>
</body>
</html>