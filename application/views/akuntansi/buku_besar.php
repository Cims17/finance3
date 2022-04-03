<div class="main-content">
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
                                        <label for="" class="my-auto">Nama Akun</label>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <span class="mr-3">:</span>
                                        <select class="form-control select2 w-100" name="idAkun">
                                            <?php foreach ($akun as $ak) : ?>
                                                <option value="<?= $ak['idAkun'] ?>"><?= $ak['namaAkun'] ?></option>
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
                                        <input type="date" class="form-control" name="mulai">
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
                                        <input type="date" class="form-control" name="selesai">
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
                            Nama Akun :
                        </h4>


                    </div>
                    <div class="card-body">
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
        <form action="<?php echo base_url() ?>akuntansi/laporan_akuntansi/pdf_jurnal_umum_all" enctype="multipart/form-data" method="post" target="_blank">
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
			<a href="<?php echo base_url() ?>akuntansi/laporan_akuntansi/pdf_jurnal_umum_all" target="_blank">
				<div class="btn btn-warning waves-effect my-auto mr-2"><i class="fas fa-print mr-2"></i></i>Cetak Semua</div>
            </a>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>
