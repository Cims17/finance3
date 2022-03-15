<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-11">
                <div class="card card-primary">
                    <div class="card-header " style="color:black">
                        <h3 class="mb-0">
                            Laporan
                        </h3>
                    </div>
                    <div class="card-body" style="color:black">
                        <h5>
                            Total Transaksi
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Pengeluaran</td>

                                        <td>
                                            Rp <?= number_format($pengeluaran->jumlah, 0, ",", ".") ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Pemasukan</td>

                                        <td>
                                            Rp <?= number_format($pemasukan->jumlah, 0, ",", ".") ?>
                                        </td>


                                    </tr>
                                </tbody>
                            </table>
                            <!-- <h5>
                                Total Transaksi
                            </h5>
                            <a href="">Tampilkan Total Transaksi</a>
                            <hr class="mt-2 mb-2"> -->
                            <h5>
                                Unduh Laporan
                            </h5>
                            <a href="<?php echo base_url()?>laporan/export"  class="btn btn-icon icon-left btn-primary mb-3"><i class="fas fa-download"></i> Download</a>
                            <hr class="m-0 mb-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>