<?php

/** @var mysqli $conn */

//tampilin semua data dri table use, urutan dari yang besar ke kecil
$query = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC"); //* ALL asc kecil ke besar 
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika parameter delete ada 
if(isset($_GET['delete'])){
  $delete = $_GET['delete'];
  $delete = mysqli_query($conn, "DELETE FROM contacts WHERE id='$delete'");
  header("location:contct.php?hapus=berhasil");
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
                  <table class="table table-bordered table-striped"> 
                    <!-- table-bordere untuk membuat 
                    table-striped untuk mengubah warna setiap table ganjil genap-->
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <!-- <th>Message</th> -->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tb>
                      <!-- tb>tr>td untuk membuat langsung -->
                      <?php
                      foreach ($rows as $index => $row): ?>
                      <tr>
                        <td><?php echo $index += 1 ?></td>
                        <td><?php echo $row ['name']  ?></td>
                        <td><?php echo $row ['email'] ?></td>
                        <td><?php echo $row ['subject'] ?></td>
                        <!-- -->
                        <td>
                          <a class="btn btn-success btn-sm"
                          href="contact-detail.php?id=<?php echo $row['id']?>
                          ">Detail</a>
                          
                          <a onclick="return confirm('Are you sure wanna delete this data?')" class="btn btn-danger btn-sm"
                          href="contact.php?delete=<?php echo $row['id']?>">Delete</a>
                        </td>
                      </tr>
                      <?php endforeach ?> 
                    </tb>
                  </table>
                </div>
              </div>
            </div>
          </div>