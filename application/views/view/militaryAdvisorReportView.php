<div id="mainview">
    <div class="buildingDescription">
        <h1>Army</h1>
        <p></p>
    </div>
	<div class="yui-navset">
        <ul class="yui-nav">
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorMilitaryMovements/" title="Перемещения войск"><em>Hành quân (<?=$this->Player_Model->fleets?>)</em></a></li>
            <li class="selected"><a href="<?php echo $this->config->item('base_url');?>game/militaryAdvisorCombatReports/" title="Боевые доклады"><em>Báo cáo chiến sự (0)</em></a></li>
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorCombatReportsArchive/" title="Архив"><em>Lưu trữ</em></a></li>
        </ul>
    </div>
    <div id="troopsReport">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Combat Reports</span></h3>
            <div class="content">
                <?php echo $param1;?>
			</div>
		</div>
	</div>	
</div>