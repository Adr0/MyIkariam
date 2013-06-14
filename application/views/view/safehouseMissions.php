<?$spy = $this->Player_Model->spyes[$this->Player_Model->town_id][$param1]?>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Các nhiệm vụ</h1>
        <p>Gửi bản phân công cho điệp viên</p>
    </div>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Chọn nhiệm vụ cho điệp viên ở <?=$this->Data_Model->temp_towns_db[$spy->to]->name?></span></h3>
        <div class="content" style="position:relative">
            <div class="percentage"><?=$spy->risk?>%</div>
            <h4><span class="textLabel">Nguy cơ điệp viên bị phát hiện hiện thời:</span></h4>
            <div class="missionText">
                <div title="Nguy hiểm разоблачения: <?=$spy->risk?>%" class="statusBar">
                    <div style="width: <?=$spy->risk?>%;" class="bar"></div>
                </div>
            </div>
            <ul id="missionlist">
<?
    $town = $this->Data_Model->temp_towns_db[$spy->to];
    $to_position = $this->Data_Model->get_position(14, $town);
    $to_text = 'pos'.$to_position.'_level';
    $to_level = ($to_position > 0) ? $town->$to_text : 0;
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(3);
?>
                <li class="gold">
                    <div title="Tên nhiệm vụ" class="missionType">Điều tra hầm kho báu</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Không dễ dàng để mạo hiểm đột nhập vào hầm kho báu của thành phố. Nhưng khi hoàn thành nhiệm vụ và trở ra được, ta sẽ biết hầm chứa bao nhiêu vàng.                     </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">45</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="3" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/3/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(4);
?>
            	<li class="resources">
                    <div title="Tên nhiệm vụ" class="missionType">Xem xét kho hàng</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Ta có thể phát hiện được có bao nhiêu nguồn tài nguyên bằng cách xem xét kho hàng trong thành phố. Ngoài ra, ta cũng có thể biết được từ phí tổn trả cho một cuộc tấn công.                     </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí</strong>
 	                	<span class="textLabel">Vàng: </span><span class="gold">75</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong><?=$risk?>%</div>
                    <div title="4" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/4/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(5);
?>

                <li class="research">
                    <div title="Tên nhiệm vụ" class="missionType">Điều tra cấp độ nghiên cứu</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Điệp viên của ta sở hữu trí thông minh như một nhà khoa học. Đó là lý do tại sao hắn có thể phát hiện và theo dõi tiến độ của một công trình nghiên cứu trong thành phố.                     </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">90</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="5" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/5/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(6);
?>

                <li class="online">
                    <div title="Tên nhiệm vụ" class="missionType">Tình trạng trực tuyến</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Với một tí may mắn, ta có phát hiện ra hiện thời tên thủ lĩnh có đang để ý đến người dân của hắn hay không.                     </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">240</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="6" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/6/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(7);
?>

            	<li class="garrison">
                    <div title="Tên nhiệm vụ" class="missionType">Điều tra doanh trại</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Nếu ta nấp ở một nơi trong khi kèn gọi quân điểm danh buổi sáng, ta có thể biết được bao nhiêu binh lính đóng quân tại đơn vị này. Nhờ thế ta có thể lập kế hoạch tấn công hiệu quả hơn!                    </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">150</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="7" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/7/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(8);
?>

            	<li class="fleet">
                    <div title="Tên nhiệm vụ" class="missionType">Theo dõi di chuyển của quân đội và các hạm đội hải quân</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Nếu ta để ý kỹ cổng thành và các cảng khác, ta sẽ phát hiện ra người dân thành phố đang lệ thuộc vào điều gì, họ chiến đấu cho ai và ai là người giao dịch với họ.                   </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">750</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="8" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/8/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
<?
    $risk = (5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$this->Player_Model->town_id][14]);
    $risk = ($risk < 0) ? 0 : $risk;
    $risk = $risk + $spy->risk + $this->Data_Model->spy_risk_by_mission(9);
?>

                <li class="message">
                    <div title="Tên nhiệm vụ" class="missionType">Theo dõi tình hình liên lạc</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Nếu điệp viên của chúng ta giả dạng thành một người đưa tin, anh ta có thể báo cáo lại mục tiêu của ta đang bắt liên lạc hay giao dịch với ai!                   </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">360</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> <?=$risk?>%</div>
                    <div title="9" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/9/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>

                <li class="retreat">
                    <div title="Tên nhiệm vụ" class="missionType">Triệu hồi điệp viên</div>
                    <div title="Mô tả nhiệm vụ" class="missionDesc">Ta có thể triệu hồi điệp viên bất cứ lúc nào, sẽ không gây báo động trong thành phố.                     </div>
                    <div title="Chi phí cho nhiệm vụ này" class="missionCosts"><strong>Chi phí:</strong>
                    	<span class="textLabel">Vàng: </span><span class="gold">0</span>
                    </div>
                    <div title="Nguy ngại trong nhiệm vụ này" class="missionRisk"><strong>Nguy hiểm:</strong> 0%</div>
                    <div title="10" class="missionStart">
                        <div class="centerButton">
                            <a class="button" href="<?=$this->config->item('base_url')?>actions/espionage/<?=$spy->from?>/<?=$spy->id?>/10/">Bắt đầu nhiệm vụ</a>
                        </div>
                    </div>
                </li>
            </ul>
    </div>     	<div class="footer"></div>
  </div></div>