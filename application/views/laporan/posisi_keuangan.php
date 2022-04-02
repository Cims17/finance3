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
					<form action="<?php echo base_url() ?>laporan/laporan_posisi_keuangan_filter" enctype="multipart/form-data" method="post">
						<div class="d-flex">
								<div class="form-group">
									<label>Periode Akuntansi</label>
									
									<div class="d-flex align-items-center">

										<input type="date" class="form-control mr-3" name="mulai" value="" required>
										<h6 class="mr-3 my-0 weight-normal">
										s/d
										</h6>
										<input type="date" class="form-control mr-3" name="selesai" value="" required>
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
							</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
