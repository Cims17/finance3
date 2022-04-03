<?php echo $this->session->flashdata('berhasil_perusahaan') ?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>
              Info Perusahaan
            </h4>
            <div class="d-flex">
              <button type="button" data-toggle="modal" data-target="#cetakpdf" class="btn btn-warning mr-2"><i class="fas fa-print mr-2"></i></i>Cetak PDF</button>
              <a href="<?= base_url() ?>master_data/tambah_perusahaan">
                <div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Info</div>
              </a>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex">
              <div class="form-group">
                <label>Periode Akuntansi</label>
                <form action="<?php base_url() ?>info_perusahaan" enctype="multipart/form-data" method="post">
                  <div class="d-flex align-items-center">

                    <input type="date" class="form-control mr-3" name="mulai" value="<?= $tgl['mulai'] ?>">
                    <h6 class="mr-3 my-0 weight-normal">
                      s/d
                    </h6>
                    <input type="date" class="form-control mr-3" name="selesai" value="<?= $tgl['selesai'] ?>">
                    <button class="btn btn-primary d-flex align-items-center" type="submit">
                      <i class="fas fas fa-search mr-2"></i>
                      Filter
                    </button>

                  </div>
                </form>
              </div>

            </div>
            <div class="table-responsive">
              <table class="table  table-hover table-striped" id="table-1" style="width:100%;">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>NPWP</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  foreach ($perusahaan as $ps) : ?>
                    <tr id="<?php echo $ps['id'] ?>" name="<?php echo $ps['nama'] ?>">
                      <td class="text-center"><?= $i++ ?></td>
                      <td><?= $ps['nama'] ?></td>
                      <td><?= $ps['alamat'] ?></td>
                      <td><?= $ps['npwp'] ?></td>
                      <td class="d-flex">
                        <button type="button" data-toggle="modal" data-target="#detail-info<?= $ps['id'] ?>" class="btn btn-info d-flex align-items-center mr-2">
                          <i class="fas fa-info-circle mr-2"></i>
                          Detail
                        </button>
												<button type="button" data-toggle="modal" data-target="#update-info<?= $ps['id'] ?>" class="btn btn-primary d-flex align-items-center mr-2">
                          <i class="fas fa-edit mr-2"></i>
                          Edit
                        </button>

												<button class="btn btn-danger d-flex align-items-center remove">
														<i class="far fa-trash-alt mr-2"></i>
														Hapus
												</button>
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
  </section>
</div>

<!-- Modal Cetak PDF -->
<div class="modal fade" id="cetakpdf" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Cetak PDF Info Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php base_url() ?>pdfinfo_perusahaan" enctype="multipart/form-data" method="post" target="_blank">
          <div class="form-group">
            <label>Tanggal Mulai</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="date" class="form-control" name="mulai" required>
            </div>
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="date" class="form-control" name="selesai" required>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-danger waves-effect mr-3 d-flex" data-dismiss="modal">
              <i class="fas fa-times my-auto mr-2"></i>
              Batal
            </button>
            <button type="submit" class="btn btn-primary waves-effect mr-3 d-flex">
              <i class="fas fa-print my-auto mr-2"></i>
              Cetak
            </button>
						<a href="<?= base_url() ?>master_data/pdfinfo_perusahaanall" target="_blank">
								<div class="btn btn-warning waves-effect my-auto mr-2"><i class="fas fa-print mr-2"></i></i>Cetak Semua</div>
            </a>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>

<?php foreach ($perusahaan as $ps) : ?>
  <div class="modal fade" id="detail-info<?= $ps['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Detail Perusahaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="">
            <div class="form-group">
              <label>Nama Perusahaan</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-building"></i>
                  </div>
                </div>
                <input type="text" class="form-control" value="<?= $ps['nama'] ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-map-marked-alt"></i>
                  </div>
                </div>
                <input type="text" class="form-control" value="<?= $ps['alamat'] ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label>NPWP</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-file-alt"></i>
                  </div>
                </div>
                <input type="text" class="form-control" value="<?= $ps['npwp'] ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label>Diinput Tanggal</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-calendar"></i>
                  </div>
                </div>
                <input type="text" class="form-control" value="<?= $ps['tanggal'] ?>" readonly>
              </div>
            </div>
            <div class="d-flex w-100 justify-content-center">
              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

<?php foreach ($perusahaan as $ps) : ?>
  <div class="modal fade" id="update-info<?= $ps['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Edit Perusahaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('master_data/update_perusahaan/') . $ps['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Perusahaan</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-building"></i>
                  </div>
                </div>
                <input type="text" class="form-control" name="nama" value="<?= $ps['nama'] ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-map-marked-alt"></i>
                  </div>
                </div>
                <input type="text" class="form-control" name="alamat" value="<?= $ps['alamat'] ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label>NPWP</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-file-alt"></i>
                  </div>
                </div>
                <input type="text" class="form-control" name="npwp"  value="<?= $ps['npwp'] ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label>Diinput Tanggal</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-calendar"></i>
                  </div>
                </div>
                <input type="text" class="form-control" value="<?= $ps['tanggal'] ?>" readonly>
              </div>
            </div>
            <div class="d-flex justify-content-around">
								<button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
										<i class="fas fa-backspace mr-1"></i>
										Batal
								</button>
								<button type="submit" class="btn btn-primary">
										<i class="fas fa-save mr-1"></i>
										Simpan
								</button>
						</div>

          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".remove").click(function() {
        var id = $(this).parents("tr").attr("id");
				var name = $(this).parents("tr").attr("name");
        swal({
            title: "Hapus Data Perusahan " + name + " ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '<?= base_url() ?>master_data/delete_perusahaan/' + id,
                    type: 'DELETE',
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        swal({
                            title: "Data Perusahaan Telah Terhapus"
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            } else {
                // swal("Batal");
            }
        });
    });
</script>
