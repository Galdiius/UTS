<?php
include('functions/koneksi.php');


$query = mysqli_query($mysqli,"SELECT * FROM dosen");



if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $nidn = $_POST['nidn'];
    $jenjang = $_POST['jenjang'];

    mysqli_query($mysqli,"INSERT INTO dosen(nama,nidn,jenjang_pendidikan) VALUES('$nama','$nidn','$jenjang')");

    header("Location:dosen.php");

}else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nidn = $_POST['nidn'];
    $jenjang = $_POST['jenjang'];

    mysqli_query($mysqli,"UPDATE dosen SET nama='$nama',nidn='$nidn',jenjang_pendidikan='$jenjang' WHERE id=$id");
    header("Location:dosen.php");
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
          <a class="nav-link " aria-current="page" href="index.php">Mata Kuliah</a>
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
    <h2>Dosen</h2>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Dosen</button>
            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah dosen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="dosen.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan nama dosen">
                            </div>
                            <div class="form-group">
                                <label for="">NIDN</label>
                                <input type="text" class="form-control" name="nidn" placeholder="Masukan nidn dosen">
                            </div>
                            <div class="form-group">
                                <label for="">Jenjang Pendidikan</label>
                                <select name="jenjang" id="" class="form-control">
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
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
                        <th>NIDN</th>
                        <th>Jenjang Pendidikan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($dosen = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $dosen['nama'] ?></td>
                        <td><?= $dosen['nidn'] ?></td>
                        <td><?= $dosen['jenjang_pendidikan'] ?></td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $dosen['id']; ?>">Edit</button>
                            <a href="functions/hapus.php?table=dosen&&id=<?=$dosen['id']?>" onclick="return confirm('Anda yakin?')" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit<?= $dosen['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Dosen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="dosen.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $dosen['id'] ?>">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Masukan nama dosen" value="<?= $dosen['nama'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">NIDN</label>
                                        <input type="text" class="form-control" name="nidn" placeholder="Masukan nidn dosen" value="<?= $dosen['nidn'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenjang Pendidikan</label>
                                        <select name="jenjang" id="" class="form-control">
                                            <option value="S2" <?= $dosen['jenjang_pendidikan'] == 'S2' ? 'selected' : '' ?>>S2</option>
                                            <option value="S3" <?= $dosen['jenjang_pendidikan'] == 'S3' ? 'selected' : '' ?>>S3</option>
                                        </select>
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