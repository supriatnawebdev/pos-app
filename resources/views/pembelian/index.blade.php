@extends('layout.admin')
@section('title')
PEMBELIAN
@endsection
@section('content')
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-body">
                        <div class="btn-group">
                            <button class="btn  btn-info" onclick="addForm()">Transaksi Baru</button>
                        </div>
                </div>
                <form method="post" class="form-produk">
                    @csrf
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Suplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
  </section>

  @includeIf('pembelian.suplier')
@endsection

@push('scripts')
    <script>
        let table;
        $(function(){

           table = $('.table').DataTable({
                // processing: true,
                // autowidth: false,
                // ajax: {
                //     url: '{{ route('pengeluaran.data')}}',
                // },
                // columns : [
                //     // {data: 'select_all'},
                //     {data: 'DT_RowIndex', searchable:false, sortable:false},
                //     {data: 'created_at'},
                //     {data: 'deskripsi'},
                //     {data: 'nominal'},
                //     {data: 'aksi', searchable: false, sortable: false}
                // ]
         });





        });

        function addForm(){
            $('#modal-suplier').modal('show');


        }
        // edit data
        function editData(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Data');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=deskripsi]').focus();

            $.get(url)

                    .done((response) => {
                        $('#modal-form [name=deskripsi]').val(response.deskripsi);
                        $('#modal-form [name=nominal]').val(response.nominal);

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






    </script>
@endpush
