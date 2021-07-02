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
                    <?= permission_export('<a class="btn btn-outline-primary" href="'.base_url('export/institute/').'"><span class="ni ni-send"></span> Export</a>');?>
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
          <h3 class="mb-0">Data Institusi</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_institute as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['code'];?>
                </th>
                <td>
                  <?= strtoupper($value['name']);?>
                </td>
                <td>
                  <?= $value['address'];?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-code="'.$value['code'].'" data-name="'.$value['name'].'" data-address="'.$value['address'].'">Update</a>');?>
                      <?= permission_delete('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal" data-id="'.$value['id'].'">Delete</a>');?>
                    </div>
                  </div>
                  <?php endif;?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php $this->template->pagging(
          array(
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('report/institute/?page=')
          )
        );?>
      </div>
    </div>
  </div>

  <?= permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/institute') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Instansi</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
              <input type="hidden" name="id">
            <div class="form-group">
              <label>Nomor Kode</label>
              <input type="text" class="form-control" placeholder="Nomor Kode" name="code">
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama Instansi" name="name">
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

  <?php permission_delete( $this->component->delete( base_url('Delete/institute') ) );?>
<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var code = button.data('code');
    var name = button.data('name');
    var address = button.data('address');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=code]').val(code);
    modal.find('.modal-body input[name=name]').val(name);
    modal.find('.modal-body textarea[name=address]').val(address);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>