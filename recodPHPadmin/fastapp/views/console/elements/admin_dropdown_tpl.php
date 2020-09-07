<?if ($current_admin_session):?>
<div class="btn-group pull-right" >
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-user"></i><span class="hidden-phone"> <?=$current_admin_session['admin_firstname'].' '.$current_admin_session['admin_lastname']?></span>
            <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
            <li><a href="<?=  console_url()?>admin/profile">Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?=  console_url()?>admin/logout">Logout</a></li>
    </ul>
</div>
<?  endif;?>