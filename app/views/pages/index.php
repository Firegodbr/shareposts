<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h1 class="display-3" id='title'><?php echo $data['title']; ?></h1>
        <p class="lead elem"><?php echo $data['description']; ?></p>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>