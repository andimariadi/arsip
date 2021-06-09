<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral">
            <span class="ni ni-fat-add"></span>
            New
          </a>
          <a href="#" class="btn btn-sm btn-neutral">
            <span class="ni ni-send"></span>
            Export
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Data Karyawan</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">NIK</th>
                <th scope="col" class="sort" data-sort="budget">Nama Lengkap</th>
                <th scope="col" class="sort" data-sort="status">Jenis Kelamin</th>
                <th scope="col">Telp</th>
                <th scope="col" class="sort" data-sort="completion">Alamat</th>
                <th scope="col" class="sort" data-sort="completion">Gambar</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <tr>
                <th scope="row">
                  0123456789
                </th>
                <td class="budget">
                  <?= strtoupper('ANDI MARIADI');?>
                </td>
                <td>
                  <?= ucwords('Laki-laki');?>
                </td>
                <td>
                  +6281234567890
                </td>
                <td style="white-space: normal;">
                  Pacific Century Place Tower Level 45 SCBD Lot 10, Jl. Jend. Sudirman No.53, RT.5/RW.3, Senayan, Kebayoran Baru, South Jakarta City, Jakarta 12190, Indonesia
                </td>
                <td>
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                  </a>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#">Update</a>
                      <a class="dropdown-item" href="#">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php $this->template->pagging(
          array(
            'page_total' => 10, 'page' => 1, 'url' => 'dash/'
          )
        );?>
      </div>
    </div>
  </div>