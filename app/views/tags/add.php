<?php require_once APPROOT.'/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT; ?>/tags" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light mt-5">
        <h2>Add Tag</h2>
        <p>Create a new tag</p>
        <form action="<?php echo URLROOT; ?>/tags/add" method="post">
            <div class="form-group">
                <label for="tag_name">Name: <sup>*</sup></label>
                <input type="text" name="tag_name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['tag_name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="tag_color">Color: <sup>*</sup></label>
                <input type="text" name="tag_color" class="form-control form-control-lg <?php echo (!empty($data['color_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['tag_color']; ?>">
                <span class="invalid-feedback"><?php echo $data['color_err']; ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Add">
        </form>
    </div>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>