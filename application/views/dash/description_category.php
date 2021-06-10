<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          
        </div>
        <div class="col-lg-6 col-5 text-right">
          <?= permission_create('<a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#newModal">
            <span class="ni ni-fat-add"></span>
            New
          </a>');?>
          <?= permission_export('
          <a href="#" class="btn btn-sm btn-neutral">
            <span class="ni ni-send"></span>
            Export
          </a>');?>
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
              <?php foreach ($data_desccategory as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['subcategory_description'];?>
                </th>
                <td >
                  <?= substr(strip_tags( $value['remark'] ), 0, 250);?>
                </td>
                <td>
                  <?= $value['area'];?>
                </td>
                <td>
                  <?= $value['full_name'];?>
                </td>
                <td>
                  <?= $value['time_minutes'];?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-subcategory_id="'.$value['subcategory_id'].'" data-remark="'.$value['remark'].'" data-area="'.$value['area'].'" data-user="'.$value['user'].'" data-time_minutes="'.$value['time_minutes'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/description_category/')
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
  $worker = "";
  foreach ($data_worker as $value) {
    $worker .= '<option value="' . $value['id'] . '">' . $value['full_name'] . '</option>';
  }

  echo permission_create('<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('create/description_category') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Kategory</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">

            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="subcategory_id">
                '.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="remark" id="editor" placeholder="Keterangan" class="form-control">
                
              </textarea>
            </div>

            <div class="form-group">
              <label>Tempat Area</label>
              <input type="text" class="form-control" placeholder="Tempat Area" name="area">
            </div>

            <div class="form-group">
              <label>Karyawan</label>
              <select class="form-control" name="user">
                '.$worker.'
              </select>
            </div>

            <div class="form-group">
              <label>Waktu Pengerjaan</label>
              <input type="tel" class="form-control" placeholder="60" name="time_minutes" />
              <small class="form-text text-muted">Dalam satuan menit</small>
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

  <?= permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/description_category') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Kategory</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
            <input type="hidden" name="id">

            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="subcategory_id">
                '.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="remark" id="editor-edit" placeholder="Keterangan" class="form-control">
                
              </textarea>
            </div>

            <div class="form-group">
              <label>Tempat Area</label>
              <input type="text" class="form-control" placeholder="Tempat Area" name="area">
            </div>

            <div class="form-group">
              <label>Karyawan</label>
              <select class="form-control" name="user">
                '.$worker.'
              </select>
            </div>

            <div class="form-group">
              <label>Waktu Pengerjaan</label>
              <input type="tel" class="form-control" placeholder="60" name="time_minutes" />
              <small class="form-text text-muted">Dalam satuan menit</small>
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

  <?php permission_delete( $this->component->delete( base_url('Delete/description_category') ) );?>

  <script src="<?= base_url('assets/vendor/ckeditor5/ckeditor.js');?>"></script>
  <script type="text/javascript">
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    ClassicEditor
            .create( document.querySelector( '#editor-edit' ) )
            .catch( error => {
                console.error( error );
            } );
  </script>


<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var subcategory_id = button.data('subcategory_id');
    var remark = button.data('remark');
    var area = button.data('area');
    var user = button.data('user');
    var time_minutes = button.data('time_minutes');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body select[name=subcategory_id]').val(subcategory_id);
    modal.find('.modal-body textarea[name=remark]').val(remark);
    modal.find('.modal-body input[name=area]').val(area);
    modal.find('.modal-body select[name=user]').val(user);
    modal.find('.modal-body input[name=time_minutes]').val(time_minutes);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>