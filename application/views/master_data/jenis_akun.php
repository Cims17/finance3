<?php echo $this->session->flashdata('berhasil_tambah_jenis_akun') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Jenis Akun
                        </h4>
                        <div class="d-flex">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahjenis"><i class="fas fa-plus-circle mr-2"></i>Tambah Jenis</button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10px">
                                            #
                                        </th>
                                        <th>Nama Jenis</th>
										<th>Kode Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jenis as $jns) { ?>
                                        <tr id="<?php echo $jns['idJenis'] ?>">

                                            <td class="text-center">
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $jns['namaJenis'] ?></td>
											<td><?= $jns['kodeJenis'] ?></td>

                                            <td class="d-flex">

                                                <button class="btn btn-primary d-flex align-items-center mr-2" data-toggle="modal" data-target="#editjenis<?php echo $jns['idJenis'] ?>" type="button">
                                                    <i class="fas fa-edit mr-2"></i>
                                                    Edit
                                                </button>

                                                <button class="btn btn-danger d-flex align-items-center remove">
                                                    <i class="far fa-trash-alt mr-2"></i>
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<div class="modal fade" id="tambahjenis" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Tambah Jenis Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php base_url() ?>tambah_jenis_akun" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Jenis</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="jenis" placeholder="Masukkan jenis akun" required>
                        </div>
                    </div>
					<div class="form-group">
                        <label>Kode Jenis</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" name="kode" required>
                        </div>
                    </div>
                    <button type="button submit" class="btn btn-primary waves-effect">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($jenis as $jns) { ?>
    <div class="modal fade" id="editjenis<?php echo $jns['idJenis'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Jenis Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php base_url() ?>edit_jenis_akun" method="post" enctype="multipart/form-data">
					<input type="text" class="form-control" name="id" value="<?php echo $jns['idJenis'] ?>" required hidden>
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="jenis" value="<?php echo $jns['namaJenis'] ?>" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label>Kode Jenis</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" name="kode" value="<?php echo $jns['kodeJenis'] ?>" required>
                            </div>
                        </div>
                        <button type="button submit" class="btn btn-primary waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($jenis as $jns) { ?>
    <div class="modal fade" id="tambahjenis<?php echo $jns['idJenis'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Jenis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="">
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="jenis" placeholder="<?php echo $jns['namaJenis'] ?>">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".remove").click(function() {
        var id = $(this).parents("tr").attr("id");
        console.log(id);
        swal({
            title: "Hapus Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '<?= base_url() ?>master_data/delete_jenis_akun/' + id,
                    type: 'DELETE',
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        swal({
                            title: "Data Telah Terhapus"
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            } else {
                // swal("Batal");
            }
        });
    });
</script>
