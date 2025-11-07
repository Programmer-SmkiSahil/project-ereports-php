<?php
$name = $_SESSION['username'] ?? 'Guest';
$role = $_SESSION['role'] ?? 'guest';

$dashboardLink = ($role === 'admin') ? 'admin/dashboard.php' : 'users/dashboard.php';
?>

<header class="mb-5">
        <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.php"><img src="./assets/mazer/compiled/svg/logo.svg" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="./assets/mazer/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?php echo $name; ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?php echo $role; ?></p>
                                    </div>
                                </a>
                                <?php if ($role !== 'guest'): ?>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a class="dropdown-item" href="<?php echo $dashboardLink; ?>">My Dashboard</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                                <?php else: ?>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="register.php">Register</a></li>
                                </ul>
                                <?php endif; ?>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
        </div>
        <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Home</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> About</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Services</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
        </nav>
</header>