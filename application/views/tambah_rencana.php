<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Perencanaan</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url()?>perencanaan/save" method="post" enctype="multipart/form-data">
                            <!-- <div class="form-group">
                                <label>Judul Rencana</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-address-book"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="nama"> 
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="date" class="form-control datepicker" name="mulai" min="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Hingga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="date" class="form-control datepicker" name="hingga" min="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jumlah Budget</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="text" class="form-control currency" name="budget">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Daftar Rencana Harian</label>
                                <div class="dynamic-wrap">
                                    <div class="entry input-group mb-2">
                                        <input class="form-control mr-2" name="rencana[]" type="text" placeholder="Type something" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-add" type="button" style="height: 100%;">
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <small>Press <span class="fas fa-plus"></span> to add another form field :)</small>
                            </div>
                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

</section>