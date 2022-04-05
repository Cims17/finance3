<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tabel Laporan Laba Rugi
						</h4>
						<div class="d-flex">

							<button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</button>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="form-group">
								<label>Periode Akuntansi</label>
								<form action="<?php base_url() ?>laporan_laba_rugi" enctype="multipart/form-data" method="post">
									<div class="d-flex align-items-center">

										<input type="date" class="form-control mr-3" name="mulai" value="<?= $tgl['mulai'] ?>">
										<h6 class="mr-3 my-0 weight-normal">
											s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="<?= $tgl['selesai'] ?>">
										<button class="btn btn-primary d-flex align-items-center" type="submit">
											<i class="fas fas fa-search mr-2"></i>
											Filter
										</button>

									</div>
								</form>
							</div>
						</div>
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
										<th class="text-left border-bottom" colspan="2"><span>Pendapatan</span></th>
										<th class="border-bottom" colspan="3"></th>
									</tr>
									<tr>
										<td class="text-center border-bottom"></td>
										<td class="text-left border-bottom">Penjualan</td>
										<td class="text-right border-bottom" colspan="2">
											<?php foreach ($jumlah_penjualan as $jml_pjl); ?>
											Rp. <?= number_format($jml_pjl['totalPenjualan'], 0, '', '.') ?>
										</td>
										<td class="border-bottom"></td>
									</tr>
									<?php foreach ($jenis as $jns) : ?>
												<?php if ($jns['id_tipeAkun'] == 5) : ?>
													<?php foreach ($akun as $ak) : ?>
														<?php if ($jns['idJenis'] == $ak['idJenis']) : ?>
															<tr>
																<td class="border-bottom"></td>
																<td class="text-left border-bottom"><?= $ak['namaAkun'] ?></td>
																<td class="text-right border-bottom" colspan="2">
																	Rp. <?= number_format($ak['debit'] - $ak['kredit'], 0, '', '.') ?>
																</td>
																<td class="border-bottom"></td>
															</tr>

														<?php endif ?>
													<?php endforeach ?>
												<?php endif ?>
											<?php endforeach ?>
									<tr>
										<th class="text-left border-bottom" colspan="4">Laba Kotor</th>
										<th class="text-center border-bottom" colspan="1">Rp. <?= number_format($jml_pjl['totalPenjualan'] - $total_hpp, 0, '', '.') ?></th>
									</tr>
									<tr>
										<th class="text-left border-bottom" colspan="2"><span>Beban</span></th>
										<th class="border-bottom" colspan="3"></th>
									</tr>
									<tr>
										<td class="text-center border-bottom"></td>
										<td class="text-left border-bottom">Pembelian</td>
										<td class="text-right border-bottom" colspan="2">
											<?php foreach ($jumlah_pembelian as $jml_pbl); ?>
											Rp. <?= number_format($jml_pbl['totalPembelian'], 0, '', '.') ?>
										</td>
										<td class="border-bottom"></td>
									</tr>
									<?php foreach ($jenis as $jns) : ?>
												<?php if ($jns['id_tipeAkun'] == 2) : ?>
													<?php foreach ($akun as $ak) : ?>
														<?php if ($jns['idJenis'] == $ak['idJenis']) : ?>
															<tr>
																<td class="border-bottom"></td>
																<td class="text-left border-bottom"><?= $ak['namaAkun'] ?></td>
																<td class="text-right border-bottom" colspan="2">
																	Rp. <?= number_format($ak['debit'] - $ak['kredit'], 0, '', '.') ?>
																</td>
																<td class="border-bottom"></td>
															</tr>

														<?php endif ?>
													<?php endforeach ?>
												<?php endif ?>
											<?php endforeach ?>
									<tr>
										<th class="text-left border-bottom" colspan="4">Total Beban</th>
										<th class="text-center border-bottom">Rp. <?= number_format($jml_pbl['totalPembelian'] + $total_beban, 0, '', '.') ?></th>
									</tr>
									<tr>
										<th class="text-left " colspan="4">Laba / Rugi Bersih</th>
										<th class="text-center">Rp. <?= number_format(($jml_pjl['totalPenjualan'] - $total_hpp) - ($jml_pbl['totalPembelian'] + $total_beban), 0, '', '.') ?></td>
									</tr>
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
				<h5 class="modal-title" id="formModal">Cetak PDF Laba Rugi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>laporan/laporanpdf_laba_rugi" enctype="multipart/form-data" method="post" target="_blank">
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
