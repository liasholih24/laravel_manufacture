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
                    ABAH
                </div>
            </li>
            <?php if(Sentinel::getUser()->hasAnyAccess(['home*'])): ?>
            <li <?php echo e((Request::is('dashboard*') ? 'class=active' : '')); ?>>
                <a href="<?php echo e(route('home.dashboard')); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php endif; ?>

            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Nasabah</span></a>
                
            </li>
            <li>
                <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Manajemen</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">  
                    <li>
                      <a href="#">Transaksi</a>
                    </li>           
                    <li>
                      <a href="#">Sampah</a>
                    </li>
                </ul>
            </li>
            
            <li <?php echo e((Request::is('sampah*','kategori*','status*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Referensi</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">  
                  <?php if(Sentinel::getUser()->hasAnyAccess(['sampah*','kategori*'])): ?>
                    <li <?php echo e((Request::is('sampah*','kategori*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('sampah.index')); ?>">Data Sampah</a>
                    </li>  
                    <?php endif; ?>         
                    <li>
                      <a href="#">Data Penadah</a>
                    </li>
                    <li>
                      <a href="#">Lokasi</a>
                    </li>
                    <?php if(Sentinel::getUser()->hasAnyAccess(['status*'])): ?>
                    <li <?php echo e((Request::is('status*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('status.index')); ?>">Status</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Laporan</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">             
                    <li>
                      <a href="#">Sampah</a>
                    </li>
                    <li>
                      <a href="#">Transaksi</a>
                    </li>
                </ul>
            </li>

            <?php if(Sentinel::getUser()->hasAnyAccess(['role*','user*'])): ?>

            <li <?php echo e((Request::is('role*','user*','log*') ? 'class=active' : '')); ?>>
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
                </ul>
            </li>
            <?php endif; ?>

            
</nav>
