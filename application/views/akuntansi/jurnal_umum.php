<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Jurnal Umum
						</h4>
						<div class="d-flex">
							<a href="<?= base_url() ?>akuntansi/jurnal_umum/tambah_jurnal_umum">
								<div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</div>
							</a>

						</div>

					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="form-group">
								<label>Periode Akuntansi</label>
								<form action="<?php base_url() ?>jurnal_umum" enctype="multipart/form-data" method="post">
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
										<a href="<?= base_url() ?>akuntansi/laporan_akuntansi/pdf_jurnal_umum_all" class="d-flex align-items-center w-100" target="_blank">
											<div class="btn btn-warning"><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
										</a>

									</div>
								</form>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped" id="table-1">
								<thead>
									<tr>
										<th class="text-center" rowspan="2">
											No.
										</th>
										<th rowspan="2">Nama Akun</th>
										<th rowspan="2">No. Akun</th>
										<th rowspan="2">Keterangan</th>
										<th rowspan="2">Tanggal</th>
										<th colspan="2">Saldo</th>
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
									foreach ($umum as $um) : ?>
										<tr id="<?= $um['idLog'] ?>">
											<td class="text-center">
												<?= $i++ ?>
											</td>
											<td><?= $um['namaAkun'] ?></td>
											<td>
												<?= $um['kodeAkun'] ?>
											</td>
											<td>
												<?= $um['keterangan'] ?>
											</td>
											<td>
												<?= $um['tanggal'] ?>
											</td>
											<td>
												<?= $um['debit'] ?>
											</td>
											<td><?= $um['kredit'] ?></td>
											<td class="d-flex">
												<a href="<?= base_url() ?>akuntansi/jurnal_umum/edit_jurnal_umum/<?= $um['idLog'] ?>">
													<div class="btn btn-primary d-flex align-items-center mr-2">
														<i class="fas fa-edit mr-2"></i>
														Edit
													</div>
												</a>
												<div class="btn btn-danger d-flex align-items-center">
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
