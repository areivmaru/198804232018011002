<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">

        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Master Data Pengguna</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <button type="button" class="btn btn-primary float-right" onclick="tambah()">
                    Tambah <?= ucwords($judul) ?>
                </button>
                <h5 class="hk-sec-title">Master Data <?= ucwords($judul) ?></h5>
                <p class="mb-40">Silahkan gunakan datatables untuk menampilkan data pada table master data <?= ucwords($judul) ?>/</p>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="tbl_general" class="table table-hover w-100 display">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
    <!-- /Row -->

</div>
<!-- /Container -->

<!-- Modal -->
<div class="modal fade" id="modal_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= ucwords($judul) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url() ?>cms/crud_users" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukan NIP" required>
                                <input type="hidden" name="csrf_baseben" value="<?= $this->security->get_csrf_hash() ?>">
                                <input type="hidden" name="user_id" value="" id="user_id">
                                <div class="invalid-feedback">
                                    Mohon masukkan NIP
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan nama" id="nama" required>
                                <div class="invalid-feedback">
                                    Mohon masukkan nama
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="input_link">
                                <label>Email </label>
                                <input type="email" name="email" class="form-control" placeholder="Masukan email" id="email">
                                <div class="invalid-feedback">
                                    Mohon masukkan email yang valid
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password </label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan password" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="input_foto">
                        <label>Foto </label>
                        <div id="last_foto"></div>
                        <input type="file" name="foto" accept="image/*" class="form-control" id="foto">
                        <div class="invalid-feedback">
                            Mohon Pilih Foto
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Pilih Role</option>
                            <option value="administrator">Administrator</option>
                            <option value="user">User</option>
                        </select>
                        <div class="invalid-feedback">
                            Mohon pilih role
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal"><i class="uil uil-times-circle"></i> Batal</button>
                <button class="btn btn-primary">
                    <i class="uil uil-save"></i> Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>