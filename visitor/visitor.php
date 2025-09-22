<?php 
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../classes/visitor.php";
// functions used here are gotten from the classes included
$visitor = new visitor($conn);
$getAttendance = $visitor->attendance();
if (!empty($getAttendance["result"])) {
  $attendance = $getAttendance["result"];
   }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>visitor</title>
  <link rel="stylesheet" href="visitor.css">
    <link rel="icon" type="image/png" href="niit.jpeg">
</head>
<body>
  <div style="display: flex;  ">
  <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
  <button onclick="location.href='../student/student.php'" style="margin-left: 60%; height: 12%; margin-top: 2%; font-family: 'Courier New', Courier, monospace;font-size: 1rem">
  Student  </button>
    
  <button onclick="location.href='../staff/staff.php'" style="margin-left: 5%; height:12%; margin-top:2%; font-family: 'Courier New', Courier, monospace;font-size: 1rem" >
    Staff</button>
  </div>
<center style="margin-top: -1.8rem"><h2>Sign in here if you are a visitor of NIIT</h2></center><br>

<div style="display:flex">
      <div class="search-box">
    <form action="visitorSearch.php" method="post">
  <input type="text" name="name" style='width:45%'placeholder="Search visitor... " required />
  <button type="submit">🔍</button>
   </form>
  </div>

   <div>
    <form action="visitordate.php" method="post">
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
      <th>Number</th>
      <th>purpose</th>
      <th>Address</th>
      <th>Counsellor</th>
      <th>Signed in </th>
      <th>Signed out</th>
      
    </tr>

    <?php foreach ($attendance as $info): ?>
      <tr>
        <td><?=htmlspecialchars($info["name"]) ?></td>
        <td><?=htmlspecialchars($info["lastname"]) ?></td>        
        <td><?= !empty($info["middlename"]) ? htmlspecialchars($info["middlename"]) : "..." ?></td>          
        <td><?=htmlspecialchars($info["number"]) ?></td>

        <td><?=htmlspecialchars($info["purpose"]) ?></td>
         <td><?=htmlspecialchars($info["address"]) ?></td>
    <td><?= !empty($info["counsellor"]) ? htmlspecialchars($info["counsellor"]) : "..." ?></td>

        <td><?= htmlspecialchars(date("h:i A", strtotime($info["timein"]))) ?></td>

        <?php if ($info["timeout"]): ?>
          <td><?=htmlspecialchars(date("h:i A", strtotime($info["timeout"]))) ?></td>
        <?php else: ?>

          <td> ... </td>
          <td class="action">
            <button  data-id="<?=htmlspecialchars($info["id"]) ?>" class="signout">Sign out</button>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table><br><br>
    

<?php else: ?>
  <center>
    <h2>No visitor signed in yet today....😴</h2> 
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
      <input type="text" placeholder="Name" id="name" name="name" required><br><br>
      <input type="text" placeholder="LastName" id="last" name="lastname" required><br><br>
      <input type="text" id="middle" placeholder="MiddleName (optional)" name="middlename"><br><br>
      <input type="number" placeholder="Phone Number" name="number" maxlength="11" required><br><br>
      <input type="text" placeholder="Address..." name="address" max-length="30" required><br><br>
      <label for="">Purpose: </label>
     <select name="purpose">
  <option value="Visitation">Visitation</option>
  <option value="Enquiry">Enquiry</option>
     </select><br>
     <p>Visitation or enquiry</p>

    <p style="color:red; display:none" id="error">Something wrong with input</p>
      <button type="submit">Submit</button>
      <button type="button" onclick="document.querySelector('.overlay').style.display='none'">
        Close
      </button>
    </form>
  </div>
</div>
<!-- counsellor pop up -->
<div class="overlayy">
  <div class="popupp">
    <form action="">
    <h3>Are you sure?</h3>
    
    <label for="">Counsellor?</label><br><br>
    <input type="text" id="counsellor" placeholder="optional..."><br><br><br>
    <div class="btn-row">
      <button id="yes">Yes</button>
      <button class="btn btn-no" onclick="document.querySelector('.overlayy').style.display='none'">No</button>
    </div>
     </form>
  </div>
</div>
<script src="visitor.js"></script>
</body>
</html>