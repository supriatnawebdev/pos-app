
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
              <label for="nama_produk" class="col-md-4">Nama Produk</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="nama_produk" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="id_kategori" class="col-md-4">Kategori</label>
              <div class="col-md-6">
                <select class="form-control" name="id_kategori" id="" required>
                  <option value="">Pilih Kategori</option>
                  @foreach ($kategori as $key => $item )
                    <option value="{{$key}}">{{$item}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="merek" class="col-md-4">Merk</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="merek" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="harga_beli" class="col-md-4">Harga Beli</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="harga_beli" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="harga_jual" class="col-md-4">Harga Jual</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="harga_jual" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="diskon" class="col-md-4">Diskon</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="diskon" id="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="stok" class="col-md-4">Stok</label>
              <div class="col-md-6">
                <input type="number" class="form-control" name="stok" id="" required>
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