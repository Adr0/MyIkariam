<div id="mainview">		
    <div class="buildingDescription">
        <h1>Gửi điệp viên</h1>
        <p>Gửi điệp viên của bạn đến thành phố của địch để biết thêm thông tin về thành phố này. Ngay khi điệp viên của bạn đột nhập vào thành phố, bạn có thể cho anh ta biết cần thực hiện nhiệm vụ nào. Chú ý: Điệp viên của bạn có thể bị phát hiện <strong>bất cứ lúc nào!</strong></p>
    </div>
<?
    $x1 = $this->Player_Model->now_island->x;
    $x2 = $this->Island_Model->island->x;
    $y1 = $this->Player_Model->now_island->y;
    $y2 = $this->Island_Model->island->y;
    $time = $this->Data_Model->spy_time_by_coords($x1,$x2,$y1,$y2);

    $to_position = $this->Data_Model->get_position(14, $this->Data_Model->temp_towns_db[$param1]);
    $to_text = 'pos'.$to_position.'_level';
    $to_level = ($to_position > 0) ? $this->Data_Model->temp_towns_db[$param1]->$to_text : 0;
    $risk = $this->Data_Model->spy_risk_by_mission(1)+(5*$this->Data_Model->temp_towns_db[$param1]->spyes)+(2*$to_level)-(2*$this->Data_Model->temp_towns_db[$param1]->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 5) ? 5 : $risk;
?>
    
    <form  action="<?=$this->config->item('base_url')?>actions/spyes/send/<?=$this->Island_Model->island->id?>/<?=$param1?>/"  method="POST">
        <div class="contentBox01h" id="sendSpy">
            <h3 class="header">Gửi điệp viên</h3>
            <div class="content">
                <p class="desc">Điệp viên của bạn sẽ cố đột nhập vào <?=$this->Data_Model->temp_towns_db[$param1]->name?>. <?=$this->Data_Model->temp_towns_db[$param1]->name?> là một thành phố cấp độ 3. Sẽ dẽ dàng hơn cho một điệp viên khi trà trộn vào một thành phố lớn, vì nhiều người qua lại khiến cho điệp viên khó lòng bị phát hiện ra.							</p>
		<div class="costs"><span class="textLabel">Chi phí:: </span>30</div>
                <div class="risk"><span class="textLabel">Nguy ngại trong thám hiểm:</span>
                    <div title="Риск разоблачения <?=$risk?>%" class="statusBar">
                        <div style="width: <?=$risk?>%" class="bar"></div>
                    </div>
                    <div class="percentage"><?=$risk?>%</div>
                </div>
                <hr>
                <div id="missionSummary">
                    <div class="common">
                        <div class="journeyTarget" title="Thành phố đích"><span class="textLabel">Thành phố đích: </span><?=$this->Data_Model->temp_towns_db[$param1]->name?></div>
                        <div class="journeyTime" title="Thời gian di chuyển"><span class="textLabel">Thời gian di chuyển: </span><?=format_time($time)?></div>
                    </div>
                </div>
                <div class="centerButton">
                    <input id="submit" class="button" type="submit" value="Gửi điệp viên">
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </form>
</div>