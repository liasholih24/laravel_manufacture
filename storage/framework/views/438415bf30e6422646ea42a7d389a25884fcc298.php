<div class="row border-bottom">
<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
</div>
<ul class="nav navbar-top-links navbar-left">
  <br/>
    <li><span class="m-r-sm text-muted welcome-message">Selamat Bekerja !
</li>
</ul>
<br/>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">
              <strong></strong>
            </span>
        </li>
            <li>
              <?php echo Form::open(['url' => url('logout'),'class'=>'form-inline']); ?>

                    <?php echo csrf_field(); ?>

               <button type="submit" class="btn btn-w-m btn-link">
                 <i class="fa fa-sign-out"></i> <b>Sign Out</b>
               </button>
              <?php echo Form::close(); ?>

            </li>
    </ul>

</nav>
</div>
