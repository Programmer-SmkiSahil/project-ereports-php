<?php
session_start();
require '../configs/connect.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = "SELECT r.id, r.title, r.description, r.image, r.status, res.response FROM reports r
    LEFT JOIN response res ON r.id = res.reports_id WHERE r.id = $id AND r.users_id = {$_SESSION['user_id']}
";

$result = $conn->query($query);
$report = $result->fetch_assoc();

if (!$report) {
    die("Data laporan tidak ditemukan atau Anda tidak berhak mengaksesnya.");
}
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
        <h3>Detail Respon Pengaduan</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <h4><?= htmlspecialchars($report['title']); ?></h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Foto:</strong><br>
                        <img src="../uploads/<?= htmlspecialchars($report['image']); ?>" alt="<?= htmlspecialchars($report['title']); ?>" width="300" class="img-thumbnail">
                    </div>
                    <div class="mb-3">
                        <strong>Isi Laporan:</strong><br>
                        <p><?= htmlspecialchars($report['description']); ?></p>
                    </div>
                    <hr>
                    <h5>Respon Admin</h5>
                    <div class="alert alert-success">
                        <p><?= htmlspecialchars($report['response'] ?? 'Belum ada respon dari admin.'); ?></p>
                    </div>
                    <a href="reports.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pengaduan</a>
                </div>
            </div>
        </section>
    </div>

<?php include('../includes/footer.php'); ?>
