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
                            <a href="">
                                <div class="btn btn-warning"><i class="fas fa-print mr-2"></i>Cetak PDF</div>
                            </a>
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
                        <div class="table-responsive" >
                            <table class="table table-hover" >
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
                                        <td class="text-left border-bottom" ><span class="ml-5">Penjualan</span></td>
                                        <td class="text-right border-bottom" colspan="2">
                                            <?php foreach ($jumlah_penjualan as $jml_pjl); ?>
                                            Rp. <?= number_format($jml_pjl['totalPenjualan'], 0, '', '.') ?>
                                        </td>
										<td class="border-bottom"></td>
                                    </tr>
                                    <tr>
                                        <th class="border-bottom"></th>
                                        <th class="text-left border-bottom" colspan="3">Total Pendapatan</th>
                                        <th class="text-center border-bottom">Rp. <?= number_format($jml_pjl['totalPenjualan'] , 0, '', '.') ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-left border-bottom" colspan="2"><span>Beban</span></th>
										<th class="border-bottom" colspan="3"></th>
                                    </tr>
                                    <tr>
										<td class="text-center border-bottom"></td>
                                        <td class="text-left border-bottom" ><span class="ml-5">Pembelian</span></td>
                                        <td class="text-right border-bottom" colspan="2">
                                            <?php foreach ($jumlah_pembelian as $jml_pbl); ?>
                                            Rp. <?= number_format($jml_pbl['totalPembelian'], 0, '', '.') ?>
                                        </td>
										<td class="border-bottom"></td>
                                    </tr>
                                    <tr>
                                        <th class="border-bottom"></th>
                                        <th class="text-left border-bottom" colspan="3">Total Pengeluaran</th>
                                        <th class="text-center border-bottom">Rp. <?= number_format($jml_pbl['totalPembelian'], 0, '', '.') ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-left " colspan="3">Laba / Rugi Bersih</th>
                                        <th class="text-center">Rp. <?= number_format($jml_pjl['totalPenjualan'] - $jml_pbl['totalPembelian'], 0, '', '.') ?></td>
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
