<?php
  require_once dirname(__DIR__, 1).'/models/studentDetails.php';
  $studentInfo = new StudentDetails();
  $page_no = 1;
  if (isset($_GET['page_no']) && !empty($_GET['page_no'])) {
      $page_no = $_GET['page_no'];
  }
  $studentDetails = $studentInfo->getStudentRegDetails($page_no);
  $total_no_of_pages = $studentDetails['pageCount'];
  
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  if ($previous_page < 1) {
      $previous_page = 1;
  }

  if ($next_page > $total_no_of_pages) {
      $next_page = $total_no_of_pages;
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SAGE Intacct</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
      div.scrollmenu {
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
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
      <h3><a href="../index.php">Student Registration</a></h3>
    </div>
    <div class="testbox">
      <form action="../controllers/studentReg.php" method="POST">
        <div class="banner">
          <h1></h1>
        </div>
        <input type="hidden" name="student_type" id ="etstudent_type" value="registration">
        <div class="item">
          <p>First Name</p>
          <div class="name-item">
            <input type="text" name="fname" placeholder="First Name" />
          </div>
        </div>
        <div class="item">
          <p>Last Name</p>
          <input type="text" name="lname" placeholder="Last Name"/>
        </div>
        <div class="item">
          <p>Phone</p>
          <input type="number" name="phone" min="10" max = "10" placeholder="### ### ####"/>
        </div>
        <div class="item">
          <p>D O B</p>
          <input type="date" name="dob" required/>
        </div>
        <div class="btn-block">
          <button type="submit" href="/">Submit</button>
        </div>
      </form>
    </div>
    <div class="testbox">
      <form method="GET" action="index.php">
        <table border="1">
          <tr>
            <th style="width: 200px">Operation</th>
            <th style="width: 250px">First Name</th>
            <th style="width: 250px">Last Name</th>
            <th style="width: 200px">Operation</th>
          </tr>
          <?php
            foreach ($studentDetails['studentInfo'] as $key => $value) {
                $studentId = $value['student_id'];
                $fname = $value['fname'];
                $lname = $value['lname'];
                $dob = $value['dob'];
                $phone = $value['phone']; ?>
          
          <td><a onclick="openForm('<?=$studentId?>','<?=$fname?>','<?=$lname?>','<?=$dob?>','<?=$phone?>','edit')">Edit</a></td>
          <td><?=$value['fname']?></td>
          <td><?=$value['lname']?></td>
          <td><a onclick="openForm('<?=$studentId?>','<?=$fname?>','<?=$lname?>','<?=$dob?>','<?=$phone?>','delete')">Delete</a></td>
          <tr>
          <?php
            }
          ?>
        </table>
    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'> 
        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
    </div>
    <ul class="pagination">
      <?php if ($page_no > 1) {
              echo "<li><a href='?page_no=1'>First Page</a></li>";
          } ?>
          
      <li <?php if ($page_no <= 1) {
              echo "class='disabled'";
          } ?>>
      <a <?php if ($page_no > 1) {
              echo "href='?page_no=$previous_page'";
          } ?>>Previous</a>
      </li>
          
      <li <?php if ($page_no >= $total_no_of_pages) {
              echo "class='disabled'";
          } ?>>
      <a <?php if ($page_no < $total_no_of_pages) {
              echo "href='?page_no=$next_page'";
          } ?>>Next</a>
      </li>
       
      <?php if ($page_no < $total_no_of_pages) {
              echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
          } ?>
    </ul>
      </form>
    </div>
    <div class="form-popup" id="studentReg">
  <form action="../controllers/studentReg.php" class="form-container" method="POST" id = "editForm">
    <input type="hidden" name="student_type" id ="etstudent_type" value="registration">
    <input type="hidden" name="type" id ="etype" value="edit">
    <input type="hidden" name="student_id" id ="estudent_id">
    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="First Name" id = "efname" name="fname" required>

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Last Name" id = "elname" name="lname" required>

    <label for="dob"><b>D O B</b></label>
    <input type="date" placeholder="DOB" id = "edob" name="dob" required>

    <label for="phone"><b>Phone</b></label>
    <input type="number" placeholder="Phone" id = "ephone" name="phone" min="10" max = "10" required>

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

</body>
<script>
function openForm(id,fname,lname,dob,phone,type) {
    document.getElementById("estudent_id").value = id;
    document.getElementById("efname").value = fname;
    document.getElementById("elname").value = lname;
    //document.getElementById("edob").value = dob;
    document.getElementById("ephone").value = phone;
    document.getElementById("etype").value = type;
    if(type == 'delete') {
      if (confirm('Are you sure you want to delete?')) {
        document.getElementById('editForm').submit();
      } else {
        console.log('Something Went Wrong');
      }
    }else{
      document.getElementById("studentReg").style.display = "block";
    }  
}

function closeForm() {
  document.getElementById("studentReg").style.display = "none";
}

</script>
</html>


