<script>
classValuePerSatisfaction = new Array();
classNamePerSatisfaction = new Array();
classValuePerSatisfaction[0] = 300;
classNamePerSatisfaction[0] = 'ecstatic';
classValuePerSatisfaction[1] = 50;
classNamePerSatisfaction[1] = 'happy';
classValuePerSatisfaction[2] = 0;
classNamePerSatisfaction[2] = 'neutral';
classValuePerSatisfaction[3] = -50;
classNamePerSatisfaction[3] = 'sad';
classValuePerSatisfaction[4] = -1000;
classNamePerSatisfaction[4] = 'outraged';
satPerWine = new Array();
savedWine = new Array();
<?
    $level_text = 'pos'.$position.'_level';
    $level = $this->Player_Model->now_town->$level_text;
 ?>
<?for($i = 0; $i <= $level; $i++){?>
	satPerWine[<?=$i?>] = <?=$i*60?>;
	savedWine[<?=$i?>] = '&nbsp;';
<?}?>
</script>
<div id="mainview">
<?include_once('building_description.php')?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Phục vụ thức uống</span></h3>
        <div class="content">
            <form id="wineAssignForm" action="<?=$this->config->item('base_url')?>actions/tavern/<?=$position?>/" method="POST">
                <ul id="units">
                    <li class="unit">
                        <div class="unitinfo">
                            <h4>Phục vụ rượu</h4>
                            <img src="<?=$this->config->item('style_url')?>skin/resources/wine-big.gif" style="margin-left:10px;">
                            <p>Bạn có thể xác định chính xác bao nhiêu rượu cần để phục vụ người dân của mình. Càng nhiều rượu, người dân càng hạnh phúc.</p>
                        </div>
                        <div class="sliderinput">
                            <div id="sliderbg_wine" class="sliderbg" title="slider value = 0">
                                <div id="actualValue_wine" class="actualValue" style="clip: rect(0px, 10px, auto, 0px);"></div>
                                <div id="sliderthumb_wine" class="sliderthumb" style="left: 0px; top: 0px;"></div>
                            </div>
                <script type="text/javascript">
                create_slider({
                        dir : 'ltr',
                        id : "slider_wine",
                        maxValue : <?=$level?>,
                        overcharge : 0,
                        iniValue : <?=$this->Player_Model->now_town->tavern_wine?>,
                        bg : "sliderbg_wine",
                        thumb : "sliderthumb_wine",
                        topConstraint: -10,
                        bottomConstraint: 326,
                        bg_value : "actualValue_wine",
                        textfield:"wineAmount"
                    });
                Event.onDOMReady(function() {
					var slider = sliders["slider_wine"];
                    var startSatisfaction = <?=$this->Player_Model->good[$this->Player_Model->town_id]?>;
                    slider.subscribe("valueChange", function() {
                        var val = classValuePerSatisfaction.length-1;
                        for (n=0;n<5;n++) {
                            if (classValuePerSatisfaction[n] <= (startSatisfaction + 60*slider.actualValue)) {
                                val = n;
                                break;
                            }
                        }
                        window.status = startSatisfaction + 60*slider.actualValue;
                        Dom.get('citySatisfaction').className = classNamePerSatisfaction[val];
                        if(satPerWine[slider.actualValue]) {
                            slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];
                            slider.UpdateField2.innerHTML = savedWine[slider.actualValue];
                        } else {
                            slider.UpdateField1.innerHTML = "0";
                            slider.UpdateField2.innerHTML = "&nbsp;"

                        }
                    });
					slider.UpdateField1 = Dom.get("bonus");
                    slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];
					slider.UpdateField2 = Dom.get("savedWine");
                    slider.UpdateField2.innerHTML = savedWine[slider.actualValue];
				});
                </script>

                            <a class="setMin" href="#reset" onClick="sliders['slider_wine'].setActualValue(0); return false;" title="Thiết lập lại mục nhập"><span class="textLabel">Min</span></a>
                            <a class="setMax" href="#max" onClick="sliders['slider_wine'].setActualValue(<?=$this->Data_Model->wine_by_tavern_level($level)?>); return false;" title="Phục vụ nhiều nhất có thể"><span class="textLabel">Max</span></a>                </div><!-- end .sliderinput -->
                            <div class="forminput">
                                <a title="Phục vụ nhiều nhất có thể" onclick="sliders['slider_wine'].setActualValue(1); return false;" href="#max" class="setMax"><span class="textLabel">Max</span></a>
                                <div class="centerButton">
                                    <input type="submit" value="Nâng cốc!" class="button">
                                </div>
                                <div id="citySatisfaction"  class="<?=$this->Data_Model->good_class_by_count($this->Player_Model->good[$this->Player_Model->town_id])?>">
                                </div>
                            </div>
                            <div id="serve" class="textfield">
                                <select id="wineAmount" name="amount" size="1">
<?for($i = 0; $i <= $level; $i++){?>
<?if ($i == 0){?>
                                    <option value="0" <?if($this->Player_Model->now_town->tavern_wine == $i){?>selected<?}?>>Không có rượu</option>
<?}else{?>
                                    <option value="<?=$i?>" <?if($this->Player_Model->now_town->tavern_wine == $i){?>selected<?}?>><?=$this->Data_Model->wine_by_tavern_level($i)?> Rượu một giờ </option>
<?}}?>
                                </select>
                                <span class="bonus">+<span id="bonus" class="value">0</span> Cư dân hạnh phúc</span>
                                <br>
                                <span class="savedWine"><span id="savedWine"></span></span>
                            </div>
                    </li>
                </ul>
            </form>
        </div>
        <div class="footer"></div>
    </div>
</div>
