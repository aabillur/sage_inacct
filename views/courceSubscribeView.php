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
    <style>
      /* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}


/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 558px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      line-height: 50px;
      font-size: 60px;
      color: #fff;
      z-index: 2;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 15px 0 #3263cd; 
      }
      
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color:  #3263cd;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 5px 0 #3263cd;
      color: #3263cd;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }  
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #3263cd;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #5b82d7;
      }
      }
    </style>
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


