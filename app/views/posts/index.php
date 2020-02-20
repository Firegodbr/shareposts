<?php require APPROOT . '/views/inc/header.php'; ?>
<p class="text-center mx-auto"><?php echo flash('post_added'); ?></p>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil" aria-hidden="true"></i> Add post
        </a>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light mb-3 p-2">Written by <?php echo $post->name; ?> on <?php echo $post->postsCreated; ?></div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>