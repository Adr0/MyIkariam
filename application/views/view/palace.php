<div id="mainview">
<?include_once('building_description.php')?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Thành phố trong thể chế của bạn</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="table01">
                <thead>
                    <tr>
                        <th class="crown"></th>
                        <th>Thành phố 	</th>
                        <th>Cấp độ</th>
                        <th>Cung điện</th>
                        <th>Hòn đảo</th>
                        <th>Tài nguyên</th>
                    </tr>
                </thead>
                <tbody>
<?foreach($this->Player_Model->towns as $town){?>
<?
    // уровень дворца
    $level = 0;
    for($i = 3; $i <= 13; $i++)
    {
        $type_text = 'pos'.$i.'_type';
        $level_text = 'pos'.$i.'_level';
        if ($town->$type_text == 10){ $level = $town->$level_text; }
    }
?>
                    <tr>
                        <td><?if($town->id == $this->Player_Model->capital_id){?><img src="<?=$this->config->item('style_url')?>skin/layout/crown.gif" width="20" height="20" alt="Столица" title="Столица"><?}?></td>
                        <td><?=$town->name?></td>
                        <td><?=$town->pos0_level?></td>
                        <td><?=$level?></td>
                        <td><?=$this->Player_Model->islands[$town->island]->name?> [<?=$this->Player_Model->islands[$town->island]->x?>:<?=$this->Player_Model->islands[$town->island]->y?>]</td>
                        <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_<?=resource_icon($this->Player_Model->islands[$town->island]->trade_resource)?>.gif"  title="<?=$this->Data_Model->island_building_by_resource($this->Player_Model->islands[$town->island]->trade_resource)?>" alt="<?=$this->Data_Model->island_building_by_resource($this->Player_Model->islands[$town->island]->trade_resource)?>"></td>
                    </tr>
<?}?>
                </tbody>
            </table>
        </div>
	<div class="footer"></div>
    </div>

<div class="contentBox01h">
    <h3 class="header"><span class="textLabel">Chiếm đóng thành phố</span></h3>
    <div class="content">
        <table cellpadding="0" cellspacing="0" class="table01">
        <thead>
        <tr>
            <th class="crown"></th>
            <th>Thành phố</th>
            <th>Cấp độ</th>
            <th>Hòn đảo</th>
            <th>Tài nguyên 	</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>

        <tr><td colspan="6">Bạn không chiếm đóng thành phố nào.</td></tr>        </tbody>
        </table>
    </div>
    <div class="footer"></div>
</div>

</div>
