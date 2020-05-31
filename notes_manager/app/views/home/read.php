<?php require_once '../app/views/inc/header_home.php'; ?>

    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>

    <a href="<?php echo URLROOT; ?>/Pages/home">Home Page</a>
    <a href="<?php echo URLROOT; ?>/Pages/home/create">Create</a>
    <a href="<?php echo URLROOT; ?>/Pages/index/logout">Logout</a>

    <?php 
    echo $data['table_of_notes'];
    ?>

<?php require_once '../app/views/inc/footer.php'; ?>