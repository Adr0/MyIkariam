<div id="mainview">
    <div class="buildingDescription">
        <h1><?php echo $this->lang->line('dashboard_title');?></h1>
        <p><?php echo $this->lang->line('dashboard_description');?></p>
    </div>
	<div class="militaryAdvisorTabs">
        <table cellpadding="0" cellspacing="0" id="tabz">
            <tbody>
			    <tr>
                    <td><a title="<?php echo $this->lang->line('news');?>" href="<?php echo base_url('acp/');?>"><em><?php echo $this->lang->line('news');?></em></a></td>
                    <td class="selected"><a title="<?php echo $this->lang->line('updates');?>" href="<?php echo base_url('acp/updates');?>"><em><?php echo $this->lang->line('updates');?></em></a></td>
					<td><a title="<?php echo $this->lang->line('credits');?>" href="<?php echo base_url('acp/credits');?>"><em><?php echo $this->lang->line('credits');?></em></a></td>
                </tr>
            </tbody>
		</table>
    </div>
    <div class="yui-navset yui-navset-top" id="demo">
        <div class="yui-content">
            <div id="tab1" style="display: block;">
                <div class="contentBox01h">
                    <h3 class="header"><span class="textLabel"><?php echo $this->lang->line('updates');?></span></h3>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
							    <tr>
								    <th colspan="2">Non ci sono aggiornamenti</th>
								</tr>
								<tr>
								    <th>Versione attuale: <?php echo getConfig('game_version');?></th>
									<th>Ultima versione stabile: 0.0.2</th>
								</tr>
                            </tbody>
						</table>
                    </div>
                    <div class="footer"></div>
                </div>
            </div>
        </div>
        <ul class="yui-nav"></ul>
	</div>

    <script type="text/javascript">
    var tabView = new YAHOO.widget.TabView('demo');
    </script>
</div>