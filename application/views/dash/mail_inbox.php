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
          <a href="'.base_url('export/mail_inbox').'" class="btn btn-sm btn-neutral">
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
          <h3 class="mb-0">Data Surat Masuk</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nomor</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kategory</th>
                <th scope="col">Perihal</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Institusi</th>
                <th scope="col">Document</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_inbox as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['code'];?>
                </th>
                <td>
                  <?= $value['number'];?>
                </td>
                <td>
                  <?= $value['date'];?>
                </td>
                <td>
                  <?= $value['category_description'];?>
                </td>
                <td>
                  <?= $value['about'];?>
                </td>
                <td>
                  <?= $value['type'];?>
                </td>
                <td>
                  <?= $value['institute_description'];?>
                </td>
                <td>
                  <?php if ( file_exists($value['document']) ) : ?>
                    <a href="<?= base_url($value['document']);?>" class="btn btn-primary btn-sm"><span class="ni ni-cloud-download-95"></span> Download</a>
                  <?php endif;?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-institute_id="'.$value['institute_id'].'" data-type="'.$value['type'].'" data-category_id="'.$value['category_id'].'" data-date="'.$value['date'].'" data-code="'.$value['code'].'" data-number="'.$value['number'].'" data-about="'.$value['about'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/mail_inbox/')
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

  echo permission_create('<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('create/mail_inbox') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Surat Masuk</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">

            <div class="form-group">
              <label>Instansi</label>
              <select class="form-control" name="institute_id">
                '.$institute.'
              </select>
              <small id="emailHelp" class="form-text text-muted"><a href="'.base_url('dash/institute').'">Klik disini</a> untuk tambah data.</small>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="category_id">
                '.$category.'
              </select>
              <small id="emailHelp" class="form-text text-muted"><a href="'.base_url('dash/sub_category').'">Klik disini</a> untuk tambah data.</small>
            </div>
            <div class="row"><div class="col-md-6">
            
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date" value="'.date('Y-m-d').'" />
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Kode Surat</label>
                <input type="text" class="form-control" placeholder="Kode Surat" name="code" id="code">
                <div class="invalid-feedback w-100" id="forcode"></div>
              </div>

            </div></div>
            <div class="row"><div class="col-md-6">

              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" placeholder="Nomor Surat" name="number">
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Jenis Surat</label>
                <input type="text" class="form-control" placeholder="Jenis Surat" name="type">
              </div>

            </div></div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="about" id="editor" placeholder="Keterangan" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Dokumen</label>
              <input type="file" class="form-control" name="document" />
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
        <form method="POST" action="' . base_url('update/mail_inbox') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Surat Masuk</h6>
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
              <label>Category</label>
              <select class="form-control" name="category_id">
                '.$category.'
              </select>
            </div>
            <div class="row"><div class="col-md-6">
            
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date" value="'.date('Y-m-d').'" />
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Kode Surat</label>
                <input type="text" class="form-control" placeholder="Kode Surat" name="code">
              </div>

            </div></div>
            <div class="row"><div class="col-md-6">

              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" placeholder="Nomor Surat" name="number">
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Jenis Surat</label>
                <input type="text" class="form-control" placeholder="Jenis Surat" name="type">
              </div>

            </div></div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="about" id="editor" placeholder="Keterangan" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Dokumen</label>
              <input type="file" class="form-control" name="document" />
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

  <?php permission_delete( $this->component->delete( base_url('Delete/mail_inbox') ) );?>

<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var institute_id = button.data('institute_id');
    var category_id = button.data('category_id');
    var type = button.data('type');
    var date = button.data('date');
    var code = button.data('code');
    var number = button.data('number');
    var about = button.data('about');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body select[name=institute_id]').val(institute_id);
    modal.find('.modal-body select[name=category_id]').val(category_id);
    modal.find('.modal-body input[name=date]').val(date);
    modal.find('.modal-body input[name=type]').val(type);
    modal.find('.modal-body input[name=code]').val(code);
    modal.find('.modal-body input[name=number]').val(number);
    modal.find('.modal-body textarea[name=about]').val(about);
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
      url: "<?= base_url('validation/mail_inbox/');?>" + val.val(),
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