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
          <h3 class="mb-0">Data Arahan</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID Sub kategory</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Area</th>
                <th scope="col">Karyawan</th>
                <th scope="col">Minute</th>
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
                  <?= ucwords('Laki-laki');?>
                </td>
                <td>
                  <?= ucwords('Laki-laki');?>
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