<?php 
require_once '../app/views/inc/header_main.php'; ?>
    
    <!--login form -->
    
    <h1>This is Main page of notes manager</h1>

    <h3>Login</h3><br/>
    <form action="<?php echo URLROOT; ?>/Pages/index/login" method="post">
        <input type="text" name="login_username" placeholder="Login" value="<?php echo (isset($data['login_username']) ? $data['login_username']: ''); ?>"><br/>
            <p><?php echo (isset($data['login_username_err']) ? $data['login_username_err']: ''); ?></p>
        <input type="password" name="password" placeholder="Password"><br/>
            <p><?php echo (isset($data['password_err']) ? $data['password_err']: ''); ?></p>
        <button type="submit">Login</button><br/>
    </form>
    
    <!-- registration form -->
    
    <h3>Register</h3><br/>
    <form action="<?php echo URLROOT; ?>/Pages/index/register" method="post">
       <p><?php echo (isset($data['register_success']) ? $data['register_success']: ''); ?></p>
        <input type="text" name="register_username" placeholder="Login" value="<?php echo (isset($data['register_username']) ? $data['register_username']: ''); ?>"><br/>
            <p><?php echo (isset($data['register_username_err']) ? $data['register_username_err']: ''); ?></p>
        <input type="password" name="password1" placeholder="Password"><br/>
            <p><?php echo (isset($data['password1_err']) ? $data['password1_err']: ''); ?></p>
        <input type="password" name="password2" placeholder="Confirm password"><br/>
            <p><?php echo (isset($data['password2_err']) ? $data['password2_err']: ''); ?></p>
        <button type="submit">Register</button><br/>
    </form>

<?php require_once '../app/views/inc/footer.php'; ?>