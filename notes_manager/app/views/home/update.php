<?php require_once '../app/views/inc/header_home.php'; ?>
    
    
    <h3>Update note</h3>
        <a href="<?php echo URLROOT; ?>/Pages/home">Home Page</a>
        <a href="<?php echo URLROOT; ?>/Pages/home/create">Create</a>
        <a href="<?php echo URLROOT; ?>/Pages/index/logout">Logout</a>
        <form action="" method="post">

        <input type="text" name="note_title" value="<?php echo ($data['note_title'] ?? ''); ?>"> <br/>
        <textarea name="note_content" id="" cols="30" rows="10"><?php echo ($data['note_content'] ?? ''); ?></textarea> <br/>
        <button type="submit" name="update_note_btn">Update note</button>
    </form>
    
<?php require_once '../app/views/inc/footer.php'; ?>