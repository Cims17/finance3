<div class="main-content">
    <?php foreach ($nama as $kk) :

    endforeach ?>
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
                                        <label for="" class="my-auto">Nama Akun : </label>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <span class="mr-3">:</span>
                                        <select class="form-control select2 w-100" name="idAkun">
                                            <?php foreach ($akun2 as $ak2) : ?>
                                                <option value="<?= $ak2['idAkun'] ?>" <?php echo ($ak2['idAkun'] == $akun->idAkun) ? "selected" : ""; ?>><?= $ak2['namaAkun'] ?></option>
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
                                        <input type="date" class="form-control" value="<?= $nama['mulai'] ?>" name="mulai">
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
                                        <input type="date" class="form-control" value="<?= $nama['selesai'] ?>" name="selesai">
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
                            Nama Akun : <?=$ak2['namaAkun']?>
                        </h4>


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th rowspan="2" width="10px">
                                            No
                                        </th>
                                        <th rowspan="2">Nama Akun</th>
                                        <th rowspan="2">Kode Akun</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Tanggal</th>

                                        <th colspan="2" class="text-center">Saldo</th>
                                        <th rowspan="2">Sumber</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody><?php
                                        $i = 1;
                                        foreach ($filter as $ps) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $ps['namaAkun'] ?></td>
                                            <td>
                                                <?= $ps['kodeAkun'] ?>
                                            </td>
                                            <td>
                                                <?= $ps['keterangan'] ?>
                                            </td>
                                            <td>
                                                <?php echo date("Y-m-d", strtotime($ps['tanggal']));  ?>
                                            </td>
                                            <td>
                                                <?= $ps['debit'] ?>
                                            </td>
                                            <td><?= $ps['kredit'] ?></td>
                                            <td>
                                            <?= $ps['input_from'] ?>
                                            </td>



                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>