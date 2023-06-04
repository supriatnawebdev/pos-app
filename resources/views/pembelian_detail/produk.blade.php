
  <!-- Modal -->
  <div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pilih Produk</h4>
          </div>
          <div class="modal-body">

            <table class="table table-striped table-responsive table-bordered">

                    <thead>
                        <th width="5%">No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                <tbody>
                    @foreach ($produks as $key => $produk )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $produk->kode_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->kategori }}</td>
                            <td>{{ $produk->merek }}</td>
                            <td>{{ $produk->harga_beli }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>
                                <a href="#" class="btn btn-primary"
                                onclick="pilihProduk({{ $produk->id }}, '{{ $produk->kode_produk }}')">
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
