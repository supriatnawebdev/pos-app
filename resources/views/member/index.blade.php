@extends('layout.admin')
@section('title')
MEMBER
@endsection
@section('content')
<section class="content">
   
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <button class="btn  btn-info" onclick="addForm('{{ route('member.store') }}')">Tambah Data</button>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-responsive table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </section>

  @includeIf('member.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function(){

           table = $('.table').DataTable({
                processing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('member.data')}}',
                },
                columns : [
                    {data: 'DT_RowIndex', searchable:false, sortable:false},
                    {data: 'kode_member'},
                    {data: 'nama_member'},
                    {data: 'telpon'},
                    {data: 'alamat'},
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
        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah member');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_member]').focus();

        }
        // edit data
        function editData(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Data');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_member]').focus();

            $.get(url)
            
                    .done((response) => {
                        $('#modal-form [name=nama_member]').val(response.nama_member);
                        $('#modal-form [name=telpon]').val(response.telpon);
                        $('#modal-form [name=alamat]').val(response.alamat);
                   
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