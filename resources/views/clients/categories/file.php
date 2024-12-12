<h1>Sửa chuyên mục</h1>
<form action="<?php echo route('categories.add'); ?>" method="POST">
    <div>
        <input type="text" name="category_name" placeholder="Tên chuyên mục" value="<?php echo old('category_name', 'mac dinh'); ?>">
    </div>
    <!-- <?php echo csrf_token(); ?> -->
    <input type="text" name="_token" value="<?php echo csrf_token(); ?>">
    <button type="submit">Thêm chuyên mục</button>
</form>