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


