<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Daftar Transaksi
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Transaksi</th>
                                        <th>Jumlah</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Tipe Transaksi</th>

                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($transaksi as $tran) : ?>
                                        <tr>

                                            <td class="text-center">
                                                <?php echo $i++ ?>
                                            </td>
                                            <td><?= $tran['judul'] ?></td>
                                            <td>
                                                <?= $tran['jumlah'] ?>
                                            </td>
                                            <td>
                                                <?= $tran['jenis_transaksi'] ?>
                                            </td>
                                            <td>
                                                <?= $tran['tipe_transaksi'] ?>
                                            </td>
                                            <td><?= $tran['tanggal'] ?></td>


                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>