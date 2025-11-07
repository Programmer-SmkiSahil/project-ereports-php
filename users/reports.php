<?php
session_start();

if(!isset($_SESSION['login'])) {
    header('Location: ../login.php');
}

require '../configs/connect.php';

// Ambil reports sesuai user yang sedang login
$result = $conn->query("SELECT * FROM reports WHERE users_id = {$_SESSION['user_id']}");
$reports = $result->fetch_all(MYSQLI_ASSOC);

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
                <h3>Pengaduan</h3>
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
                                            <th>JUDUL</th>
                                            <th>FOTO</th>
                                            <th>ISI</th>
                                            <th>STATUS</th>
                                            <th>RESPONSE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($reports as $report) : ?>
                                    <tr>
                                        <td class="text-bold-500"><?= htmlspecialchars($report['title']); ?></td>
                                        <td class="text-bold-500">
                                            <img src="../uploads/<?= htmlspecialchars($report['image']); ?>" 
                                                alt="<?= htmlspecialchars($report['title']); ?>" width="100">
                                        </td>
                                        <td class="text-bold-500"><?= nl2br(htmlspecialchars($report['description'])); ?></td>
                                        <td class="text-bold-500">
                                            <div>
                                                <span class="badge bg-warning"><?= $report['status']; ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($report['status'] == 'responded'): ?>
                                                <a href="reports-response.php?id=<?= $report['id']; ?>" class="btn btn-sm btn-primary">
                                                    Lihat Respon
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">Belum ada respon</span>
                                            <?php endif; ?>
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