<div id="mainview">
    <div class="buildingDescription">
        <h1>Thành tựu nghiên cứu trước đây</h1>
        <p>Tất cả những công trình nghiên cứu từ trước đến nay của ta đã được lưu giữ lại tại Thư viên. Những người khách viếng thăm có hứng thú có thể bỏ chút thời gian để tìm hiểu rõ hơn về những nghiên cứu của ta.</p>
    </div>

    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Thành tựu nghiên cứu từ trước đến nay</span></h3>
        <div class="content">
            <h4>Hải dương học</h4>
            <ul>
<?php for($i = 1; $i <= 14; $i++){?>
<?$research = $this->Data_Model->get_research(1, $i, $this->Player_Model->research)?>
<?$res_text = 'res1_'.$i?>
                <li class="<?if($this->Player_Model->research->$res_text == 0){?>un<?}?>explored">
                    <a href="<?=$this->config->item('base_url')?>game/researchDetail/1/<?=$i?>/" title="<?=$research['name']?>"><?=$research['name']?></a>
                </li>
<?}?>
            </ul>
            <br><hr>
            <h4>Kinh tế</h4>
            <ul>
<?for($i = 1; $i <= 15; $i++){?>
<?$research = $this->Data_Model->get_research(2, $i, $this->Player_Model->research)?>
<?$res_text = 'res2_'.$i?>
                <li class="<?if($this->Player_Model->research->$res_text == 0){?>un<?}?>explored">
                    <a href="<?=$this->config->item('base_url')?>game/researchDetail/2/<?=$i?>/" title="<?=$research['name']?>"><?=$research['name']?></a>
                </li>
<?}?>
            </ul>
            <br><hr>
            <h4>Khoa học</h4>
            <ul>
<?for($i = 1; $i <= 16; $i++){?>
<?$research = $this->Data_Model->get_research(3, $i, $this->Player_Model->research)?>
<?$res_text = 'res3_'.$i?>
                <li class="<?if($this->Player_Model->research->$res_text == 0){?>un<?}?>explored">
                    <a href="<?=$this->config->item('base_url')?>game/researchDetail/3/<?=$i?>/" title="<?=$research['name']?>"><?=$research['name']?></a>
                </li>
<?}?>
            </ul>
            <br><hr>
            <h4>Quân sự</h4>
            <ul>
<?for($i = 1; $i <= 14; $i++){?>
<?$research = $this->Data_Model->get_research(4, $i, $this->Player_Model->research)?>
<?$res_text = 'res4_'.$i?>
                <li class="<?if($this->Player_Model->research->$res_text == 0){?>un<?}?>explored">
                    <a href="<?=$this->config->item('base_url')?>game/researchDetail/4/<?=$i?>/" title="<?=$research['name']?>"><?=$research['name']?></a>
                </li>
<?}?>
            </ul>
						
        </div>
        <div class="footer"></div>
    </div>
</div>