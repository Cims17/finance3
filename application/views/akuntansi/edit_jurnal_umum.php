<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Edit Jurnal Umum
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>akuntansi/jurnal_umum/update_jurnal_umum" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Kode Akun</label>
                                        <select class="form-control select2" name="kodeAkun" disabled>

                                            <option value="<?= $akun2->kodeAkun ?>"><?= $akun2->idAkun ?></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <input type="text" class="form-control" name="idLog" value="<?= $jurnal->idLog ?>" hidden>
                                        <input type="text" class="form-control" name="idAkun" value="<?= $jurnal->idAkun ?>" hidden>
                                        <input type="text" class="form-control" name="keterangan" value="<?= $jurnal->keterangan ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Jenis Saldo</label>
                                        <input type="text" value="<?php echo ($jurnal->kredit != 0) ? 'Kredit':'Debit'?>" name="saldoLawas" hidden>
                                        <select class="form-control selectric" name="jenisSaldo" >

                                            <option value="Kredit" <?php echo ($jurnal->kredit != 0) ? "selected" : "" ?>>Kredit</option>
                                            <option value="Debit" <?php echo ($jurnal->debit != 0) ? "selected" : "" ?>>Debit</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Nominal</label>
                                        <input type="text" class="form-control" name="nominal" value="<?php echo ($jurnal->kredit != 0) ? "$jurnal->kredit" : "$jurnal->debit" ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group d-flex">
                                <a href="<?=base_url()?>akuntansi/jurnal_umum"><div class="btn btn-danger d-flex align-items-center mr-3"><i class="fas fa-times mr-2"></i>Batal</div></a>
                                <button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>