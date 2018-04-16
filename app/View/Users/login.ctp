<!--<form method="post" action="">
   <fieldset>
     <legend>Đăng nhập</legend>
     <label>Tên đăng nhập</label><input type="text" name="username" /><br />
     <label>Mật khẩu</label><input type="password" name="password" /><br />
     <input type="submit" name="ok" value="Login" />
     <span class="error"><?php echo $error; ?></span>
   </fieldset>
</form>-->

<html>
<body>
<div class="form-box" id="login-box">
 <div class="header">Sign In</div>
 <?=$this->Form->create();?>
 <?=$this->Form->input('username');?>
 <?=$this->Form->input('password');?>
 <button type="submit">Sign me in</button>
 <?=$this->Form->end();?>
</div>
</body>
</html>