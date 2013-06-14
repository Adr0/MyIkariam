<div id="information" class="dynamic"></div>
<div id="mainview">
    <div class="buildingDescription">
        <h1><?=$this->lang->line('error')?></h1>
    </div>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel"><?=$this->lang->line('error_message')?></span></h3>
        <div class="content">
            <!--<ul class="error">
            </ul>-->
            <!--<p><br><center><?if($param1){?><?=$param1?><?}elseif($this->session->flashdata('game_error') != ''){?><?=$this->session->flashdata('game_error')?><?}else{?><?=$this->lang->line('page_not_found')?><?}?></center></p>-->
            <p><br><center><?if($param1 != ''){?><?=$param1?><?}else{?><?=$this->lang->line('page_not_found')?><?}?></center></p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/" class="button">Ritorna alla citt&agrave;</a>
        </div>
		</div>
        <div class="footer"></div>
    </div>
    <br><br>
</div> 