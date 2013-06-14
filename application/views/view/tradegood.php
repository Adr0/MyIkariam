<?if ($this->Player_Model->research->res2_3 == 0){?>
<div id="mainview">

<?if($this->Island_Model->island->trade_resource == 1){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_wine.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 2){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_marble.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 3){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_glass.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 4){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_sulfur.gif) no-repeat right 10px; min-height:180px;">
<?}?>
        <h1><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></h1>
        <p>Đối với việc khai thác tài nguyên, bạn cần phải điều tra các phúc lợi!</p>
    </div>
</div>
<?}else{?>
<?
    $plus_text = 'plus_'.$this->Data_Model->resource_class_by_type($this->Island_Model->island->trade_resource);
    $cost = $this->Data_Model->island_cost($this->Island_Model->island->trade_resource, $this->Island_Model->island->trade_level-1);
    $peoples = floor($this->Player_Model->now_town->peoples);
    $all = $this->Player_Model->now_town->peoples + $this->Player_Model->now_town->tradegood;
    $max = ($cost['workers'] < $all) ? $cost['workers'] : $all;
    $max = floor($max);
?>

<div id="mainview">
    <div class="buildingDescription">
        <h1><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></h1>
        <p></p>
    </div>

    <form id="setWorkers" action="<?=$this->config->item('base_url')?>actions/workers/tradegood/<?=$this->Island_Model->island->id?>"  method="POST">
        <div id="setWorkersBox" class="contentBox">
            <h3 class="header"><span class="textLabel">Phân phối công nhân</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Người dân: </span><span class="value" id="valueCitizens"><?=$peoples?></span></li>
                    <li class="workers"><span class="textLabel">Công nhân: </span><span class="value" id="valueWorkers"><?=number_format($this->Player_Model->now_town->tradegood)?></span></li>
                    <li class="gain" title="Sản xuất:<?=number_format($this->Player_Model->now_town->tradegood*(1-$this->Player_Model->corruption[$this->Player_Model->town_id])*($this->Player_Model->$plus_text))?>" alt="Sản xuất:<?=number_format($this->Player_Model->now_town->tradegood*(1-$this->Player_Model->corruption[$this->Player_Model->town_id])*($this->Player_Model->$plus_text))?>">
                        <span class="textLabel">Sức chứa: </span>
                        <div id="gainPoints">
                            <div id="resiconcontainer">
        <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_<?=resource_icon($this->Island_Model->island->trade_resource)?>.gif" width="25" height="20">
                            </div>
                        </div>
                        <div class="gainPerHour">
                            <span id="valueResource" >+<?=number_format($this->Player_Model->now_town->tradegood*(1-$this->Player_Model->corruption[$this->Player_Model->town_id])*($this->Player_Model->$plus_text))?></span> <span class="timeUnit">Mỗi giờ</span>
                        </div>
                    </li>
                    <li class="costs">
                        <span class="textLabel">Thu nhập thành phố: </span>
                        <span id="valueWorkCosts" class="negative"><?=floor($this->Player_Model->saldo[$this->Player_Model->town_id])?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" title="Vàng" alt="Vàng">
                        <span class="timeUnit"> Mỗi giờ</span>
                    </li>
                </ul>
                <div id="overchargeMsg" class="status nooc ocready oced">Quá tải!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="Không có công nhân"><span class="textLabel">min</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?=$max?>); return false;" title="Số công nhân tối đa"><span class="textLabel">max</span></a>

                <input class="textfield" id="inputWorkers" type="text" name="tw" maxlength="4" autocomplete="off">
                <input class="button" id="inputWorkersSubmit" type="submit" value="Xác nhận">
            </div>
            <div class="footer"></div>
        </div>
    </form>

    <div id="resourceUsers" class="contentBox">
        <h3 class="header"><span class="textLabel">Những người chơi khác trên đảo</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Người chơi                        </th>
                        <th>Thành phố                    </th>
                        <th>Cấp độ                    </th>
                        <th>Công nhân                    </th>
                        <th>Đã quyên góp                         </th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>

<? for ($i = 0; $i <= 15; $i++){?>
<?if (isset($this->Island_Model->towns[$i])){?>
    <?if($this->Player_Model->user->id != $this->Island_Model->users[$i]->id){?>
    <tr class="alt avatar ">
    <?}else{?>
    <tr class="alt own avatar ">
    <?}?>
        <td class="ownerName"><?=$this->Island_Model->users[$i]->login?></td>
        <td class="cityName"><?=$this->Island_Model->towns[$i]->name?></td>
        <td class="cityLevel">Cấp độ <?=$this->Island_Model->towns[$i]->pos0_level?></td>
        <td class="cityWorkers"><?=$this->Island_Model->towns[$i]->tradegood?> Công nhân</td>
        <td class="ownerDonation"><?echo number_format($this->Island_Model->towns[$i]->tradegood_wood);?> <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" alt="Vật liệu xây dựng" /></td>
        <?if($this->Player_Model->user->id != $this->Island_Model->users[$i]->id){?>
        <td class="actions"><a href="<?=$this->config->item('base_url')?>game/sendIKMessage/<?=$this->Island_Model->towns[$i]->user?>/"><img src="<?=$this->config->item('style_url')?>skin/interface/icon_message_write.gif" alt="Gửi tin nhắn" /></a></td>
        <?}?>
    </tr>
<?}?>
<?}?>

                </tbody>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">
    create_slider({
        dir : 'ltr',
        id : "default",
        maxValue : <?=floor($max)?>,
        overcharge : 0,
        iniValue : <?=floor($this->Player_Model->now_town->tradegood)?>,
        bg : "sliderbg",
        thumb : "sliderthumb",
        topConstraint: -10,
        bottomConstraint: 344,
        bg_value : "actualValue",
        bg_overcharge : "overcharge",
        textfield:"inputWorkers"
    });
    Event.onDOMReady(function() {
	var slider = sliders["default"];
        var res = new resourceStack({
            container : "resiconcontainer",
            resourceicon : "resicon",
            width : 140
        });
        res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        slider.subscribe("valueChange", function() {
            res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        });
        var startSlider = slider.actualValue;
        var valueWorkers = Dom.get("valueWorkers");
        var valueCitizens = Dom.get("valueCitizens");
        var valueResource = Dom.get("valueResource");
        var valueWorkCosts = Dom.get("valueWorkCosts");
        var inputWorkersSubmit = Dom.get("inputWorkersSubmit");
        slider.flagSliderMoved =0;
        slider.subscribe("valueChange", function() {
            var startCitizens = <?=floor($this->Player_Model->now_town->peoples)?>;
            var startResourceWorkers = <?=floor($this->Player_Model->now_town->tradegood)?>;
            var startIncomePerTimeUnit = <?=floor($this->Player_Model->saldo[$this->Player_Model->town_id])?>;
            this.flagSliderMoved = 1;
            valueWorkers.innerHTML = locaNumberFormat(slider.actualValue);
            valueCitizens.innerHTML = locaNumberFormat(startCitizens+startResourceWorkers - slider.actualValue);
            var valRes = <?=($this->Player_Model->$plus_text)?> * <?=(1-$this->Player_Model->corruption[$this->Player_Model->town_id])?> * (Math.min(<?=$cost['workers']?>, slider.actualValue) + Math.max(0, 0.25 * (slider.actualValue-<?=$cost['workers']?>)));
            valueResource.innerHTML = '+' + Math.floor(valRes);
            valueWorkCosts.innerHTML = startIncomePerTimeUnit  - 3*(slider.actualValue-startSlider);
        });
        slider.subscribe("slideEnd", function() {
            if (this.flagSliderMoved) {
                inputWorkersSubmit.className = 'buttonChanged';
            }
        });
    });
</script>
<?}?>