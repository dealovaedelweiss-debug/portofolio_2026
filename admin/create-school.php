<?php
/** @var mysqli $conn */
//jika tombol save di tekan 
$id = isset($_GET['edit'])?$_GET['edit']:'';
$query = mysqli_query($conn, "SELECT * FROM schools WHERE id = '$id'"); 
$row = mysqli_fetch_assoc($query);
if (isset($_POST['save'])){
  $year_start = $_POST['year_start']; 
  $year_end = $_POST['year_end']; 
  $title = $_POST['title'];
  $substitle = $_POST['substitle'];
  $is_active = $_POST['is_active'];
  //masukan ke dalam table users, sebutkan kolom di table user yang nilanya
  //diambil dari user ketika menginput data
if($id){
  //query update
  $update = mysqli_query($conn, "UPDATE schools SET year_start ='$year_start', year_end = '$year_end', title ='$title', substitle = '$substitle', is_active = '$is_active' WHERE id='$id'");
  header("location:app.php?page=school&update=berhasil");
}else{
  $insert = mysqli_query($conn, "INSERT INTO schools (year_start, year_end, title, substitle, is_active) VALUES('$year_start', '$year_end', '$title', '$substitle', '$is_active' )");
  header("location:app.php?page=school&tambah=berhasil");
  }

}

//tampilin semua data dri table use, urutan dari yang besar ke kecil
//* ALL asc kecil ke besar 

?>
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit'])? 'Edit School' : 'Create New School' ?></h3>
              <!-- <h6 class="op-7 mb-2">Hallo, Selamat Bergabung</h6> -->
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-12">
              <div class="card">
                <div class="card-body">
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for=""  class="form-label fw-bold">Years Start</label>
                      <select class="form-select" name="year_start" id="year_start"></select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Years End</label>
                      <select class="form-select" name="year_end" id="year_end"></select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Enter title" required 
                      value="<?php echo ($id) ? $row['title'] : ''?>">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label fw-bold">Substitle</label>
                      <input type="text" class="form-control" name="substitle" placeholder="Enter substitle" required 
                      value="<?php echo ($id) ? $row['substitle'] : ''?>">
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
      <script>
        document.addEventListener('DOMContentLoaded', function(){
        const year_start =  document.getElementById("year_start");
        const year_end =  document.getElementById("year_end");
        const year_old = 1920;
        const currentYear = new Date().getFullYear();
        const futureYear = 2030;

        const yearDataStart = "<?=  ($id) ? $row['year_start'] : '' ?>";
        const yearDataEnd = "<?= ($id) ? $row['year_end'] : '' ?>";

        for (let year = currentYear; year >= year_old; year--) {
          const option = document.createElement("option");
          option.value = year;
          option.textContent =  year;
          if (yearDataStart && yearDataStart == year) {
            option.selected = true;
          }
          year_start.appendChild(option);
        }
        for (let year = futureYear; year > year_old; year--) {
          const option = document.createElement("option");
          option.value = year;
          option.textContent =  year;
          if (yearDataEnd && yearDataEnd == year) {
            option.selected = true;
          }
          
          year_end.appendChild(option);
        }
      });
    </script>
