
<div id="bread">
<ul class="accordion">
<?php
foreach ($menus as $menu) {
    if(empty($menu->children))
    {
    	$checked='';
    	if(in_array($menu->id, $userRightsIds))
    	{
    		$checked='checked';
    	}
        ?>
        <li style="margin-top: 5px;"><label>
        	<?= $this->Form->checkbox('menu_id[]',['value'=>$menu->id,'hiddenField'=>false,'class'=>'menu_check',$checked]).' '.$menu->menu_name; ?></label>
        </li>
        <?php
    }
    else if(!empty($menu->children))
    {
    	$checked='';
    	if(in_array($menu->id, $userRightsIds))
    	{
    		$checked='checked';
    	}
        ?>
        <li class="treeview ">
             <label>
            <?= $this->Form->checkbox('menu_id[]',['value'=>$menu->id,'hiddenField'=>false,'class'=>'menu_check',$checked]).' <a href="javascript:void(0)" class="toggle">'.$menu->menu_name; ?></a></label>
            <ul class="treeview-menu inner" style="display: none;">
        <?php
        foreach ($menu->children as $childrenMenu) {
            if(!empty($childrenMenu->children))
            {
            	$checked='';
		    	if(in_array($childrenMenu->id, $userRightsIds))
		    	{
		    		$checked='checked';
		    	}
                ?>
                <li class="treeview">
                    <label>
                    <?= $this->Form->checkbox('menu_id[]',['value'=>$childrenMenu->id,'hiddenField'=>false,'class'=>'menu_check',$checked]).' <a href="javascript:void(0)" class="toggle">'.$childrenMenu->menu_name; ?></a></label>
                    <ul class="treeview-menu inner" style="display: none;">
                    <?php
                    foreach ($childrenMenu->children as $childrenSubMenu) {
                    	$checked='';
				    	if(in_array($childrenSubMenu->id, $userRightsIds))
				    	{
				    		$checked='checked';
				    	}
                        ?>
                        <li  style="margin-top: 5px;"><label>
                             <?= $this->Form->checkbox('menu_id[]',['value'=>$childrenSubMenu->id,'hiddenField'=>false,'class'=>'menu_check',$checked]).' '.$childrenSubMenu->menu_name; ?></label>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                </li>
                <?php
            }
            else
            {
            	$checked='';
		    	if(in_array($childrenMenu->id, $userRightsIds))
		    	{
		    		$checked='checked';
		    	}
                ?>
                <li  style="margin-top: 5px;"><label>
                   <?= $this->Form->checkbox('menu_id[]',['value'=>$childrenMenu->id,'hiddenField'=>false,'class'=>'menu_check',$checked]).' '.$childrenMenu->menu_name; ?></label>
                </li>
                <?php
            }
                
        }
        ?>
            </ul>
        </li>
        <?php
    }
}
?>
</ul>
</div>
<div class="box-footer">
    <div class="row">
        <center>
            <div class="col-md-12">
                <div class="col-md-offset-3 col-md-6">  
                    <?php echo $this->Form->button('Submit',['class'=>'btn button submit','id'=>'submit_member']); ?>
                </div>
            </div>
        </center>       
    </div>
</div>
