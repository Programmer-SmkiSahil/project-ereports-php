<?php
session_start();

  if(!isset($_SESSION['login'])) {
    header('Location: ../login.php');
  }
  
require '../configs/connect.php';

if (!isset($_GET['reports_id'])) {
    header("Location: reports.php");
    exit;
}

$reports_id = $_GET['reports_id'];

// Ambil data laporan
$report_query = $conn->query("SELECT * FROM reports WHERE id = $reports_id");
$report = $report_query->fetch_assoc();

// 🔹 Ubah status jadi 'process' saat admin buka halaman ini (jika masih 'sent')
if ($report['status'] === 'sent') {
    $conn->query("UPDATE reports SET status = 'process' WHERE id = $reports_id");
    $report['status'] = 'process'; // update variabel lokal biar langsung tampil
}

// 🔹 Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response_text = $conn->real_escape_string($_POST['response']);

    // Simpan ke tabel response
    $conn->query("INSERT INTO response (reports_id, response) VALUES ('$reports_id', '$response_text')");

    // 🔹 Ubah status jadi 'responded'
    $conn->query("UPDATE reports SET status = 'responded' WHERE id = '$reports_id'");

    header("Location: reports.php");
    exit;
}
?>

<?php include('../includes/head-dashboard.php'); ?>
<?php include('../includes/sidebar.php'); ?>
</div>
        </div>
<div id="main">
    <div class="page-heading">
        <h3>Berikan Response untuk Pengaduan</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h5><?= $report['title']; ?></h5>
                <p><?= $report['description']; ?></p>
                <p><strong>Status saat ini:</strong> <?= $report['status']; ?></p>
                <hr>
                <form method="POST">
                    <div class="form-group">
                        <label for="response">Response Anda:</label>
                        <textarea name="response" id="response" rows="4" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Kirim Response</button>
                    <a href="reports.php" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
