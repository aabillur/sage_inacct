<?php
  require_once dirname(__DIR__, 1).'/models/studentDetails.php';
  $studentInfo = new StudentDetails();
  $page_no = 1;

  if (isset($_GET['page_no']) && !empty($_GET['page_no'])) {
      $page_no = $_GET['page_no'];
  }
  $studentDetails = $studentInfo->getCourceDetails($page_no);
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
    <div class="testbox">
      
      <h3><a href="../index.php">Course Registration</a></h3>
    </div>
    <div class="testbox">
      <form action="../controllers/studentReg.php" method="POST">
        <div class="banner">
          <h1></h1>
        </div>
        <input type="hidden" name="student_type" id ="etstudent_type" value="cource">
        <div class="item">
          <p>Course Name</p>
          <div class="name-item">
            <input type="text" name="cname" placeholder="Course Name" />
          </div>
        </div>
        <div class="item">
          <p>Course Details</p>
          <textarea rows="4" cols="50" name="cdetails">
            </textarea>
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
            <th style="width: 250px">Course</th>
            <th style="width: 200px">Operation</th>
          </tr>
          <?php
            foreach ($studentDetails['counrceInfo'] as $key => $value) {
                $courceId = $value['course_id'];
                $cource = $value['cource'];
                $cDetail = $value['c_detail']; ?>
          <tr><td><a onclick="openForm('<?=$courceId?>','<?=$cource?>','<?=$cDetail?>','edit')">Edit</a></td>
          <td><?=$value['cource']?></td>
          <td><a onclick="openForm('<?=$courceId?>','<?=$cource?>','<?=$cDetail?>','delete')">Delete</a></td>
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
    <input type="hidden" name="student_type" id ="etstudent_type" value="cource">
    <input type="hidden" name="type" id ="etype" value="edit">
    <input type="hidden" name="cource_id" id ="ecource_id">
    <label for="fname"><b>Cource</b></label>
    <input type="text" placeholder="Cource Name" id = "ecource" name="cource" required>

    <label for="lname"><b>Cource Detail</b></label>
    <input type="text" placeholder="Cource Details" id = "ecDetail" name="cDetail" required>

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

</body>
<script>
function openForm(id,cource,cDetail,type) {
    document.getElementById("ecource_id").value = id;
    document.getElementById("ecource").value = cource;
    document.getElementById("ecDetail").value = cDetail;
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


