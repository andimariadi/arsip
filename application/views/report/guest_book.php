<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <div class="card" style="margin: 0;">
            <div class="card-body">
              <form method="GET">
                <div class="form-row">
                  <div class="form-group col-md-4" style="margin-bottom:0">
                    <label>Mulai Tanggal</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Mulai tanggal" value="<?=$start_date;?>">
                  </div>
                  <div class="form-group col-md-4" style="margin-bottom:0">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="end_date" placeholder="Sampai tanggal" value="<?=$end_date;?>">
                  </div>
                  <div class="form-group col-md-4" style="margin-bottom:0">
                    <label>&nbsp;</label><br/>
                    <button class="btn btn-outline-primary" type="submit">Filter</button>
                    <?= permission_export('<a class="btn btn-outline-primary" href="'.base_url('export/report_guest_book/?start_date='.$start_date.'&end_date='.$end_date).'"><span class="ni ni-send"></span> Export</a>');?>
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
          <h3 class="mb-0">Data Buku Tamu</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Alamat</th>
                <th scope="col">Keperluan</th>
                <th scope="col">Institusi</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_guestbook as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['date'];?>
                </th>
                <td>
                  <?= $value['nik'];?>
                </td>
                <td>
                  <?= $value['full_name'];?>
                </td>
                <td>
                  <?= $value['address'];?>
                </td>
                <td>
                  <?= $value['utility_description'];?>
                </td>
                <td>
                  <?= $value['institute_description'];?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-nik="'.$value['nik'].'" data-full_name="'.$value['full_name'].'" data-address="'.$value['address'].'" data-utility="'.$value['utility'].'" data-institute_id="'.$value['institute_id'].'">Update</a>');?>
                      <?= permission_delete('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal" data-id="'.$value['id'].'">Delete</a>');?>
                    </div>
                  </div>
                  <?php endif;?>
                </td>
                <?php endforeach; ?>
              </tr>
            </tbody>
          </table>
        </div>
        <?php $this->template->pagging(
          array(
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/guest_book/')
          )
        );?>
      </div>
    </div>
  </div>

  
  <?php
  $category = "";
  foreach ($data_subcategory as $value) {
    $category .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
  }
  $institute = "";
  foreach ($data_institute as $value) {
    $institute .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
  }

  permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/guest_book') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Buku Tamu</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label>Instansi</label>
              <select class="form-control" name="institute_id">
                '.$institute.'
              </select>
            </div>

            <div class="form-group">
              <label>Keperluan</label>
              <select class="form-control" name="utility">
                '.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Nomor Induk Kependudukan</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik">
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="full_name">
            </div>

            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="address" placeholder="Alamat"></textarea>
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

  <?php permission_delete( $this->component->delete( base_url('Delete/guest_book') ) );?>
<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nik = button.data('nik');
    var full_name = button.data('full_name');
    var address = button.data('address');
    var utility = button.data('utility');
    var institute_id = button.data('institute_id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=nik]').val(nik);
    modal.find('.modal-body input[name=full_name]').val(full_name);
    modal.find('.modal-body textarea[name=address]').val(address);
    modal.find('.modal-body input[name=utility]').val(utility);
    modal.find('.modal-body textarea[name=institute_id]').val(institute_id);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>