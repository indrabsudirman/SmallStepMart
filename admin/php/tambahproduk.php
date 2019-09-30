<?php

//Initialize the session
session_start();

//Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
    exit();
}


?>

<!DOCTYPE HTML>
<html lang ="en">
<head>
    <meta charset ="UTF-8">
    <title> Tambah Produk </title>
    <link rel="icon" type="image/png" href="../../image/smallsteplogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

.custom-size-btn {
            width: 120px;        

        }

        <style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: Green;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: Green;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
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
    <img src="../image/smallsteplogo.png" width="80" height="80" class="d-inline-block align-center" alt=""><h1>Small Step Mart</h1></a></div>
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
  
  <div class="card">
  <h5 class="card-header bg-success"><b>Form Tambah Produk</b></h5>
  <div class="card-body">
    
  
<div class = "container">

<form action="insertproduk.php" method="post" enctype="multipart/form-data">
  <div class="form-group row" id="jenisProduk">
    <label for="jenisProduk" class="col-sm-2 col-form-label">Jenis Produk:</label>
    <select class ="form-control col-md-4" name="jenisProduk" id="jenisProduk" required>
                <option value="" disable selected> Pilih Jenis Produk</option>
                <option value="Susu">Susu</option>
                <option value="Perlengkapan Memasak">Perlengkapan Memasak</option>
                <option value="Perlengkapan Mandi">Perlengkapan Mandi</option>
                <option value="Perlengkapan Sekolah">Perlengkapan Sekolah</option>
            </select>
            
      
    
  </div>
  <div class="form-group row">
    <label for="namaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
    
    <input class = "form-control col-md-4" type="text" name="namaProduk" id="namaProduk" required>
    </div>
    <div class="form-group row">
    <label for="hargaProduk" class="col-sm-2 col-form-label">Harga Produk</label>
    
    <input class = "form-control col-md-4" type="text" name="hargaProduk" id="hargaProduk" required>
    </div>
    <div class="form-group row">
    <label for="stokProduk" class="col-sm-2 col-form-label">Stok Produk</label>
    
    <input class = "form-control col-md-4" type="number" name="stokProduk" id="stokProduk" required>
    </div>
    <div class="form-group row">
    <label for="gambarProduk" class="col-sm-2 col-form-label">Gambar Produk</label>
    
    <input class = "form-control col-md-4" type="file" name="gambarProduk" id="gambarProduk" required>
    </div>
    <input type="submit" class="btn custom-size-btn mr-4 btn-outline-success btn-rounded z-depth-0 my-4 waves-effect" value="Submit">
        <input type="reset" class="btn custom-size-btn btn-outline-success btn-rounded z-depth-0 my-4 waves-effect" value="Reset">
  </div>
</form>
  

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

//Material Select Initialization
$('#jenisProduk').find(":selected").text();
</script>


</body>
</html>





       


    






