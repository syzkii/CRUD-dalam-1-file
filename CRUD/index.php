<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD barang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
    body {
    background: #B3FFAB;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #12FFF7, #B3FFAB);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #12FFF7, #B3FFAB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    } 
</style>
</head>
<body>
<?php

$koneksi = mysqli_connect("localhost","root","","buat_sosmed");

function tambah($koneksi){
    if(isset($_POST['btn_simpan'])){
        $id = time();
        $nama = $_POST['nama'];
        $status = $_POST['status'];

    if(!empty($nama) && !empty($status)){
         $sql = "INSERT INTO sosmed (id, nama, status) VALUES ('$id','$nama','$status')";
        $simpan = mysqli_query($koneksi, $sql);
    if($simpan && isset($_GET['aksi']) ){
    if($_GET['aksi'] == 'create'){
                    header('Location: index.php');
                }
            }
        }else{
            $pesan = "<p style='color: red'>Tidak dapat menyimpan atau data belum lengkap!</p>";
        }
    }

?>
<form action="" method="post">
<h3 style="margin-top:10px;  ">Tambah Data</h3>
<hr style="height:1px;border-width:0;color:gray;background-color:grey">
    <table border="0">
    <tr>
        <input type="hidden" name="id">
    </tr>
    <tr>
    <h5><font face="comic sans ms">Nama <input type="text" class="form-control" name="nama" /></h5> <br></font>
    </tr>
    <tr>
    <h5><font face="comic sans ms">Status Barang <input type="text" class="form-control" name="status" /></h5> <br></font>
    </tr>
    <tr>
    <td colspan='2'>
        <button type="submit" name="btn_simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-danger"><i class="fa fa-reply-all"></i> Bersihkan</button>
    </tr>
    </table>
    <p><?php echo isset($pesan) ? $pesan : "" ?></p>
</form>
<br><br>
<?php 

}


function tampil_data($koneksi){
    $sql = "SELECT * FROM sosmed";
    $query = mysqli_query($koneksi, $sql);
    echo"<h3 style='margin-top:0px;'>Data Barang</h3>";
    echo"<table  class='table table-striped table-dark' class='table-hover' class='table-bordered' border='2'>";
    echo"<tr>
    <hr>
        <th>ID</th>
        <th>Nama</th>
        <th>Status</th>
        <th><center>Opsi</th></center>
        </tr>";
    $id = 1;
    while($data = mysqli_fetch_array($query)){

        ?>
        <tr>
            <td><?php echo $id++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['status']; ?></td>
            <td>
                <a href="index.php?aksi=update&id=<?= $data['id']; ?>&nama=<?= $data['nama']; ?>&status=<?= $data['status']; ?>" class="btn btn-warning"><i class="fa fa-edit">Edit</i></a>
                <a href="index.php?aksi=delete&id=<?= $data['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o">Hapus</i></a>
            </td>
        </tr>
<?php
}
"</table>";
}


function ubah($koneksi){
    if(isset($_POST['btn_ubah'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $status = $_POST['status'];

        if(!empty($nama) && !empty($status)){
            $sql_update = "UPDATE sosmed SET nama='$nama', status='$status' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('Location: index.php');
                }
            }
        }else{
            $pesan = "Data Tidak Lengkap!";
        }
    }
    if(isset($_GET['id'])){
        ?>


        <a href="index.php" class="btn btn-info"><i class="fa fa-home"></i> Home</a> &nbsp;
            <a href="index.php?aksi=create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr style="height:1px;border-width:0;color:gray;background-color:grey">
            <form action="" method="POST">
            <h2>Ubah data</h2>
            <table>
            <tr>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
            </tr>
                <tr>
                      <h5><font face="comic sans ms">Nama <input type="text" class="form-control" name="nama" /></h5> <br></font><value="<?php echo $_GET['nama'] ?>"/></td>
                </tr>
                <tr>
                      <h5><font face="comic sans ms">Status Barang <input type="text" class="form-control" name="status" /></h5> <br></font><value="<?php echo $_GET['status'] ?>"/></td>
                </tr>
                <tr>
                <td>
                    <button type="submit" name="btn_ubah" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
                </td>
                <td>
                <a href="index.php?aksi=delete&id=<?php echo $_GET['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i>HAPUSS</a>
                </td>
                </tr>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
               
            </form>
        <?php
    }
   
}
// --- Tutup Fungsi Update
// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id']) && isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM sosmed WHERE id=" . $id;
        $hapus = mysqli_query($koneksi, $sql_hapus);
       
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('Location: index.php');
            }
        }
    }
   
}
// --- Tutup Fungsi Hapus
// ===================================================================
// Dari semua elemen
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="index.php" class="btn btn-info"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
    tambah($koneksi);
    tampil_data($koneksi);
}
?>
</body>
</html>