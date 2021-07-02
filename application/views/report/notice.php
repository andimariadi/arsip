<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-8 col-8">
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
                    <?= permission_export('<a class="btn btn-outline-primary" href="'.base_url('export/report_notice/?start_date='.$start_date.'&end_date='.$end_date).'"><span class="ni ni-send"></span> Export</a>');?>
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
          <h3 class="mb-0">Data Notice</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Judul</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Tanggal Berakhir</th>
                <th scope="col">Dokumen</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_notice as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['number'];?>
                </th>
                <td>
                  <?= strtoupper( $value['title'] );?>
                </td>
                <td>
                  <?= substr(strip_tags( $value['description'] ), 0, 250);?>
                </td>
                <td>
                  <?= $value['expired_at'];?>
                </td>
                <td>
                  <?php if ( file_exists($value['path']) ) : ?>
                    <a href="<?= base_url($value['path']);?>" class="btn btn-primary btn-sm"><span class="ni ni-cloud-download-95"></span> Download</a>
                  <?php endif;?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-number="'.$value['number'].'" data-title="'.$value['title'].'" data-expired_at="'.$value['expired_at'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('report/notice/?start_date='.$start_date.'&end_date='.$end_date.'&page=')
          )
        );?>
      </div>
    </div>
  </div>

  <?= permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/notice') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Pengunguman</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
          <input type="hidden" class="form-control" name="id" id="id" />
            <div class="form-group">
              <label>Nomor</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="number">
            </div>

            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="title">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="description" id="editor-edit" placeholder="Keterangan" class="form-control">
                
              </textarea>
            </div>


            <div class="form-group">
              <label>Tanggal Berakhir</label>
              <input type="date" class="form-control" placeholder="Nama Lengkap" name="expired_at">
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
  <?php permission_delete( $this->component->delete( base_url('Delete/notice') ) );?>

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


<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var number = button.data('number');
    var title = button.data('title');
    // var description = button.data('description');
    var expired_at = button.data('expired_at');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=number]').val(number);
    modal.find('.modal-body input[name=title]').val(title);
    // modal.find('.modal-body textarea[name=description]').val(description);
    modal.find('.modal-body input[name=expired_at]').val(expired_at);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>