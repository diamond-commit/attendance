<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    body{
        font-family:'Courier New', Courier, monospace;
        background-color: white;
    }
    button{
        cursor: pointer;
        background-color: #444; 
         padding: 0.3rem 0.6rem;
        color: white;
        font-family: 'Courier New', Courier, monospace;
        font-size: 1rem;
        border-radius: 10%;

    }
</style>
<body>
      <img src="niit.jpeg" style="margin-left: 0.8rem" alt="">
     <center style="margin-top: -2.5rem"><h1>Attendance page </h1>
      <h3>Sign in for today</h3> </center>
        <div >
            <button onclick="location.href='student/student.php'" style="margin-left: 10rem;"> Student</button>
            <button onclick="location.href='staff/staff.php'" style="margin-left: 13rem;">Staff</button>
            <button onclick="location.href='visitor/visitor.php'" style="margin-left: 10rem;">Visitor</button>
        </div>
</body>
</html>