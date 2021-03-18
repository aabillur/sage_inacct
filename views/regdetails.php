<?php
  require_once dirname(__DIR__, 1).'/models/studentDetails.php';
  $studentInfo = new StudentDetails();
  $page_no = 1;
  if (isset($_GET['page_no']) && !empty($_GET['page_no'])) {
      $page_no = $_GET['page_no'];
  }
  $studentDetails = $studentInfo->getAllRegDetails($page_no);
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
      <h3><a href="../index.php">Report</a></h3>
    </div>
    <div class="testbox">
      <form method="GET" action="index.php">
        <table border="1">
          <tr>
            <th style="width: 200px">Student Name</th>
            <th style="width: 250px">Cource</th>
            <th style="width: 250px">Cource Details</th>
          </tr>
          <?php
            foreach ($studentDetails['studentInfo'] as $key => $value) {
                //echo '<tr><td>'.$value['slNo'].'</td>';
                echo '<tr><td>'.$value['fname'].' '.$value['lname'].'</td>';
                echo '<td>'.$value['cource'].'</td>';
                echo '<td>'.$value['c_detail'].'</td></td>';
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
  

</body>

</html>


