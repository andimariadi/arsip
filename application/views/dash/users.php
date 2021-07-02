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
          <?php 
          // echo permission_export('<a href="#" class="btn btn-sm btn-neutral"> <span class="ni ni-send"></span> Export </a>');
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <?= $this->session->flashdata('msg');?>
  <?php if( permission_read('true') != '' ) : ?>

  <div class="row">

    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Data Users</h3>
        </div>

        
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name" rowspan="2">Username</th>
                <th scope="col" class="sort" data-sort="budget" rowspan="2">Nama Lengkap</th>
                <th scope="col" class="sort" data-sort="status" rowspan="2">Level</th>
                <th scope="col" colspan="5">Data Access</th>
                <th scope="col" class="sort" data-sort="completion" rowspan="2">Restricted Area</th>
                <th scope="col" rowspan="2"></th>
              </tr>
              <tr>
                <th scope="col">Create</th>
                <th scope="col">Read</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
                <th scope="col">Export</th>
              </tr>
            </thead>
            <tbody class="list">
              <?php foreach ($data_users as $value) : ?>
              <tr>
                <th scope="row">
                  <?= $value['username'];?>
                </th>
                <td class="budget">
                  <?= strtoupper($value['full_name']);?>
                </td>
                <td>
                  <?= $value['level'];?>
                </td>
                <td>
                  <?= strtoupper($value['data_create']);?>
                </td>
                <td>
                  <?= strtoupper($value['data_read']);?>
                </td>
                <td>
                  <?= strtoupper($value['data_update']);?>
                </td>
                <td>
                  <?= strtoupper($value['data_delete']);?>
                </td>
                <td>
                  <?= strtoupper($value['data_export']);?>
                </td>
                <td>
                  <?= $value['restrict'];?>
                </td>
                <td class="text-right">
                  <?php if (permission_update('true') != '' || permission_delete('true') != '' || permission_administrator('true') != ''): ?>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <?= permission_administrator('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#resetpasswordModal" data-id="'.$value['id'].'">Reset Password</a>');?>
                      <?= permission_update('<a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="'.$value['id'].'" data-username="'.$value['username'].'" data-full_name="'.$value['full_name'].'" data-level="'.$value['level'].'" data-data_create="'.$value['data_create'].'" data-data_read="'.$value['data_read'].'" data-data_update="'.$value['data_update'].'" data-data_delete="'.$value['data_delete'].'" data-data_export="'.$value['data_export'].'" data-restrict="'.$value['restrict'].'">Update</a>');?>
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
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('dash/users/')
          )
        );?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?= permission_administrator('<div class="modal fade" id="resetpasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="' . base_url('update/users_password') . '">
          <div class="modal-header">
            <h5 class="modal-title">Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
              <input type="hidden" class="form-control" name="id" id="id" />
              <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="Password" />
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>');?>

  
  <?= permission_create('<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content">
        <form method="POST" action="' . base_url('create/users') . '">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah User</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">
            <div class="row">
              <div class="col-6">

                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                  <div class="invalid-feedback w-100" id="forusername"></div>
                </div>
                
              </div>
              <div class="col-6">

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="full_name">
            </div>

            <div class="form-group">
              <label>Level</label>
              <select class="form-control" name="level">
                <option value="administrator">Administrator</option>
                <option value="user">Admin</option>
              </select>
            </div>

            <div class="row">
              <div class="col-6">

                <div class="form-group">
                  <label>Access Create</label>
                  <select class="form-control" name="data_create">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
              <div class="col-6">

                <div class="form-group">
                  <label>Access Read</label>
                  <select class="form-control" name="data_read">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
            </div>
            <div class="row">
              <div class="col-6">

                <div class="form-group">
                  <label>Access Update</label>
                  <select class="form-control" name="data_update">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
              <div class="col-6">

                <div class="form-group">
                  <label>Access Delete</label>
                  <select class="form-control" name="data_delete">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Access Export</label>
              <select class="form-control" name="data_export">
                <option value="true">True</option>
                <option value="false">False</option>
              </select>
            </div>

            <div class="form-group">
              <label>Restrict Menu</label>
              <select class="form-control" name="restrict[]" multiple="true">
                <option value="">Tidak ada</option>
                <option value="description_category">Arahan</option>
                <option value="archive">Arsip surat</option>
                <option value="archive_sk">Arsip SK</option>
                <option value="guest_book">Buku Tamu</option>
                <option value="disposition">Disposisi</option>
                <option value="institute">Instansi</option>
                <option value="workers">Karyawan</option>
                <option value="category">Kategory Surat</option>
                <option value="notice">Pengunguman</option>
                <option value="sub_category">Sub Kategory Surat</option>
                <option value="mail_outbox">Surat Keluar</option>
                <option value="mail_inbox">Surat Masuk</option>
                <option value="report_guest_book">Report Buku Tamu</option>
                <option value="report_disposition">Report Surat Disposisi</option>
                <option value="report_mail_outbox">Report Surat Keluar</option>
                <option value="report_mail_inbox">Report Surat Masuk</option>
                <option value="users">Users</option>
              </select>
              <small class="form-text text-muted"> Tekan CTRL untuk memilih lebih banyak. </small>
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
        <form method="POST" action="' . base_url('update/users') . '">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Ubah User</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>


          <div class="modal-body">

            <input type="hidden" class="form-control" name="id" id="id" />
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control disabled" placeholder="Username" name="username" disabled>
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="full_name">
            </div>

            <div class="form-group">
              <label>Level</label>
              <select class="form-control" name="level">
                <option value="administrator">Administrator</option>
                <option value="user">Admin</option>
              </select>
            </div>

            <div class="row">
              <div class="col-6">

                <div class="form-group">
                  <label>Access Create</label>
                  <select class="form-control" name="data_create">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
              <div class="col-6">

                <div class="form-group">
                  <label>Access Read</label>
                  <select class="form-control" name="data_read">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
            </div>
            <div class="row">
              <div class="col-6">

                <div class="form-group">
                  <label>Access Update</label>
                  <select class="form-control" name="data_update">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
                
              </div>
              <div class="col-6">

                <div class="form-group">
                  <label>Access Delete</label>
                  <select class="form-control" name="data_delete">
                    <option value="true">True</option>
                    <option value="false">False</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Access Export</label>
              <select class="form-control" name="data_export">
                <option value="true">True</option>
                <option value="false">False</option>
              </select>
            </div>

            <div class="form-group">
              <label>Restrict Menu</label>
              <select class="form-control" name="restrict[]" multiple="true" id="restrict">
                <option value="">Tidak ada</option>
                <option value="description_category">Arahan</option>
                <option value="archive">Arsip surat</option>
                <option value="guest_book">Buku Tamu</option>
                <option value="disposition">Disposisi</option>
                <option value="institute">Instansi</option>
                <option value="workers">Karyawan</option>
                <option value="category">Kategory Surat</option>
                <option value="notice">Pengunguman</option>
                <option value="sub_category">Sub Kategory Surat</option>
                <option value="mail_outbox">Surat Keluar</option>
                <option value="mail_inbox">Surat Masuk</option>
                <option value="report_guest_book">Report Buku Tamu</option>
                <option value="report_disposition">Report Surat Disposisi</option>
                <option value="report_mail_outbox">Report Surat Keluar</option>
                <option value="report_mail_inbox">Report Surat Masuk</option>
                <option value="users">Users</option>
              </select>
              <small class="form-text text-muted"> Tekan CTRL untuk memilih lebih banyak. </small>
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

  <?php $url = base_url('Delete/users');
  permission_delete( $this->component->delete( $url ) );?>

<!-- MODAL BOOTSTRAP SCRIPT -->

<script type="text/javascript">
  $('#resetpasswordModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });
  $('#updateModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var username = button.data('username');
    var full_name = button.data('full_name');
    var level = button.data('level');
    var data_create = button.data('data_create');
    var data_read = button.data('data_read');
    var data_update = button.data('data_update');
    var data_delete = button.data('data_delete');
    var data_export = button.data('data_export');
    var restrict = button.data('restrict');
    split_restrict = restrict.split(',');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id);
    modal.find('.modal-body input[name=username]').val(username);
    modal.find('.modal-body input[name=full_name]').val(full_name);
    modal.find('.modal-body select[name=level]').val(level);
    modal.find('.modal-body select[name=data_create]').val(data_create.toString() );
    modal.find('.modal-body select[name=data_read]').val(data_read.toString() );
    modal.find('.modal-body select[name=data_update]').val(data_update.toString() );
    modal.find('.modal-body select[name=data_delete]').val(data_delete.toString() );
    modal.find('.modal-body select[name=data_export]').val(data_export.toString() );
    // modal.find('.modal-body select[name=restrict]').val(restrict.toString() );
    split_restrict.forEach(function(valToSelect) {
      $( '.modal-body #restrict' ).find('option[value="' + valToSelect + '"]').prop('selected', true);
    });
  });
  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body input[name=id]').val(id)
  });


  $(document).on('change', '#username', function(e) {
    e.preventDefault();
    var val = $(this);
    $.ajax({
      url: "<?= base_url('validation/users/');?>" + val.val(),
    }).done(function(data) {
      console.log(data);
      if(data) {
        $("#forusername").html(data);
        val.attr('class', 'form-control is-invalid');
      } else {
        $("#forusername").html('');
        val.attr('class', 'form-control');
      }
    });
  });
</script>