<div id="mainview">
    <div class="buildingDescription">
        <h1>Cố vấn nghiên cứu</h1>
        <p></p>
    </div>
    <div class="contentBox01h" id="currentResearch">
        <h3 class="header"><span class="textLabel">Công trình nghiên cứu hiện tại</span></h3>
        <div class="content">
            <ul class="researchTypes">
<?php for ($way = 1; $way <= 4; $way++){?>
                <li class="researchType ">
                    <div class="researchInfo" style="width:100px; min-height:120px;">
                        <h4><a href="<?php echo $this->config->item('base_url');?>game/researchDetail/1/<?=$this->Player_Model->ways[$way]['id']?>/"><?=$this->Player_Model->ways[$way]['name']?></a></h4>
                        <div class="leftBranch">
<?php switch($way){
case 1:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchSeafaring.jpg">
<?break;?>
<?case 2:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchEconomy.jpg">
<?break;?>
<?case 3:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchKnowledge.jpg">
<?break;?>
<?case 4:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchMilitary.jpg">
<?break;?>
<?}?>
                            <div class="researchTypeLabel">
                                <div class="unitcount">
                                    <span class="textLabel">
                                        <span class="before"></span>
<?switch($way){?>
<?case 1:?>
Hải dương học
<?break;?>
<?case 2:?>
Kinh tế
<?break;?>
<?case 3:?>
Наука
<?break;?>
<?case 4:?>
Khoa học
<?break;?>
<?}?>
                                        <span class="after"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p><?=$this->Player_Model->ways[$way]['desc']?></p>
<?if ($this->Player_Model->ways[$way]['need_id'] > 0){?>
<?$need = $this->Data_Model->get_research($this->Player_Model->ways[$way]['need_way'],$this->Player_Model->ways[$way]['need_id'],$this->Player_Model->research)?>
                        <div class="researchButton2">
                        Ít nhất một yêu cầu chưa được nghiên cứu (công trình có thể tiếp theo: <a href="<?=$this->config->item('base_url')?>game/researchDetail/<?=$this->Player_Model->ways[$way]['need_way']?>/<?=$this->Player_Model->ways[$way]['need_id']?>/"><?=$need['name']?></a>)
                        </div>
<?php }else{
if($this->Player_Model->ways[$way]['points'] > $this->Player_Model->research->points){
    $this->db->set('way'.$way.'_checked', 0);
    $this->db->where(array('user' => $this->Player_Model->user->id));
    $this->db->update($this->session->userdata('universe').'_research');
?>
                        <div class="researchButton2">
                        Không đủ điểm nghiên cứu.
                        </div>
                        <div class="costs">
                            <h5>Chi phí:</h5>
                            <ul class="resources">
                                <li class="researchPoints"><?=number_format($this->Player_Model->ways[$way]['points'])?></li>
                            </ul>
                        </div>
<?php }else{

    $this->db->set('way'.$way.'_checked', time());
    $this->db->where(array('user' => $this->Player_Model->user->id));
    $this->db->update($this->session->userdata('universe').'_research');
?>
                        <div class="researchButton">
                            <a class="button build" style="padding-left:3px;padding-right:3px;"  href="<?=$this->config->item('base_url')?>actions/doResearch/<?=$way?>/<?=$this->Player_Model->ways[$way]['id']?>/">
                                <span class="textLabel">Nghiên cứu</span>
                            </a>			
                        </div>			
                        <div class="costs">		
                            <h5>Chi phí:</h5>		
                            <ul class="resources">		
                                <li class="researchPoints"><?=number_format($this->Player_Model->ways[$way]['points'])?></li>
                            </ul>			
                        </div>
<?}?>
<?}?>
                    </div>
                </li>
<?}?>
			</ul>
        </div>
		<div class="footer"></div>
	</div>
</div>