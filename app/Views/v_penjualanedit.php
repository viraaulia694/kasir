<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>

<div class="col-12">
    <!-- Bagian menampilkan error dari validasi -->
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4>Periksa antrian form</h4>
            <hr>
            <?php echo session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <!-- Akhir bagian menampilkan error dari validasi -->

    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">
                Edit Penjualan
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="<?= base_url('/penjualan/edit') ?>">
            <div class="card-body">
                <?php if (isset($penjualan)) : ?>
                    <!-- Mode Edit -->
                    <input type="hidden" name="PenjualanID" value="<?= $penjualan->PenjualanID ?>">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="TglPenjualan" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="TglPenjualan" name="TglPenjualan" placeholder="Masukkan tanggal penjualan" value="<?= $penjualan->TglPenjualan ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="TotalHarga" class="col-sm-2 col-form-label">Total Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="TotalHarga" name="TotalHarga" value="<?= $penjualan->TotalHarga ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PelangganID" class="col-sm-2 col-form-label">Pelanggan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="PelangganID" name="PelangganID">
                                    <?php foreach ($pelanggans as $p) : ?>
                                        <option value="<?= $p['PelangganID'] ?>" <?= ($penjualan->PelangganID == $p['PelangganID']) ? 'selected' : '' ?>><?= $p['NamaPelanggan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <?php if (isset($penjualan)) : ?>
                            Update
                        <?php endif; ?>
                    </button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Batal</a>
                </div>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->
</div>

<?= $this->endSection(); ?>