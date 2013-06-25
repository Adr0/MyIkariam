<?php
        $config['base_url'] = $this->config->item('base_url').'game/version/';
        $config['total_rows'] = SizeOf($param1);
        $config['per_page'] = '4';
        $config['num_links'] = 3;
        $config['next_link'] = '<img src="'.$this->config->item('style_url').'skin/img/resource/btn_max.png" title="След. 4">';
        $config['last_link'] = '<img src="'.$this->config->item('style_url').'skin/img/resource/btn_max.png" title="В Конец">';
        $config['prev_link'] = '<img src="'.$this->config->item('style_url').'skin/img/resource/btn_min.png" title="Пред. 4">';
        $config['first_link'] = '<img src="'.$this->config->item('style_url').'skin/img/resource/btn_min.png" title="В Начало">';
        $this->pagination->initialize($config);
?>
<head>
<style type="text/css">
#version #container #mainview .table01 td.desc {text-align:left}
#version #container #mainview .table01 td.version{vertical-align:top}
#version #container #mainview .table01{width:660px}
#version #container #mainview li{padding-bottom:10px}
#version #container #mainview li li{list-style:circle outside;padding-bottom:0}
#version #container #mainview ul ul{margin-left:16px;padding-left:0;font-size:0.8em}
</style>

</head>
<div id="mainview">
    <h1>ChangeLog</h1>
    <table cellpadding="0" cellspacing="0" class="table01">
        <tr>
            <th><?php echo lang('version');?></th>
            <th><?php echo lang('date');?></th>
            <th><?php echo lang('description');?></th>
        </tr>
        <?php foreach($param1 as $value){?>
		<tr>
            <td class="version"><?php echo $value['number'];?></td>
            <td class="version"><?php echo $value['date'];?></td>
            <td class="desc">
			    <ul>
                    <?php foreach($value['text'] as $text) {?>
					<li><?php echo $text;?></li>					
					<?php  } ?>
                </ul>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>