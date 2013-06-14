<div id="mainview">
    <h1>Tổng quan xây dựng</h1>
    <div class="yui-navset">
        <ul class="yui-nav">
            <li <?if($param1=='resources'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/premiumTradeAdvisor/resources/" title="Tài nguyên"><em>Tài nguyên</em></a></li>
            <li <?if($param1=='population'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/premiumTradeAdvisor/population/" title="Người dân"><em>Người dân</em></a></li>
            <li <?if($param1=='buildings'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/premiumTradeAdvisor/buildings/" title="Công trình"><em>Công trình</em></a></li>
        </ul>
    </div>
<?if($param1=='population'){?>
    <div id="populationOverview" class="contentBox">
        <h3 class="header"><span class="textLabel">Tổng quan về đế chế</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="overview">
                <tr>
                    <th title="Thành phố"><img src="<?=$this->config->item('style_url')?>skin/layout/city.gif" alt="Thành phố" title="Thành phố"></th>
                    <th title="Dân số"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_population.gif" alt="Dân số" title="Dân số"></th>
                    <th title="Tăng trưởng dân số"><img src="<?=$this->config->item('style_url')?>skin/icons/growth_positive.gif"></th>
                    <th title="Công dân"><img src="<?=$this->config->item('style_url')?>skin/characters/40h/citizen_r.gif" alt="Công dân" title="Công dân"></th>
                    <th title="Công nhân xưởng gỗ"><img src="<?=$this->config->item('style_url')?>skin/characters/40h/woodworker_r.gif" alt="Công nhân xưởng gỗ" title="Công nhân xưởng gỗ"></th>
                    <th title="Công nhân chuyển hàng"><img src="<?=$this->config->item('style_url')?>skin/characters/40h/luxuryworker_r.gif" alt="Công nhân chuyển hàng" title="Công nhân chuyển hàng"></th>
                    <th title="Các nhà khoa học"><img src="<?=$this->config->item('style_url')?>skin/characters/40h/scientist_r.gif" alt="Các nhà khoa học" title="Các nhà khoa học"></th>
                    <th title="Mức độ hài lòng"><img src="<?=$this->config->item('style_url')?>skin/smilies/happy_x32.gif" alt="Mức độ hài lòng" title="Mức độ hài lòng"></th>
                </tr>
<?$town_id = 0?>
<?foreach($this->Player_Model->towns as $town){?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về Thành phốа <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class="citizens text"><?=number_format($this->Player_Model->peoples[$town->id])?> / <?=number_format($this->Player_Model->max_peoples[$town->id])?></td>
                    <td class="citizens text"><?=number_format($this->Player_Model->good[$town->id]/50, 2, '.', '')?></td>
                    <td class="citizens text"><?=number_format($town->peoples)?></td>
<?
    $wood = $this->Data_Model->island_cost(0, $this->Player_Model->islands[$town->island]->wood_level);
    $trade = $this->Data_Model->island_cost(1, $this->Player_Model->islands[$town->island]->trade_level);
?>
                    <td class="worker1 text"><?=number_format($town->workers)?> / <?=number_format($wood['workers'])?></td>
                    <td class="worker2 text"><?=number_format($town->tradegood)?> / <?=number_format($trade['workers'])?></td>
                    <td class="scientists text"><?=number_format($town->scientists)?> / <?=number_format($this->Data_Model->scientists_by_level($this->Player_Model->levels[$town->id][3]))?></td>
                    <td class="satisfaction"><img src="<?=$this->config->item('style_url')?>skin/smilies/<?=$this->Data_Model->good_class_by_count($this->Player_Model->good[$town->id])?>_x25.gif" alt="<?=$this->Data_Model->good_name_by_count($this->Player_Model->good[$town->id])?>" title="<?=$this->Data_Model->good_name_by_count($this->Player_Model->good[$town->id])?>" /></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
        </div>
        <div class="footer"></div>
    </div>
<?}?>


<?if($param1=='resources'){?>
    <div id="resourceOverview" class="contentBox">
        <h3 class="header"><span class="textLabel">Tổng quan về đế chế</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="overview">
                <tr>
                    <th class="image"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" alt="Vật liệu xây dựng" title="Vật liệu xây dựng"></th>
                    <th class="text">Trong kho hàng</th>
                    <th class="text">Cấp độ</th>
                    <th class="text">Công nhân</th>
                    <th class="text">Sản xuất</th>
                    <th class="text">Giới hạn sức chứa của kho hàng</th>
                    <th class="text"></th>
                    <th class="text"></th>
                </tr>
<?
    $town_id = 0;
    $all_wood = 0;
    $all_wine = 0;
    $all_marble = 0;
    $all_crystal = 0;
    $all_sulfur = 0;
    $all_workers = 0;
    $all_add = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?
    $wood = $this->Data_Model->island_cost(0, $this->Player_Model->islands[$town->island]->wood_level);
    $all_wood = $all_wood + $town->wood;
    $all_workers = $all_workers + $town->workers;
    $all_add = $all_add + $town->workers*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_wood;
?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->wood)?></td>
                    <td class="wine">
                        <a title="Ссылка на строительные материалы" href="<?=$this->config->item('base_url')?>game/resource/<?=$town->island?>/"><?=$this->Player_Model->islands[$town->island]->wood_level?></a>
                    </td>
                    <td><?=number_format($town->workers)?>/<?=number_format($wood['workers'])?></td>
                    <td><?=number_format($town->workers*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_wood)?> Mỗi giờ</td>
                    <td><?if($town->workers>0){?><?=format_time((($this->Player_Model->capacity[$town->id]-$town->wood)/($town->workers*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_wood))*3600)?><?}else{?>-<?}?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?$town_id++?>
<?}?>
                <tr>
                    <td class="total city">Tổng</td>
                    <td class="total stock"><?=number_format($all_wood)?></td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_workers)?></td>
                    <td class="total stock"><?=number_format($all_add)?> Mỗi giờ</td>
                    <td>-</td>
                    <td class="total stock">-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <th class="image"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" alt="Rượu" title="Rượu"></th>
                    <th class="text">Trong kho hàng</th>
                    <th class="text">Cấp độ</th>
                    <th class="text">Công nhân</th>
                    <th class="text">Sản xuất</th>
                    <th class="text">Giới hạn sức chứa của kho hàng</th>
                    <th class="text">Sự tiêu thụ</th>
                    <th class="text">Thời gian còn lại</th>
                </tr>
<?
    $all_workers = 0;
    $all_add = 0;
    $all_remove = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?
    $trade = $this->Data_Model->island_cost(1, $this->Player_Model->islands[$town->island]->trade_level);
    $all_wine = $all_wine + $town->wine;
    if($this->Player_Model->islands[$town->island]->trade_resource == 1)
    {
        $all_workers = $all_workers + $town->tradegood;
        $all_add = $all_add + $town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_crystal;
    }
    $all_remove = $all_remove + $this->Data_Model->wine_by_tavern_level($this->Player_Model->towns[$town->id]->tavern_wine);
?>
<?if($this->Player_Model->islands[$town->island]->trade_resource == 1){?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->wine)?></td>
                    <td class="wine">
                        <a title="Ссылка на виноград" href="<?=$this->config->item('base_url')?>game/tradegood/<?=$town->island?>/"><?=$this->Player_Model->islands[$town->island]->trade_level?></a>
                    </td>
                    <td><?=number_format($town->tradegood)?>/<?=number_format($trade['workers'])?></td>
                    <td><?=number_format($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_wine)?> Mỗi giờ</td>
                    <td><?if($town->tradegood>0){?><?=format_time((($this->Player_Model->capacity[$town->id]-$town->wine)/($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_wine))*3600)?><?}else{?>-<?}?></td>
                    <td><?=$this->Data_Model->wine_by_tavern_level($this->Player_Model->towns[$town->id]->tavern_wine)?> Mỗi giờ</td>
                    <td><?if($town->wine > 0 and $this->Player_Model->levels[$town->id][8] > 0){?><?=format_time(($town->wine/$this->Data_Model->wine_by_tavern_level($this->Player_Model->levels[$town->id][8]))*3600)?><?}else{?>-<?}?></td>
                </tr>
<?}else{?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->wine)?></td>
                    <td class="wine">-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?=$this->Data_Model->wine_by_tavern_level($this->Player_Model->levels[$town->id][8])?> Mỗi giờ</td>
                    <td><?if($this->Data_Model->wine_by_tavern_level($this->Player_Model->levels[$town->id][8]) > 0){?><?=format_time(($town->wine/$this->Data_Model->wine_by_tavern_level($this->Player_Model->levels[$town->id][8]))*3600)?><?}else{?>-<?}?></td>
                </tr>
<?}?>
<?$town_id++?>
<?}?>
                <tr>
                    <td class="total city">Tổng</td>
                    <td class="total stock"><?=number_format($all_wine)?></td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_workers)?></td>
                    <td class="total stock"><?=number_format($all_add)?> Mỗi giờ</td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_remove)?> Mỗi giờ</td>
                    <td>-</td>
                </tr>
                <tr>
                    <th class="image"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" alt="Cẩm thạch" title="Cẩm thạch"></th>
                    <th class="text">Trong kho hàng</th>
                    <th class="text">Cấp độ</th>
                    <th class="text">Công nhân</th>
                    <th class="text">Sản xuất</th>
                    <th class="text">Giới hạn sức chứa của kho hàng</th>
                    <th class="text"></th>
                    <th class="text"></th>
                </tr>
<?
    $all_workers = 0;
    $all_add = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?
    $trade = $this->Data_Model->island_cost(1, $this->Player_Model->islands[$town->island]->trade_level);
    $all_marble = $all_marble + $town->marble;
    if($this->Player_Model->islands[$town->island]->trade_resource == 2)
    {
        $all_workers = $all_workers + $town->tradegood;
        $all_add = $all_add + $town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_crystal;
    }
?>
<?if($this->Player_Model->islands[$town->island]->trade_resource == 2){?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->marble)?></td>
                    <td class="marble">
                        <a title="Ссылка на виноград" href="<?=$this->config->item('base_url')?>game/tradegood/<?=$town->island?>/"><?=$this->Player_Model->islands[$town->island]->trade_level?></a>
                    </td>
                    <td><?=number_format($town->tradegood)?>/<?=number_format($trade['workers'])?></td>
                    <td><?=number_format($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_marble)?> Mỗi giờ</td>
                    <td><?if($town->tradegood>0){?><?=format_time((($this->Player_Model->capacity[$town->id]-$town->marble)/($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_marble))*3600)?><?}else{?>-<?}?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}else{?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->marble)?></td>
                    <td class="marble">-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}?>
<?$town_id++?>
<?}?>
                <tr>
                    <td class="total city">Tổng</td>
                    <td class="total stock"><?=number_format($all_marble)?></td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_workers)?></td>
                    <td class="total stock"><?=number_format($all_add)?> Mỗi giờ</td>
                    <td>-</td>
                    <td class="total stock">-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <th class="image"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" alt="Pha lê" title="Pha lê"></th>
                    <th class="text">Trong kho hàng</th>
                    <th class="text">Cấp độ</th>
                    <th class="text">Công nhân</th>
                    <th class="text">Sản xuất</th>
                    <th class="text">Giới hạn sức chứa của kho hàng</th>
                    <th class="text"></th>
                    <th class="text"></th>
                </tr>
<?
    $all_workers = 0;
    $all_add = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?
    $trade = $this->Data_Model->island_cost(1, $this->Player_Model->islands[$town->island]->trade_level);
    $all_crystal = $all_crystal + $town->crystal;
    if($this->Player_Model->islands[$town->island]->trade_resource == 3)
    {
        $all_workers = $all_workers + $town->tradegood;
        $all_add = $all_add + $town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_crystal;
    }
?>
<?if($this->Player_Model->islands[$town->island]->trade_resource == 3){?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->crystal)?></td>
                    <td class="crystal">
                        <a title="Ссылка на виноград" href="<?=$this->config->item('base_url')?>game/tradegood/<?=$town->island?>/"><?=$this->Player_Model->islands[$town->island]->trade_level?></a>
                    </td>
                    <td><?=number_format($town->tradegood)?>/<?=number_format($trade['workers'])?></td>
                    <td><?=number_format($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_crystal)?> Mỗi giờ</td>
                    <td><?if($town->tradegood>0){?><?=format_time((($this->Player_Model->capacity[$town->id]-$town->crystal)/($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_crystal))*3600)?><?}else{?>-<?}?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}else{?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->crystal)?></td>
                    <td class="crystal">-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}?>
<?$town_id++?>
<?}?>
                <tr>
                    <td class="total city">Tổng</td>
                    <td class="total stock"><?=number_format($all_crystal)?></td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_workers)?></td>
                    <td class="total stock"><?=number_format($all_add)?> Mỗi giờ</td>
                    <td>-</td>
                    <td class="total stock">-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <th class="image"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" alt="Lưu huỳnh" title="Lưu huỳnh"></th>
                    <th class="text">Trong kho hàng</th>
                    <th class="text">Cấp độ</th>
                    <th class="text">Công nhân</th>
                    <th class="text">Sản xuất</th>
                    <th class="text">Giới hạn sức chứa của kho hàng</th>
                    <th class="text"></th>
                    <th class="text"></th>
                </tr>
<?
    $all_workers = 0;
    $all_add = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?
    $trade = $this->Data_Model->island_cost(1, $this->Player_Model->islands[$town->island]->trade_level);
    $all_sulfur = $all_sulfur + $town->sulfur;
    if($this->Player_Model->islands[$town->island]->trade_resource == 4)
    {
        $all_workers = $all_workers + $town->tradegood;
        $all_add = $all_add + $town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_sulfur;
    }
?>
<?if($this->Player_Model->islands[$town->island]->trade_resource == 4){?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->sulfur)?></td>
                    <td class="sulfur">
                        <a title="Liên kết với" href="<?=$this->config->item('base_url')?>game/tradegood/<?=$town->island?>/"><?=$this->Player_Model->islands[$town->island]->trade_level?></a>
                    </td>
                    <td><?=number_format($town->tradegood)?>/<?=number_format($trade['workers'])?></td>
                    <td><?=number_format($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_sulfur)?> Mỗi giờ</td>
                    <td><?if($town->tradegood>0){?><?=format_time((($this->Player_Model->capacity[$town->id]-$town->sulfur)/($town->tradegood*(1-$this->Player_Model->corruption[$town->id])*$this->Player_Model->plus_sulfur))*3600)?><?}else{?>-<?}?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}else{?>
                <tr class='<?if (($town_id % 2) == 0){?>normal<?}else{?>alt<?}?>'>
                    <td class="city"><a title="Biết thêm về <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></td>
                    <td class=""><?=number_format($town->sulfur)?></td>
                    <td class="sulfur">-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
<?}?>
<?$town_id++?>
<?}?>
                <tr>
                    <td class="total city">Tổng</td>
                    <td class="total stock"><?=number_format($all_sulfur)?></td>
                    <td>-</td>
                    <td class="total stock"><?=number_format($all_workers)?></td>
                    <td class="total stock"><?=number_format($all_add)?> Mỗi giờ</td>
                    <td>-</td>
                    <td class="total stock">-</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <div class="footer"></div>
    </div>
<?}?>

<?if($param1=='buildings'){?>
    <div id="buildingsOverview" class="contentBox">
        <h3 class="header"><span class="textLabel">Tổng quan về đế chế</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0">
                <tr class="headingrow">
                    <th class="city" title="Thành phố"><img src="<?=$this->config->item('style_url')?>skin/layout/city.gif" alt="Thành phố" title="Thành phố"></th>
                    <th class="building" title="Tòa thị chính"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_townHall.gif" alt="Tòa thị chính" title="Tòa thị chính"></th>
                    <th class="building" title="Học viện"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_academy.gif" alt="Học viện" title="Học viện"></th>
                    <th class="building" title="Kho hàng"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_warehouse.gif" alt="Kho hàng" title="Kho hàng"></th>
                    <th class="building" title="Quán rượu"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_tavern.gif" alt="Quán rượu" title="Quán rượu"></th>
                    <th class="building" title="Cung điện"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_palace.gif" alt="Cung điện" title="Cung điện"></th>
                </tr>
<?$town_id = 0?>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phố <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][1]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/townHall/" title="К Tòa thị chính"><?=$this->Player_Model->levels[$town->id][1]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][3]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/academy/" title="К Học viện"><?=$this->Player_Model->levels[$town->id][3]?></a><?}else{?>-<?}?></td>
                    <td class="building">
                        <?if($this->Player_Model->warehouses[$town->id] > 0){?>
                        <?for($i = 3; $i <= 13; $i++){?>
                        <?$type_text = 'pos'.$i.'_type'?>
                        <?$level_text = 'pos'.$i.'_level'?>
                        <?if($town->$type_text == 6){?>
                        <a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/warehouse/<?=$i?>/" title="К Kho hàng"><?=$town->$level_text?></a>&nbsp;&nbsp;
                        <?}}?>
                        <?}else{?>-<?}?>
                    </td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][8]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/tavern/" title="К Quán rượu"><?=$this->Player_Model->levels[$town->id][8]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][10]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/palace/" title="К Cung điện"><?=$this->Player_Model->levels[$town->id][10]?></a><?}else{?>-<?}?></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
            <table cellpadding="0" cellspacing="0">
                <tr class="headingrow">
                    <th class="city" title="Thành phố">&nbsp;</th>
                    <th class="building" title="Thủ phủ hiến"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_palaceColony.gif" alt="Thủ phủ hiến" title="Thủ phủ hiến"></th>
                    <th class="building" title="Cảng giao dịch"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_port.gif" alt="Cảng giao dịch" title="Cảng giao dịch"></th>
                    <th class="building" title="Xưởng đóng tàu"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_shipyard.gif" alt="Xưởng đóng tàu" title="Xưởng đóng tàu"></th>
                    <th class="building" title="Doan trại quân đội"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_barracks.gif" alt="Doan trại quân đội" title="Doan trại quân đội"></th>
                    <th class="building" title="Tường thành"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_wall.gif" alt="Tường thành" title="Tường thành"></th>
                </tr>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phố <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][15]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/palaceColony/" title="К Thủ phủ hiến"><?=$this->Player_Model->levels[$town->id][15]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][2]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/port/" title="К Cảng giao dịch"><?=$this->Player_Model->levels[$town->id][2]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][4]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/shipyard/" title="К Xưởng đóng tàu"><?=$this->Player_Model->levels[$town->id][4]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][5]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/barracks/" title="К Doan trại quân đội"><?=$this->Player_Model->levels[$town->id][5]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][7]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/wall/" title="К Tường thành"><?=$this->Player_Model->levels[$town->id][7]?></a><?}else{?>-<?}?></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
            <table cellpadding="0" cellspacing="0">
                <tr class="headingrow"><th class="city" title="Thành phố">&nbsp;</th>
                    <th class="building" title="Tòa đại sứ"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_embassy.gif" alt="Tòa đại sứ" title="Tòa đại sứ"></th>
                    <th class="building" title="Trạm giao dịch"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_branchOffice.gif" alt="Trạm giao dịch" title="Trạm giao dịch"></th>
                    <th class="building" title="Xưởng"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_workshop.gif" alt="Xưởng" title="Xưởng"></th>
                    <th class="building" title="Hầm trú ẩn"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_safehouse.gif" alt="Hầm trú ẩn" title="Hầm trú ẩn"></th>
                    <th class="building" title="Nhà của kiểm lâm"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_forester.gif" alt="Nhà của kiểm lâm" title="Nhà của kiểm lâm"></th>
                </tr>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phố <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][11]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/embassy/" title="К Tòa đại sứ"><?=$this->Player_Model->levels[$town->id][11]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][12]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/branchOffice/" title="К Trạm giao dịch"><?=$this->Player_Model->levels[$town->id][12]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][13]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/workshop/" title="К Xưởng"><?=$this->Player_Model->levels[$town->id][13]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][14]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/safehouse/" title="К Hầm trú ẩn"><?=$this->Player_Model->levels[$town->id][14]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][16]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/forester/" title="К Nhà của kiểm lâm"><?=$this->Player_Model->levels[$town->id][16]?></a><?}else{?>-<?}?></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
            <table cellpadding="0" cellspacing="0"><tr class="headingrow">
                    <th class="city" title="Thành phố">&nbsp;</th>
                    <th class="building" title="Người thổi thủy tinh"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_glassblowing.gif" alt="Người thổi thủy tinh" title="Người thổi thủy tinh"></th>
                    <th class="building" title="Tòa tháp của nhà giả kim thuật"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_alchemist.gif" alt="Tòa tháp của nhà giả kim thuật" title="Tòa tháp của nhà giả kim thuật"></th>
                    <th class="building" title="Người trồng nho"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_winegrower.gif" alt="Người trồng nho" title="Người trồng nho"></th>
                    <th class="building" title="Thợ xây đá"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_stonemason.gif" alt="Thợ xây đá" title="Thợ xây đá"></th>
                    <th class="building" title="Xưởng mộc"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_carpentering.gif" alt="Xưởng mộc" title="Xưởng mộc"></th>
                </tr>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phố <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][18]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/glassblowing/" title="К Người thổi thủy tinh"><?=$this->Player_Model->levels[$town->id][18]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][20]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/alchemist/" title="К Tòa tháp của nhà giả kim thuật"><?=$this->Player_Model->levels[$town->id][20]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][19]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/winegrower/" title="К Người trồng nho"><?=$this->Player_Model->levels[$town->id][19]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][17]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/stonemason/" title="К Thợ xây đá"><?=$this->Player_Model->levels[$town->id][17]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][21]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/carpentering/" title="К Xưởng mộc"><?=$this->Player_Model->levels[$town->id][21]?></a><?}else{?>-<?}?></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
            <table cellpadding="0" cellspacing="0"><tr class="headingrow">
                    <th class="city" title="Thành phố">&nbsp;</th>
                    <th class="building" title="Viện bảo tàng"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_museum.gif" alt="Viện bảo tàng" title="Viện bảo tàng"></th>
                    <th class="building" title="Văn phòng kiến trúc sư"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_architect.gif" alt="Văn phòng kiến trúc sư" title="Văn phòng kiến trúc sư"></th>
                    <th class="building" title="Thợ làm kính"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_optician.gif" alt="Thợ làm kính" title="Thợ làm kính"></th>
                    <th class="building" title="Máy ép nho"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_vineyard.gif" alt="Máy ép nho" title="Máy ép nho"></th>
                    <th class="building" title="Khu vực thử nghiệm thuốc súng"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_fireworker.gif" alt="Khu vực thử nghiệm thuốc súng" title="Khu vực thử nghiệm thuốc súng"></th>
                </tr>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phố <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][9]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/museum/" title="К Viện bảo tàng"><?=$this->Player_Model->levels[$town->id][9]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][22]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/architect/" title="К Văn phòng kiến trúc sư"><?=$this->Player_Model->levels[$town->id][22]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][23]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/optician/" title="К Thợ làm kính"><?=$this->Player_Model->levels[$town->id][23]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][24]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/vineyard/" title="К Máy ép nho"><?=$this->Player_Model->levels[$town->id][24]?></a><?}else{?>-<?}?></td>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][25]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/fireworker/" title="К Khu vực thử nghiệm thuốc súng"><?=$this->Player_Model->levels[$town->id][25]?></a><?}else{?>-<?}?></td>
                </tr>
<?$town_id++?>
<?}?>
            </table>

            <table cellpadding="0" cellspacing="0">
                <tr class="headingrow">
                    <th class="city" title="Thành phố">&nbsp;</th>
                    <th class="building" title="Thần điện"><img src="<?=$this->config->item('style_url')?>skin/buildings/y50/y50_temple.gif" alt="Thần điện" title="Thần điện"></th>
                    <th class="city">&nbsp;</th>
                    <th class="city">&nbsp;</th>
                    <th class="city">&nbsp;</th<th class="city">&nbsp;</th>
                    <th class="city">&nbsp;</th>
                </tr>
<?foreach($this->Player_Model->towns as $town){?>
                <tr<?if (($town_id % 2) != 0){?> class="alt"<?}?>>
                    <th class="city"><a title="Biết thêm về Thành phốа <?=$town->name?>" href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/"><?=$town->name?></a></th>
                    <td class="building"><?if($this->Player_Model->levels[$town->id][26]>0){?><a href="<?=$this->config->item('base_url')?>game/city/<?=$town->id?>/temple/" title="К Thần điện"><?=$this->Player_Model->levels[$town->id][26]?></a><?}else{?>-<?}?></td>
                    <td class="building">&nbsp;</td>
                    <td class="building">&nbsp;</td>
                    <td class="building">&nbsp;</td>
                    <td class="building">&nbsp;</td>
                </tr>
<?$town_id++?>
<?}?>
            </table>
        </div>
        <div class="footer"></div>
    </div>
<?}?>
</div>