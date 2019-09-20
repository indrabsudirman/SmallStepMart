<?php

require_once "config.php";

$con=mysqli_connect("localhost","root","","smallstepmart");
 

$jenisProduk = $namaProduk = $hargaProduk = $stokProduk = $gambarProduk = $tanggalMasuk = "";
$jenisProduk_err = $namaProduk_err = $hargaProduk_err = $stokProduk_err = $gambarProduk_err = $tanggalMasuk_err = "";

function upload()
{
    global $con;

	$namaFile = $_FILES['gambarProduk']['name'];
	$ukuranFile = $_FILES['gambarProduk']['size'];
	$error = $_FILES['gambarProduk']['error'];
	$tmpName = $_FILES['gambarProduk']['tmp_name'];

// cek apa tidak ada gambar yg di upload
	if($error === 4)
	{
		echo "<script>alert('pilih gambar dahulu');</script>";
		return false;
	}

	$ektensiGambarValid = ['jpg','png','jpeg'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar,$ektensiGambarValid))
	{

		echo "<script>alert('yang di upload bukan gambar');</script>";
		return false;
	}

 	if($ukuranFile > 1000000 )
 		{
 			echo "<script>alert('ukuran terlalu besar');</script>";
 			return false;
 		}
 		//generate nama gambar baru
 			$namaFileBaru = uniqid();
 			$namaFileBaru .= '.';
 			$namaFileBaru .= $ekstensiGambar;
 		// lolos pengcekan
 		move_uploaded_file($tmpName,'/home/indrasudirman/smallstepmart/admin/image/' . $namaFileBaru);
 		return $namaFileBaru;
}
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
    $input_jenisProduk = trim($_POST["jenisProduk"]);
    if(empty($input_jenisProduk)){
        $jenisProduk_err = "Masukkan jenis produk.";
    } elseif(!filter_var($input_jenisProduk, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $jenisProduk_err = "Masukkan jenis produk dengan benar.";
    } else{
        $jenisProduk = $input_jenisProduk;
    }
    
    
    $input_namaProduk = trim($_POST["namaProduk"]);
    if(empty($input_namaProduk)){
        $namaProduk_err = "Masukkan nama produk.";     
    } else{
        $namaProduk = $input_namaProduk;
    }
    
    
    $input_hargaProduk = trim($_POST["hargaProduk"]);
    if(empty($input_hargaProduk)){
        $hargaProduk_err = "Masukkan harga produk.";     
    } else{
        $hargaProduk = $input_hargaProduk;
    }

   
    $input_stokProduk = trim($_POST["stokProduk"]);
    if(empty($input_stokProduk)){
        $stokProduk_err = "Masukkan stok produk.";     
    } elseif(!ctype_digit($input_stokProduk)){
        $stokProduk_err = "Masukkan stok produk dengan benar.";
    } else{
        $stokProduk = $input_stokProduk;
    }

   
    $input_tanggalMasuk = trim($_POST["tanggalMasuk"]);
    if(empty($input_tanggalMasuk)){
        $tanggalMasuk_err = "Masukkan tanggal masuk produk.";     
    } elseif(!strtotime($input_tanggalMasuk)){
        $tanggalMasuk_err = "Masukkan tanggal masuk produk dengan benar.";
    } else{
        $tanggalMasuk = $input_tanggalMasuk;
    }

    // $id = 
    $gambarProduk = $_POST["gambarProduk"];
    $gambarLama = $_POST["gambarLama"];

    // echo "nama gambar produk ".$gambarProduk ; 
    // echo "<br>";
    // echo "nama gambar produk lama ".$gambarLama;

  
    if(empty($_POST['gambarProduk'])){
        $gambarProduk = $gambarLama;
        echo "nama gambar produk lama ".$gambarLama;
   }
   if(isset($_POST['gambarProduk'])) {
    // $gambarProduk = upload();
    echo "nama gambar produk ".$gambarProduk ; 
    echo "<pre>";
print_r($_FILES);
echo "</pre>";
}
    
//     if($_FILES["gambarProduk"]["error"]===4)
//  {
//  	$gambarProduk = $gambarLama;
//  }
//  else
//  {
//  	$gambarProduk = upload();
//  }
    
    
    if(empty($jenisProduk_err) && empty($namaProduk_err) && empty($hargaProduk_err) && empty($stokProduk_err) && empty($tanggalMasuk_err)){
        
        $sql = "UPDATE produk SET jenisProduk=?, namaProduk=?, hargaProduk=?, stokProduk=?, gambarProduk= ?, tanggalMasuk=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "ssdissi", $param_jenisProduk, $param_namaProduk, $param_hargaProduk, $param_stokProduk, $param_gambarProduk, $param_tanggalMasuk, $param_id);
            
            
            $param_jenisProduk = $jenisProduk;
            $param_namaProduk = $namaProduk;
            $param_hargaProduk = $hargaProduk;
            $param_stokProduk = $stokProduk;
            $param_gambarProduk = $gambarProduk;
            $param_tanggalMasuk = $tanggalMasuk;
            $param_id = $id;

            
           
            if(mysqli_stmt_execute($stmt)){

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () {';
                echo 'swal("Berhasil!","Produk berhasil diupdate!","success").then( function(val) {';
                echo 'if (val == true) window.location.href = \'editproduk.php\';';
                echo '});';
                echo '}, 100);  </script>';

                
               

                exit();
            } else{
                //<script>window.alert('Ada kesalahan dalam Update Produk, cek kembali Form yang sudah diisi.');</script>
                echo "Ada kesalahan dalam Update Produk, cek kembali Form yang sudah diisi.";
                // echo "<div id='demo'></div>";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM produk WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $jenisProduk = $row["jenisProduk"];
                    $namaProduk = $row["namaProduk"];
                    $hargaProduk = $row["hargaProduk"];
                    $stokProduk = $row["stokProduk"];
                    $gambarProduk = $row["gambarProduk"];
                    $tanggalMasuk = $row["tanggalMasuk"];
                } else{
                    
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
       
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
        
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../sweetalertmaster/dist/sweetalert.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script type="text/JavaScript"> 

document.getElementById("demo").innerHTML = x; 
Swal.fire({
  title: 'Error!',
  text: 'Do you want to continue',
  type: 'error',
  confirmButtonText: 'Cool'
})
</script>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Produk</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="" method="post">
                        <div class="form-group <?php echo (!empty($jenisProduk_err)) ? 'has-error' : ''; ?>">
                            <label>Jenis Produk</label>
                            <input type="text" name="jenisProduk" class="form-control" value="<?php echo $jenisProduk; ?>">
                            <span class="help-block"><?php echo $jenisProduk_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($namaProduk_err)) ? 'has-error' : ''; ?>">
                            <label>Nama Produk</label>
                            <input type="text" name="namaProduk" class="form-control" value="<?php echo $namaProduk; ?>">
                            <span class="help-block"><?php echo $namaProduk_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($hargaProduk_err)) ? 'has-error' : ''; ?>">
                            <label>Harga Produk</label>
                            <input type="text" name="hargaProduk" class="form-control" value="<?php echo $hargaProduk; ?>">
                            <span class="help-block"><?php echo $hargaProduk_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($stokProduk_err)) ? 'has-error' : ''; ?>">
                            <label>Stok Produk</label>
                            <input type="text" name="stokProduk" class="form-control" value="<?php echo $stokProduk; ?>">
                            <span class="help-block"><?php echo $stokProduk_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($stokProduk_err)) ? 'has-error' : ''; ?>">
                            <label>Gambar Produk</label><br>
                            <img src="../image/<?= $row["gambarProduk"]; ?>" width="50" style="width:150px">
                            <input type="hidden" name="gambarLama" value="<?php echo $row["gambarProduk"]; ?>">
                            
                        
                        <input type="file" name="gambarProduk" accept="image/*" onchange="loadFile(event)">
                            <img id="gambarProduk"/>
                            <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('gambarProduk');
                                output.src = URL.createObjectURL(event.target.files[0]);
                            };
                            </script>
                            </div>
                        <div class="form-group <?php echo (!empty($tanggalMasuk_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal Masuk Produk</label>
                            <input type="text" name="tanggalMasuk" class="form-control" value="<?php echo $tanggalMasuk; ?>">
                            <span class="help-block"><?php echo $tanggalMasuk_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input id="delete-a" type="submit" class="btn btn-primary" value="Submit" id="delete">
                        <a href="editproduk.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <script>


    
    
    </script>
</body>
</html>
