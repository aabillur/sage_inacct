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


