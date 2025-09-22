<?php
    require_once __DIR__ . "/../conn.php";
    require_once __DIR__ . "/../classes/staff.php";

        $name = $_POST["name"];
        $staff = new staff($conn);
        $search = $staff->search($name); 
      
      //  echo json_encode(["success"=> true, "result" => $search["result"], "redirect"=> "visitorSearch.php"]);
    $searchResults = $search["result"];
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="staff.css">
    <link rel="icon" type="image/png" href="niit.jpeg">
</head>
<body>
   <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
 <div style="justify-self: end;">
       <button onclick="location.href='staff.php'" >Back 🔙</button>
   </div>
   <?php if (!empty($searchResults)): ?>
  <table>
    <center><h1>Staff has been found...</h1></center>
    <tr>
      <th>FirstName</th>
      <th>LastName</th>
      <th>MiddleName</th>
      <th>Course</th>
      <th>Number</th>
      <th>Device</th>
      <th>Role</th>
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
        <td><?=htmlspecialchars($info["role"]) ?></td>
        <td><?= htmlspecialchars(date("h:i A", strtotime($info["timein"]))) ?></td>

        <?php if ($info["timeout"]): ?>
          <td><?=htmlspecialchars(date("h:i A", strtotime($info["timeout"]))) ?></td>
        <?php else: ?>
          <td> ... </td>

          <td class="action">
            <button data-id="<?=htmlspecialchars($info["id"]) ?>" class="signout">Sign out</button>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table><br><br>
<?php else: ?>
  <center>
    <h2>Staff not found....😴</h2> 
  </center>
<?php endif; ?>
</body>
   <script src="staff.js"></script>
</html>