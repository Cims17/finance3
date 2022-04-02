<?php echo $this->session->flashdata('berhasil_beli') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card" style="overflow: hidden;">
                    <div class="card-header">
                        <h4>
                            Daftar Produk
                        </h4>
                    </div>
                    <div class="card-body " style="max-height: 82vh; overflow-y:scroll">
                        <div id="lefttop">
                            <div class="form-group">
                                <p align="left"><a href="#" title="Cari Barang"><i class="fa fa-search"></i></a> Cari Barang </p>
                                <form>
                                    <div class="form-group">
                                        <input class="form-control" name="idbarang" type="text" onkeyup="showResult(this.value)" placeholder="Ketik Nama Barang">
                                        <div id="hasilcari">

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <form action="" method="post">
                            <?php foreach ($jenis as $jns) : ?>
                                <h6 class="text-dark"><?= $jns['namaJenis'] ?></h6>
                                <div class="row">
                                    <?php foreach ($barang as $brg) : ?>
                                        <?php if ($brg['idJenis'] == $jns['idJenis']) : ?>
                                            <?php if ($brg['stok'] > '0') : ?>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group text-center">
                                                        <div class="card card-primary">
                                                            <a href="#" data-id="<?= $brg['idBarang'] ?>" data-name="<?php echo str_replace(" ", "_", $brg['nama']); ?>" data-price="<?= $brg['harga'] ?>" class="add-to-cart">
                                                                <div class="card-header">
                                                                    <h3 class="mt-2 mb-0 font-18 text-dark"><?= $brg['nama'] ?></h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <h6 class="text-dark font-15">Rp. <?= number_format($brg['harga'], 0, '', '.') ?></h6>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <form id="formTerjual" action="<?php base_url() ?>terjual" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="card h-100" style="overflow: hidden;">
                                <div class="card-header">
                                    <h4>
                                        Transaksi
                                    </h4>

                                </div>
                                <div class="card-body">
                                    <div class="container" style="height: 25vh;overflow-y:scroll">
                                        <div class="row py-1 border-bottom border-top text-dark font-weight-bold">
                                            <div class="col-4 my-auto  font-16">
                                                Nama
                                            </div>
                                            <div class="col-3 my-auto  font-16 text-center">
                                                Jumlah
                                            </div>
                                            <div class="col-3 my-auto  font-16">
                                                Total
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="show-cart table">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4>
                                        Pembayaran
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="">Total Belanja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="text" class="form-control " id="total-cart" name="total_belanja" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Uang</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" min="0" class="form-control" name="bayar" id="uang">
                                        </div>
                                    </div>

                                    <!-- Input tanggal digunakan saat preorder -->
                                    <input hidden id="noTransaksi" type="text" name="noTransaksi" value="<?php echo $noTransaksi ?>" class="form-control">
                                    <input hidden id="idPelangganHasil" type="text" name="idPelanggan" class="form-control">
                                    <input hidden id="keteranganhasil" type="text" name="keterangan" class="form-control">

                                    <div class="d-flex">
                                        <div class="clear-cart btn btn-danger mr-3" type="button">
                                            Batal
                                        </div>
                                        <div class="btn btn-success" onclick="lanjut_bayar()" type="button">
                                            Lanjut ke Pembayaran
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Pembayaran-->
                    <div class="modal fade" id="modal_kembalian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-center">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>
                                                Total Belanja
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        Rp
                                                    </div>
                                                </div>
                                                <input id="total_belanja" type="text" name="total_belanja" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>
                                                Kembalian
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        Rp
                                                    </div>
                                                </div>
                                                <input id="kembalian" type="text" name="kembalian" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Kode Transaksi
                                        </label>
                                        <div class="input-group">
                                            <input id="noTransaksi" type="text" name="noTransaksi" class="form-control" value="<?php echo $noTransaksi ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Pelanggan
                                        </label>
                                        <div class="input-group">
                                            <select type="text" class="form-control" name="idPelanggan" id="idPelanggan" onChange="getidPelanggan();">
                                                <option value="" disabled selected>Pilih Pelanggan</option>
                                                <?php foreach ($pelanggan as $plg) : ?>
                                                    <option value="<?php echo $plg['idPelanggan'] ?>"><?php echo $plg['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Keterangan
                                        </label>
                                        <textarea id="keterangan" type="text" name="keterangan" class="form-control" onkeyup="getketerangan(this.id);"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                                            <i class="fas fa-backspace mr-1"></i>
                                            Batal
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="submit_terjual()">
                                            <i class="fas fa-save mr-1"></i>
                                            Simpan
                                        </button>
                                    </div>
                </form>
            </div>
        </div>
</div>
</div>
<!-- tutup modal -->
</div>
</div>
</section>
</div>


<!-- <script src="<?= base_url() ?>assets/bundles/select2/dist/js/select2.full.min.js"></script> -->
<script src="<?= base_url() ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    function showResult(str) {
        if (str.length == 0) {
            document.getElementById("hasilcari").innerHTML = "";
            document.getElementById("hasilcari").style.border = "0px";
            return;
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("hasilcari").innerHTML = this.responseText;
                document.getElementById("hasilcari").style.border = "1px solid #059cfa";
            }
        }
        xmlhttp.open("GET", "<?= base_url(); ?>index.php/transaksi/caribarang?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>