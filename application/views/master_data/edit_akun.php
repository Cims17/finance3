<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Edit Akun
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>master_data/update_akun" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">No Akun</label>
                                <input type="text" value="<?= $akun->idAkun ?>" hidden name="idAkun">
                                <input type="number" class="form-control" name="kodeAkun" value="<?= $akun->kodeAkun ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Akun</label>
                                <input type="text" class="form-control" name="namaAkun" value="<?= $akun->namaAkun ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Akun</label>
                                <select name="jenis" id="jenis" class="form-control selectric">
                                    <?php foreach ($jenis as $jns) : ?>
                                        <option value="<?=$jns['idJenis']?>" <?php echo ($jns['idJenis'] == $akun->idJenis) ? 'selected' : ''?>><?=$jns['namaJenis']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" value="<?= $akun->keterangan ?>">
                            </div>
                            
                            <div class="form-group d-flex">
                                <a href="<?= base_url() ?>master_data/data_perkiraan_akun">
                                    <div class="btn btn-danger d-flex align-items-center mr-3"><i class="fa fa-times mr-2"></i>Batal</div>
                                </a>
                                <button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-check mr-2"></i>Simpan</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>