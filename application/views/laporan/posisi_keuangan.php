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
                            <a href="">
                                <div class="btn btn-warning"><i class="fas fa-print mr-2"></i>Cetak PDF</div>
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
					<form action="" enctype="multipart/form-data" method="post">
						<div class="d-flex">
								<div class="form-group">
									<label>Periode Akuntansi</label>
									
									<div class="d-flex align-items-center">

										<input type="date" class="form-control mr-3" name="mulai" value="">
										<h6 class="mr-3 my-0 weight-normal">
										s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="">
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
											Periode .. s/d ..
									</h6>
								</div>
                                
                                
                            </div>
							<div class="card-body">
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
												<th class="text-left border-bottom" colspan="2"><span><h5>Aset</h5></span></th>
												<th class="border-bottom" colspan="3"></th>
											</tr>
											<tr>
												<th class="text-center border-bottom"></th>
												<th class="text-left border-bottom" colspan="4" >[Jenis Akun]</th>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3">Total [JenisAKun]</th>
												<th class="text-center border-bottom">Rp. <?= number_format(100000 , 0, '', '.') ?></th>
											</tr>
											<tr>
												<th class="text-center border-bottom"></th>
												<th class="text-left border-bottom" colspan="4" >[Jenis Akun]</th>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3">Total [JenisAKun]</th>
												<th class="text-center border-bottom">Rp. <?= number_format(100000 , 0, '', '.') ?></th>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3"><h4>Total Aset</h4></th>
												<th class="text-center border-bottom"><h4>Rp. <?= number_format(100000 , 0, '', '.') ?></h4></th>
											</tr>
											<tr>
												<th class="text-left border-bottom" colspan="2"><span><h5>Liabilitas dan Ekuitas</h5></span></th>
												<th class="border-bottom" colspan="3"></th>
											</tr>
											<tr>
												<th class="text-center border-bottom"></th>
												<th class="text-left border-bottom" colspan="4" >[Jenis Akun]</th>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3">Total [JenisAKun]</th>
												<th class="text-center border-bottom">Rp. <?= number_format(100000 , 0, '', '.') ?></th>
											</tr>
											<tr>
												<th class="text-center border-bottom"></th>
												<th class="text-left border-bottom" colspan="4" >[Jenis Akun]</th>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<td class="text-center border-bottom"></td>
												<td class="text-left border-bottom" >[No.Akun]<span class="ml-5">[Nama Akun]</span></td>
												<td class="text-right border-bottom" colspan="2">
													Rp. <?= number_format(100000, 0, '', '.') ?>
												</td>
												<td class="border-bottom"></td>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3">Total [JenisAKun]</th>
												<th class="text-center border-bottom">Rp. <?= number_format(100000 , 0, '', '.') ?></th>
											</tr>
											<tr>
												<th class="border-bottom"></th>
												<th class="text-left border-bottom" colspan="3"><h4>Total Liabilitas dan Ekuitas</h4></th>
												<th class="text-center border-bottom"><h4>Rp. <?= number_format(100000 , 0, '', '.') ?></h4></th>
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
