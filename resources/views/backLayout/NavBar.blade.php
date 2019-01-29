<nav class="navbar-default navbar-static-side" role="navigation" style="position: fixed;">
	<div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
					<span>
                   		<img alt="image" width="40px" height="40px" style="object-fit: cover;" class="img-circle" src="{{ asset(Sentinel::getUser()->url_image) }}" />
                    </span>
                    <a href="#">
                    	<span class="block m-t-xs"> <strong class="font-bold">{{Sentinel::getUser()->first_name.' ' .Sentinel::getUser()->last_name }}</strong></span>
                    </a>
                </div>
                <div class="logo-element">
                    KS
                </div>
            </li>
            @if (Sentinel::getUser()->hasAnyAccess(['home*']))
            <li {{{ (Request::is('dashboard*') ? 'class=active' : '') }}}>
                <a href="{{route('home.dashboard')}}"><i class="fa fa-area-chart"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @endif 
            @if (Sentinel::getUser()->hasAnyAccess(['produksi*','hargapokok*','pakan*','pengobatan*']))
           
            <li {{{ (Request::is('produksi*','hargapokok*','pakan*','pengobatan*') ? 'class=active' : '') }}}>
                <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Recording</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li {{{ (Request::is('produksi*') ? 'class=active' : '') }}}>
                      <a href="{{route('produksi.index')}}">Produksi </a>
                    </li>
                    <li {{{ (Request::is('pengobatan*') ? 'class=active' : '') }}}>
                      <a href="{{route('pengobatan.index')}}">Pengobatan </a>
                    </li>
                    <li {{{ (Request::is('hargapokok*') ? 'class=active' : '') }}}>
                      <a href="{{route('hargapokok.index')}}">HPP Telur</a>
                    </li>
                    @if (Sentinel::getUser()->hasAnyAccess(['pakan*']))
                    <li {{{ (Request::is('pakan*') ? 'class=active' : '') }}}>
                      <a href="{{route('pakan.index')}}">HPP Pakan</a>
                    </li>
                    @endif
                </ul>
          </li>
          @endif
             @if (Sentinel::getUser()->hasAnyAccess(['pengajuan.*', 'penerimaan.*', 'pengeluaran.*', 'penjualan.*', 'transfer.*']))
            <li {{{ (Request::is('pengajuan*','penerimaan*','penjualan*','pemakaian*','transfer*') ? 'class=active' : '') }}}>
                <a href="#"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Monitoring</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if (Sentinel::getUser()->hasAnyAccess(['pengajuan.*']))
                    <li {{{ (Request::is('pengajuan*') ? 'class=active' : '') }}}>
                      <a href="{{route('pengajuan.index')}}">Pengajuan </a>
                    </li>
                    @endif
                    <li {{{ (Request::is('penerimaan*') ? 'class=active' : '') }}}>
                      <a href="{{route('penerimaan.index')}}">Penerimaan </a>
                    </li>
                    <li {{{ (Request::is('penjualan*') ? 'class=active' : '') }}}>
                      <a href="{{route('penjualan.index')}}">Penjualan </a>
                    </li>
                    <li {{{ (Request::is('pemakaian*') ? 'class=active' : '') }}}>
                      <a href="{{route('pemakaian.index')}}">Pemakaian </a>
                    </li>
                    @if (Sentinel::getUser()->hasAnyAccess(['transfer.*']))
                    <li {{{ (Request::is('transfer*') ? 'class=active' : '') }}}>
                      <a href="{{route('transfer.index')}}">Mutasi</a>
                    </li>
                    @endif
                </ul>
            </li>
          @endif
          
          @if (Sentinel::getUser()->hasAnyAccess(['item*','kategori.*','satuan.*','supplier*','lokasi*']))
            <li {{{ (Request::is('item*','kategori*','status*','satuan*','supplier*','lokasi*','customer*') ? 'class=active' : '') }}}>
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                   @if (Sentinel::getUser()->hasAnyAccess(['item*','kategori*']))
                    <li {{{ (Request::is('item*','kategori*') ? 'class=active' : '') }}}>
                      <a href="{{route('item.index')}}">Barang</a>
                    </li> 
                    @endif
                    @if (Sentinel::getUser()->hasAnyAccess(['satuan*']))
                    <li {{{ (Request::is('satuan*') ? 'class=active' : '') }}}>
                      <a href="{{route('satuan.index')}}">Satuan</a>
                    </li>
                    @endif
                    @if (Sentinel::getUser()->hasAnyAccess(['supplier*']))
                    <li {{{ (Request::is('supplier*') ? 'class=active' : '') }}}>
                      <a href="{{route('supplier.index')}}">Supplier</a>
                    </li>
                    @endif      
                    @if (Sentinel::getUser()->hasAnyAccess(['lokasi*']))
                    <li {{{ (Request::is('lokasi*') ? 'class=active' : '') }}}>
                      <a href="{{route('lokasi.index')}}">Lokasi</a>
                    </li>
                    @endif
                    <li {{{ (Request::is('customer*') ? 'class=active' : '') }}}>
                      <a href="{{route('customer.index')}}">Customer</a>
                    </li>
                    <li {{{ (Request::is('ekspedisi*') ? 'class=active' : '') }}}>
                      <a href="{{route('ekspedisi.index')}}">Ekspedisi</a>
                    </li>
                </ul>
            </li>
            @endif
            @if (Sentinel::getUser()->hasAnyAccess(['stocks*','rekapitulasi*','laporan.*']))
            <li {{{ (Request::is('stocks*','rekapitulasi/stocks*','laporan*','rekapitulasi*') ? 'class=active' : '') }}}>
                <a href="#"><i class="fa fa-area-chart"></i> <span class="nav-label">Laporan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if (Sentinel::getUser()->hasAnyAccess(['laporan.stocks','rekapitulasi.stocks']))
                  <li {{{ (Request::is('stocks*','rekapitulasi/stocks') ? 'class=active' : '') }}}>
                            <a href="#">Persediaan <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                     @if (Sentinel::getUser()->hasAnyAccess(['laporan.stocks']))
                    <li {{{ (Request::is('stocks*') ? 'class=active' : '') }}}>
                      <a href="{{route('laporan.stocks')}}">Laporan Persediaan</a>
                    </li>
                    @endif
                    @if (Sentinel::getUser()->hasAnyAccess(['rekapitulasi.stocks']))
                    <li {{{ (Request::is('rekapitulasi/stocks') ? 'class=active' : '') }}}>
                      <a href="{{route('rekapitulasi.stocks')}}">Rekap Persediaan</a>
                    </li>
                    @endif
                  </ul>
                  </li>
                   @endif  
                </ul>
            </li>
            @endif
            @if (Sentinel::getUser()->hasAnyAccess(['role*','user*']))
            <li {{{ (Request::is('role*','user*','log*','posts*') ? 'class=active' : '') }}}>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">System Setting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  @if (Sentinel::getUser()->hasAnyAccess(['role.*']))
                    <li {{{ (Request::is('role*') ? 'class=active' : '') }}}>
                      <a href="{{route('role.index')}}">Roles</a>
                    </li>
                  @endif
                  @if (Sentinel::getUser()->hasAnyAccess(['user.*']))
                    <li {{{ (Request::is('user*') ? 'class=active' : '') }}}>
                      <a href="{{route('user.index')}}">User Management</a>
                    </li>
                  @endif
                  @if (Sentinel::getUser()->hasAnyAccess(['log.*']))
                  <li {{{ (Request::is('log') ? 'class=active' : '') }}}>
                      <a href="{{route('log.index')}}">Activity Log</a>
                  </li>
                    @endif
                    @if (Sentinel::getUser()->hasAnyAccess(['posts.*']))
                    <li {{{ (Request::is('posts') ? 'class=active' : '') }}}>
                        <a href="{{route('posts.index')}}">Posts</a>
                    </li>
                      @endif
                </ul>
            </li>
            @endif
		</ul>
	</div>
</nav>
