<?php
    require_once dirname(__DIR__, 1).'/models/studentDetails.php';
    $studentInfo = new StudentDetails();
    $studenList = $studentInfo->getStudentList();
    $courceList = $studentInfo->getCourceList();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SAGE Intacct</title>
     <link rel="stylesheet" href="web/styles.css">
  </head>
  <body>
    <div class="scrollmenu">
      <a href="studentView.php">Student</a>
      <a href="courceView.php">Cource</a>
      <a href="courceSubscribeView.php">Subscribe</a>
      <a href="regdetails.php">Reports</a>
   </div>
    <div class="testbox">   
      <h3><a href="../index.php">Students subscribe to Course</a></h3>
    </div>
    <div class="testbox">
      <form action="../controllers/studentReg.php" method="POST">
        <div class="banner">
          <h1></h1>
        </div>
        <input type="hidden" name="student_type" id ="etstudent_type" value="cource_subscribe">
        <div class="item">
          <select name = "student">
              <option value="">Select Student</option>
              <?php
                  foreach ($studenList as $key => $value) {
                      echo '<option value='.$value['student_id'].'>'.$value['fname'].' '.$value['lname'].'</option>';
                  }
              ?>
          </select>

          <select name = "cource">
              <option value="">Select Cource</option>
              <?php
                  foreach ($courceList as $key => $value) {
                      echo '<option value='.$value['course_id'].'>'.$value['cource'].'</option>';
                  }
              ?>
          </select>
        </div>
        
        <div class="btn-block">
          <button type="submit" href="/">Submit</button>
        </div>
      </form>
    </div>
</body>
</html>


