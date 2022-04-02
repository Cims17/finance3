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
							<div class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
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
										<a href="<?= base_url() ?>master_data/pdfinfo_perusahaanall" target="_blank">
											<div class="btn btn-warning my-auto "><i class="fas fa-print mr-2"></i></i>Cetak PDF</div>
										</a>

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
												<?= $ps['tanggal'] ?>
											</td>
											<td>
												<?= $ps['debit'] ?>
											</td>
											<td><?= $ps['kredit'] ?></td>
											<td class="d-flex">
												<a href="<?= base_url() ?>akuntansi/jurnal_penyesuaian/edit_jurnal_penyesuaian/<?= $ps['idLog'] ?>">
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
