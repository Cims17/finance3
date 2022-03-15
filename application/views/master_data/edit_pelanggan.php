<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Edit Pelanggan
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>master_data/update_pelanggan" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="idPelanggan" value="<?= $pelanggan->idPelanggan ?>" hidden>
                                <input type="text" class="form-control" name="nama" value="<?= $pelanggan->nama ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $pelanggan->alamat ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="text" class="form-control" name="notelp" value="<?= $pelanggan->no_telp ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select type="text" class="form-control selectric" name="status">
                                    <option value="Mitra" <?php echo ($pelanggan->status == "Mitra") ? "selected" : "" ?>>Mitra</option>
                                    <option value="Non Mitra" <?php echo ($pelanggan->status == "Non Mitra") ? "selected" : "" ?>>Non Mitra</option>
                                </select>
                            </div>
                            <div class="form-group d-flex">
                                <a href="<?= base_url() ?>master_data/data_pelanggan">
                                    <div class="btn btn-danger d-flex align-items-center mr-3"><i class="fa fa-times mr-2"></i>Batal</div>
                                </a>
                                <button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
