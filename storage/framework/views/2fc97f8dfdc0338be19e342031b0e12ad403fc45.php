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
                    iAMS
                </div>
            </li>
            <?php if(Sentinel::getUser()->hasAnyAccess(['home*'])): ?>
            <li <?php echo e((Request::is('dashboard*') ? 'class=active' : '')); ?>>
                <a href="<?php echo e(route('home.dashboard')); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['workorder*'])): ?>
            <li <?php echo e((Request::is('workorder*') ? 'class=active' : '')); ?>>
                <a href="<?php echo e(route('workorder.index')); ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Work Order</span></a>
            </li>
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['asset*'])): ?>
            <li <?php echo e((Request::is('asset*','qrcode*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Assets Management</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <?php if(Sentinel::getUser()->hasAnyAccess(['asset*'])): ?>
                    <li <?php echo e((Request::is('asset*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('asset.index')); ?>">Asset List</a>
                    </li>
                  <?php endif; ?>

                    <li <?php echo e((Request::is('qrcode*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('qrcode.index')); ?>">QR Generator</a>
                    </li>

                </ul>
            </li>
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['organization*','kategori*','status*','location*','sbu*','brand*','template*','templates*','sid*'])): ?>

            <li <?php echo e((Request::is('organization*','kategori*','status*','location*','sbu*','brand*','template*','templates*','sid*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <?php if(Sentinel::getUser()->hasAnyAccess(['organization.*'])): ?>
                    <li <?php echo e((Request::is('organization*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('organization.index')); ?>">Organization</a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['status.*'])): ?>
                    <li <?php echo e((Request::is('status*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('status.index')); ?>">Status</a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['location.*'])): ?>
                    <li <?php echo e((Request::is('location*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('location.index')); ?>">Location                                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['sbu.*','site.*'])): ?>
                    <li <?php echo e((Request::is('sbu*','site*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('site.index')); ?>">SBU
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['kategori.*'])): ?>
                    <li <?php echo e((Request::is('kategori*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('kategori.index')); ?>">Asset Category</a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['brand.*','model.*','template*','templates*'])): ?>
                    <li <?php echo e((Request::is('brand*','model.*','template*','templates*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('model.index')); ?>">Brand of Assets             </a>
                    </li>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAnyAccess(['sid.*'])): ?>
                    <li <?php echo e((Request::is('sid*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('sid.index')); ?>">SID Data </a>
                    </li>
                  <?php endif; ?>

                </ul>
            </li>
            <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAnyAccess(['report*'])): ?>
            <li <?php echo e((Request::is('report*') ? 'class=active' : '')); ?>>
                <a href="#"><i class="fa fa-print"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <li <?php echo e((Request::is('report*') ? 'class=active' : '')); ?>>
                      <a href="<?php echo e(route('report.asset')); ?>">Asset Report</a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
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
