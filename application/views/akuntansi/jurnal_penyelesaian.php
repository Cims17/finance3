<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Jurnal Penyesuaian
						</h4>
						<div class="d-flex">
						<button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</button>
							<a href="<?= base_url() ?>akuntansi/jurnal_penyesuaian/tambah_jurnal_penyesuaian">
								<div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
							</a>
						</div>

					</div>
					<div class="card-body">'
						<div class="d-flex">
							<div class="form-group">
								<label>Periode Akuntansi</label>
								<form action="<?php base_url() ?>jurnal_penyesuaian" enctype="multipart/form-data" method="post">
									<div class="d-flex align-items-center">

										<input type="date" class="form-control mr-3" name="mulai" value="<?= $tgl['mulai'] ?>">
										<h6 class="mr-3 my-0 weight-normal">
											s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="<?= $tgl['selesai'] ?>">
										<button class="btn btn-primary d-flex align-items-center mr-3" type="submit">
											<i class="fas fas fa-search mr-2"></i>
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
										<th rowspan="2">
											Kode
										</th>
										<th rowspan="2">Nama Akun</th>
										<th rowspan="2">No</th>
										<th rowspan="2">Keterangan</th>
										<th rowspan="2">Tanggal</th>

										<th colspan="2" class="text-center">Saldo</th>
										<th rowspan="2">Aksi</th>
									</tr>
									<tr class="text-center">
										<th>Debit</th>
										<th>Kredit</th>
									</tr>
								</thead>
								<tbody><?php
										$i = 1;
										foreach ($penyesuaian as $ps) : ?>
										<tr id="<?= $ps['idLog'] ?>">
											<td class="text-center">
												<?= $i++ ?>
											</td>
											<td><?= $ps['namaAkun'] ?> </td>
											<td>
												<?= $ps['kodeAkun'] ?>
											</td>
											<td>
												<?= $ps['keterangan'] ?>
											</td>
											<td>
												<?= $ps['tanggal'] ?>
											</td>
											<td>
											Rp <?= number_format($ps['debit'] , 0, ",", ",") ?>
											</td>
											<td>Rp <?= number_format($ps['kredit'] , 0, ",", ",") ?></td>
											<td class="d-flex">
												<a href="<?= base_url() ?>akuntansi/jurnal_penyesuaian/edit_jurnal_penyesuaian/<?= $ps['idLog'] ?>">
													<div class="btn btn-primary d-flex align-items-center mr-2">
														<i class="fas fa-edit mr-2"></i>
														Edit
													</div>
												</a>
												<div class="btn btn-danger d-flex align-items-center remove">
													<i class="far fa-trash-alt mr-2"></i>
													Hapus
												</div>

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

<!-- Modal Cetak PDF -->
<div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Cetak PDF Jurnal Penyesuaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>akuntansi/laporan_akuntansi/pdf_jurnal_penyesuaian" enctype="multipart/form-data" method="post" target="_blank">
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
			<a href="<?php echo base_url() ?>akuntansi/laporan_akuntansi/pdf_jurnal_penyesuaian" target="_blank">
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
                    url: '<?= base_url() ?>akuntansi/jurnal_penyesuaian/delete_jurnal_penyesuaian/' + id,
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

