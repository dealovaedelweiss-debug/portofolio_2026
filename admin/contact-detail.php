<?php

/** @var mysqli $conn */

$id = isset($_GET['id']) ? $_GET['id'] : '';
//tampilin semua data dri table use, urutan dari yang besar ke kecil
$query = mysqli_query($conn, "SELECT * FROM contacts WHERE id = '$id'"); //* ALL asc kecil ke besar 
$row = mysqli_fetch_assoc($query);

//jika parameter delete ada 
if(isset($_GET['delete='])){
  $delete = $_GET['delete'];
  $delete = mysqli_query($conn, "DELETE FROM contacts WHERE id='$delete'");
  header("location:capp.php?page=contact&hapus=berhasil");
}

?>
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Contact</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
              <!-- <a href="create-user.php" class="btn btn-primary btn-round">Create New contact</a> -->
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label for="">Name</label>
                      <input type="text" readonly class="form-control" value="<?= $row['name'] ?>">
                    </div>
                    <div class="col-md-4">
                      <label for="">Email</label>
                      <input type="text" readonly class="form-control" value="<?= $row['email'] ?>">
                    </div>
                    <div class="col-md-4">
                      <label for="">Subject</label>
                      <input type="text" readonly class="form-control" value="<?= $row['subject'] ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    <label for="">Message</label>
                    <textarea class="form-control" readonly><?= $row['message'] ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>