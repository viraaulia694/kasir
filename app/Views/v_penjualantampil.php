<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>
<div class="col-12 mt3">

    <div class="row">
        <div class="col-12 mt-3">
            <a href="<?= base_url('/penjualan/tambah') ?>" class="btn btn-primary float-right"><i class="fas fa-plus"></i>Tambah Penjualan</a>
        </div>
        <div class="col-12 mt-3">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Penjualan</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('penjualan/tampil') ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Penjualan</h3>
                                    </div>

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID Penjualan</th>
                                                    <th>Tanggal Penjualan</th>
                                                    <th>Total Harga</th>
                                                    <th>ID Pelanggan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tbody>
                                                <?php foreach ($penjualans as $penjualan) : ?>
                                                    <tr>
                                                        <td><?= $penjualan->PenjualanID ?></td>
                                                        <td><?= $penjualan->TglPenjualan ?></td>
                                                        <td><?= $penjualan->TotalHarga ?></td>
                                                        <td><?= $penjualan->PelangganID ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('penjualan/delete/' . $penjualan->PenjualanID); ?>" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                            <a href="<?= base_url('/penjualan/pusheditpenjualan/' . $penjualan->PenjualanID); ?>" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection(); ?>
