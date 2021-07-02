<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-12 col-12">
          <div class="card" style="margin: 0;">
            <div class="card-body">
              <form method="GET">
                <div class="form-row">
                  <div class="form-group col-md-4" style="margin-bottom:0">
                    <?= permission_export('<a class="btn btn-outline-primary" href="'.base_url('export/workers/').'"><span class="ni ni-send"></span> Export</a>');?>
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

<div class="container-fluid mt--6">
  <?= $this->session->flashdata('msg');?>
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
                <th scope="col">NIK</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Telp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Gambar</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_workers as $value) : ?>
              <tr>
                <th scope="row">
                  <?= strtoupper($value['nik']);?>
                </th>
                <td>
                  <?= strtoupper($value['full_name']);?>
                </td>
                <td>
                  <?= strtoupper($value['gender']);?>
                </td>
                <td>
                  <?= strtoupper($value['telp']);?>
                </td>
                <td style="white-space: normal;">
                  <?= strtoupper($value['address']);?>
                </td>
                <td>
                  <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                    <img alt="Image placeholder" src="<?= base_url($value['image']);?>">
                  </a>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-nik="'.$value['nik'].'" data-full_name="'.$value['full_name'].'" data-gender="'.$value['gender'].'" data-telp="'.$value['telp'].'" data-address="'.$value['address'].'" data-image="'.base_url($value['image']).'">Update</a>');?>
                      <?= permission_delete('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal" data-id="'.$value['id'].'">Delete</a>');?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php $this->template->pagging(
          array(
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('report/workers/?page=')
          )
        );?>
      </div>
    </div>
  </div>


  <?= permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/workers') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Karyawan</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label>NIK</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik">
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="full_name">
            </div>

            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="gender">
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
            </div>

            <div class="form-group">
              <label>Nomor Handphone</label>
              <input type="text" class="form-control" placeholder="Nomor Handphone" name="telp">
            </div>

            <div class="form-group">
              <label>Alamat Lengkap</label>
              <textarea class="form-control" name="address" placeholder="Alamat lengkap"></textarea>
            </div>

            <div class="form-group">
              <label>Gambar</label>
            </div>

            <div class="form-group">              
              <img src="#" id="image" class="img-thumbnail" />
              <input type="file" class="form-control" name="image" />
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
          </div>
        </form>

      </div>
    </div>
  </div>');?>


  <?php permission_delete( $this->component->delete( base_url('Delete/workers') ) );?>
<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nik = button.data('nik');
    var full_name = button.data('full_name');
    var gender = button.data('gender');
    var telp = button.data('telp');
    var address = button.data('address');
    var image = button.data('image');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=nik]').val(nik);
    modal.find('.modal-body input[name=full_name]').val(full_name);
    modal.find('.modal-body select[name=gender]').val(gender);
    modal.find('.modal-body input[name=telp]').val(telp.toString() );
    modal.find('.modal-body textarea[name=address]').val(address.toString() );
    modal.find('.modal-body img[id=image]').attr("src", image);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>