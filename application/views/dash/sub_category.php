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
          <a href="'.base_url('export/sub_category').'" class="btn btn-sm btn-neutral">
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
          <h3 class="mb-0">Data Sub Kategory</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID Kategory</th>
                <th scope="col">Nomor</th>
                <th scope="col">Nama</th>
                <th scope="col">Keterangan</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_subcategory as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['category_description'];?>
                </th>
                <th scope="row">
                  <?= $value['code'];?>
                </th>
                <td>
                  <?= strtoupper($value['name']);?>
                </td>
                <td>
                  <?= ucfirst($value['remark']);?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-category="'.$value['category_id'].'" data-code="'.$value['code'].'" data-name="'.$value['name'].'" data-remark="'.$value['remark'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/sub_category/')
          )
        );?>
      </div>
    </div>
  </div>

  <?php
  $category = "";
  foreach ($data_category as $value) {
    $category .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
  }

  echo permission_create('<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('create/sub_category') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Sub Kategory</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">

            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="category_id">'.$category.'
              </select>
              <small id="emailHelp" class="form-text text-muted"><a href="'.base_url('dash/category').'">Klik disini</a> untuk tambah data.</small>
            </div>

            <div class="form-group">
              <label>Nomor Kode</label>
              <input type="text" class="form-control" placeholder="Nomor Kode" name="code" id="code">
                <div class="invalid-feedback w-100" id="forcode"></div>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama Kategory" name="name">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="remark" placeholder="Keterangan"></textarea>
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

    <?=
    permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/sub_category') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Sub Kategory</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">

            <input type="hidden" name="id">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="category_id">'.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Nomor Kode</label>
              <input type="text" class="form-control" placeholder="Nomor Kode" name="code">
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama Kategory" name="name">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="remark" placeholder="Keterangan"></textarea>
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

  <?php permission_delete( $this->component->delete( base_url('Delete/sub_category') ) );?>
<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var category = button.data('category');
    var code = button.data('code');
    var name = button.data('name');
    var remark = button.data('remark');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body select[name=category_id]').val(category);
    modal.find('.modal-body input[name=code]').val(code);
    modal.find('.modal-body input[name=name]').val(name);
    modal.find('.modal-body textarea[name=remark]').val(remark);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });

  $(document).on('change', '#code', function(e) {
    e.preventDefault();
    var val = $(this);
    $.ajax({
      url: "<?= base_url('validation/sub_category/');?>" + val.val(),
    }).done(function(data) {
      console.log(data);
      if(data) {
        $("#forcode").html(data);
        val.attr('class', 'form-control is-invalid');
      } else {
        $("#forcode").html('');
        val.attr('class', 'form-control');
      }
    });
  });
</script>