<div id="mainview">
    <h1><?=$this->lang->line('game_top')?></h1>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel"><?=$this->lang->line('game_top')?></span></h3>
        <div class="content">
<table class="table01">
             <tr>
                <th width="15%"><?=$this->lang->line('position')?></th>
                <th width="30%">Nome Alleanza</th>
                <th width="15%">Punti</th>
                <th width="20%">Media Punti</th>
                <th width="20%"><?=$this->lang->line('actions')?></th>
            </tr>
	</div>
   
<?$i = 1;?>
<?$null_user = array()?>

<?foreach ($param1->result() as $ally){?>
            <tr class="<?if(!fmod($i,2)){?>alt<?}?><?if($param3['offset']==0){?><?if($i==1){?> first<?}?><?if($i==2){?> second<?}?><?if($i==3){?> third<?}?><?}?><?if($param2==$this->Player_Model->user->id){?> own<?}?>">
                    <td class="place"><?=$i?></td>
    	            <td class="name"><?=$ally->ally_name?></td>
	            <td class="allytag"></td>
	            <td class="score">
<?switch($param3['highscoreType']){?>
<?case 'score': echo number_format($user->points); break;?>
<?case 'building_score_main': echo number_format($user->points_buildings); break;?>
<?case 'building_score_secondary': echo number_format($user->points_levels); break;?>
<?case 'research_score_main': echo number_format($user->points_research); break;?>
<?case 'research_score_secondary': echo number_format($user->points_complete); break;?>
<?case 'army_score_main': echo number_format($user->points_army); break;?>
<?case 'trader_score_secondary': echo number_format($user->points_gold); break;?>

<?}?>
                    </td>
	            <td class="action"><?if($ally->ally_id!=$param2){?><a title="<?=$this->lang->line('create_message')?>" href="<?=$this->config->item('base_url')?>game/sendIKMessage/<?=$param3?>/"><img src="<?=$this->config->item('style_url')?>skin/interface/icon_message_write.gif" alt="<?=$this->lang->line('create_message')?>"> </a><?}?></td>
	    </tr>
<?$i++?>
<?}?>
           </table>
        </div>

        <div class="contentBox01h"><div class="content"><p>
                    </p>
        </div></div>

        <div class="footer"></div>
    </div>
</div>

