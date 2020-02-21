<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit post</h2>
    <p>Edit a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="title">Title: </label>
            <input name="title" type="text" class="form-control form-control-lg <?php echo (!empty($data['title_err']) ? 'border border-danger' : ''); ?>" value="<?php echo $data['title']; ?>">
            <span class="text-danger"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: </label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err']) ? 'border border-danger' : ''); ?>">
                    <?php echo $data['body']; ?>
                </textarea>
            <span class="text-danger"><?php echo $data['body_err']; ?></span>
        </div>
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>