<?php
$con=mysqli_connect("localhost","root","","phpdasar");


//mengambil table di ibaratkan lemari pakaian
function query($query) 
{
global $con;

$result=mysqli_query($con,$query);
$rows=[];
while($row=mysqli_fetch_assoc($result))
	{

	$rows[]=$row;
	}
	return $rows;
}

function tambah($data)
{

 global $con;	

 $nrp = htmlspecialchars($data["jenisProduk"]);
 $nama = htmlspecialchars($data["namaProduk"]);
 $email = htmlspecialchars($data["hargaProduk"]);

 //upload gambar
 $gambar = upload();
 if(!gambar)
 {
 	return false;
 }


$query = "INSERT INTO produk VALUES('','$nrp','$nama','$email','$gambar')";

mysqli_query($con,$query);
return mysqli_affected_rows($con);

}

function hapus($id)
{
global $con;
mysqli_query($con,"DELETE FROM mahasiswa WHERE id= $id");

return mysqli_affected_rows($con);

}

function edit($data)
{
global $con;	
 $id = $data['id'];
 $nrp = htmlspecialchars($data["nrp"]);
 $nama = htmlspecialchars($data["nama"]);
 $email = htmlspecialchars($data["email"]); 
 $gambarLama = htmlspecialchars($data["gambarLama"]);

//cek apakah user pilih gambar baru/tdk
 if($_FILES['gambar']['error']===4)
 {
 	$gambar = $gambarLama;
 }
 else
 {
 	$gambar = upload();
 }
 

$query = "UPDATE mahasiswa SET
			nrp='$nrp',
			nama='$nama',
			email='$email',
			gambar='$gambar'

WHERE id=$id";

mysqli_query($con,$query);
return mysqli_affected_rows($con);


}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

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
 		move_uploaded_file($tmpName,'img/' . $namaFileBaru);
 		return $namaFileBaru;
}

function registrasi($data)
{
	global $con;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($con,$data["password"]);

	$password2 = mysqli_real_escape_string($con,$data["password2"]);

	//cek konfirmasi pass
	if($password !== $password2)
	{
		echo "<script>alert('konfirmasi password tdk sesuai');</script>";
		return false;
	}
	//cek username sudah ada atau belom
	$result=mysqli_query($con,"SELECT username FROM user WHERE username='$username'");
	if(mysqli_fetch_assoc($result))
	{
		echo "<script> alert('username sudah ada');
		 </script>";
		 return false;
	}

	$password = password_hash($password,PASSWORD_DEFAULT);
	
		
	mysqli_query($con,"INSERT INTO user VALUES('','$username','$password')");

	return mysqli_affected_rows($con);
}



//mengambil isi table / ibarat pakaiannnya
// mysqli_fetch_row
// mysqli_fetch_assoc
// mysqli_fetch_array
// mysqli_fetch_object
?>