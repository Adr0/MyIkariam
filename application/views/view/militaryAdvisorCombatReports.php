<div id="mainview">
    <div class="buildingDescription">
        <h1>Army</h1>
        <p></p>
    </div>
	<div class="yui-navset">
        <ul class="yui-nav">
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorMilitaryMovements/" title="Перемещения войск"><em>Hành quân (<?=$this->Player_Model->fleets?>)</em></a></li>
            <li class="selected"><a href="<?php echo $this->config->item('base_url');?>game/militaryAdvisorCombatReports/" title="Боевые доклады"><em>Báo cáo chiến sự (<?php echo $this->Player_Model->reports_count;?>)</em></a></li>
            <li><a href="<?=$this->config->item('base_url')?>game/militaryAdvisorCombatReportsArchive/" title="Архив"><em>Lưu trữ</em></a></li>
        </ul>
    </div>
    <div id="troopsOverview">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Combat Reports</span></h3>
			<div class="content">
                <?php if ($this->Player_Model->reports) {
				      foreach ($this->Player_Model->reports->result() as $row)
                      {
			    ?>
				<form method="post" id="finishedReports" action="<?php echo base_url();?>actions/modifyCombatReport/">
                <input type="hidden" name="start" value="0">
                    <table cellpadding="0" cellspacing="0" class="operations">
                        <tbody>
						    <tr>
                                <td class="empty"></td>
                                <td><input type="checkbox" name="combatId[<?php echo $row->id;?>]" value="1"></td>
                                <td class="date"><?php echo date("d.m.Y G:i",$row->date);?></td>
                                <td class="subject won"> <!-- or lost -->
                                    <a href="<?php echo base_url();?>game/militaryAdvisorReportView/<?php echo $row->id;?>" title="TODO">TODO</a>
                                </td>
                                <td class="empty"></td>
                            </tr>
                        
                    <?php } ?>
                        <tr>
                            <td class="empty"></td>
                            <td colspan="2" class="all"><a href="javascript:markAll('checked');">Tutto</a></td>
                        </tr>
                        <tr>
                            <td class="empty"></td>
                            <td colspan="2" class="all"><a href="javascript:markAll('reverse');">Inverti Selezione</a></td>
                        </tr>
                        <tr>
                            <td class="empty"></td>
                            <td colspan="2" class="selection">
                                <select id="command" size="1" name="command">
                                    <option value="">Scegli azione...</option>
                                    <option value="delete">Cancella</option>
                                    <option value="mark">segna come letto</option>
                                </select>
                            </td>
                            <td class="go"><input type="submit" value="Ok" class="button"></td>
                            <td class="empty"></td>
                        </tr>
                    </tbody></table>
                </form>
                <script type="text/javascript">
                function markAll(command) {
                    var allInputs = document.getElementById('finishedReports').getElementsByTagName('input');
                    for (var i=0; i<allInputs.length; i++) {
                        if (allInputs[i].getAttribute('type') == "checkbox") {
                            if (command == 'checked') {
                                allInputs[i].checked = true;
                            }
                            if (command == 'reverse') {
                                if (allInputs[i].checked == true) {
                                    allInputs[i].checked = false;
                                } else {
                                    allInputs[i].checked = true;
                                }
                            }
                        }
                    }
                }
                </script>
				<?php } else { ?>
				<div class="content"><p style="text-align: center;">Non ci sono rapporti di combattimento</p></div>
			    <?php } ?>
			</div>
            <div class="footer"></div>
        </div>
    </div>
</div>