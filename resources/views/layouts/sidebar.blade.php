<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        

        <li class="menu-sidebar"><a href="{{ url('/dashboard') }}"><span class="fa fa-calendar-minus-o"></span> Beranda Dashboard</span></a></li>

        <li class="menu-sidebar"><a href="{{ url('/biodata') }}"><span class="fa fa-cart-plus"></span> Biodata</span></a></li>

        <li class="treeview menu-sidebar {{ (Request::segment(1)=='master') ? 'active' : ''}}">
          <a href="">
            <span class="fa fa-check-circle">
            </span> Master Data</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::path()=='master/kategori') ? 'active' : ''}} menu-sidebar">
              <a href="{{ url('master/kategori') }}"><i class="fa fa-fw fa-newspaper-o">  Kategori</i></a>
            </li>
            <li class="{{ (Request::path()=='master/kategori') ? 'active' : ''}} menu-sidebar">
              <a href="{{ url('master/buku') }}"><i class="fa fa-fw fa-newspaper-o">  Buku</i></a>
            </li>
          </ul>
        </li>

        <li class="menu-sidebar"><a href="{{ url('/pinjam-buku') }}"><span class="fa fa-level-up"></span> Peminjaman all Buku</span></a></li>

        <li class="menu-sidebar"><a href="{{ url('/pengembalian-buku') }}"><span class="fa fa-folder-o"></span> Pengembalian all Buku</span></a></li>

        @if(\Auth::user()->status ==1)
        <li class="menu-sidebar"><a href="{{ url('/manage-anggota') }}"><span class="fa fa-info-circle"></span> Manage Anggota</span></a></li>
        <li class="menu-sidebar"><a href="{{ url('/laporan-buku') }}"><span class="fa fa-folder-o"></span> Laporan</span></a></li>
        @endif

       


        @if(\Auth::user()->role == 1)
        <li class="menu-sidebar"><a href="{{ url('/verifikasi') }}"><span class="fa fa-coffee"></span> Verifikasi</span></a></li>

        <li class="menu-sidebar"><a href="{{ url('/peserta') }}"><span class="fa fa-exclamation"></span> Data Peserta</span></a></li>

        <li class="menu-sidebar"><a href="{{ url('/profile-sekolah') }}"><span class="fa fa-exclamation-circle"></span> Update Profile Sekolah</span></a></li>
        @endif

        <li class="header">OTHER</li>

        @if(\Auth::user()->name == 'Admin')
        <li class="menu-sidebar"><a href="{{ url('/reset-password') }}"><span class="glyphicon glyphicon-log-out"></span> Reset Password</span></a></li>
        @endif

        <li class="menu-sidebar"><a href="{{ url('/keluar') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</span></a></li>


      </ul>
    </section>