<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php message('post_message'); ?>
    <div class="row mb-3">
        <div class=" pl-4">
            <h1>Tags</h1>
        </div>
    </div>
    <div class="pt-2 pl-4">
        <a href="<?php echo URLROOT; ?>/tags/add" class="btn btn-primary pull-right">Add Tag</a>
    </div>
    <div class="bg-light pull-right">
<?php foreach ($data['tags'] as $tag) : ?>
    <div class="form-check m-3">
        <a class="btn btn-primary d-inline" style="background:<?php echo $tag->tag_color; ?>; color: #ffffff; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; border-radius: 4px;" href="<?php echo URLROOT; ?>/tags/posts/<?php echo $tag->tag_id; ?>"><?php echo $tag->tag_name; ?></a>
        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tag_id; ?>">X</a>
    </div>
<?php endforeach; ?>
    </div>

<?php require_once APPROOT.'/views/inc/footer.php'; ?>

<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->post_id; ?>" method="post">
