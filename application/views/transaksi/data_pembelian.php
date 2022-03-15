<?php echo $this->session->flashdata('berhasil_pembelian') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Pembelian
                        </h4>
                        <div class="d-flex">
						<a href="<?= base_url() ?>cetak_pdf/pdf_data_pembelian" target="_blank">
								<div class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
                            </a>
                            <a href="<?= base_url() ?>transaksi/tambah_pembelian">
                                <div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No. Transaksi
                                        </th>
                                        <th>Tanggal</th>
                                        <th>Vendor</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$i = 1;
                                    foreach ($pembelian as $pbl) { ?>
                                    <tr id="<?php echo $pbl['idPembelian'] ?>">

                                        <td class="text-center">
											<?php echo $pbl['noTransaksi'] ?>
                                        </td>
                                        <td>
											<?php echo $pbl['tanggal'] ?>
                                        </td>
                                        <td>
											<?php echo $pbl['nama'] ?>
                                        </td>
										<td>
											<?php echo $pbl['keterangan'] ?>
										</td>
                                        <td>
											Rp. <?php echo number_format($pbl['totalPembelian'], 0, '', '.') ?>
										</td>
                                        <td>
											<div class="d-flex justify-content-around">
												<button class="btn btn-info" data-toggle="modal" data-target="#modal_detail_pembelian<?= $pbl['idPembelian'] ?>">
													<i class="fas fa-search"></i> Detail</button>
												<button class="btn btn-danger d-flex align-items-center remove">
                                                    <i class="far fa-trash-alt mr-2"></i>
                                                    Hapus
                                                </button>
											</div>
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


<!-- modal detail Pembelian -->
<?php foreach ($pembelian as $pbl) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_pembelian<?= $pbl['idPembelian'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Barang</th>
                                    <th>Kuantitas</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
									<th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach($pembelian_detail as $pbdt): 
                                if ($pbl['idPembelian'] == $pbdt['idPembelian']):?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++?>
                                        </td>
                                        <td>
                                            <?= $pbdt['namaBarang'] ?>
                                        </td>
                                        <td>
                                            <?= $pbdt['kuantitas'] ?>
                                        </td>
                                        <td>
                                            Rp <?= number_format($pbdt['harga'], 0, '', '.') ?>
                                        </td>
                                        <td>
                                            Rp <?= number_format($pbdt['totalHarga'], 0, '', '.') ?>
                                        </td>
										<td>
										<?php foreach($barang as $brg) :
											if ($pbdt['namaBarang'] != $brg['nama']): ?>
											
										<?php else: ?> 
											<a href="<?= base_url() ?>transaksi/tambah_pembelian">
												<div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Barang</div>
											</a>
										<?php endif; endforeach; ?>
										
										</td>
                                    </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($pbl['totalPembelian'], 0, '', '.') ?></strong></td>
                            </tfooter>
                        </table>
                    </div>
                        <div align="right">
                            <button class="btn btn-info" type="button" data-dismiss="modal">Tutup</button>
                        </div>
                </div>
                
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
                    url: '<?= base_url() ?>transaksi/delete_pembelian/' + id,
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

