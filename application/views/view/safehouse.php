<div id="mainview">
<?include_once('building_description.php')?>
<div class="yui-navset">
    <ul class="yui-nav">
        <li <?if($param2!='reports' and $param2!='archive'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/safehouse/<?=$position?>/" title="Nơi ẩn náu"><em>Nơi ẩn náu</em></a></li>
        <li <?if($param2=='reports'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/safehouse/reports/" title="Các báo cáo hoạt động tình báo"><em>Các báo cáo hoạt động tình báo</em></a></li>
        <li <?if($param2=='archive'){?>class="selected"<?}?>><a href="<?=$this->config->item('base_url')?>game/safehouse/archive/"><em>Lưu trữ</em></a></li>
    </ul>
</div>
<?if($param2!='reports' and $param2!='archive'){?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Đào tạo điệp viên</span></h3>
        <div class="content">
            <ul id="units">
                <li class="unit">
                    <div class="unitinfo">
                        <h4>Đào tạo điệp viên</h4>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/spy_120x100.gif">
                        <p>Người công dân này rất cẩn trọng và trung thành - một ứng cử viên sáng giá để trở thành điệp viên. Thời gian đào tạo một điệp viên :</p>
                    </div>
                    <div class="forminput">
<?if($this->Player_Model->now_town->spyes_start == 0){?>
<?
    $build_pos = 0;
    if (SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]) > 0)
    foreach($this->Player_Model->build_line[$this->Player_Model->town_id] as $build_line)
    {
        if ($build_line['position'] == $position){ $build_pos = $position; }
    }
?>
<?if($build_pos > 0){?>
                        Công trình trong quá trình nâng cấp!
<?}else{?>
<?$all_spyes = SizeOf($this->Player_Model->spyes[$this->Player_Model->town_id])+$this->Player_Model->now_town->spyes?>
<?if(($this->Player_Model->levels[$this->Player_Model->town_id][14]-$all_spyes) > 0){?>
                        <div class="centerButton">
                            <a href="<?=$this->config->item('base_url')?>actions/spyes/buy/" class="button" title="Тренировать">Тренировать</a>
                        </div>
<?}else{?>
                        Đã đạt tối đa số điệp viên cho phép!
<?}}?>
<?}else{?>
                        Cơ sở đào tạo
<?}?>
                    </div>
                    <div class="costs">
                        <h5>Chi phí:</h5>
                        <ul class="resources">
                            <li class="gold"><span class="textLabel">Золото: </span>150</li>
                            <li class="glass"><span class="textLabel">Стройматериалы: </span>80</li>
                            <li class="time"><?=format_time($this->Data_Model->spyes_time_by_level($this->Player_Model->levels[$this->Player_Model->town_id][14]))?></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="footer"></div>
    </div>


<div class="contentBox01h">
  <h3 class="header"><span class="textLabel">Điệp viên đang thực thi nhiệm vụ</span></h3>
  <div class="content">

<?if (sizeOf($this->Player_Model->spyes[$this->Player_Model->town_id]) > 0){?>
<?foreach($this->Player_Model->spyes[$this->Player_Model->town_id] as $spy){?>

      <div class="spyinfo">
          <ul>
              <li title="Резиденция" class="city"><?=$this->Data_Model->temp_towns_db[$spy->to]->name?> (<?=$this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$spy->to]->island]->x?>,<?=$this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$spy->to]->island]->y?>)</li>
<?if($spy->mission_start > 0 and $spy->mission_type != 2){?>
              <li title="Tình trạng" class="status">Điệp viên đang làm việc</li>
<?}?>
              <li title="Tình trạng" class="status">
<?if($spy->mission_start > 0){?>
<?
    $x1 = $this->Player_Model->now_island->x;
    $x2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$spy->to]->island]->x;
    $y1 = $this->Player_Model->now_island->y;
    $y2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$spy->to]->island]->y;
    $time = $this->Data_Model->spy_time_by_coords($x1,$x2,$y1,$y2);
    $ostalos = $time - time() + $spy->mission_start;
?>
<script type="text/javascript">
    Event.onDOMReady(function() {
    getCountdown({
        enddate: <?=$spy->mission_start + $time?>,
        currentdate: <?=time()?>,
        el: "SpyCountDown<?=$spy->id?>"
    }, 3, " ", "", true, true);
});
</script>
<?}?>
                  <div  class="time">
                      <span class="textLabel"><?=$this->Data_Model->spy_mission_name_by_type($spy->mission_type)?></span>
<?if($spy->mission_start > 0){?>
                      <span id="SpyCountDown<?=$spy->id?>">
                          <?=format_time($ostalos)?>
                      </span>
<?}?>
                  </div>
              </li>
<?if($spy->mission_type != 2){?>
<?
if($spy->mission_type == 1){
                $town = $this->Data_Model->temp_towns_db[$spy->to];
                $to_position = $this->Data_Model->get_position(14, $town);
                $to_text = 'pos'.$to_position.'_level';
                $to_level = ($to_position > 0) ? $town->$to_text : 0;
                $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
                if ($risk < 0){ $risk = 0; }
                $risk = $risk + $this->Data_Model->spy_risk_by_mission($spy->mission_type) + $spy->risk;
}
else
{
                $risk = $spy->risk;
}
?>
              <li class="risk"><span class="textLabel">Nguy ngại trong thám hiểm</span>:<br>
                  <div class="statusBar">
                      <div style="width: <?=$risk?>%;" class="bar"></div>
                  </div>
                  <div class="percentage"><?=$risk?>%</div>
              </li>
<?}?>
          </ul>
<?if($spy->mission_start == 0){?>
          <div class="missionButton">
              <a title="Gửi bản phân công cho điệp viên" href="<?=$this->config->item('base_url')?>game/safehouseMissions/<?=$spy->id?>/">Nhiệm vụ</a>
          </div>
          <div class="missionAbort">
              <a title="Triệu tập điệp viên trở về thành phố" href="<?=$this->config->item('base_url')?>actions/spyes/return/<?=$spy->id?>/<?=$spy->from?>/">Hủy bỏ</a>
          </div>
<?}?>
      </div>
<?}?>
<?}else{?>
        <center><div style="padding:10px;">Không có điệp viên nào đang thi hành nhiệm vụ! </div></center>
<?}?>
      </div>
  <div class="footer"></div>
</div>
<?}?>
<?if($param2=='reports'){?>
    <div class="contentBox01">
        <h3 class="header"><span class="textLabel">Báo cáo của Điệp viên</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="spyMessages table01">                            
<?foreach($this->Player_Model->spyes_messages as $messages){?>
                <?$this->Data_Model->Load_Town($messages[0]->to)?>
                <tr><th colspan="3">Báo cáo của các điệp viên <?=$this->Data_Model->temp_towns_db[$messages[0]->to]->name?></th></tr>
<?foreach($messages as $message){?>
                <tr>
                    <td class="icon <?=spy_mission_icon($message->mission)?>"></td>
                    <td class="date"><?=date("d.m.Y G:i",$message->date)?></td>
                    <td class="subject"><?if($message->checked == 0){?><b><?}?><a title="<?=$message->desc?>" href="<?=$this->config->item('base_url')?>game/safehouseReports/<?=$message->id?>/"><?=$message->desc?></a><?if($message->checked == 0){?></b><?}?></td>
                </tr>
<?}?>
<?}?>
            </table>
        </div>
        <div class="footer"></div>
    </div> 
<?}?>
<?if($param2=='archive'){?>
<div id="troopsOverview">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Các báo cáo hoạt động tình báo</span></h3>
            <div class="content">
                <p style="text-align: center;">Không có hồ sơ nào</p>
            </div>
            <div class="footer"></div>
        </div>
    </div>
<?}?>
<br> 
</div>