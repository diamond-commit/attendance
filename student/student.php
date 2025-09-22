<?php 
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../classes/student.php";
// functions used here are gotten from the classes included
$student = new student($conn);
$getAttendance = $student->attendance();
if (!empty($getAttendance["result"])) {
  $attendance = $getAttendance["result"];
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student</title>
  <link rel="stylesheet" href="student.css">
  <link rel="icon" type="image/png" href="niit.jpeg">

</head>
<body>
  <div style="display: flex;  ">
  <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
  <button style="margin-left: 60%; height: 12%; margin-top: 2%" onclick="location.href='../visitor/visitor.php'" >
    Visitor</button>
    
  <button style="margin-left: 5%; height:12%; margin-top:2%" onclick="location.href='../staff/staff.php'" >
    Staff</button>
  </div>
<center style="margin-top: -1.8rem"><h2>Sign in here if you are a student of NIIT</h2></center><br>

   <div style="display:flex">
      <div class="search-box">
    <form action="studentSearch.php" method="post">
  <input type="text" name="name" style='width:45%'placeholder="Search student... " required />
  <button type="submit">🔍</button>
   </form>
  </div>

   <div>
    <form action="studentdate.php" method="post">
  <input type="date" name="date" style='width:45%'placeholder="Search date... " required />
  <button type="submit">🔍</button>
   </form><br>
  </div>
  </div>
   

<?php if (!empty($attendance)): ?>
  <table>
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

    <?php foreach ($attendance as $info): ?>
      <tr>
        <td><?=htmlspecialchars($info["name"]) ?></td>
        <td><?=htmlspecialchars($info["lastname"]) ?></td>        
 <td><?= !empty($info["middlename"]) ? htmlspecialchars($info["middlename"]) : "..." ?></td>      
        <td><?=htmlspecialchars($info["course"]) ?></td>
        <td><?=htmlspecialchars($info["number"]) ?></td>
        <td><?=htmlspecialchars($info["device"]) ?></td>
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
    <h2>No student signed in yet today....😴</h2> 
  </center>
<?php endif; ?>

<!-- Sign in button -->
<button onclick="document.querySelector('.overlay').style.display='flex'" style="font-family: 'Courier New', Courier, monospace;font-size: 1rem">
  Sign in
</button>

<!-- Popup overlay for info input -->
<div class="overlay">
  <div class="popup">
    <h3>Sign In</h3>
    <form id="form">
      <input type="text" placeholder="FirstName" id="name" name="name" required><br><br>
      <input type="text" placeholder="LastName" id="last" name="lastname" required><br><br>
      <input type="text" id="middle" placeholder="MiddleName (optional)" name="middlename"><br><br>
      <input type="text" placeholder="Course" name="course" required><br><br>
      <input type="text" placeholder="Device" name="device" required><br><br>
      <input type="number" placeholder="Number" maxlength="11" name="number" required><br><br>
          <p style="color:red; display:none" id="error">Something wrong with input</p>
      <button type="submit">Submit</button>
      <button type="button" onclick="document.querySelector('.overlay').style.display='none'">
        Close
      </button>
    </form>
  </div>
</div>

<script src="student.js"></script>
</body>
</html>