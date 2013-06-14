<div id="mainview">
    <h1 style="text-align:center">Tòa thị chính</h1>

    <form action="<?=$this->config->item('base_url')?>actions/rename/"  method="POST">
        <div id="renameCity" class="contentBox01h">
            <h3 class="header">Đổi tên thành phố</h3>
            <div class="content">
                <div class="oldCityName"><span class="textLabel">Tên thành phố cũ: </span><?=$this->Player_Model->now_town->name?></div>
                <div class="newCityName"><label for="newCityName">Tên thành phố mới: </label>
                    <input type="text" class="textfield" id="newCityName" name="name" size="30" maxlength="15">
                    <input type="submit" class="button" value="Chấp nhận tên thành phố">
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </form>
</div>