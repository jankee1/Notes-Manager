<?php require_once '../app/views/inc/header_home.php'; ?>
    <h2>Delete note</h2>
        <a href="<?php echo URLROOT; ?>/Pages/home">Home Page</a>
        <a href="<?php echo URLROOT; ?>/Pages/home/create">Create</a>
        <a href="<?php echo URLROOT; ?>/Pages/index/logout">Logout</a>
        
    <form action="" method="post">
        <h3>Do you want to delete note: <?php echo $data['note_title'] ?></h3>
        <p><?php echo $data['note_content']; ?></p>
        <button type="submit" name="delete_note_btn">Delete note</button>
    </form>
<?php require_once '../app/views/inc/footer.php'; ?>