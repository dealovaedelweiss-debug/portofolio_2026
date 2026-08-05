<?php

/** @var mysqli $conn */

//tampilin semua data dri table use, urutan dari yang besar ke kecil
$query = mysqli_query($conn, "SELECT * FROM settings LIMIT 1"); //* ALL asc kecil ke besar, limit untuk memunculkan 1 data yang muncul 
$row = mysqli_fetch_assoc($query);

//jika button save ditekan 
if (isset($_POST['save'])) {
  $website_name = $_POST['website_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $ig = $_POST['ig'];
  $address = $_POST['address'];
  $description = $_POST['description'];
  $id = $row['id']?? '';
  //jika data didalam table setting aada
  if ($row) {
    mysqli_query($conn, "UPDATE settings SET website_name = '$website_name', 
    email = '$email', 
    phone = '$phone', 
    ig = '$ig', 
    address = '$address', 
    description ='$description' WHERE id = '$id' 
    ");
  }else{
    mysqli_query($conn, "INSERT INTO settings (website_name, email, phone, ig, address, description)
    VALUES('$website_name', '$email', '$phone', '$ig', '$address', '$description')");
  }
  header("location:app.php?page=setting");
}

//jika parameter delete ada 
if(isset($_GET['delete'])){
  $delete = $_GET['delete'];
  $delete = mysqli_query($conn, "DELETE FROM users WHERE id='$delete'");
  header("location:app.php?page=setting&hapus=berhasil");
}

?>
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Setting</h3>
            </div>  
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Website Name</label>
                            <input type="text" name="website_name" class="form-control" required value="<?php echo isset($row) ? $row['website_name'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Phone</label>
                            <input type="number" name="phone" class="form-control"  required value="<?php echo isset($row) ? $row['phone'] : '' ?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" required value="<?php echo isset($row) ? $row['email'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Instagram Link</label>
                            <input type="text" name="ig" class="form-control" required value="<?php echo isset($row) ? $row['ig'] : '' ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Address</label>
                            <textarea name="address" class="form-control" id=""><?php echo isset($row) ? $row['address'] : '' ?></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" id="" ><?php echo isset($row) ? $row['description'] : '' ?></textarea>
                          </div>
                          <button class="btn btn-primary" type="submit" name="save">Save</button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

