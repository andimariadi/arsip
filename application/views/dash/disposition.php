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
          <a href="'.base_url('export/disposition').'" class="btn btn-sm btn-neutral">
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
          <h3 class="mb-0">Data Surat Disposisi</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Instansi</th>
                <th scope="col">NIK</th>
                <th scope="col">Nomor Dokumen</th>
                <th scope="col">Nomor Surat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Tanggal Diterima</th>
                <th scope="col">Perihal</th>
                <th scope="col">Category</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Document</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_disposition as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['code'];?>
                </th>
                <td>
                  <?= $value['institute_description'];?>
                </td>
                <td>
                  <?= $value['nik'];?>
                </td>
                <td>
                  <?= $value['file_number'];?>
                </td>
                <td>
                  <?= $value['reference_number'];?>
                </td>
                <td>
                  <?= $value['date'];?>
                </td>
                <td>
                  <?= $value['date_recieved'];?>
                </td>
                <td>
                  <?= $value['about'];?>
                </td>
                <td>
                  <?= $value['subcategory_description'];?>
                </td>
                <td>
                  <?= $value['purpose'];?>
                </td>
                <td>
                  <?= $value['type'];?>
                </td>
                <td>
                  <?= $value['remark'];?>
                </td>
                <td>
                  <?php if ( file_exists($value['path']) ) : ?>
                    <a href="<?= base_url($value['path']);?>" class="btn btn-primary btn-sm"><span class="ni ni-cloud-download-95"></span> Download</a>
                  <?php endif;?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != '') : ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-code="'.$value['code'].'" data-subcategory_id="'.$value['subcategory_id'].'" data-institute_id="'.$value['institute_id'].'" data-nik="'.$value['nik'].'" data-file_number="'.$value['file_number'].'" data-reference_number="'.$value['reference_number'].'" data-type="'.$value['type'].'" data-date="'.$value['date'].'" data-date_recieved="'.$value['date_recieved'].'" data-about="'.$value['about'].'" data-purpose="'.$value['purpose'].'" data-remark="'.$value['remark'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/disposition/')
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
        <form method="POST" action="' . base_url('create/disposition') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Surat Disposisi</h6>
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
            </div>
            <div class="form-group">
              <label>Kategory</label>
              <select class="form-control" name="subcategory_id">
                '.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Kode</label>
              <input type="text" class="form-control" placeholder="Kode" name="code" id="code">
                <div class="invalid-feedback w-100" id="forcode"></div>
            </div>

            <div class="form-group">
              <label>Nomor Induk Kependudukan</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik">
            </div>
            <div class="row"><div class="col-md-6">
            
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date" value="'.date('Y-m-d').'" />
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Tanggal Diterima</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date_recieved" value="'.date('Y-m-d').'" />
              </div>

            </div></div>
            <div class="row"><div class="col-md-6">


              <div class="form-group">
                <label>Nomor Dokumen</label>
                <input type="text" class="form-control" placeholder="Nomor Dokumen" name="file_number">
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" placeholder="Nomor Surat" name="reference_number">
              </div>

            </div></div>

            <div class="form-group">
              <label>Jenis Surat</label>
              <input type="text" class="form-control" placeholder="Jenis Surat" name="type">
            </div>

            <div class="form-group">
              <label>Perihal</label>
              <textarea name="about" placeholder="Perihal" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Tujuan</label>
              <textarea name="purpose" placeholder="Tujuan" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="remark" placeholder="Keterangan" class="form-control"></textarea>
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

  <?=

  permission_create('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/disposition') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Surat Disposisi</h6>
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
              <label>Kategory</label>
              <select class="form-control" name="subcategory_id">
                '.$category.'
              </select>
            </div>

            <div class="form-group">
              <label>Kode</label>
              <input type="text" class="form-control" placeholder="Kode" name="code">
            </div>

            <div class="form-group">
              <label>Nomor Induk Kependudukan</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik">
            </div>
            <div class="row"><div class="col-md-6">
            
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date" value="'.date('Y-m-d').'" />
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Tanggal Diterima</label>
                <input type="date" class="form-control" placeholder="Tanggal" name="date_recieved" value="'.date('Y-m-d').'" />
              </div>

            </div></div>
            <div class="row"><div class="col-md-6">


              <div class="form-group">
                <label>Nomor Dokumen</label>
                <input type="text" class="form-control" placeholder="Nomor Dokumen" name="file_number">
              </div>

            </div><div class="col-md-6">

              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" placeholder="Nomor Surat" name="reference_number">
              </div>

            </div></div>

            <div class="form-group">
              <label>Jenis Surat</label>
              <input type="text" class="form-control" placeholder="Jenis Surat" name="type">
            </div>

            <div class="form-group">
              <label>Perihal</label>
              <textarea name="about" placeholder="Perihal" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Tujuan</label>
              <textarea name="purpose" placeholder="Tujuan" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="remark" placeholder="Keterangan" class="form-control"></textarea>
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
  <?php permission_delete( $this->component->delete( base_url('Delete/archive') ) );?>


<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var code = button.data('code');
    var subcategory_id = button.data('subcategory_id');
    var institute_id = button.data('institute_id');
    var nik = button.data('nik');
    var file_number = button.data('file_number');
    var reference_number = button.data('reference_number');
    var type = button.data('type');
    var date = button.data('date');
    var date_recieved = button.data('date_recieved');
    var about = button.data('about');
    var purpose = button.data('purpose');
    var remark = button.data('remark');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=code]').val(code);
    modal.find('.modal-body select[name=subcategory_id]').val(subcategory_id);
    modal.find('.modal-body select[name=institute_id]').val(institute_id);
    modal.find('.modal-body input[name=nik]').val(nik);
    modal.find('.modal-body input[name=file_number]').val(file_number);
    modal.find('.modal-body input[name=reference_number]').val(reference_number);
    modal.find('.modal-body input[name=type]').val(type);
    modal.find('.modal-body input[name=date]').val(date);
    modal.find('.modal-body input[name=date_recieved]').val(date_recieved);
    modal.find('.modal-body textarea[name=about]').val(about);
    modal.find('.modal-body textarea[name=purpose]').val(purpose);
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
      url: "<?= base_url('validation/disposition/');?>" + val.val(),
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