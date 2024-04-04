<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 



    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BookNest |  Issued Books</title>
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
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <!-- <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Issued Books</h4>
    </div> -->
    
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Books</title>
  <!-- Assuming FontAwesome is used for the icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Additional CSS can be included here for styling */
    /* For demonstration purposes, some basic styling is included */
    .container {
      margin: 0 auto;
      max-width: 910px;
    }
    .choose {
      width: 100%;
      height: 40px;
    }
    .fa {
      margin-right: 20px;
      font-size: 30px;
      color: gray;
      float: right;
    }
    .books-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .book {
      width: 230px;
      height: 390px;
      box-shadow: 0 0 20px #aaa;
      margin: 25px;
      padding: 10px;
      vertical-align: top;
      transition: height 1s;
      position: relative; /* Added for positioning */
    }
    .cover {
      border: 2px solid gray;
      height: 68%;
      overflow: hidden;
    }
    .cover img {
      width: 100%;
    }
    .book p {
      margin-top: 12px;
      font-size: 20px;
    }
    .book .author {
      font-size: 15px;
    }
    .book .category {
      font-size: 14px;
      color: #555;
      margin-bottom: 5px;
    }
    .book .already-issued {
      position: relative;
      bottom: 15px;
      left: 0;
      width: 100%;
      text-align: center;
      background-color: rgba(255, 0, 0, 0.5);
      /* padding: 5px 0; */
      border-radius: 5px;
      color: white;
      font-size: 14px;
      /* padding-top: 2px; */
    }
    @media (max-width: 941px) {
      .container {
        max-width: 700px;
      }
      .book {
        margin: 49px;
      }
    }
    @media (max-width: 730px) {
      .book {
        width: 100%;
        margin: 0 auto 50px auto;
      }
    }
    #list-th:target .book {
      height: 100px;
      width: 250px;
      margin: 25px auto;
    }
    #list-th:target .cover {
      width: 246px;
    }
    #list-th:target img {
      opacity: .1;
    }
    #list-th:target p {
      margin-top: -62px;
      margin-left: 20px;
    }
  </style>
</head>
<body>
  <div id="large-th">
    <div class="container">
      <br>
      <div id="list-th">
        <div class="books-container">
          <?php
          $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid, tblbooks.bookImage, tblbooks.isIssued FROM tblbooks JOIN tblcategory ON tblcategory.id=tblbooks.CatId JOIN tblauthors ON tblauthors.id=tblbooks.AuthorId";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {
          ?>
              <div class="book read">
                <div class="cover">
                  <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" alt="Book Cover">
                </div>
                <div class="description">
                  <p class="title"><b><?php echo htmlentities($result->BookName); ?></b><br>
                    <span class="author"><b><?php echo htmlentities($result->AuthorName); ?></b></span><br>
                    <span class="category"><?php echo htmlentities($result->CategoryName); ?></span>
                  </p>
                  <?php if ($result->isIssued == '1') : ?>
                    <p class="already-issued">Book Already issued</p>
                  <?php endif; ?>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>



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
