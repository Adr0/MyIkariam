<div id="mainview">
<?include_once('building_description.php')?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Thành phố trong thể chế của bạn</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="table01">
                <thead>
                    <tr>
                        <th class="crown"></th>
                        <th>Thành phố</th>
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
                        <td><?if($town->id == $this->Player_Model->capital_id){?><img src="<?=$this->config->item('style_url')?>skin/layout/crown.gif" width="20" height="20" alt="Thủ đô" title="Thủ đô"><?}?></td>
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
<?if($param2 == 'upgrade'){?>
<div class="contentBox01h" id="moveCapitalConfirmation">
    <h3 class="header"><span class="textLabel">Vui lòng xác nhận</span></h3>
    <div class="content">
        <p>Bạn thật sự muốn chọn <?=$this->Player_Model->now_town->name?> là thủ đô mới? Hãy nhớ: <ul><li> Dinh cơ chính phủ cũng sẽ được di dời sang cung điện mới.</li><li>Cấp độ cung điện <?=$this->Player_Model->levels[$this->Player_Model->capital_id][10]?> ở thủ đô cũ <?=$this->Player_Model->towns[$this->Player_Model->capital_id]->name?> sẽ bị <strong>phá hủy hoàn toàn</strong>! Bạn sẽ <strong>mất toàn bộ tài nguyên</strong>! Phí tổn công trình sẽ mất sạch!</li><ul></p>
            <div class="centerButton">
                <a href="<?=$this->config->item('base_url')?>actions/changeCapital/<?=$this->Player_Model->now_town->id?>/" class="button">Xác nhận</a>
            </div>
    </div>
    <div class="footer"></div>
</div>
<?}else{?>
<div class="contentBox01h" id="moveCapital">
    <h3 class="header"><span class="textLabel">Định lại vị trí thủ đô</span></h3>
    <div class="content">
        <p>Bạn có thể tuyên bố thuộc địa này là <strong>thủ đô</strong>. của bạn. Bằng cách này, dinh thự thống đốc được chuyển đổi thành một  <strong>cung điện cùng cấp</strong> và do đó thị trấn này sẽ trở thành thủ đô của đế chế bạn. Tuy nhiên, cung điện trong thủ đô cũ của bạn sẽ được <strong>phá hủy hoàn toàn</strong> - do đó bạn sẽ phải thiết lập lại pháp luật và trật tự do việc xây dựng một chính phủ mới !</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/palaceColony/upgrade/" class="button">Chọn thành phố là thủ đô của bạn</a>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?}?>
</div>
