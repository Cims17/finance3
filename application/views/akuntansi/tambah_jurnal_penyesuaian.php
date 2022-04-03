<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Tambah Jurnal Penyesuaian
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>akuntansi/jurnal_penyesuaian/save_jurnal_penyesuaian" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Kode Akun</label>
                                        <select class="form-control select2" name="idAkun">
                                            <?php foreach ($akun as $ak ): ?>
                                            <option value="<?=$ak['idAkun']?>"><?=$ak['namaAkun']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="">Jenis Saldo</label>
                                        <select class="form-control select2" name="jenisSaldo">
                                            <option value="Kredit">Kredit</option>
                                            <option value="Debit">Debit</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="">Nominal</label>
                                        <input type="text" class="form-control" name="nominal">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group d-flex">
                                <button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
