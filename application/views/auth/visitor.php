<?php $this->load->view('partials/head.php');?>
<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-white">Lakukan login untuk mengakses semua data Desa Banyu Landas.</p>
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
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <?= $this->session->flashdata('msg');?>
              <form role="form" method="POST" action="<?= base_url('auth/action_visitor');?>">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nomor Induk Kependudukan" type="text" name="nik" required="true" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nama Lengkap" type="text" name="full_name" required="true" autocomplete="off" />
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-tag"></i></span>
                    </div>
                    <select class="form-control" name="utility">
                      <option value="">Pilih salah satu</option>
                      <?php
                      foreach ($data_subcategory as $value) {
                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-istanbul"></i></span>
                    </div>
                    <select class="form-control" name="institute_id">
                      <option value="">Pilih salah satu</option>
                      <?php
                      foreach ($data_institute as $value) {
                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>

                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                    </div>
                    <textarea class="form-control" name="address" placeholder="Alamat Lengkap"></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Simpan</button>
                  <a href="<?= base_url('auth');?>" class="btn btn-secondary my-4">
                    <span class="ni ni-bold-left"></span>Back
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>