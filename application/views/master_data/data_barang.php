<?php echo $this->session->flashdata('berhasil_update_barang') ?>
<?php echo $this->session->flashdata('berhasil_tambah_barang') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Barang
                        </h4>
                        <div class="d-flex">
							<a href="<?= base_url() ?>cetak_pdf/pdfdata_barang">
								<div class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
                            </a>
                            <a href="<?= base_url() ?>master_data/tambah_barang">
                                <div class="btn btn-success mr-2"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
                            </a>
                            <a href="<?= base_url() ?>master_data/jenis_barang">
                                <div class="btn btn-dark"><i class="fa fa-cog mr-2"></i>Jenis Barang</div>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>

                                    <tr>
                                        <th class="text-center">
                                            Kode
                                        </th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
										<th>Stok</th>

                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($barang as $br) : ?>
                                        <tr id="<?php echo $br['idBarang'] ?>">
                                            <td class="text-center">
                                                <?= $br['kodeBarang'] ?>
                                            </td>
                                            <td><?= $br['nama'] ?></td>
                                            <td>
                                                <?= $br['namaJenis'] ?>
                                            </td>
                                            <td>
                                                <?= $br['keterangan'] ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($br['harga'], 0, ",", ",") ?>
                                            </td>
											<td>
                                                <?= number_format($br['stok'], 0, ",", ",") ?>
                                            </td>
                                            <td class="d-flex">
                                                <a href="<?=base_url()?>master_data/edit_barang/<?=$br['idBarang'] ?>">
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
                    url: '<?= base_url() ?>master_data/delete_barang/' + id,
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
