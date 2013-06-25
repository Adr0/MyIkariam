<div id="mainview">
<?php include_once('building_description.php'); ?>
    <form id="buildForm"  action="<?=$this->config->item('base_url')?>actions/fleet/<?=$position?>/" method="POST">
        <input type="hidden" name="action" value="buildUnits">
        <div class="contentBox01h">
            <h3 class="header">Chế tạo tàu</h3>
            <div class="content">
                <ul id="units">
<?php for($i = 16; $i <= 22; $i++){
    if (($i == 16) or
        ($i == 17 and $this->Player_Model->research->res1_8 > 0) or
        ($i == 18 and $this->Player_Model->research->res1_12 > 0) or
        ($i == 19 and $this->Player_Model->research->res1_2 > 0) or
        ($i == 20 and $this->Player_Model->research->res1_9 > 0) or
        ($i == 21 and $this->Player_Model->research->res1_13 > 0) or
        ($i == 22 and $this->Player_Model->research->res3_14 > 0)){

    $max_wood = 0;
    $max_sulfur = 0;
    $max_wine = 0;
    $max_crystal = 0;
    $max_peoples = 0;
    $cost = $this->Data_Model->army_cost_by_type($i, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
    $cost['time'] = floor($cost['time'] / getConfig('game_speed'));
	$class = $this->Data_Model->army_class_by_type($i);
    if ($cost['wood'] > 0){ $max_wood = floor($this->Player_Model->now_town->wood/$cost['wood']);}
    if ($cost['sulfur'] > 0){ $max_sulfur = floor($this->Player_Model->now_town->sulfur/$cost['sulfur']); }
    if ($cost['wine'] > 0){ $max_wine = floor($this->Player_Model->now_town->wine/$cost['wine']); }
    if ($cost['crystal'] > 0){ $max_crystal = floor($this->Player_Model->now_town->crystal/$cost['crystal']); }
    if ($cost['peoples'] > 0){ $max_peoples = floor($this->Player_Model->now_town->peoples/$cost['peoples']); }
    $max = 999999;
    if ($cost['wood'] > 0){ $max = ($max_wood > $max) ? $max : $max_wood; }
    if ($cost['sulfur'] > 0){ $max = ($max_sulfur > $max) ? $max : $max_sulfur; }
    if ($cost['wine'] > 0){ $max = ($max_wine > $max) ? $max : $max_wine; }
    if ($cost['crystal'] > 0){ $max = ($max_crystal > $max) ? $max : $max_crystal; }
    if ($cost['peoples'] > 0){ $max = ($max_peoples > $max) ? $max : $max_peoples; }

?>
                    <li class="unit <?=$class?>">
                        <div class="unitinfo">
                            <h4><?=$this->Data_Model->army_name_by_type($i)?></h4>
                            <a title="Biết thêm về <?=$this->Data_Model->army_name_by_type($i)?>" href="<?=$this->config->item('base_url')?>game/unitDescription/<?=$i?>">
                                <img src="<?=$this->config->item('style_url')?>skin/characters/fleet/120x100/<?=$class?>_r_120x100.gif">
                            </a>
                            <div class="unitcount"><span class="textLabel">Sẵn có: </span><?=$this->Player_Model->armys[$this->Player_Model->town_id]->$class?></div>
                            <p><?=$this->Data_Model->army_desc_by_type($i)?></p>
                        </div>
                        <label for="textfield_<?=$class?>">Thuê <?=$this->Data_Model->army_name_by_type($i)?></label>
                        <div class="sliderinput">
                            <div class="sliderbg" id="sliderbg_<?=$class?>">
                                <div class="actualValue" id="actualValue_<?=$class?>"></div>
                                <div class="sliderthumb" id="sliderthumb_<?=$class?>"></div>
                            </div>
<script type="text/javascript">
    create_slider({
        dir : 'ltr',
        id : "slider_<?=$class?>",
        maxValue : <?=$max?>,
        overcharge : 0,
        iniValue : 0,
        bg : "sliderbg_<?=$class?>",
        thumb : "sliderthumb_<?=$class?>",
        topConstraint: -10,
        bottomConstraint: 326,
        bg_value : "actualValue_<?=$class?>",
        textfield:"textfield_<?=$class?>"
    });
    var slider = sliders["default"];
</script>
                            <a class="setMin" href="#reset" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(0); return false;" title="Сбросить ввод"><span class="textLabel">мин.</span></a>
                            <a class="setMax" href="#max" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(<?=$max?>); return false;" title="Рекрутировать максимум"><span class="textLabel">макс.</span></a>
			</div>
<?if ($this->Player_Model->now_town->build_line != '' and $this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'] == $position){?>
                        <div class="forminput">
                            Công trình đang nâng cấp
                        </div>
<?}else{?>
<?if(   ($this->Player_Model->levels[$this->Player_Model->town_id][4] < 1) or
        ($i == 17 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 4) or // 4
        ($i == 18 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 5) or // 5
        ($i == 19 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 2) or // 2
        ($i == 20 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 3) or // 3
        ($i == 21 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 6) or // 6
        ($i == 22 and $this->Player_Model->levels[$this->Player_Model->town_id][4] < 7)){  // 7?>
                        <div class="forminput">Cấp độ công trình quá thấp!</div>
<?}else{?>
                        <div class="forminput">
                            <input class="textfield" id="textfield_<?=$this->Data_Model->army_class_by_type($i)?>" type="text" name="<?=$i?>"  value="0" size="4" maxlength="4">
                            <a class="setMax" href="#max" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(<?=$max?>); return false;" title="Chế tạo nhiều nhất có thể">
                                <span class="textLabel">Max</span>
                            </a>
                            <input class="button" type="submit" value="Chiêu mộ!">
                        </div>
<?}}?>
                        <div class="costs">
                            <h5>Chi phí:</h5>
                            <ul class="resources">
<?if($cost['peoples'] > 0){?>
                                <li class="citizens" title="Người dân"><span class="textLabel">Người dân: </span><?=$cost['peoples']?></li>
<?}?>
<?if($cost['wood'] > 0){?>
                                <li class="wood" title="Vật liệu xây dựng"><span class="textLabel">Vật liệu xây dựng: </span><?=number_format($cost['wood'])?></li>
<?}?>
<?if($cost['sulfur'] > 0){?>
                                <li class="sulfur" title="Lưu huỳnh"><span class="textLabel">Lưu huỳnh: </span><?=number_format($cost['sulfur'])?></li>
<?}?>
<?if($cost['wine'] > 0){?>
                                <li class="wine" title="Rượu"><span class="textLabel">Rượu: </span><?=number_format($cost['wine'])?></li>
<?}?>
<?if($cost['crystal'] > 0){?>
                                <li class="glass" title="Pha lê"><span class="textLabel">Pha lê: </span><?=number_format($cost['crystal'])?></li>
<?}?>
<?if($cost['gold'] > 0){?>
                                <li class="upkeep" title="Lương mỗi giờ"><span class="textLabel">Lương mỗi giờ: </span><?=number_format($cost['gold'])?></li>
<?}?>
<?if($cost['time'] > 0){?>
                                <li class="time" title="Thời gian xây dựng"><span class="textLabel">Thời gian xây dựng: </span><?=format_time($cost['time'])?></li>
<?}?>
                            </ul>
                        </div>
                    </li>
<?}?>
<?}?>
				</ul>
			</div>
			<div class="footer"></div>
		</div>
		</form>
	</div>