<h1>Sửa chuyên mục</h1>
<form method="POST" action="<?php echo route('categories.upload'); ?>" enctype="multipart/form-data">
    <div>
        <input type="file" name="photo" id="" />
    </div>
    <!-- <?php echo csrf_token(); ?> -->
    <input type="text" name="_token" value="<?php echo csrf_token(); ?>">
    <button type="submit">Upload</button>
</form>