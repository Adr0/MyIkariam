<div id="mainview">
    <div class="buildingDescription">
        <h1>Quân sự</h1>
        <p></p>
    </div>
    <div class="yui-navset">
        <ul class="yui-nav">
            <li class="selected"><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorMilitaryMovements/" title="Перемещения войск"><em>Hành quân (<?=$this->Player_Model->fleets?>)</em></a></li>
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorCombatReports/" title="Боевые доклады"><em>Báo cáo chiến sự (0)</em></a></li>
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorCombatReportsArchive/" title="Архив"><em>Lưu trữ</em></a></li>
        </ul>
    </div>
    <div id="combatsInProgress" class="contentBox">
        <h3 class="header">Sự kiện hiện tại</h3>
        <div class="content">
            <ul>
            </ul>
        </div>
        <div class="footer"></div>
    </div>
    <div id="fleetMovements" class="contentBox">
        <h3 class="header"><span class="textLabel">Di chuyển của Chiến hạm / Quân đội</span></h3>
        <div class="content">
            <table width="100%" cellpadding="0" cellspacing="0" class="locationEvents">
                <tr style="font-weight: bold; background-color: #faeac6; background-repeat: repeat-x;">
                    <td style="background-repeat: repeat-x; width: 35px; padding: 0"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 150px;">	Quân lính</td>
                    <td>Xuất xứ</td>
                    <td colspan="3" style="width: 80px; text-align: center;">Nhiệm vụ</td>
                    <td>Mục tiêu</td>
                    <td style="width: 42px">Hành động</td>
                </tr>
<?php 
$mission_id = 0;
if(isset($this->Player_Model->missions) && SizeOf($this->Player_Model->missions) > 0)
foreach($this->Player_Model->missions as $mission){

    $all_resources = $mission->wood+$mission->wine+$mission->marble+$mission->crystal+$mission->sulfur+$mission->peoples;
    require(APPPATH.'models/mission_data.php');
    if($mission->user == $this->Player_Model->user->id or ($mission->return_start == 0 and $mission->user != $this->Player_Model->user->id)){?>
	<tr  <?if (($mission_id % 2) == 1){?>class='alt'<?}?>>
            <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_time.gif" /></td>
            <td id="fleetRow<?=$mission->id?>" title="Thời gian đến">
                        <?if ($mission->mission_start == 0){?>
                            Đang nạp
                        <?}else{?>
                            <?if($mission_end > 0 and $mission->return_start == 0){?>
                                <?=format_time($mission_end)?>
                            <?}elseif($mission_end == 0 and $mission->return_start > 0){?>
                                <?if($mission->return_start == 0){?>
                                    Đang nạp
                                <?}?>
                            <?}elseif($mission->loading_to_start == 0 and $mission->return_start> 0){?>
                                <?if($mission->loading_to_start > 0){?>
                                    <?=format_time($loading_end + $time)?>
                                <?}elseif($mission->mission_start == 0){?>
                                    <?=format_time($return_end)?>
                                <?}?>
                            <?}?>
                        <?}?>
            </td>
            <td title="Tàu thuyền" style="cursor: pointer" onMouseOut="this.firstChild.nextSibling.style.display = 'none'" onMouseOver="this.firstChild.nextSibling.style.display = 'block'"><?=$mission->ship_transport?> Tàu thuyền
                <div class="tooltip2" style="z-index: 2000">
                    <h5>Hạm đội/Quân lính/Hàng hóa</h5>
                    <div class="unitBox" title="Tàu chở hàng">
                        <div class="icon">
                            <img src="<?=$this->config->item('style_url')?>skin/characters/fleet/40x40/ship_transport_r_40x40.gif">
                        </div>
                        <div class="count"><?=$mission->ship_transport?></div>
                    </div>
                    <?if($mission->wood > 0){?>
                    <div class="unitBox" title="Vật liệu xây dựng">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif">
                        </div>
                        <div class="count"><?=number_format($mission->wood)?></div>
                    </div>
                    <?}?>
                    <?if($mission->wine > 0){?>
                    <div class="unitBox" title="Rượu">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif">
                        </div>
                        <div class="count"><?=number_format($mission->wine)?></div>
                    </div>
                    <?}?>
                    <?if($mission->marble > 0){?>
                    <div class="unitBox" title="Cẩm thạch">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif">
                        </div>
                        <div class="count"><?=number_format($mission->marble)?></div>
                    </div>
                    <?}?>
                    <?if($mission->crystal > 0){?>
                    <div class="unitBox" title="Pha lê">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif">
                        </div>
                        <div class="count"><?=number_format($mission->crystal)?></div>
                    </div>
                    <?}?>
                    <?if($mission->sulfur > 0){?>
                    <div class="unitBox" title="Lưu huỳnh">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif">
                        </div>
                        <div class="count"><?=number_format($mission->sulfur)?></div>
                    </div>
                    <?}?>
                    <?if($mission->peoples > 0){?>
                    <div class="unitBox" title="Người dân">
                        <div class="iconSmall">
                            <img src="<?=$this->config->item('style_url')?>skin/resources/icon_citizen.gif">
                        </div>
                        <div class="count"><?=number_format($mission->peoples)?></div>
                    </div>
                    <?}?>
                </div>
            </td>
            <td title="Xuất xứ"><a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Data_Model->temp_towns_db[$mission->from]->island?>/<?=$this->Data_Model->temp_towns_db[$mission->from]->id?>/"><?=$this->Data_Model->temp_towns_db[$mission->from]->name?></a> (<?=$this->Data_Model->temp_user_db[$this->Data_Model->temp_towns_db[$mission->from]->user]->login?>)</td>
            <td style='width: 12px; padding-left: 0px; padding-right: 0px'>
<?if($mission->return_start > 0){?>
                <img style="padding-bottom: 5px;" src="<?=$this->config->item('style_url')?>skin/interface/arrow_left_green.gif">
<?}?>
            </td>
            <td style="text-align: center; width: 35px" title="<?=$this->Data_Model->mission_name_by_type($mission->mission_type)?>  <?if($mission->return_start == 0){?><?if($mission->mission_start > 0 and $loading_end > 0){?>(Đang tiến hành)<?}else{?>(Đang tải)<?}?><?}else{?><?if($mission->percent < 1){?>(Huỷ)<?}else{?>(Trở lại)<?}}?>">
<?if($mission->mission_type <=2){?>
                <img src="<?=$this->config->item('style_url')?>skin/interface/mission_transport.gif">
<?}elseif($mission->mission_type > 2 and $mission->mission_type <= 4){?>
                <img src="<?=$this->config->item('style_url')?>skin/interface/mission_trade.gif">
<?}?>
            </td>
            <td style='width: 12px; padding-left: 0px; padding-right: 0px'>
<?if($mission->return_start == 0 and $mission->mission_start > 0 and $loading_end > 0){?>
                <img style="padding-bottom: 5px;" src="<?=$this->config->item('style_url')?>skin/interface/arrow_right_green.gif">
<?}?>
            </td>
            <td title="Mục tiêu"><a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Data_Model->temp_towns_db[$mission->to]->island?>/<?=$this->Data_Model->temp_towns_db[$mission->to]->id?>/"><?=$this->Data_Model->temp_towns_db[$mission->to]->name?></a> (<?=$this->Data_Model->temp_user_db[$this->Data_Model->temp_towns_db[$mission->to]->user]->login?>)</td>
            <td title="Hành động" style="text-align: center; ">
<?if($mission->return_start == 0 and $mission->user == $this->Player_Model->user->id){?>
                <a href="<?=$this->config->item('base_url')?>actions/abortFleet/<?=$mission->id?>/0/militaryAdvisorMilitaryMovements/">
                    <img title="Rút!" src="<?=$this->config->item('style_url')?>skin/interface/btn_abort.gif">
                </a>
<?}else{?>-<?}?>
            </td>
        </tr>

<?if($mission->mission_start > 0 and $mission->return_start == 0 and $mission->loading_to_start == 0){?>
        <script type="text/javascript">
            Event.onDOMReady(function() {
                getCountdown({enddate: <?=time()+$mission_end?>, currentdate: <?=time()?>, el: "fleetRow<?=$mission->id?>"});
            })
        </script>
<?}elseif($mission->return_start > 0){?>
        <script type="text/javascript">
            Event.onDOMReady(function() {
                getCountdown({enddate: <?=time()+$return_end?>, currentdate: <?=time()?>, el: "fleetRow<?=$mission->id?>"});
            })
        </script>
<?}elseif($mission->mission_start > 0){?>
<?if($mission->return_start > 0){?>
        <script type="text/javascript">
            Event.onDOMReady(function() {
                getCountdown({enddate: <?=time()+$loading_end+$time?>, currentdate: <?=time()?>, el: "fleetRow<?=$mission->id?>"});
            })
        </script>
<?}else{?>
        <script type="text/javascript">
            Event.onDOMReady(function() {
                getCountdown({enddate: <?=time()+$loading_end?>, currentdate: <?=time()?>, el: "fleetRow<?=$mission->id?>"});
            })
        </script>
<?}?>
<?}}?>
<?$mission_id++?>
<?}?>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>