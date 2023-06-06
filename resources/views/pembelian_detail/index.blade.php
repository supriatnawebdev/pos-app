@extends('layout.admin')
@section('title')
TRANSAKSI PEMBELIAN DETAIL
@endsection
@section('content')
<section class="content">


       <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <table>
                        <tr>
                            <td>Suplier</td>
                            <td>: {{ $suplier->nama_suplier }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $suplier->telpon }}</td>
                        </tr>
                    </table>
                </div>
                <div class="box-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                                    <input type="hidden" name="id_produk" id="id_produk">
                                    <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                    <span class="input-group-btn">
                                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                        <table class="table table-striped table-responsive table-bordered table-pembelian">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>


                </div>
            </div>
        </div>
    </div>

 </section>

  @includeIf('pembelian_detail.produk')
@endsection

@push('scripts')
    <script>
        let table, table2;
        $(function(){

           table = $('.table-pembelian').DataTable({
                processing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('pembelian_detail.data', $id_pembelian )}}',
                },
                columns : [
                    {data: 'DT_RowIndex', searchable:false, sortable:false},
                    {data: 'kode_produk'},
                    {data: 'nama_produk'},
                    {data: 'harga_beli'},
                    {data: 'jumlah'},
                    {data: 'subtotal'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
         });


         table2 = $('.table-produk').DataTable();

         $(document).on('input', '.edit-quantity', function(){
            let token   = $("meta[name='csrf-token']").attr("content");

            let id = $(this).data("id");
            let jumlah = parseInt($(this).val());
            // console.log(jumlah)
            // return;


            if(jumlah> 100){
                alert('jumlah tidak boleh lebih dari 100');
                return;
            }

            $.post(`{{ url('/pembelian_detail')}}/${id}`, {
                '_method' : 'PUT',
                '_token': token,
                'jumlah': jumlah
            })
            .done((response) => {
                $(this).on('mouseout', function(){
                    table.ajax.reload();
                });
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                        });
         });


        });

        function tampilProduk(){
            $('#modal-produk').modal('show');

        }

        function hideProduk(){
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id,kode){
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();

        }

        function tambahProduk(){
            $.post('{{ route('pembelian_detail.store')}}', $('.form-produk').serialize())
            .done((response) => {
                $('#kode_produk').focus();
                    table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                        })

        }



            function deleteData(url){
                let token   = $("meta[name='csrf-token']").attr("content");
                if (confirm('Yakin ingin mengapus data yang dipilih?')){

                $.post(url, {
                '_token': token,
                '_method': 'delete'
                   })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                        });
                        }
                }






    </script>
@endpush
