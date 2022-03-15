<?php echo $this->session->flashdata('berhasil_pelanggan') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Pelanggan
                        </h4>
                        <div class="d-flex">
							<a href="<?= base_url() ?>master_data/pdfdata_pelanggan">
								<div class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
							</a>
                            <a href="<?= base_url() ?>master_data/tambah_pelanggan">
                                <div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
                            </a>
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
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>Status</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($pelanggan as $plg) { ?>
                                        <tr id="<?php echo $plg['idPelanggan'] ?>">

                                            <td class="text-center">
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $plg['nama'] ?></td>
                                            <td>
                                                <?= $plg['alamat'] ?>
                                            </td>
                                            <td>
                                                <?= $plg['no_telp'] ?>
                                            </td>
                                            <td>
                                                <?= $plg['status'] ?>
                                            </td>
                                            <td class="d-flex">
                                                <a href="<?= base_url() ?>master_data/edit_pelanggan/<?php echo $plg['idPelanggan'] ?>">
                                                    <div class="btn btn-primary d-flex align-items-center mr-2">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        Edit
                                                    </div>
                                                </a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".remove").click(function() {
        var id = $(this).parents("tr").attr("id");
        swal({
            title: "Hapus Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '<?= base_url() ?>master_data/delete_pelanggan/' + id,
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
