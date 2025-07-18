<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #00ff33;"> <!-- hijau tua -->
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="display: flex; align-items: center; padding: 10px;">
        <img src="https://i.postimg.cc/kX9Z9PQ8/Chat-GPT-Image-May-4-2025-06-27-18-PM.png" alt="Logo" style="height:40px; margin-right: 10px;">
        <span class="brand-text font-weight-bold" style="color:#ffd700;">LIMBAH JAYA BERKAH</span> <!-- gold -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color:#0a3d1a;"> <!-- hijau tua -->
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid #00ff33;">
            <div class="image">
            <img src="https://i.postimg.cc/MT6ByjTZ/rr.jpg"alt="User  Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: #ffd700; font-weight: bold;"><?= $_SESSION['title'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?page=barang" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=penjualan" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=users" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" style="color: #ffd700;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    .nav-link {
        color: #ffd700 !important; /* warna teks normal */
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-link:hover {
        background-color: #ffd700 !important; /* gold */
        color: #000000 !important; /* teks jadi hitam saat hover */
    }

    .nav-item.active .nav-link,
    .nav-link.active {
        background-color: #ffd700 !important; /* gold */
        color: #00ff33 !important;
    }

    .brand-link {
        background-color: #0a3d1a !important;
    }

    .nav-icon {
        color: #00ff33(255, 0, 0) !important;
    }
</style>
