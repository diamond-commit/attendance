 <?php
    require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../classes/staff.php";
// functions used here are gotten from the classes included
$staff = new staff($conn);
$getAttendance = $staff->attendance();
if (!empty($getAttendance["result"])) {
  $attendance = $getAttendance["result"];
   }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="staff.css">
      <link rel="icon" type="image/png" href="niit.jpeg">
</head>
<body>
  <div style="display: flex;  ">
  <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
  <button onclick="location.href='../student/student.php'" style="margin-left: 60%; height: 12%; margin-top: 2%; font-family: 'Courier New', Courier, monospace;font-size: 1rem">
  Student  </button>
  <button onclick="location.href='../visitor/visitor.php'" style="margin-left: 5%; height:12%; margin-top:2%; font-family: 'Courier New', Courier, monospace;font-size: 1rem" >
    Visitor</button>
  </div>

    <center style="margin-top: -1.8rem"><h2>Sign in here if you are a staff of NIIT</h2></center><br>
   <div style="display:flex">
      <div class="search-box">
    <form action="staffSearch.php" method="post">
  <input type="text" name="name" style='width:45%'placeholder="Search staff... " required />
  <button type="submit">🔍</button>
   </form>
  </div>

   <div>
    <form action="staffdate.php" method="post">
  <input type="date" name="date" style='width:45%'placeholder="Search date... " required />
  <button type="submit">🔍</button>
   </form><br>
  </div>
  </div>

   <?php if (!empty($attendance)): ?>
  <table>
    <tr>
      <th>FirstName</th>
      <th>Lastname</th>
      <th>Middlename</th>
      <th>Course</th>
      <th>Number</th>
      <th>Device</th>
      <th>Role</th>
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
    <h2>No staff signed in yet today....😴</h2> 
  </center>
<?php endif; ?>

<button onclick="document.querySelector('.overlay').style.display='flex'" style="font-family: 'Courier New', Courier, monospace;font-size: 1rem">
  Sign in
</button>
<!-- sign in popup -->
    <div class="overlay">
  <div class="popup">
    <h3>Sign In</h3>
    <form id="form">
      <input type="text" id="name" placeholder="Name" name="name" required><br><br>
       <input type="text" id="last" placeholder="LastName" name="lastname" required><br><br>
      <input type="text" id="middle" placeholder="MiddleName (optional)" name="middlename"><br><br>
      <input type="text" placeholder="Course" name="course" required><br><br>
      <input type="text" placeholder="Device" name="device" required><br><br>
      <input type="text" placeholder="Role" name="role" required><br><br>
      <input type="number" placeholder="phone number" name="number" maxlength="11" required><br>
      <p style="color:red; display:none;"  id="error">Something wrong with input</p>
      <button type="submit" >Submit</button>
      <button type="button" onclick="document.querySelector('.overlay').style.display='none'">
        Close
      </button>
    </form>
  </div>
</div>
   <script src="staff.js"></script>
</body>
</html>