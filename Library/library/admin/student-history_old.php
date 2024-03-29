<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:http://localhost/Library/library/homepage/index.php');
}
else{ 

// code for block student    
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update tblstudents set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-students.php');
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update tblstudents set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-students.php');
}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GRANTH | Student History</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');
include_once '../Admin.php'?>

<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <?php $collegeid=$_GET['collegeid']; 
                ?>
                <h4 class="header-line"> Book Issued History - <?php echo $collegeid;?></h4>
    </div>


        </div>
        
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">

 Details
                        </div>
                        <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <!-- <div class="panel panel-default">
                        <div class="panel-heading">
                          Issued Books 
                        </div> -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Id</th>
                                            <th>Student Name</th>
                                            <th>Email Id</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Book Name</th>
                                            <th>Status</th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Fine(INR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
    include_once 'Admin.php';
    $collegeid = $_SESSION['collegeid'];
    $x = $o->getUserIssuedBooks($collegeid);
    $fine = 0;
    for($i=0;$i<mysqli_num_rows($x);$i++)
    { 
     $rs = mysqli_fetch_row($x);
     echo "<tr>";
     for($k=0;$k<count($rs)-1;$k++)
     {
        echo "<td>$rs[$k]</td>";
     }
     if($rs[count($rs)-1]<=0)
       $fine=0;
     else
       $fine=$rs[count($rs)-1]*10;
    echo "<td>",$fine,"</td>";
    //  echo "<td><a href=ReturnBook.php?n=$rs[0]&f=$fine>Return</a></a></td>";
     echo "</tr>";
    }
  ?>
  </table>
  <pre>






  

  
  </pre>

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
