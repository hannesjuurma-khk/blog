<?php require_once APPROOT.'/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-danger"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light mt-5">
        <h2>Edit Post</h2>
        <p>Create a post with this form</p>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="content">Content: <sup>*</sup></label>
                <textarea name="content" class="form-control form-control-lg <?php echo (!empty($data['content_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['content']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['content_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="tagselect">Pick your tags</label>
                <select name="tags[]" multiple class="form-control" id="tagselect">
                    <?php foreach ($data['tags'] as $tag) : ?>
                        <option value="<?php echo $tag->tag_id; ?>"<?php echo in_array($tag, $data['postTags']) ? 'selected' : '' ?>><?php echo $tag->tag_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>