<?php if ($this->session->flashdata('msg')) { ?>
    <div class="alert alert-error"><?php echo $this->session->flashdata('msg'); ?></div>

<?php } ?>
<form name="f" method="post" action="<?php echo site_url('login');?>">
<label>Username</label>
<input type="text" name="username"/><br>
<label>Password</label>
<input type="password" name="password"/><br>
<input type="submit" value="Login"/>
</form>
