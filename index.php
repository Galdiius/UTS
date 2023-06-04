<?php
include('functions/koneksi.php');


$query = mysqli_query($mysqli,"SELECT * FROM matakuliah");



if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($mysqli,"INSERT INTO matakuliah(nama,kode_matakuliah,deskripsi) VALUES('$nama','$kode','$deskripsi')");

    header("Location:index.php");

}else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($mysqli,"UPDATE matakuliah SET nama='$nama',kode_matakuliah='$kode',deskripsi='$deskripsi' WHERE id=$id");
    header("Location:index.php");
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">UTS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Mata Kuliah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dosen.php">Dosen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container pt-4">
    <h2>Mata Kuliah</h2>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah mata kuliah</button>
            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah mata kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan nama mata kuliah">
                            </div>
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Masukan kode mata kuliah">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="" cols="5" rows="5" placeholder="Masukan deskripsi mata kuliah"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode mata kuliah</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($matkul = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $matkul['nama'] ?></td>
                        <td><?= $matkul['kode_matakuliah'] ?></td>
                        <td><?= $matkul['deskripsi'] ?></td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $matkul['id']; ?>">Edit</button>
                            <a href="functions/hapus.php?table=matakuliah&&id=<?=$matkul['id']?>" onclick="return confirm('Anda yakin?')" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit<?= $matkul['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit mata kuliah</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="index.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $matkul['id'] ?>">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukan nama mata kuliah" value="<?= $matkul['nama'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kode</label>
                                        <input type="text" class="form-control" name="kode" placeholder="Masukan kode mata kuliah" value="<?= $matkul['kode_matakuliah'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" id="" cols="5" rows="5" placeholder="Masukan deskripsi mata kuliah"><?= $matkul['deskripsi'] ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>