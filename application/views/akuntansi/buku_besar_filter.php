<div class="main-content">
	<?php foreach ($nama as $kk) :

	endforeach ?>
	<section class="section">
		<div class="row">
			<div class="col-7">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Pilih Akun
						</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url() ?>akuntansi/buku_besar/akun" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<div class="col-3 d-flex align-items-center">
										<label for="" class="my-auto">Nama Akun : </label>
									</div>
									<div class="col-9 d-flex align-items-center">
										<span class="mr-3">:</span>
										<select class="form-control select2 w-100" name="idAkun">
											<?php foreach ($akun2 as $ak2) : ?>
												<option value="<?= $ak2['idAkun'] ?>" <?php echo ($ak2['idAkun'] == $akun->idAkun) ? "selected" : ""; ?>><?= $ak2['namaAkun'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-3 d-flex align-items-center">
										<label for="" class="my-auto">Tanggal Awal</label>
									</div>
									<div class="col-9 d-flex align-items-center">
										<span class="mr-3">:</span>
										<input type="date" class="form-control" value="<?= $nama['mulai'] ?>" name="mulai">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-3 d-flex align-items-center">
										<label for="" class="my-auto">Tanggal Akhir</label>
									</div>
									<div class="col-9 d-flex align-items-center">
										<span class="mr-3">:</span>
										<input type="date" class="form-control" value="<?= $nama['selesai'] ?>" name="selesai">
									</div>
								</div>
							</div>
							<div class="form-group mb-2">
								<div class="row">
									<div class="col-3 d-flex align-items-center">

									</div>
									<div class="col-9 d-flex align-items-center">
										<div class="mr-3" style="color: white;">:</div>
										<div class="d-flex">
											<button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter mr-2"></i></i>Filter</button>
											<button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</button>
										</div>

									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Nama Akun : <?= $nama['namaAkun'] ?>
						</h4>


					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-1">
								<thead>
									<tr>
										<th rowspan="2" width="10px">
											No
										</th>
										<th rowspan="2">Nama Akun</th>
										<th rowspan="2">Kode Akun</th>
										<th rowspan="2">Keterangan</th>
										<th rowspan="2">Tanggal</th>

										<th colspan="2" class="text-center">Saldo</th>
										<th rowspan="2">Sumber</th>
									</tr>
									<tr class="text-center">
										<th>Debit</th>
										<th>Kredit</th>
									</tr>
								</thead>
								<tbody><?php
										$i = 1;
										foreach ($filter as $ps) : ?>
										<tr>
											<td class="text-center">
												<?= $i++ ?>
											</td>
											<td><?= $ps['namaAkun'] ?></td>
											<td>
												<?= $ps['kodeAkun'] ?>
											</td>
											<td>
												<?= $ps['keterangan'] ?>
											</td>
											<td>
												<?php echo date("Y-m-d", strtotime($ps['tanggal']));  ?>
											</td>
											<td>
												<?= $ps['debit'] ?>
											</td>
											<td><?= $ps['kredit'] ?></td>
											<td>
												<?= $ps['input_from'] ?>
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
</div>
</section>
</div>

<!-- Modal Cetak PDF -->
<div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModal">Cetak PDF Buku Besar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>akuntansi/laporan_akuntansi/pdf_buku_besar" enctype="multipart/form-data" method="post" target="_blank">
					<div class="form-group">
						<label>Nama Akun</label>
						<div class="input-group">
							<select class="form-control w-100" name="idAkun" required>
								<option value="" selected disabled>Pilih Nama Akun</option>
								<?php foreach ($akun2 as $ak2) : ?>
									<option value="<?= $ak2['idAkun'] ?>"><?= $ak2['namaAkun'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
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
					</div>


				</form>
			</div>
		</div>
	</div>
</div>
