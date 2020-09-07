<style>
.accordion{
	margin:0;
	padding:0;
	cursor:pointer;
}
</style>
<? 
$nav = null;
foreach($site_menu as $menu){
	if(empty($menu['menu_parent_id'])){
			$nav[$menu['menu_ID']]= $menu;
	} else {
		$nav[$menu['menu_parent_id']]['child'][$menu['menu_ID']]= $menu;
	}
	
}
if ($current_user_session): ?>
        <div class="span2 main-menu-span">
            <div class="well nav-collapse sidebar-nav" style="height:auto !important;">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li ><a class="ajax-link" href="<?= console_url('dashboard') ?>">
						<i class="icon icon-black icon-home"></i><span class="hidden-tablet"> Dashboard</span></a>
					</li>
                    <? if (is_array($nav)): ?>
                        <? foreach ($nav as $key => $value): ?><!--level1 -->
						<? if (empty($value['child'])): ?>
                            <li>
								<a class="ajax-link" title="<?=$value['menu_hint']?>" href="<?= console_url($value['menu_link']) ?>">
									<span class="hidden-tablet"> <i class="<?= $value['menu_icon_class'] ?>"></i> <?= $value['menu_name'] ?></span>
								</a>
							</li>
                            <? else: ?><!--level2 -->
                            <li class="accordion"><a class="ajax-link" href="#"  title="<?=$value['menu_hint']?>">
						    <i class="<?= $value['menu_icon_class'] ?>"></i>
							<span class="hidden-tablet"> <?= $value['menu_name'] ?></span> <i class="icon-chevron-right"></i></a>
							

							   <ul class="nav nav-pills nav-stacked" style="display:none;background:lightblue;">
								<? foreach ($value['child'] as $ckey => $cvalue): ?>
									<li><a  title="<?=$cvalue['menu_hint']?>" class="ajax-link" href="<?= console_url($cvalue['menu_link']) ?>"><i class="<?= $cvalue['menu_icon_class'] ?>"></i><span class="hidden-tablet"> <?= $cvalue['menu_name'] ?></span></a></li>
								<? endforeach; ?>
								</ul>
							</li>
						<? endif; ?>							
							<? endforeach; ?>
                    <? endif; ?>
		
                </ul>
            </div><!--/.well -->
        </div><!--/span-->
<? endif; ?>
