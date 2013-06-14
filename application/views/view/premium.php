<div id="mainview">
    <h1><?=$this->lang->line('h1_premium')?></h1>
    <div id="premiumOffers" class="contentBox01h">
        <h3 class="header"><?=$this->lang->line('h1_premium')?></h3>
        <div class="content">
            <p><?=$this->lang->line('intestazione_premium')?></p>
            <table class="TableHoriMax Account">
                <tr>
                    <th class="feature"><?=$this->lang->line('caratteristiche_premium')?></th>
                    <th class="duration"><?=$this->lang->line('durata_premium')?></th>
                    <th class="cost"><?=$this->lang->line('costi_premium')?></th>
                    <th class="buy">&nbsp;</th>
                </tr>
                <tr class="account">
                    <td class="feature" rowspan="2">
                      <h4><?=$this->lang->line('account_premium')?></h4>
                      <p><?=$this->lang->line('descrizione_account_premium')?></p>
                      <a href="<?=$this->config->item('base_url')?>game/premiumDetails/"><?=$this->lang->line('ulteriori_info_premium')?></a>
                    </td>
                    <td class="duration">7&nbsp;<?=$this->lang->line('giorni_account_premium')?></td>
                    <td class="cost">10&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy" rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 10){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/account/" class="button" title="Kích hoạt"><?=$this->lang->line('attiva_account_premium')?></a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 10 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>
                <tr>
<?if($this->Player_Model->user->premium_account > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_account-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>
            </table>

            <table class="TableHoriMax">
                <tr>
                    <th class="feature">Phần thưởng PLUS</th>
                    <th class="duration">Quá trình</th>
                    <th class="cost">Giá</th>
                    <th class="buy">&nbsp;</th>
                </tr>

                <tr class="woodbonus">
                    <td class="feature" rowspan="2">
                      <h4>Thêm 20% vật liệu xây dựng</h4>
                      <p>Trong khoảng thời gian thưởng, sẽ thêm 20% vào sản lượng khai thác gỗ cho tất cả các thành phố trên đảo!</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">10&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 10){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/wood/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 10 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_wood > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_wood-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

                <tr style="background-image:url(<?=$this->config->item('style_url')?>skin/premium/table_border_2.gif); background-repeat:no-repeat; background-position:center;">
                    <td colspan=4></td>
                </tr>

                <tr class="marblebonus">
                    <td class="feature" rowspan="2">
                      <h4>Thêm 20% cẩm thạch</h4>
                      <p>Trong khoảng thời gian thưởng, sẽ thêm 20% vào sản lượng khai thác cẩm thạch trên toàn đảo!</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">8&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 8){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/marble/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 8 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_marble > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_marble-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

                <tr style="background-image:url(<?=$this->config->item('style_url')?>skin/premium/table_border_2.gif); background-repeat:no-repeat; background-position:center;">
                    <td colspan=4></td>
                </tr>

                <tr class="sulfurbonus">
                    <td class="feature" rowspan="2">
                      <h4>Thêm 20% lưu huỳnh</h4>
                      <p>Trong khoảng thời gian thưởng, sẽ thêm 20% vào sản lượng khai thác lưu huỳnh cho tất cả các đảo của bạn!</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">3&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 3){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/sulfur/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 3 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_sulfur > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_sulfur-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

                <tr style="background-image:url(<?=$this->config->item('style_url')?>skin/premium/table_border_2.gif); background-repeat:no-repeat; background-position:center;">
                    <td colspan=4></td>
                </tr>

                <tr class="crystalbonus">
                    <td class="feature" rowspan="2">
                      <h4>Thêm 20% pha lê</h4>
                      <p>Trong khoảng thời gian thưởng, sẽ thêm 20% vào sản lượng khai thác pha lê cho tất cả các đảo của bạn!</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">5&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 5){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/crystal/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 5 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_crystal > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_crystal-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

                <tr style="background-image:url(<?=$this->config->item('style_url')?>skin/premium/table_border_2.gif); background-repeat:no-repeat; background-position:center;">
                    <td colspan=4></td>
                </tr>

                <tr class="winebonus">
                    <td class="feature" rowspan="2">
                      <h4>Thêm 20% rượu vang</h4>
                      <p>Trong suốt thời gian tặng thưởng, 20% lượng rượu sản xuất sẽ tăng trên toàn hòn đảo!</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">3&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 3){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/wine/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 3 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_wine > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_wine-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

                <tr style="background-image:url(<?=$this->config->item('style_url')?>skin/premium/table_border_2.gif); background-repeat:no-repeat; background-position:center;">
                    <td colspan=4></td>
                </tr>

                <tr class="savecapacityBonus">
                    <td class="feature" rowspan="2">
                      <h4>Tăng độ an toàn khi bị cướp bóc thêm 100%.</h4>
                      <p>Bạn nhận được thêm 100% an toàn cho hàng hóa trong nhà kho.</p>
                    </td>
                    <td class="duration">7&nbsp;Ngày</td>
                    <td class="cost">14&nbsp;<img src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif" width="24" height="20" alt="Аmbrosia" /></td>
                    <td class="buy"  rowspan="2">
<?if($this->Player_Model->user->ambrosy >= 14){?>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/premium/capacity/" class="button" title="Kích hoạt">Kích hoạt</a>
        </div>
<?}else{?>
                      <a class="notenough" href="<?=$this->config->item('base_url')?>game/premiumPayment/">Còn thiếu 14 Ambrosia!<br><span class="buyNow">Mua ngay!</span></a>
<?}?>
                    </td>
                </tr>

                <tr>
<?if($this->Player_Model->user->premium_capacity > 0){?>
                    <td class="active" colspan="3"><br>Còn <?=premium_time($this->Player_Model->user->premium_capacity-time())?></td>
<?}else{?>
                    <td class="inactive" colspan="3">Chưa kích hoạt</td>
<?}?>
                </tr>

            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>