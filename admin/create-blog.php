<?php
session_start(); //wajib di palingh atsa
session_regenerate_id();
include "config/koneksi.php";
/** @var mysqli $conn */
if (!isset($_SESSION['NAME'])){
  header("location:index.php");
  exit();
}
//jika tombol save di tekan 
$id = isset($_GET['edit'])?$_GET['edit']:'';
$query = mysqli_query($conn, "SELECT * FROM blog WHERE id = '$id'"); 
$row = mysqli_fetch_assoc($query);

if (isset($_POST['save'])){
  $title = $_POST['title'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $image = $_FILES['image'];
  $is_active = $_POST['is_active'];

  if ($image['error'] == 0) {
    $filename = uniqid() . "_" . basename($image['name']);
    $filepath = "assets/img/".$filename;
    if ($id && !empty ($row['image'])) {
      $old_picture_path = "assets/img/" . $row['image'];
      if (file_exists($old_picture_path)) {
        unlink($old_picture_path); //untuk mengganti gambar lamaa ke yang baru tpi gambar lama hilang
      }
    }
    //tempat untuk menyimpan fotonya
    move_uploaded_file($image['tmp_name'], $filepath);
  
  // $password = $_POST['password'] ? $_POST['password'] : $row['password'];
  //masukan ke dalam table users, sebutkan kolom di table user yang nilanya
  //diambil dari user ketika menginput data
    if($id){
      //query update
      //update dengan gambar
      $update = mysqli_query($conn, "UPDATE blog SET title='$title', date ='$date', description ='$description', image ='$filename', is_active = '$is_active' WHERE id='$id'");
      header("location:app.php?page=blog&update=berhasil");
    }else{
      $insert = mysqli_query($conn, "INSERT INTO blog(
      title, date, description, image, is_active) 
      VALUES ('$title','$date','$description', '$filename', '$is_active')");
      header("location:app.php?page=blog&tambah=berhasil");
    }
  }else {
    //update tanpa gambar
    $update = mysqli_query($conn, "UPDATE sliders SET title='$title', date ='$date', description ='$description', is_active = '$is_active'
      WHERE id='$id'");
      header("location:app.php?page=blog&update=berhasil");
  }
}

//tampilin semua data dri table use, urutan dari yang besar ke kecil
//* ALL asc kecil ke besar 

?>

          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit'])? 'Edit BLOG' : 'Create New Blog' ?></h3>
              <!-- <h6 class="op-7 mb-2">Hallo, Selamat Bergabung</h6> -->
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div class="card">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Enter Title" required 
                      value="<?php echo ($id) ? $row['title'] : ''?>">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Date</label>
                      <input type="date" class="form-control" name="date" placeholder="date" required 
                      value="<?php echo ($id) ? $row['date'] : ''?>">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Image</label>
                      <input type="file" class="form-control" name="image" placeholder="Enter Image"
                      value="<?php echo ($id) ? $row['image'] : ''?>">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Description</label></label>
                      <textarea name="description" class="form-control" cols="30" rows="3" id=""><?php
                      echo ($id) ? $row['description'] : '' 
                      ?></textarea>
                    </div>
                    <div class="mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radioDefault1" value="1" checked <?php echo ($id) &&
                        $row['is_active'] == 1 ? "checked" : '' ?>>
                        <label class="form-check-label" for="radioDefault1"  >
                          Active
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="radioDefault2" value="0" <?php echo ($id) &&
                        $row['is_active'] == 0 ? "checked" : '' ?>>
                        <label class="form-check-label" for="radioDefault2">
                          In-Active
                        </label>
                      </div>
                    </div>
                    
                    <button class="btn btn-primary" name="save" type="submit">
                      Save
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
