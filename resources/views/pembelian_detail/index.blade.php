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

                        {{-- <div class="btn-group">
                            <button class="btn  btn-info" onclick="addForm()">PILIH PRODUK</button>
                        </div> --}}
                        <table>
                            <tr>
                                <td>Suplier</td>
                                <td>: {{ $suplier->nama_suplier }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>: {{ $suplier->telpon }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $suplier->alamat }}</td>
                            </tr>
                        </table>
                </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <form class="form-produk form-group">
                                    @csrf
                                    <label for="kode_produk">Kode Produk</label>
                                    <div class="input-group">
                                        <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                                        <input type="hidden" name="id_produk" id="id_produk">
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                        <span class="input-group-btn ">
                                            <button onclick="tampilProduk()" class="btn btn-info" type="button">
                                                <i class="fa fa-arrow-right "></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table table-striped table-responsive table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  @includeIf('pembelian_detail.produk')
@endsection

@push('scripts')
    <script>
        let table;
        $(function(){

           table = $('.table').DataTable({
                processing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('pembelian_detail.data', $id_pembelian)}}',
                },
                columns : [
                    // {data: 'select_all'},
                    {data: 'DT_RowIndex', searchable:false, sortable:false},
                    {data: 'kode_produk'},
                    {data: 'nama_produk'},
                    {data: 'harga_beli'},
                    {data: 'jumlah'},
                    {data: 'subtotal'},
                    {data: 'aksi', searchable: false, sortable: false}
                ]
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
            tambahProduk(id);

        }

        function tambahProduk(){
            $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
            .done((response) => {
                $('#kode_produk').focus();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                        });

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
