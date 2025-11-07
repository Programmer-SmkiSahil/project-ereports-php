<?php

session_start();

  if(!isset($_SESSION['login'])) {
    header('Location: ../login.php');
  }
  
require '../configs/connect.php';
$result = $conn->query("SELECT * FROM users");
$users = $result->fetch_all(MYSQLI_ASSOC);


?>



<?php include('../includes/head-dashboard.php'); ?>
<?php include('../includes/sidebar.php'); ?>
    </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <h3>Users</h3>
</div> 
<div class="page-content"> 
    <section class="row">
        <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>ROLE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td class="text-bold-500"><?= $user['nama']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td class="text-bold-500"><?= $user['role']; ?></td>
                                            <td class="text-bold-500">
                                                <a href="user-delete.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>

<?php include('../includes/footer.php'); ?>