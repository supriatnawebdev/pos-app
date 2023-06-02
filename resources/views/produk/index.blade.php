@extends('layout.admin')
@section('title')
PRODUK
@endsection
@section('content')
<section class="content">
   
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group">
                        <button class="btn  btn-info" onclick="addForm('{{ route('produk.store') }}')">Add Data</button>
                        <button class="btn  btn-danger" onclick="deleteSelected('{{ route('produk.delete_selected') }}')">Delete All</button>
                        <button class="btn  btn-success" onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')">Barcode</button>
                    </div>
                </div>
                <div class="box-body">
                    <form method="post" class="form-produk">
                        @csrf
                        <table class="table table-striped table-responsive table-bordered">
                            <thead>
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all"/>
                                </th>
                                <th width="5%">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
  </section>

  @includeIf('produk.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function(){

           table = $('.table').DataTable({
                processing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('produk.data')}}',
                },
                columns : [
                    {data: 'select_all'},
                    {data: 'DT_RowIndex', searchable:false, sortable:false},
                    {data: 'kode_produk'},
                    {data: 'nama_produk'},
                    {data: 'nama_kategori'},
                    {data: 'merek'},
                    {data: 'harga_jual'},
                    {data: 'harga_beli'},
                    {data: 'diskon'},
                    {data: 'stok'},
                    {data: 'aksi', searchable: false, sortable: false}
                ]
         });

         $('#modal-form').validator().on('submit', function(e) {
                if(! e.preventDefault()){
                    $.ajax({
                        url : $('#modal-form form').attr('action'),
                        type :'post',
                        data : $('#modal-form form').serialize()

                    })
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
                }
         });


         select_all
         $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked)
         });

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_produk]').focus();

        }
        // edit data
        function editData(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Data');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_produk]').focus();

            $.get(url)
            
                    .done((response) => {
                        $('#modal-form [name=nama_produk]').val(response.nama_produk);
                        // $('#modal-form [name=kode_produk]').val(response.kode_produk);
                        $('#modal-form [name=id_kategori]').val(response.id_kategori);
                        $('#modal-form [name=merek]').val(response.merek);
                        $('#modal-form [name=harga_beli]').val(response.harga_beli);
                        $('#modal-form [name=harga_jual]').val(response.harga_jual);
                        $('#modal-form [name=diskon]').val(response.diskon);
                        $('#modal-form [name=stok]').val(response.stok);
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menampilkan data');
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

            function deleteSelected(url) {

                if($('input:checked').length >= 1){
                        if (confirm('Yakin ingin mengapus data yang dipilih?')){
                        $.post(url, $('.form-produk').serialize())
                            .done((response) => {
                                table.ajax.reload();
                                })
                                .fail((errors) => {
                                    alert('Tidak dapat menghapus data');
                                    return;
                                });
                            
                        }
                        else{
                            alert('Pilih datayang akan dihapus');
                            return;
                           }
                }
            }


            // cetak Barcode
            function cetakBarcode(url){
                if($('input:checked').length < 1){
                      
                        alert('Pilih data yang akan dicetak');
                        return;    
                    }else if($('input:checked').length < 3) {
                        alert('Minimal pilih 3 data yang akan dicetak');
                        return;   
                    }else {


                        $('.form-produk')
                            .attr('target', '_blank')
                            .attr('action', url)
                            .submit();


                    }
                       
                
            }


            
    </script>
@endpush