<div id="mainview">
    <div class="buildingDescription">
        <h1>Thị trưởng</h1>
        <p>Xin chào! Với cương vị của 1 cố vấn, tôi sẽ thông báo với bạn những thông tin chính diễn ra tại các thành phố của bạn</p>
    </div>

    <div class="yui-navset">
        <ul class="yui-nav"  >
            <li  ><a
                href="<?=$this->config->item('base_url')?>game/tradeAdvisor/"
                title="Tin tức thành phố"><em>Tin tức thành phố</em></a></li>
            <li class="selected"><a
                href="<?=$this->config->item('base_url')?>game/tradeAdvisorTradeRoute/"
                title="Tuyến giao dịch"><em>Tuyến giao dịch</em></a></li>
        </ul>
    </div>
    <div class="contentBox01h">
        <h3 class="header">Sửa tuyến giao dịch</h3>
        <div class="content">
            <p>Một tuyến giao dịch thông thường vận chuyển hàng hóa giữa 2 thành phố của vương quốc của bạn. Do đó bạn có thể, ví dụ, tự động cung cấp rượu cho các thuộc địa. Bạn có thể lập 1 tuyến giao dịch miễn phí và thêm tuyến giao dịch với 1 ít Ambrosia. <br/><br/>Hãy chắc rằng luôn có đủ hàng hóa và tàu chở hàng tại thời điểm định sẵn trong suốt chuyến đi trong tuyến giao dịch và cảng tại thành phố đến không có tàu thuyền của quân địch.</p>

            <table >
                <tr>
                    <th colspan=3 style="width:446px;">Tuyến giao dịch:</th>
                    <th style="text-align:left;width:42px;">Thời gian:</th>
                    <th style="text-align:left;width:47px;">Giá: </th>
                    <th style="width:107px;"></th>
                </tr>
            </table>

<?if(SizeOf($this->Player_Model->trade_routes) > 0){?>
<?foreach($this->Player_Model->trade_routes as $trade){?>
            
            <form action="<?=$this->config->item('base_url')?>actions/tradeRoute/" method="post" id="tradeRouteForm0">
                <input type="hidden" name="renew" value="0" id="renew0">
                <input type="hidden" name="route" value="<?=$trade->id?>">
                <ul class="tradeRoute"  style="z-index:100">
                    <li class="startCity" style="position:relative;z-index:100">
                        <select id="tradeRouteStart<?=$trade->id?>" class="dropdown size175 smallFont" name="city1Id" onchange="this.focus();">
                            <option>Chọn thành phố bắt đầu</option>
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ($town->id == $trade->from) ? 'selected="selected"' : ''?>
                            <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Giao dịch: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?}?>
                        </select>
                    </li>
                    <li class="endCity">
                        <select id="tradeRouteEnd<?=$trade->id?>" class="dropdown size175 smallFont" name="city2Id" >
                            <option>Chọn thành phố đến</option>
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ($town->id == $trade->to) ? 'selected="selected"' : ''?>
                            <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Giao dịch: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?}?>
                        </select>
                    </li>
                    <li class="premiumDuration"><?=format_time($this->config->item('trade_route_time'))?></li>
                    <li class="premiumCost">&nbsp; -</li>
                    <li class="renew"></li>
                </ul>
                <ul class="tradeRoute2"  style="z-index:99">
                    <li class="number">
                        <input type="text" name="number"  value="<?=$trade->send_count?>" style="width:50px">
                    </li>
<?  $selected_wood = ($trade->send_resource == 0) ? 'selected' : '';
    $selected_wine = ($trade->send_resource == 1) ? 'selected' : '';
    $selected_marble = ($trade->send_resource == 2) ? 'selected' : '';
    $selected_crystal = ($trade->send_resource == 3) ? 'selected' : '';
    $selected_sulfur = ($trade->send_resource == 4) ? 'selected' : '';?>
                    <li class="tradegood">
                        <select name="tradegood" id="tradegood<?=$trade->id?>" class="dropdown size68 smallFont">
                            <option class="resource" value="0"  title="Vật liệu xây dựng <?=$selected_wood?>></option>
                            <option class="tradegood1" value="1"  title="Nho" <?=$selected_wine?>></option>
                            <option class="tradegood2" value="2"  title="Cẩm thạch" <?=$selected_marble?>></option>
                            <option class="tradegood3" value="3"  title="Pha lê" <?=$selected_crystal?>></option>
                            <option class="tradegood4" value="4"  title="Lưu huỳnh" <?=$selected_sulfur?>></option>
                        </select>
                    </li>
                    <li class="time">
                        <select name="time" id="time<?=$trade->id?>" class="dropdown size115 smallFont">
<?
for ($i = 0; $i <= 23; $i++)
{
        $selected = ($i == $trade->send_time) ? 'selected' : '';
?>
                            <option value="<?=$i?>" <?=$selected?>>Hàng ngày vào <?=$i?>:00</option>
<?
}
?>
                        </select>
                    </li>
                    <li class="save">
                        <input id="colonizeBtn" name="save" type="submit" value="" title="Lưu Thay đổi"><br>
                    </li>
                    <li class="status">
                        <span style="font-size:16px;font-weight:bold;color:green;">Còn <?=premium_time($this->config->item('trade_route_time')-(time()-$trade->start_time))?></span>
                    </li>
                    <li class="delete">
                        <a  href="<?=$this->config->item('base_url')?>actions/tradeRoute/<?=$trade->id?>/" title="Xóa"></a>
                    </li>
                </ul>
            </form>
            <div class="listFooter"></div><br>
<?}?>
<?}?>

<?if(SizeOf($this->Player_Model->trade_routes) == 0 or $param1 == 'new'){?>
            <form action="<?=$this->config->item('base_url')?>actions/tradeRoute/" method="post" id="tradeRouteForm0">
                <input type="hidden" name="renew" value="0" id="renew0">
                <input type="hidden" name="route" value="0">
                <ul class="tradeRoute"  style="z-index:100">
                    <li class="startCity" style="position:relative;z-index:100">
                        <select id="tradeRouteStart0" class="dropdown size175 smallFont" name="city1Id" onchange="this.focus();">
                            <option>Chọn thành phố bắt đầu</option>
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ($this->Player_Model->town_id == $town->id) ? 'selected="selected"' : ''?>
                            <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Giao dịch: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?}?>
                        </select>
                    </li>
                    <li class="endCity">
                        <select id="tradeRouteEnd0" class="dropdown size175 smallFont" name="city2Id" >
                            <option>Chọn thành phố đến</option>
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ''?>
                            <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Giao dịch: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?}?>
                        </select>
                    </li>
                    <li class="premiumDuration"><?=format_time($this->config->item('trade_route_time'))?></li>
<?if(SizeOf($this->Player_Model->trade_routes) > 0){?>
                    <li class="premiumCost">10 <img height="20" width="24" alt="Амброзия" src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif"></li>
<?if($this->Player_Model->user->ambrosy >= 10){?>
                    <li class="renew">
                        <a onclick="Dom.get('renew0').value=1;Dom.get('tradeRouteForm0').submit();" id="colonizeBtn" name="renew" style="margin:0px;" class="button">Kích hoạt</a><br>
                    </li>
<?}else{?>
                    <li class="renew">
                        <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Chưa kích hoạt <?=10 - $this->Player_Model->user->ambrosy?> Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
                    </li>
<?}?>
<?}else{?>
                    <li class="premiumCost">&nbsp; -</li>
                    <li class="renew">
                        <a onclick="Dom.get('renew0').value=1;Dom.get('tradeRouteForm0').submit();" id="colonizeBtn" name="renew" style="margin:0px;" class="button">Kích hoạt</a><br>
                    </li>
<?}?>

                </ul>
                <ul class="tradeRoute2"  style="z-index:99">
                    <li class="number">
                        <input type="text" name="number"  value="0" style="width:50px">
                    </li>
<?
    $selected_wood = '';
    $selected_wine = '';
    $selected_marble = '';
    $selected_crystal = '';
    $selected_sulfur = '';
?>
                    <li class="tradegood">
                        <select name="tradegood" id="tradegood0" class="dropdown size68 smallFont">
                            <option class="resource" value="0"  title="Vật liệu xây dựng" <?=$selected_wood?>></option>
                            <option class="tradegood1" value="1"  title="Nho" <?=$selected_wine?>></option>
                            <option class="tradegood2" value="2"  title="Cẩm thạch" <?=$selected_marble?>></option>
                            <option class="tradegood3" value="3"  title="Pha lệ" <?=$selected_crystal?>></option>
                            <option class="tradegood4" value="4"  title="Lưu huỳnh" <?=$selected_sulfur?>></option>
                        </select>
                    </li>
                    <li class="time">
                        <select name="time" id="time0" class="dropdown size115 smallFont">
<?
for ($i = 0; $i <= 23; $i++)
{
    $selected = '';
?>
                            <option value="<?=$i?>" <?=$selected?>>Hàng ngày vào <?=$i?>:00</option>
<?
}
?>
                        </select>
                    </li>
                    <li class="save">
                        <input id="colonizeBtn" name="save" type="submit" value="" title="Lưu thay đổi"><br>
                    </li>
                    <li class="status">
                        <span style="font-size:16px;font-weight:bold;color:red;">Chưa kích hoạt</span>
                    </li>
                    <li class="delete"></li>
                </ul>
            </form>
            <div class="listFooter"></div><br>
<?}else{?>
            <div class="addRoute">
                <a href="<?=$this->config->item('base_url')?>game/tradeAdvisorTradeRoute/new/" id="colonizeBtn" style="margin:0px;" class="button" >Tạo một tuyến giao dịch mới</a><br>
            </div>
<?}?>
        </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">
<!--
function testTradeRouteDelete() {
    return confirm('Bạn có chắc chắn muốn xóa một tuyến giao dịch? Bạn sẽ phải thiết lập các đề nghị giao dịch đến 0.');
}

Event.onDOMReady( function() {
<?if(SizeOf($this->Player_Model->trade_routes) > 0){?>
<?foreach($this->Player_Model->trade_routes as $trade){?>
    replaceSelect(Dom.get("tradeRouteStart<?=$trade->id?>"));
    replaceSelect(Dom.get("tradeRouteEnd<?=$trade->id?>"));
    replaceSelect(Dom.get("tradegood<?=$trade->id?>"));
    replaceSelect(Dom.get("time<?=$trade->id?>"));
<?}}?>
<?if(SizeOf($this->Player_Model->trade_routes) == 0 or $param1 == 'new'){?>
    replaceSelect(Dom.get("tradeRouteStart0"));
    replaceSelect(Dom.get("tradeRouteEnd0"));
    replaceSelect(Dom.get("tradegood0"));
    replaceSelect(Dom.get("time0"));
<?}?>
});
//-->
</script>
