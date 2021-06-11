<?php $this->load->view('partials/head.php', array('title' => 'Arahan Progress'));?>
<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">

              <h1><?= $data_descsubcategory['subcategory_description'];?></h1>
              <div>
                <?= $data_descsubcategory['remark'];?>
              </div>

              <hr />
              <div class="row">
                <div class="col-md-4">Petugas</div>
                <div class="col-md-8">: <?= $data_descsubcategory['full_name'];?></div>
              </div>
              <hr />
              <div class="row">
                <div class="col-md-4">Ruangan</div>
                <div class="col-md-8">: <?= $data_descsubcategory['area'];?></div>
              </div>
              <hr />
              <div class="row">
                <div class="col-md-4">Estimasi Pengerjaan</div>
                <div class="col-md-8">: <?= $data_descsubcategory['time_minutes'];?> menit</div>
              </div>
            </div>


                <div class="text-center">
                  <a href="<?= base_url('auth');?>" class="btn btn-secondary my-4">
                    <span class="ni ni-bold-left"></span>Back
                  </a>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>