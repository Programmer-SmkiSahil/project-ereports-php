<?php
session_start();
require 'configs/connect.php';

// Cek login
$isLoggedIn = isset($_SESSION['login']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : "NULL";
$nama_user = $isLoggedIn ? $_SESSION['username'] : "";

// Ambil data jumlah Reports sesuai status (sent, process, responded)
$sent_count = $conn->query("SELECT COUNT(*) as count FROM reports WHERE status = 'sent' OR status = 'process'")->fetch_assoc()['count'];
$responded_count = $conn->query("SELECT COUNT(*) as count FROM reports WHERE status = 'responded'")->fetch_assoc()['count'];
$total_count = $conn->query("SELECT COUNT(*) as count FROM reports")->fetch_assoc()['count'];

// Ambil data total Users
$user_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];

if (isset($_POST['submit'])) {
    // Memasukkan data form ke variabel
    $nama = htmlspecialchars($_POST['nama'] ?: $nama_user);
    $judul = htmlspecialchars($_POST['judul']);
    $isi = htmlspecialchars($_POST['isi']);
    $status = 'sent';

    // Variabel untuk upload foto
    $foto = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];

    // Validasi input
    if (empty($foto)) {
        echo "<script>
                alert('Foto harus diisi!');
                document.location.href = 'create.php';
              </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    if (!in_array(pathinfo($foto, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
        echo "<script>
                alert('Yang anda upload bukan gambar!');
                document.location.href = 'create.php';
              </script>";
        return false;
    }

    // Tambahkan nama unik ke foto
    $uniq_foto = uniqid() . '-' . $foto;

    // Pindahkan foto ke folder img
    move_uploaded_file($temp, 'uploads/' . $uniq_foto);

    // Memasukkan data ke tabel di database
    $query = "INSERT INTO reports VALUES ('', $user_id, '$nama', '$judul', '$uniq_foto', '$isi', '$status')";

    mysqli_query($conn, $query);

    // Cek apakah data berhasil ditambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Laporan berhasil dikirimkan!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Laporan gagal dikirim!');
              </script>";
        echo "<br>";
        echo mysqli_error($conn);
    }
}

?>


<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar-landing.php'; ?>

<div class="content-wrapper container">
<div class="page-heading">
    <h3>Pengaduan Masyarakat</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah User</h6>
                                    <h6 class="font-extrabold mb-0"><?php echo $user_count; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Pengaduan</h6>
                                    <h6 class="font-extrabold mb-0"><?php echo $total_count; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengaduan Diproses</h6>
                                    <h6 class="font-extrabold mb-0"><?php echo $sent_count; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengaduan Selesai</h6>
                                    <h6 class="font-extrabold mb-0"><?php echo $responded_count; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Pengaduan</h4>
                        </div>
                        <div class="card-body">
                            <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Username</label>
                                                        <div class="position-relative">
                                                            <input 
                                                                type="text" 
                                                                class="form-control"
                                                                placeholder="Username"
                                                                id="first-name-icon" 
                                                                name="nama"
                                                                value="<?= htmlspecialchars($nama_user) ?>"
                                                                <?= $isLoggedIn ? 'readonly' : '' ?>>
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-icon">Foto</label>
                                                        <div class="position-relative">
                                                            <input class="form-control" type="file" id="formFile" name="foto">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="mobile-id-icon">Judul</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Judul"
                                                                id="mobile-id-icon" name="judul">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-id-icon">Isi Pengaduan</label>
                                                        <div class="position-relative">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="submit">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-4">
                    
                </div>
                <div class="col-12 col-xl-8">
                    
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="./assets/mazer/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= $nama_user ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Pengaduan</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile-my"></div>
                </div>
            </div>
        </div>
    </section>
</div>

            </div>

<?php include 'includes/footer.php'; ?>