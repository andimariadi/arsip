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
  <div class="row">
    <?= $this->session->flashdata('msg');?>

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
                      <?= permission_administrator('<a class="dropdown-item" href="#">Reset Password</a>');?>
                      <?= permission_update('<a class="dropdown-item" href="#">Update</a>');?>
                      <?= permission_delete('<a class="dropdown-item" href="#">Delete</a>');?>
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

  
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <form method="POST" action="<?= base_url('create/users');?>">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah User</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="full_name">
            </div>

            <div class="form-group">
              <label>Level</label>
              <select class="form-control" name="level">
                <option value="administrator ">Administrator</option>
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
              <select class="form-control" name="restrict">
                <option value="true">...</option>
                <option value="false">False</option>
              </select>
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
          </div>
        </form>

      </div>
    </div>
  </div>