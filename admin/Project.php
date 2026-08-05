<?php

/** @var mysqli $conn */

//tampilin semua data dri table use, urutan dari yang besar ke kecil
$query = mysqli_query($conn, "SELECT * FROM project ORDER BY id DESC"); //* ALL asc kecil ke besar 
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika parameter delete ada 
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $img = mysqli_query($conn, "SELECT image FROM project WHERE id='$delete'");
  $rowImg = mysqli_fetch_assoc($img);

  $old_picture_path = "assets/img/" . $rowImg['image'];
  if (file_exists($old_picture_path)) {
    unlink($old_picture_path); //untuk mengganti gambar lamaa ke yang baru tpi gambar lama hilang
  }

  $delete = mysqli_query($conn, "DELETE FROM project WHERE id='$delete'");
  header("location:app.php?page=project&hapus=berhasil");
}

?>
<div
  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
  <div>
    <h3 class="fw-bold mb-3">Project</h3>
  </div>
  <div class="ms-md-auto py-2 py-md-0">
    <a href="app.php?page=create-projects" class="btn btn-primary btn-round">Create New Project</a>
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-md-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <!-- table-bordere untuk membuat 
                      table-striped untuk mengubah warna setiap table ganjil genap-->
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>image</th>
              <th>Subtitle</th>
              <th>Link</th>
              <th>Action</th>
            </tr>
          </thead>
          <tb>
            <!-- tb>tr>td untuk membuat langsung -->
            <?php
            foreach ($rows as $index => $row): ?>
              <tr>
                <td><?php echo $index += 1 ?></td>
                <td><?php echo $row['title']  ?></td>
                <td>
                  <img src="assets/img/<?= $row['image'] ?>" width="170" alt="">
                  <!-- ? dan = adalah echo php -->
                </td>
                <td><?php echo $row['subtitle'] ?></td>
                <td><?php echo $row['link'] ?></td>
                <td>
                  <a class="btn btn-success btn-sm"
                    href="app.php?page=create-projects&edit=<?php echo $row['id'] ?>
                            ">Edit</a>
                  <!-- edit dan delete = sama dengan parameter yang dimana dia mempunyai id -->
                  <a onclick="return confirm('Are you sure wanna delete this data?')" class="btn btn-danger btn-sm"
                    href="app.php?page=project&delete=<?php echo $row['id'] ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tb>
        </table>
      </div>
    </div>
  </div>
</div>