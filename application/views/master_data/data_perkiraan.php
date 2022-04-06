<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Perkiraan Akun
                        </h4>
                        <div class="d-flex">
                            <a href="<?= base_url() ?>master_data/tambah_akun">

                                <div class="btn btn-success mr-2"><i class="fas fa-plus-circle mr-2"></i>Tambah Akun</div>
                            </a>
                            <a href="<?= base_url() ?>master_data/jenis_akun">
                                <div class="btn btn-dark"><i class="fa fa-cog mr-2"></i>Jenis Akun</div>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover table-striped" id="table-1" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th width="10px" rowspan="2">No</th>
                                        <th rowspan="2">Nama Akun</th>
                                        <th rowspan="2">Kode Akun</th>
                                        <th rowspan="2">Jenis Akun</th>
                                        <th colspan="2" class="text-center">Saldo</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($akun as $ak) : ?>
                                        <tr id="<?php echo $ak['idAkun'] ?>">
                                            <td><?php echo $i++; ?></td>
                                            <td><?= $ak['namaAkun'] ?></td>
                                            <td><?= $ak['kodeAkun'] ?></td>
                                            <td><?= $ak['namaJenis'] ?></td>
                                            <td>
                                                <?php
                                                if (($ak['debit']-$ak['kredit'])>0) {
													echo 'Rp '.  number_format($ak['debit']-$ak['kredit'], 0, ",", ",");
                                                } else {
                                                    echo "-";
                                                } ?></td>
                                            <td><?php
                                                if (($ak['debit']-$ak['kredit'])<0) {
													echo 'Rp '.  number_format(abs($ak['debit']-$ak['kredit']), 0, ",", ",");
                                                } else {
                                                    echo "-";
                                                } ?></td>
                                            <td class="d-flex">
                                                <a href="<?=base_url()?>master_data/edit_akun/<?php echo $ak['idAkun'] ?>">
                                                    <div class="btn btn-primary d-flex align-items-center mr-2">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        Edit
                                                    </div>
                                                </a>

                                                <button class="btn btn-danger d-flex align-items-center remove" id="swal-6">
                                                    <i class="far fa-trash-alt mr-2"></i>
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>

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
                    url: '<?= base_url() ?>master_data/delete_akun/' + id,
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
