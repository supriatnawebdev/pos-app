
  <!-- Modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
      <form action="" method="post" class="form-horizontal">
        @csrf
        @method('post')

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="nama_suplier" class="col-md-4">Nama Suplier</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="nama_suplier" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="telpon" class="col-md-4">Nomor Telpon</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="telpon" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-md-4">Alamat</label>
              <div class="col-md-6">
                <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>

    </div>
  </div>
