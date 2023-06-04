@extends('layout.admin')
@section('title')
PENGELUARAN
@endsection
@section('content')
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-body">
                        <div class="btn-group">
                            <button class="btn  btn-info" onclick="addForm('{{ route('pengeluaran.store') }}')">Tambah Data</button>
                            {{-- <button class="btn  btn-success" onclick="cetakpengeluaran('{{ route('pengeluaran.cetak_pengeluaran') }}')">Cetak pengeluaran</button> --}}
                        </div>
                </div>
                <form method="post" class="form-produk">
                    @csrf
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
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

  @includeIf('pengeluaran.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function(){

           table = $('.table').DataTable({
                processing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('pengeluaran.data')}}',
                },
                columns : [
                    // {data: 'select_all'},
                    {data: 'DT_RowIndex', searchable:false, sortable:false},
                    {data: 'created_at'},
                    {data: 'deskripsi'},
                    {data: 'nominal'},
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

           //  select_all
        //    $('[name=select_all]').on('click', function () {
        //     $(':checkbox').prop('checked', this.checked)
        //  });

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah pengeluaran');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=deskripsi]').focus();

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
