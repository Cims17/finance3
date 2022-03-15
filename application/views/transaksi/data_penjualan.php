<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Data Penjualan
                        </h4>
                        <div class="d-flex">
							<button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2">
								<i class="fas fa-print mr-2"></i>Cetak PDF
							</button>
                            <a href="<?= base_url() ?>transaksi/tambah_penjualan">
                                <div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
					<div class="d-flex">
						<div class="form-group">
							<label>Periode Penjualan</label>
							<form action="<?php base_url() ?>daftar_penjualan" enctype="multipart/form-data" method="post">
							<div class="d-flex align-items-center">

								<input type="date" class="form-control mr-3" name="mulai" value="<?= $tgl['mulai'] ?>">
								<h6 class="mr-3 my-0 weight-normal">
								s/d
								</h6>
								<input type="date" class="form-control mr-3" name="selesai" value="<?= $tgl['selesai'] ?>">
								<button class="btn btn-primary d-flex align-items-center" type="submit">
								<i class="fas fa-search mr-2"></i>
								Filter
								</button>

							</div>
							</form>
						</div>
					</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No. Transaksi
                                        </th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>

                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$i = 1;
                                    foreach ($penjualan as $pjl) { ?>
                                    <tr id="<?php echo $pjl['idTransaksi'] ?>">

                                        <td class="text-center">
											<?php echo $pjl['noTransaksi'] ?>
                                        </td>
                                        <td><?php echo $pjl['tanggal'] ?></td>
                                        <td>
											<?php echo $pjl['nama'] ?>
                                        </td>
                                        <td>
											<?php echo $pjl['keterangan'] ?>
                                        </td>
                                        <td>Rp. <?php echo number_format($pjl['total'], 0, '', '.') ?></td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <button class="btn btn-info" data-toggle="modal" data-target="#modal_detail_transaksi<?= $pjl['idTransaksi'] ?>">
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

<!-- modal detail Penjualan -->
<?php foreach ($penjualan as $pjl) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_transaksi<?= $pjl['idTransaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi</h5>
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
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach($detail_penjualan as $dtpj): 
                                if ($pjl['idTransaksi'] == $dtpj['idTransaksi']):?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++?>
                                        </td>
                                        <td>
                                            <?= $dtpj['namaBarang'] ?>
                                        </td>
                                        <td>
                                            <?= $dtpj['kuantitas'] ?>
                                        </td>
                                        <td>
                                            Rp <?= number_format($dtpj['harga'], 0, '', '.') ?>
                                        </td>
                                        <td>
                                            Rp <?= number_format($dtpj['total'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($pjl['total'], 0, '', '.') ?></strong></td>
                            </tfooter>
                        </table>
						<table class="table table-striped table-condensed" style="margin-top:10px;">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><strong>Bayar :</strong></td>
                                                    <td><strong>Rp.<?= number_format($pjl['bayar'], 0, '', '.') ?></strong></td>
                                                    <td class="text-right"><strong>Kembalian:</strong></td>
                                                    <td><strong>Rp.<?= number_format($pjl['bayar']-$pjl['total'] , 0, '', '.') ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>

                    </div>
                        <div align="right">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                        </div>
                </div>
                
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Cetak PDF -->
<div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Cetak PDF Data Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php base_url() ?>pdf_data_penjualan" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label>Tanggal Mulai</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="date" class="form-control" name="mulai" required>
            </div>
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="date" class="form-control" name="selesai" required>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-danger waves-effect mr-3 d-flex" data-dismiss="modal">
              <i class="fas fa-times my-auto mr-2"></i>
              Batal
            </button>
            <button type="submit" class="btn btn-primary waves-effect mr-3 d-flex">
              <i class="fas fa-print my-auto mr-2"></i>
              Cetak
            </button>
						<a href="<?= base_url() ?>cetak_pdf/pdf_data_penjualan" target="_blank">
								<div class="btn btn-warning waves-effect my-auto mr-2"><i class="fas fa-print mr-2"></i></i>Cetak Semua</div>
            </a>
          </div>


        </form>
      </div>
    </div>
  </div>
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
                    url: '<?= base_url() ?>transaksi/delete_penjualan/' + id,
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
