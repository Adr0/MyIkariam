<style>
ul.adminmenu > li { margin-bottom:8px!important; } 
</style>
<div id="information" class="dynamic" style="z-index:1;">        
    <h3 class="header"><?php echo $this->lang->line('acp_menu_title');?></h3>
    <div class="content">
        <ul class="adminmenu" style="font-size:15px;padding:15px;">
		    <li><a href="<?php echo base_url('acp');?>"><?php echo $this->lang->line('menu_index_title');?></a></li>
            <li><a href="<?php echo base_url('acp/config');?>"><?php echo $this->lang->line('menu_config_title');?></a></li>
        </ul>
    </div>
    <div class="footer"></div>
</div>