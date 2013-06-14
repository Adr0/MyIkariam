<div id="backTo" class="dynamic">
    <h3 class="header">Quay lại</h3>
    <div class="content">
<?if(isset($this->Island_Model)){?>
        <a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Island_Model->island->id?>/" title="Trở lại hòn đảo">
<?}else{?>
        <a href="<?=$this->config->item('base_url')?>game/island/<?=$param2?>/" title="Trở lại hòn đảo">            
<?}?>
            <img src="<?=$this->config->item('style_url')?>skin/img/action_back.gif" width="160" height="100">
            <span class="textLabel">&lt;&lt; Trở lại hòn đảo</span></a>
    </div>
    <div class="footer"></div>
</div>