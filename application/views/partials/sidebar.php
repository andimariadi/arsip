<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="<?= base_url('assets/img/brand/blue.png');?>" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="<?= base_url('dash/');?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Data Arsip</span>
          </h6>
          <ul class="navbar-nav">
            <?= permission_menu_restrict('guest_book', '
            <li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/guest_book') . '">
                <i class="ni ni-book-bookmark text-primary"></i>
                <span class="nav-link-text">Buku Tamu</span>
              </a>
            </li>');?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dash/mail_inbox');?>">
                <i class="ni ni-email-83 text-default"></i>
                <span class="nav-link-text">Surat Masuk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dash/mail_outbox');?>">
                <i class="ni ni-send text-info"></i>
                <span class="nav-link-text">Surat Keluar</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dash/disposition');?>">
                <i class="ni ni-support-16 text-danger"></i>
                <span class="nav-link-text">Disposisi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dash/archive');?>">
                <i class="ni ni-collection text-warning"></i>
                <span class="nav-link-text">Arsip surat</span>
              </a>
            </li>
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Data Master</span>
          </h6>
          <ul class="navbar-nav">
            <?= permission_menu_restrict('workers', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/workers') . '">
                <i class="ni ni-badge text-orange"></i>
                <span class="nav-link-text">Karyawan</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('users', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/users') . '">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('notice', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/notice') . '">
                <i class="ni ni-notification-70 text-yellow"></i>
                <span class="nav-link-text">Pengunguman</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('category', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/category') . '">
                <i class="ni ni-folder-17 text-default"></i>
                <span class="nav-link-text">Kategory Surat</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('sub_category', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/sub_category') . '">
                <i class="ni ni-bullet-list-67 text-info"></i>
                <span class="nav-link-text">Sub Kategory Surat</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('description_category', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/description_category') . '">
                <i class="ni ni-books text-danger"></i>
                <span class="nav-link-text">Arahan</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('institute', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/institute') . '">
                <i class="ni ni-istanbul text-primary"></i>
                <span class="nav-link-text">Instansi</span>
              </a>
            </li>');?>
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Laporan</span>
          </h6>
          <ul class="navbar-nav">
            <?= permission_menu_restrict('workers', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/#') . '">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Surat Masuk</span>
              </a>
            </li>');?>
            <?= permission_menu_restrict('workers', '<li class="nav-item">
              <a class="nav-link" href="' . base_url('dash/#') . '">
                <i class="ni ni-bullet-list-67 text-info"></i>
                <span class="nav-link-text">Surat Keluar</span>
              </a>
            </li>');?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?= base_url('assets/img/theme/bootstrap.jpg');?>">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?= $this->session->userdata('full_name');?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth/logout');?>" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->