  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('/adminlte')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="{{asset('/adminlte')}}/#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="{{asset('/adminlte')}}/#">
            <i class=""></i> <span>MASTER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{route('kategori.index')}}"><i class="fa fa-cube"></i> Kategori</a></li>
            <li><a href="{{route('produk.index')}}"><i class="fa fa-cubes"></i> Produk</a></li>
            <li><a href="{{route('member.index')}}"><i class="fa fa-id-card"></i> Member</a></li>
            <li><a href="{{route('suplier.index')}}"><i class="fa fa-truck"></i> Suplier</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="{{route('dashboard')}}/#">
            <i class=""></i> <span>TRANSAKSI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-money"></i> Pengeluaran</a></li>
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-download"></i> Pembelian</a></li>
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-upload"></i> Penjualan</a></li>
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-cart-arrow-down"></i> Transaksi Lama</a></li>
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-cart-arrow-down"></i> Transaksi Baru</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="{{asset('/adminlte')}}/#">
            <i class=""></i> <span>REPORT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-file-pdf-o"></i> Laporan</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="{{asset('/adminlte')}}/#">
            <i class=""></i> <span>PENGATURAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{asset('/adminlte')}}/index.html"><i class="fa fa-user"></i>Pengaturan User</a></li>
            <li><a href="{{asset('/adminlte')}}/index2.html"><i class="fa fa-cog"></i>Pengaturan Aplikasi</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
