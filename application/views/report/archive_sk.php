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
                    <?= permission_export('<a class="btn btn-outline-primary" href="'.base_url('export/report_archive_sk/?start_date='.$start_date.'&end_date='.$end_date).'"><span class="ni ni-send"></span> Export</a>');?>
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
          <h3 class="mb-0">Data Arsip SK</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Nomor SK</th>
                <th scope="col">Tanggal Berlaku</th>
                <th scope="col">Tanggal Berakhir</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Dokumen</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_archives as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['number'];?>
                </th>
                <td>
                  <?= strtoupper( $value['nik'] );?>
                </td>
                <td>
                  <?= strtoupper( $value['name'] );?>
                </td>
                <td>
                  <?= $value['sk_number'];?>
                </td>
                <td>
                  <?= $value['start_date'];?>
                </td>
                <td>
                  <?= $value['expired_date'];?>
                </td>
                <td>
                  <?= substr(strip_tags( $value['description'] ), 0, 250);?>
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
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'"
                        data-number="'.$value['number'].'"
                        data-nik="'.$value['nik'].'"
                        data-name="'.$value['name'].'"
                        data-sk_number="'.$value['sk_number'].'"
                        data-start_date="'.$value['start_date'].'"
                        data-expired_date="'.$value['expired_date'].'"
                        data-description="'.$value['description'].'"
                      ">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('report/archive_sk/?start_date='.$start_date.'&end_date='.$end_date.'&page=')
          )
        );?>
      </div>
    </div>
  </div>


  <?= permission_update('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/archive_sk') . '" enctype="multipart/form-data">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah Arsip</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
          <input type="hidden" class="form-control" name="id" id="id" />
            <div class="form-group">
              <label>Nomor</label>
              <input type="text" class="form-control" placeholder="Nomor" name="number">
            </div>

            <div class="form-group">
              <label>NIK</label>
              <input type="text" class="form-control" placeholder="Nomor Induk Kependudukan" name="nik">
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="name">
            </div>

            <div class="form-group">
              <label>Nomor SK</label>
              <input type="text" class="form-control" placeholder="Nomor SK" name="sk_number">
            </div>
            <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Tanggal Berlaku</label>
                <input type="date" class="form-control" name="start_date">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Tanggal Berakhir</label>
                <input type="date" class="form-control" name="expired_date">
              </div>
            </div>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="description" placeholder="Keterangan" class="form-control"></textarea>
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
  <?php permission_delete( $this->component->delete( base_url('Delete/archive_sk') ) );?>

<script type="text/javascript">
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var number = button.data('number');
    var nik = button.data('nik');
    var name = button.data('name');
    var sk_number = button.data('sk_number');
    var start_date = button.data('start_date');
    var expired_date = button.data('expired_date');
    var description = button.data('description');



    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=number]').val(number);
    modal.find('.modal-body input[name=nik]').val(nik);
    modal.find('.modal-body input[name=name]').val(name);
    modal.find('.modal-body input[name=sk_number]').val(sk_number);
    modal.find('.modal-body input[name=start_date]').val(start_date);
    modal.find('.modal-body input[name=expired_date]').val(expired_date);
    modal.find('.modal-body textarea[name=description]').val(description);
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
</script>