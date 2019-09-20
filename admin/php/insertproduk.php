<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "smallstepmart");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$hargaProduk ='null';

function upload()
{
    global $link;

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

$gambarProduk = upload();
if(!$gambarProduk)
 {
 	return false;
 }

//  echo "nilai gambar produk: ".$gambarProduk;


// $gambarProduk = isset($_POST['gambarProduk']) ? $_POST['gambarProduk'] : null;

// $gambarProduk = $_REQUEST['gambarProduk'];



$hargaProduk = (float)$hargaProduk;
if ($hargaProduk===$hargaProduk) {
	echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () {';
                echo 'swal("Gagal!","Harga Produk harus angka!","error").then( function(val) {';
                echo 'if (val == true) window.location.href = \'tambahproduk.php\';';
                echo '});';
                echo '}, 100);  </script>';
}	
 
// Prepare an insert statement
$sql = "INSERT INTO produk (jenisProduk, namaProduk, hargaProduk, stokProduk, gambarProduk) VALUES (?, ?, ?, ?, ?)";

	
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssdis", $jenisProduk, $namaProduk, $hargaProduk, $stokProduk, $gambarProduk);
    
    // Set parameters
    $jenisProduk = $_REQUEST['jenisProduk'];
	$namaProduk = $_REQUEST['namaProduk'];
	$hargaProduk = $_REQUEST['hargaProduk'];
	$stokProduk = $_REQUEST['stokProduk'];

    
    
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () {';
                echo 'swal("Berhasil!","Produk berhasil ditambah!","success").then( function(val) {';
                echo 'if (val == true) window.location.href = \'tambahproduk.php\';';
                echo '});';
                echo '}, 100);  </script>';
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}
 
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($link);
?>