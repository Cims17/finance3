<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tabel Laporan Posisi Keuangan
						</h4>
						<div class="d-flex">
								<button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</button>

						</div>
					</div>
					<div class="card-body">
						<form action="" enctype="multipart/form-data" method="post">
							<div class="d-flex">
								<div class="form-group">
									<label>Periode Akuntansi</label>

									<div class="d-flex align-items-center">

										<input type="date" class="form-control mr-3" name="mulai" value="<?= $nama['mulai'] ?>">
										<h6 class="mr-3 my-0 weight-normal">
											s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="<?= $nama['selesai'] ?>">
										<button class="btn btn-primary d-flex align-items-center" type="submit">
											<i class="fas fas fa-search mr-2"></i>
											Filter
										</button>

									</div>
								</div>
							</div>
						</form>
						<div class="card">
							<div class="card-header d-block justify-content-center">
								<div class="text-center">
									<h4 class="my-0 col-black">Data Posisi Keuangan</h4>
								</div>
								<div class="text-center">
									<h6 class="mt-1 mb-0 col-black">
										Periode <?= $nama['mulai'] ?> s/d <?= $nama['selesai'] ?>
									</h6>
								</div>


							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<!-- <thead>
											<tr>
												<th class="bg-white border-bottom col-black" colspan="3"><span class="ml-2">Pendapatan</span></th>
												<th class="bg-white border-bottom" colspan="3"></th>
												<th class="bg-white border-bottom" colspan="3"></th>
											</tr>
										</thead> -->
										<tbody>
											<tr>
												<th class="text-left border-bottom" colspan="2"><span>
														<h5>Aset</h5>
													</span></th>
												<th class="border-bottom" colspan="3"></th>
											</tr>
											<?php foreach ($jenis as $jns) { ?>
												<?php if ($jns['id_tipeAkun'] == 3) { ?>
													<tr>
														<th class="text-center border-bottom"></th>
														<th class="text-left border-bottom" colspan="4" style="width:90%"><?= $jns['namaJenis'] ?></th>
													</tr>
													<?php foreach ($akun as $ak) { ?>
														<?php if ($jns['idJenis'] == $ak['idJenis']) { ?>
															<tr>
																<td class="border-bottom"></td>
																<td class="text-left border-bottom" style="width:45%"><?= $ak['namaAkun'] ?></td>
																<td class="text-right border-bottom" colspan="2">
																	Rp. <?= number_format(abs($ak['debit'] - $ak['kredit']), 0, '', '.') ?>
																</td>
																<td class="border-bottom"></td>
															</tr>

														<?php } ?>
													<?php } ?>
													<tr>
														<th class="border-bottom"></th>
														<th class="text-left border-bottom" colspan="3">Total <?= $jns['namaJenis'] ?></th>
														<?php foreach ($total_jenis as $ttl_jns) { ?>
															<?php if ($jns['idJenis'] == $ttl_jns['idJenis']) { ?>
																<th class="text-center border-bottom">Rp. <?= number_format($ttl_jns['debit'] - $ttl_jns['kredit'], 0, '', '.') ?></th>
															<?php } ?>
														<?php } ?>
													</tr>

												<?php } ?>
											<?php } ?>
											<tr>
												<th class="text-left border-bottom" colspan="3">
													<h4>Total Aset</h4>
												</th>
												<th class="text-center border-bottom" colspan="2">
													<h4>Rp. <?= number_format($total_aset, 0, '', '.') ?></h4>
												</th>
											</tr>
											<tr>
												<th class="text-left border-bottom" colspan="2"><span>
														<h5>Liabilitas dan Ekuitas</h5>
													</span></th>
												<th class="border-bottom" colspan="3"></th>
											</tr>
											<?php foreach ($jenis as $jns) : ?>
												<?php if ($jns['id_tipeAkun'] == 4) : ?>
													<tr>
														<th class="text-center border-bottom"></th>
														<th class="text-left border-bottom" colspan="4"><?= $jns['namaJenis'] ?></th>
													</tr>
													<?php foreach ($akun as $ak) : ?>
														<?php if ($jns['idJenis'] == $ak['idJenis']) : ?>
															<tr>
																<td class="border-bottom"></td>
																<td class="text-left border-bottom"><?= $ak['namaAkun'] ?></td>
																<td class="text-right border-bottom" colspan="2">
																	Rp. <?= number_format(abs($ak['debit'] - $ak['kredit']), 0, '', '.') ?>
																</td>
																<td class="border-bottom"></td>
															</tr>

														<?php endif ?>
													<?php endforeach ?>
													<tr>
														<th class="border-bottom"></th>
														<th class="text-left border-bottom" colspan="3">Total <?= $jns['namaJenis'] ?></th>
														<?php foreach ($total_jenis as $ttl_jns) { ?>
															<?php if ($jns['idJenis'] == $ttl_jns['idJenis']) { ?>
																<th class="text-center border-bottom">Rp. <?= number_format(abs($ttl_jns['debit'] - $ttl_jns['kredit']), 0, '', '.') ?></th>
														<?php }
														} ?>
													</tr>
												<?php endif ?>
											<?php endforeach ?>
											<tr>
										<th class="text-left " colspan="4">Laba / Rugi Bersih</th>
										<th class="text-center">Rp. <?= number_format($laba_rugi_bersih , 0, '', '.') ?></td>
									</tr>
											<tr>
												<th class="text-left border-bottom" colspan="3">
													<h4>Total Liabilitas dan Ekuitas</h4>
												</th>
												<th class="text-center border-bottom" colspan="2">
														<h4>Rp. <?= number_format(abs($total_liabilitas_ekuitas - $laba_rugi_bersih), 0, '', '.') ?></h4>
												</th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
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
				<h5 class="modal-title" id="formModal">Cetak PDF Posisi Keuangan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>laporan/laporanpdf_posisi_keuangan" enctype="multipart/form-data" method="post" target="_blank">
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
