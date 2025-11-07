<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

require '../configs/connect.php';

// Konfigurasi Pagination
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fitur Search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = "";

if (!empty($search)) {
    // Filter data berdasarkan nama, judul, atau isi
    $safeSearch = $conn->real_escape_string($search);
    $where = "WHERE guest_name LIKE '%$safeSearch%' 
              OR title LIKE '%$safeSearch%' 
              OR description LIKE '%$safeSearch%'";
}

// Hitung total data untuk pagination
$total_result = $conn->query("SELECT COUNT(*) AS total FROM reports $where");
$total_row = $total_result->fetch_assoc();
$total_reports = $total_row['total'];
$total_pages = ceil($total_reports / $limit);

// Ambil data sesuai halaman dan pencarian
$result = $conn->query("SELECT * FROM reports $where ORDER BY id DESC LIMIT $start, $limit");
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

                                <!-- Form Search -->
                                <form method="GET" class="mb-3 d-flex" style="max-width:400px;">
                                    <input type="text" name="search" class="form-control me-2" 
                                           placeholder="Cari nama, judul, atau isi..." 
                                           value="<?= htmlspecialchars($search); ?>">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </form>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>NAMA</th>
                                                <th>JUDUL</th>
                                                <th>FOTO</th>
                                                <th>ISI</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($reports)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($reports as $report): ?>
                                                <tr>
                                                    <td class="text-bold-500"><?= htmlspecialchars($report['guest_name']); ?></td>
                                                    <td><?= htmlspecialchars($report['title']); ?></td>
                                                    <td>
                                                        <img src="../uploads/<?= htmlspecialchars($report['image']); ?>" 
                                                             alt="<?= htmlspecialchars($report['title']); ?>" width="100">
                                                    </td>
                                                    <td><?= htmlspecialchars($report['description']); ?></td>
                                                    <td>
                                                        <span class="badge 
                                                            <?= $report['status'] == 'selesai' ? 'bg-success' : 'bg-warning'; ?>">
                                                            <?= htmlspecialchars($report['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" 
                                                           href="reports-response.php?reports_id=<?= $report['id']; ?>">RESPONSE</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <?php if ($total_pages > 1): ?>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page - 1; ?>&search=<?= urlencode($search); ?>">Previous</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?= $i; ?>&search=<?= urlencode($search); ?>"><?= $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page + 1; ?>&search=<?= urlencode($search); ?>">Next</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </section>
            </div>

<?php include('../includes/footer.php'); ?>
