<?php require_once '../app/views/inc/header_home.php'; ?>

    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>

    <a href="<?php echo URLROOT; ?>/Pages/home">Home Page</a>
    <a href="<?php echo URLROOT; ?>/Pages/home/create">Create</a>
    <a href="<?php echo URLROOT; ?>/Pages/index/logout">Logout</a>

    <form action="" method="post">
        <p><?php echo ($data['note_title_err'] ?? $data['note_content_err'] ?? '') ?></p>
        <input type="text" name='note_title' value="<?php echo (isset($data['note_title']) ? $data['note_title'] : ''); ?>"> <br/>
        <textarea name="note_content" id="" cols="30" rows="10"><?php echo (isset($data['note_content']) ? $data['note_content'] : ''); ?></textarea> <br/>
        <button type="submit" name="add_note_btn">Add note</button>
    </form>

<?php require_once '../app/views/inc/footer.php'; ?>