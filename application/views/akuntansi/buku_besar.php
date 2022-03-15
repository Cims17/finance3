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
                                            <div class="btn btn-warning"><i class="fas fa-print mr-2"></i>Cetak PDF</div>
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