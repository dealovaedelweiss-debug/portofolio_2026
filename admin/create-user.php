<?php

/** @var mysqli $conn */

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
$row = mysqli_fetch_assoc($query);
if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'] ? $_POST['password'] : $row['password'];
  $pass = sha1($password);

  $chekemail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
  $showemail = mysqli_fetch_assoc($chekemail);
  if ($showemail) {
    header("location:app.php?page=crete-user&email=gagal");
  }
  //masukan ke dalam table users, sebutkan kolom di table user yang nilanya
  //diambil dari user ketika menginput data
  if ($id) {
    //query update
    $update = mysqli_query($conn, "UPDATE users SET name='$name', email ='$email', password = '$pass' WHERE id='$id'");
    header("location:app.php?page=user&update=berhasil");
  } else {
    $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES('$name','$email','$pass')");
    header("location:app.php?page=user&tambah=berhasil");
  }
}
//tampilin semua data dri table use, urutan dari yang besar ke kecil
//* ALL asc kecil ke besar 

?>
<div
  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
  <div>
    <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit User' : 'Create New User' ?></h3>
    <!-- <h6 class="op-7 mb-2">Hallo, Selamat Bergabung</h6> -->
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-md-12">
    <div class="card">
      <div class="card-body">
        <?php
        if (isset($_GET['email']) && $_GET['email'] == 'gagal') {
        ?>
          <div class="alert alert-danger" role="alert">
            Email sudah digunakan!
          </div>

        <?php
        }
        ?>

        <form action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label fw-bold">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" required
              value="<?php echo ($id) ? $row['name'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter Email" required
              value="<?php echo ($id) ? $row['email'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bold">
              <?php echo ($id) ?
                'password <small class="text-secondary">(leave blank if you dont not
                        wish to change it)</small>' : 'password' ?>
            </label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" <?php echo ($id) ? '' : 'required' ?>>
          </div>
          <button class="btn btn-primary" name="save" type="submit">
            Save
          </button>
        </form>
      </div>
    </div>
  </div>
</div>