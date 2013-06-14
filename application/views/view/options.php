<div id="mainview">

  <div class="buildingDescription">
    <h1> <?=$this->lang->line('opzioni')?></h1>
    </div><!-- ende .buildingDescription -->

<?if($this->Player_Model->user->register_complete == 0 and $this->config->item('game_email')){?>
  <div class="contentBox01h" id="emailInvalidWarning">
    <h3 class="header"><span class="textLabel">Địa chỉ email chưa được xác nhận!</span></h3>
    <div class="content">
      <p>Địa chỉ email của bạn chưa được xác nhận. Bạn không thể bắt liên lạc với người chơi khác hay gửi quân đội và tàu thuyền. Bạn có thể xác nhận địa chỉ email bằng cách truy cập link trong email mà chúng tôi đã gửi. Nếu bạn không nhận được, vui lòng hồi báo lại và chúng tôi sẽ gửi cho bạn một email khác.</p>
      <div class="centerButton">
          <a class="button" href="<?=$this->config->item('base_url')?>actions/options/validationEmail/">Gửi lại thư xác nhận</a>
      </div>
    </div>
    <div class="footer"></div>
  </div>
<?}?>

<?if($this->session->flashdata('options_error')){?>
<div class="contentBox01h">
    <h3 class="header"><span class="textLabel">Thông báo Lỗi</span></h3>
    <div class="content">
        <ul class="errors">
<?if($this->session->flashdata('options_error_login')){?>
            <li><?=$this->session->flashdata('options_error_login')?></li>
<?}?>
        </ul>
    </div>
    <div class="footer"></div>
</div>
<?}?>

  <div class="contentBox01h">
    <h3 class="header"><span class="textLabel">Cài đặt</span></h3>
    <div class="content">
      <form  action="<?=$this->config->item('base_url')?>actions/options/user/" method="POST">
      
      <div id="options_userData">
        <table cellpadding="0" cellspacing="0">
          <tr>
            <th>Đổi tên người chơi</th>
            <td><input class="textfield" type="text" name="name" size="15" value="<?=$this->Player_Model->user->login?>"></td>
          </tr>

        </table>
      </div>

      <div id="options_changePass">
        <h3>Thay đổi mật khẩu</h3>
        <table cellpadding="0" cellspacing="0">
          <tr>
            <th>Mật khẩu cũ</th>
            <td><input type="password" class="textfield" name="oldPassword" size="20"></td>
          </tr>
          <tr>
            <th>Mật khẩu mới</th>
            <td><input type="password" class="textfield" name="newPassword" size="20"></td>
          </tr>
          <tr>
            <th>Xác nhận mật khẩu mới</th>
            <td><input type="password" class="textfield" name="newPasswordConfirm" size="20"></td>
          </tr>
        </table>
      </div>

    <div>
    <h3></h3>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Hiển thị chi tiết của thị trấn được chọn</th>
            <td>
                <select name="citySelectOptions" size="1">
                    <option value="0" <?if($this->Player_Model->user->options_select == 0){?>selected="selected"<?}?>>Không có thông tin</option>
                    <option value="1" <?if($this->Player_Model->user->options_select == 1){?>selected="selected"<?}?>>Hiển thị tọa độ ở hướng dẫn thị trấn</option>
                    <option value="2" <?if($this->Player_Model->user->options_select == 2){?>selected="selected"<?}?>>Hàng hóa thương mại</option>
                    </select>
                </td>
            </tr>
<?if($this->Player_Model->user->tutorial < 999){?>
        <tr>
            <th>Hướng dẫn</th>
            <td>
                <select name="tutorialOptions" size="1">
                    <option value="2"selected>Bật</option>
                    <option value="-2">Tắt</option>
                    </select>
                </td>
        </tr>
<?}?>
        </table>
    </div>

      <div id="options_debug">
      <h3>Debugdata</h3>
      <table cellpadding="0" cellspacing="0">
        <tr>
          <th>Player-ID:</th>
          <td> <?=$this->Player_Model->user->id?></td>
        </tr>
        <tr>
          <th>Current City-ID: </th>
          <td><?=$this->Player_Model->user->town?></td>
        </tr>
      </table>
      </div>


      <div class="centerButton">
        <input type="submit" class="button" value="Сохранить">
      </div>
      </form>
      </div>
      <div class="footer"></div>
    </div>



    <div class="contentBox01h">
    <h3 class="header"><span class="textLabel">Đổi địa chỉ email</span></h3>
    <div class="content">
      <form  action="<?=$this->config->item('base_url')?>actions/options/email/" method="POST">
      <table cellpadding="0" cellspacing="0">

      <tr>
            <th>Đổi địa chỉ email</th>
            <td>
                                <input class="textfield" type="text" name="email" size="30" value="<?=$this->Player_Model->user->email?>">
                                (<?=$this->Player_Model->user->email?>)
            </td>
          </tr>

           <tr>
          	<th>Xác nhận thay đổi địa chỉ Email bằng mật khẩu của bạn</th>
          	<td><input type="password" class="textfield" name="emailPassword" size="20"/></td>
          </tr>
      </table>
      <div class="centerButton">
          <input type="submit" class="button" value="Đổi địa chỉ email">
      </div>
      </form>
      </div>
      <div class="footer"></div>
    </div>

      <div class="contentBox01h" id="vacationMode">
        <h3 class="header"><span class="textLabel">Kích hoạt chế độ nghỉ phép</span></h3>
        <div class="content">
          <p>Bạn có thể kích hoạt chế độ nghỉ ở đây. Điều này có nghĩa là tài khoản game của bạn sẽ không bị xóa nếu bạn không đăng nhập trong thời gian dài và thành phố của bạn không thể bị tấn công trong thời gian này. Công nhân và các nhà khoa học cũng sẽ đi nghỉ và không làm việc. Do đó chế độ nghỉ không phải là một lợi thế, chế độ nghỉ khi kích hoạt sẽ kéo dài ít nhất là 48 giờ. Bạn sẽ không thể chơi Ikariam trong thời gian này. Sau 2 ngày, chế độ nghỉ sẽ tự động kết thúc khi bạn đăng nhập.</p>
          <p class="warningFont">Chú ý! Tàu thuyền và quân đội đang ở ngoài thành phố bạn sẽ giải tán và trở về khi bạn kích hoạt chế độ nghỉ! Hàng hóa đang vận chuyển sẽ bị mất!</p>
            <div class="centerButton">
                <a class="button" href="<?=$this->config->item('base_url')?>game/options_umod_confirm/">Kích hoạt chế độ nghỉ phép</a>
            </div>
        </div>
        <div class="footer"></div>
      </div>


      <div class="contentBox01h" id="deletionMode">
        <h3 class="header"><span class="textLabel">Xóa người chơi</span></h3>
        <div class="content">
          <p>Nếu bạn không muốn chơi nữa, bạn có thể xóa bỏ tài khoản của mình tại đây. Nó sẽ được loại khỏi trò chơi trong vòng 7 ngày.</p>
          <br>
          <div class="centerButton">
            <a class="button" href="<?=$this->config->item('base_url')?>game/options_deletion_confirm/">Xóa vĩnh viễn người chơi!</a>
          </div>
          <br>
        </div>
        <div class="footer"></div>
      </div>



</div> 