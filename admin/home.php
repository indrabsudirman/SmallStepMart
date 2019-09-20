<?php

//Initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
} 

?>

<!DOCTYPE HTML>
<html lang ="en">
<head>
    <meta charset ="UTF-8">
    <title> Home </title>
    <link rel="icon" type="image/png" href="../../image/smallsteplogo.png">
    <link rel = "stylesheet" href ="../../bootstrap/dist/css/bootstrap.min.css">
    <style type="text/css">
    body {
        font : 14px sans-serif; text-align:center;
        transition: background-color .5s;
        

        .navbar-text {
            text-align:center;
            float: none;

        }
    }

    

    .sidenav {
      
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #01ad29;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 30px;
  text-decoration: none;
  font-size: 16px;
  color: #ffffff;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #0a3003;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 30px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 0px;
  padding-left: 16px;
  padding-right: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}



    </style>
    </head>
    <body>

        <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="tambahproduk.php">Tambah Produk</a>
  <a href="editproduk.php">Edit Produk</a>
  <a href="#">Penjualan</a>
</div>

<div id="main">
       
<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <div class="container text-white">
  <div style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; Menu</div>
    
    
    <div class="navbar-nav ml-auto">Hi,&nbsp;<b><?php echo htmlspecialchars ($_SESSION["username"]);?></b>&nbsp;&nbsp;<a class= "text-white" href = "logout.php">Keluar</a></div>
  </div>
</nav>
<div class="jumbotron bg-success"> 
<div class="navbar-brandnavbar-nav ml-auto text-white"><a class="navbar-brand text-white" href="home.php">
    <img src="../../image/smallsteplogo.png" width="80" height="80" class="d-inline-block align-center" alt=""><h1>Small Step Mart</h1></a></div>
    <div class="text-white"> <p> Small Step mart adalah Aplikasi Mini Market berbasis Web</p></div>





</div>
<div class="card-deck">
<div class="card text-black bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Summary</b></div>
  <div class="card-body">
    <p class="card-title">Total Produk: <br> Total Penjualan: <br> Total Stock:</p>
    
  </div>
  </div>
<div class="card text-black bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Produk</b></div>
  <div class="card-body">
  <p class="card-title">Total Produk: <br> Total Penjualan: <br> Total Stock:</p>
  </div>
  </div>
  <div class="card text-black bg-info mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Penjualan</b></div>
  <div class="card-body">
  <p class="card-title">Total Produk: <br> Total Penjualan: <br> Total Stock:</p></div>
  </div>
  <div class="card text-black bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Stock</b></div>
  <div class="card-body">
  <p class="card-title">Total Produk: <br> Total Penjualan: <br> Total Stock:</p></div></div>
  </div>
  
  <div class="table-responsive">
  <!--Table-->
  <table class="table table-striped">

    <!--Table head-->
    <thead>
      <tr>
        <th>#</th>
        <th>Produk</th>
        <th>Penjualan</th>
        <th>Stock</th>
        
      </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Kate Kate Kate Kate Kate Kate Kate Kate Kate Kate Kate Kate Kate Kate</td>
        <td>Moss</td>
        <td>USA / The United Kingdom / China / Russia </td>
        
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Anna</td>
        <td>Wintour</td>
        <td>USA / The United Kingdom / China / Russia </td>
        
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>Jerry</td>
        <td>Horwitz</td>
        <td>USA / The United Kingdom / China / Russia </td>
        
      </tr>
    </tbody>
    <!--Table body-->
  </table>
  <!--Table-->
</div>



<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(138,138,138,1)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>





        </body>
        </html>


    
    </body>