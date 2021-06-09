<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Data</a></li>
              <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral">
            <span class="ni ni-fat-add"></span>
            New
          </a>
          <a href="#" class="btn btn-sm btn-neutral">
            <span class="ni ni-send"></span>
            Export
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
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
              <tr>
                <th scope="row">
                  admin
                </th>
                <td class="budget">
                  <?= strtoupper('ANDI MARIADI');?>
                </td>
                <td>
                  <?= strtoupper('Admin');?>
                </td>
                <td>
                  <?= strtoupper('true');?>
                </td>
                <td>
                  <?= strtoupper('true');?>
                </td>
                <td>
                  <?= strtoupper('true');?>
                </td>
                <td>
                  <?= strtoupper('true');?>
                </td>
                <td>
                  <?= strtoupper('true');?>
                </td>
                <td>
                  Users, Karyawan
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#">Reset Password</a>
                      <a class="dropdown-item" href="#">Update</a>
                      <a class="dropdown-item" href="#">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Card footer -->
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>