<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Saldo Awal
						</h4>
						<a href="<?= base_url() ?>master_data/tambah_saldo">
							<div class="btn btn-success"><i data-feather="plus-circle" class="mr-2" style="width: 20px;height: 20px;"></i>Tambah Saldo</div>
						</a>

					</div>
					<div class="card-body">
						<form action="<?= base_url() ?>master_data/saldo_awal" method="post" enctype="multipart/form-data">
							<div class="d-flex">
								<div class="form-group">
									<label>Periode Akuntansi</label>
									<div class="d-flex align-items-center">
										<input type="date" class="form-control mr-3" name="mulai" value="<?= $tgl['mulai'] ?>">
										<h6 class="mr-3 my-0 weight-normal">
											s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="<?= $tgl['selesai'] ?>">
										<button type="submit" class="btn btn-primary d-flex align-items-center">
											<i class="fas fas fa-search mr-2"></i>
											Filter
										</button>
									</div>
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<table class="table  table-hover table-striped" id="table-1" style="width:100%;">
								<thead>
									<tr>
										<th width="10px">No</th>
										<th>Kode Akun</th>
										<th>Jenis Akun</th>
										<th>Nama Akun</th>
										<th>Saldo Akhir</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($akun as $ak) : ?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td><?= $ak['kodeAkun'] ?></td>
											<td><?= $ak['namaJenis'] ?></td>
											<td><?= $ak['namaAkun'] ?></td>
											<td>Rp <?= number_format($ak['debit'] - $ak['kredit'], 0, ",", ",") ?></td>
											<td class="d-flex">
												<button type="button" data-toggle="modal" data-target="#detail-info<?= $ak['idAkun'] ?>" class="btn btn-info d-flex align-items-center mr-2">
													<i class="fas fa-info-circle mr-2"></i>
													Detail
												</button>
												<button type="button" data-toggle="modal" data-target="#update-saldo<?= $ak['idAkun'] ?>" class="btn btn-primary d-flex align-items-center mr-2">
													<i class="fas fa-edit mr-2"></i>
													Edit
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

<?php foreach ($akun as $ak) : ?>
	<div class="modal fade" id="update-saldo<?= $ak['idAkun'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModal">Detail Saldo Awal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url() ?>master_data/edit_saldo/<?= $ak['idAkun'] ?>" method="post" enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Kode Akun</label>
								<input type="text" class="form-control" value="<?= $ak['kodeAkun'] ?>" readonly>
							</div>
							<div class="form-group col-md-6">
								<label>Jenis Akun</label>
								<input type="text" class="form-control" value="<?= $ak['namaJenis'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>Nama Akun</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-address-card"></i>
									</div>
								</div>
								<input type="text" class="form-control" value="<?= $ak['namaAkun'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="mb-2">Tipe Saldo</label>
							<?php foreach ($log1 as $log) :
								if ($log['idAkun'] == $ak['idAkun']) { ?>
									<input type="text" class="form-control" name="idLog" value="<?= $log['idLog'] ?>" hidden>
								<?php } ?>
							<?php endforeach ?>

							<input type="text" class="form-control" name="saldoLawas" value="<?= $ak['tipe_awal'] ?>" hidden>
							<select type="text" class="form-control" id="tipe_saldo" name="tipe_saldo">
								<option value="Debit" <?= ($ak['tipe_awal'] == 'Debit') ? 'selected' : '' ?>>Debit</option>
								<option value="Kredit" <?= ($ak['tipe_awal'] == 'Kredit') ? 'selected' : '' ?>>Kredit</option>
							</select>
						</div>
						<div class="form-group">
							<label>Saldo Awal</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Rp
									</div>
								</div>
								<input type="text" class="form-control" name="saldoAwal" value="<?= $ak['saldoAwal'] ?>">
							</div>
						</div>

						<div class="d-flex justify-content-around">
							<button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
								<i class="fas fa-backspace mr-1"></i>
								Batal
							</button>
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-save mr-1"></i>
								Simpan
							</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>



<?php foreach ($akun as $ak) : ?>
	<div class="modal fade" id="detail-info<?= $ak['idAkun'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModal">Detail Saldo Awal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Kode Akun</label>
								<input type="text" class="form-control" value="<?= $ak['kodeAkun'] ?>" readonly>
							</div>
							<div class="form-group col-md-6">
								<label>Jenis Akun</label>
								<input type="text" class="form-control" value="<?= $ak['namaJenis'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>Nama Akun</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-address-card"></i>
									</div>
								</div>
								<input type="text" class="form-control" value="<?= $ak['namaAkun'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>Saldo Awal</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Rp
									</div>
								</div>
								<input type="text" class="form-control" value="<?= number_format($ak['saldoAwal'], 0, ",", ",") ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>Saldo Akhir</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										Rp
									</div>
								</div>
								<input type="text" class="form-control" value="<?= number_format($ak['debit'] - $ak['kredit'], 0, ",", ",") ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-info-circle"></i>
									</div>
								</div>
								<input type="text" class="form-control" value="<?= $ak['keterangan'] ?>" readonly>
							</div>
						</div>
						<div class="d-flex w-100 justify-content-center">
							<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
