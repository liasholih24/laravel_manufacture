<nav class="navbar-default navbar-static-side" role="navigation" style="position: fixed;">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                   <img alt="image" width="40px" height="40px" style="object-fit: cover;" class="img-circle" src="<?php echo e(asset(Sentinel::getUser()->url_image)); ?>" />
                     </span>
                    <a href="#">
                    <span class="block m-t-xs"> <strong class="font-bold"><?php echo e(Sentinel::getUser()->first_name.' ' .Sentinel::getUser()->last_name); ?></strong>
                    </span>
                    </a>
                </div>
                <div class="logo-element">
                    KS
                </div>
            </li>
            <?php if(Sentinel::getUser()->hasAnyAccess(['home*'])): ?>
            <li <?php echo e((Request::is('dashboard*') ? 'class=active' : '')); ?>>
                <a href="<?php echo e(route('home.dashboard')); ?>"><i class="fa fa-area-chart"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['nasabah*'])): ?>
            <li <?php echo e((Request::is('nasabah*') ? 'class=active' : '')); ?>>
                <a href="<?php echo e(route('nasabah.index')); ?>"><i class="fa fa-users"></i> <span class="nav-label">Nasabah</span></a>

            </li>
            <?php endif; ?>
             <?php if(Sentinel::getUser()->hasAnyAccess(['transfer.*'])): ?>
            <li <?php echo e((Request::is('transfer*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Monitoring</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li>
                      <a href="#">Pengajuan </a>
                    </li>
                    <li>
                      <a href="#">Penerimaan </a>
                    </li>
                    <li>
                      <a href="#">Pengeluaran </a>
                    </li>
                    <li>
                      <a href="#">Pemakaian </a>
                    </li>
                     <?php if(Sentinel::getUser()->hasAnyAccess(['transfer.*'])): ?>
                    <li <?php echo e((Request::is('transfer*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('transfer.index')); ?>">Transfer</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
          <?php if(Sentinel::getUser()->hasAnyAccess(['penadah*','item*','kategori.*','satuan.*','lokasi*','status*'])): ?>
            <li <?php echo e((Request::is('item*','kategori*','status*','satuan*','penadah*','lokasi*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <?php if(Sentinel::getUser()->hasAnyAccess(['penadah*'])): ?>
                    <li <?php echo e((Request::is('penadah*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('penadah.index')); ?>">Supplier</a>
                    </li>
                    <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['item*','kategori*'])): ?>
                    <li <?php echo e((Request::is('item*','kategori*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('item.index')); ?>">Barang</a>
                    </li>
                    <?php endif; ?>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['satuan*'])): ?>
                    <li <?php echo e((Request::is('satuan*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('satuan.index')); ?>">Satuan</a>
                    </li>
                    <?php endif; ?>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['lokasi*'])): ?>
                    <li <?php echo e((Request::is('lokasi*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('lokasi.index')); ?>">Lokasi</a>
                    </li>
                    <?php endif; ?>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['status*'])): ?>
                    <li <?php echo e((Request::is('status*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('status.index')); ?>">Status</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
             <?php if(Sentinel::getUser()->hasAnyAccess(['stocks*','rekapitulasi*','laporan.*'])): ?>
           
            <li <?php echo e((Request::is('stocks*','rekapitulasi/stocks*','laporan*','rekapitulasi*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-area-chart"></i> <span class="nav-label">Laporan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <?php if(Sentinel::getUser()->hasAnyAccess(['laporan.stocks','rekapitulasi.stocks'])): ?>
                  <li <?php echo e((Request::is('stocks*','rekapitulasi/stocks') ? 'class=active' : '')); ?>>
                            <a href="#">Persediaan <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                     <?php if(Sentinel::getUser()->hasAnyAccess(['laporan.stocks'])): ?>
                    <li <?php echo e((Request::is('stocks*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('laporan.stocks')); ?>">Laporan Persediaan</a>
                    </li>
                    <?php endif; ?>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['rekapitulasi.stocks'])): ?>
                    <li <?php echo e((Request::is('rekapitulasi/stocks') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('rekapitulasi.stocks')); ?>">Rekap Persediaan</a>
                    </li>
                    <?php endif; ?>
                  </ul>
                  </li>
                   <?php endif; ?>  
                </ul>
            </li>
         
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['role*','user*'])): ?>

            <li <?php echo e((Request::is('role*','user*','log*','posts*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">System Setting</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <?php if(Sentinel::getUser()->hasAnyAccess(['role.*'])): ?>
                    <li <?php echo e((Request::is('role*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('role.index')); ?>">Roles</a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['user.*'])): ?>
                    <li <?php echo e((Request::is('user*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('user.index')); ?>">User Management</a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['log.*'])): ?>
                  <li <?php echo e((Request::is('log') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('log.index')); ?>">Activity Log</a>
                  </li>
                    <?php endif; ?>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['posts.*'])): ?>
                    <li <?php echo e((Request::is('posts') ? 'class=active' : '')); ?>>
                        <a href="<?php echo e(route('posts.index')); ?>">Posts</a>
                    </li>
                      <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>


</nav>
