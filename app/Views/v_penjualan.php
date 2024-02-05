<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>
  <body>
    <h1>Data Penjualan</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            <div class="card">  
            <div class="card-header">
                Tambah Data Penjualan
            </div>
            <div class="card-body">
                <form>
                <div class="row mb-3">
                    <label for="TglPenjualan" class="col-sm-4 col-form-label">Tanggal Penjualan</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" id="TglPenjualan">
                    <input type="hidden" id="status">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="TotalHarga" class="col-sm-4 col-form-label">Total Harga</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="TotalHarga">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="PelangganID" class="col-sm-4 col-form-label">Pelanggan</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="PelangganID">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                </form>
            </div>
            </div>
            </div>
            <div class="col-sm-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Penjualan</th>
                            <th>Total Harga</th>
                            <th>Pelanggan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="showData">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?= base_url()?>adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            tampil_data();

            function tampil_data(){
                $.ajax({ //setelah isi ajax, tambah routes
                    url: 'penjualan/tampil',
                    type: 'get',
                    dataType: 'json',
                    success: function(data)
                    {
                        console.log(data);
                        var HTML = '';
                        var i;
                        var no = 0;
                        if(data.length == 0) {
                            HTML += '<tr>' + 
                                    '<td colspan = "5" class = "text-center"> Data pada tabel masih kosong</td>'+
                                    '</tr>'
                                    $('#showData').html(HTML);
                        }else{
                            for (var i = 0; i < data.length; i++) {
                            no++;
                            HTML += '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + data[i].TglPenjualan + '</td>' +
                                '<td>' + data[i].TotalHarga + '</td>' +
                                '<td>' + data[i].PelangganID + '</td>' +
                                '<td>' +
                                    '<button id="edit" data-id="' + data[i].PenjualanID + '" class="btn btn-warning">Edit</button>' + 
                                    '&nbsp;&nbsp;' + 
                                    '<button id="hapus" data-id="' + data[i].PenjualanID + '" class="btn btn-danger">Hapus</button>' +
                                '</td>' +
                                '</tr>';
                                $('#showData').html(HTML);
                        }
                        }
                    }
                });
            }

                        $('#simpan').on('click', function(e){
                            e.preventDefault();
                            
                            var tglPenjualan = $('#TglPenjualan').val();
                            var totalHarga = $('#TotalHarga').val();
                            var tlp = $('#Tlp').val();
                            var status = $('#status').val();
                            var id = $('#PelangganID').val();
                           
                            if (status == '') {
                                $.ajax({
                                    url: 'pelanggan/simpan',
                                    type: 'post',
                                    data: {namaPelanggan: namaPelanggan, alamat: alamat, tlp: tlp}, //kiri dari controller, kanan dari var atas
                                    success: function(data){
                                        $('#NamaPelanggan').val('');
                                        $('#Alamat').val('');
                                        $('#Tlp').val('');

                                        tampil_data();
                                    }
                                })
                            } else if (status == 'update') {
                                $.ajax({
                                    url: 'pelanggan/update',
                                    type: 'post',
                                    data: {id: id, namaPelanggan: namaPelanggan, alamat: alamat, tlp: tlp},
                                    success: function(data){
                                        $('#NamaPelanggan').val('');
                                        $('#Alamat').val('');
                                        $('#Tlp').val('');
                                        $('#status').val('');

                                        tampil_data();
                                    }
                                })
                                
                            }
                        }); //end simpan
                        
                        //edit
                        $('#showData').on('click', '#edit', function(e){
                            e.preventDefault();

                            var id = $(this).data('id'); //ini apa
                            
                            $.ajax({
                                url: 'pelanggan/edit',
                                type: 'get',
                                dataType: 'json',
                                data: {id: id}, //sebelah kanan dari var, sebelah kiri dari controller

                                success: function(data){
                                    console.log(data);
                                    $('#PelangganID').val(data.PelangganID);
                                    $('#NamaPelanggan').val(data.NamaPelanggan);
                                    $('#Alamat').val(data.Alamat);
                                    $('#Tlp').val(data.Tlp);
                                    $('#status').val('update');
                                }
                            })
                        });

                        //update
                        $('#update').on('click',function(e) {
                            e.preventDefault();

                            var namaPelanggan = $(this).data('namaPelanggan'); //ini kanan kiri sama paling
                            var alamat = $(this).data('namaPelanggan');
                            var tlp = $(this).data('namaPelanggan');

                            $.ajax({
                                url: 'pelanggan/update',
                                type: 'post',
                                data: {namaPelanggan: NamaPelanggan, alamat: alamat, tlp:tlp},
                                success:function(data) {
                                    $('#NamaPelanggan').val('');
                                    $('#Alamat').val('');
                                    $('#Tlp').val('');

                                    tampil_data();
                                }
                            })
                        }) //end update

                        //delete
                        $('#showData').on('click','#hapus', function(e){
                            e.preventDefault();

                            var id = $(this).data('id');
                            console.log('Berhasil Dihapus');
                            

                            $.ajax({
                            method : 'post',
                            url : 'pelanggan/delete',
                            data : {id: id},
                            success : function(data){
                                
                                tampil_data();
                                $('PelangganID').focus();
                            }
                            
                            })

                        });
                        //end delete
                    
        });
    </script>
</body>
<?= $this->endSection(); ?>