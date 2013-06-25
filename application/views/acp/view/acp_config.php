<div id="mainview">
    <div class="buildingDescription">
        <h1><?php echo $this->lang->line('config_title');?></h1>
        <p><?php echo $this->lang->line('config_description');?></p>
    </div>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel"><?php echo $this->lang->line('config_server_name');?></span></h3>
        <div class="content">
            <form method="post" action="<?php echo base_url('acp/config');?>">
				<table cellpadding="0" cellspacing="0">
                    <tbody>
		                <tr>
					        <th><?php echo $this->lang->line('config_game_name');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="game_name" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('game_name');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_game_speed');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="game_speed" class="textfield" type="text" maxlength="5" value="<?php echo getConfig('game_speed');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_admin_email');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="admin_email" class="textfield" type="text" maxlength="15" value="<?php echo getConfig('admin_email');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_board_link');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="board_url" class="textfield" type="text" maxlength="50" value="<?php echo getConfig('board_link');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_head_news');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="head_news" class="textfield" type="text" maxlength="30" value="<?php echo getConfig('head_news');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_easter_design');?>:</th>
						    <th><input type="radio" name="easter_design" value="1" <?php if(getConfig('easter_design') == '1') {?>checked="checked"<?php } ?>>Si <input type="radio" name="easter_design" <?php if(getConfig('easter_design') == '0') {?>checked="checked"<?php } ?>value="0">No</th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_double_login');?>:</th>
						    <th><input type="radio" name="double_login" value="1" <?php if(getConfig('double_login') == '1') {?>checked="checked"<?php } ?>>Si <input type="radio" name="double_login" <?php if(getConfig('double_login') == '0') {?>checked="checked"<?php } ?>value="0">No</th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_standard_capacity');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="standard_capacity" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('standard_capacity');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_transport_capacity');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="transport_capacity" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('transport_capacity');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_town_queue_size');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="town_queue_size" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('town_queue_size');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_army_queue_size');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="army_queue_size" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('army_queue_size');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_notes_default');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="notes_default" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('notes_default');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_notes_premium');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="notes_premium" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('notes_premium');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_trade_route_time');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="trade_route_time" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('trade_route_time');?>"></th>
					    </tr>
						<tr>
					        <th><?php echo $this->lang->line('config_research_rate');?>:</th>
						    <th><input autocomplete="off" id="inputScientists" name="research_rate" class="textfield" type="text" maxlength="10" value="<?php echo getConfig('research_rate');?>"></th>
					    </tr>
                    </tbody>
		        </table>
				<div class="centerButton">
                    <input type="submit" class="button" value="<?php echo $this->lang->line('config_send_button');?>">
                </div>
			</form>
        </div>
        <div class="footer"></div>
    </div>        
</div>