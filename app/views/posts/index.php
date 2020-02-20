<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php message('post_message'); ?>
    <div class="row mb-3">
        <div class=" pl-4">
            <h1>Posts</h1>
        </div>
        <div class="pt-2 pl-4">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">Add Post</a>
        </div>
    </div>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h3 class="card-title"><?php echo $post->post_title; ?></h3>
        <div class="bg-light p-2 mb-3">Created by <?php echo $post->userId; ?> at <?php echo $post->postCreated; ?>

        <!-- Siit tulevad postitustele tagid -->
        <?php foreach($post->tags as $tags) :?>
            <span
                style="background:<?php echo $tags->tag_color; ?>;" class="ml-2 p-1 badge badge-secondary"><?php echo $tags->tag_name; ?></span>
        <?php endforeach; ?>
        </div>
        <p class="card-text"><?php echo $post->postContent; ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId;?>" class="w-25 btn btn-info">More</a>
    </div>
<?php endforeach; ?>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>