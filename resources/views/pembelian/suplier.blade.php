
  <!-- Modal -->
  <div class="modal fade" id="modal-suplier" tabindex="-1" role="dialog" aria-labelledby="modal-suplier">
    <div class="modal-dialog" role="document">


        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pilih Suplier</h4>
          </div>
          <div class="modal-body">

            <table class="table table-striped table-responsive table-bordered">
                <thead>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th width="15%"><i class="fa fa-cog"></i></th>
                </thead>
                <tbody>
                    @foreach ($supliers as $key => $suplier )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $suplier->nama_suplier }}</td>
                            <td>{{ $suplier->telpon }}</td>
                            <td>{{ $suplier->alamat }}</td>
                            <td>
                                <a href="{{ route('pembelian.create', ['id' =>$suplier->id]) }}" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i>
                                    Pilih
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

          </div>
        </div>


    </div>
  </div>
