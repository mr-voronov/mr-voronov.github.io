<form action="" method="POST" enctype="multipart/form-data" class="form--create-update">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo $result['title']; ?>">
    </div>
    <div>
        <label for="url">URL</label>
        <input type="text" name="url" id="url" value="<?php echo $result['url']; ?>">
    </div>
    <div>
        <label for="descr_min">Descr min</label>
        <textarea name="descr_min" id="descr_min" cols="20" rows="3"><?php echo $result['descr_min']; ?></textarea>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="20" rows="5"><?php echo $result['description']; ?></textarea>
    </div>
    <div>
        <label for="categories-list">Categories</label>
        <select name="cid" id="categories-list">
            <?php

            $out = '';

            foreach ($categories as $key => $value) {
                if ($value['id'] === $result['cid']) {
                    $out .= '<option value="'.$value['id'].'" selected>';
                    $out .= $value['title'];
                    $out .= "</option>";
                } else {
                    $out .= '<option value="'.$value['id'].'">';
                    $out .= $value['title'];
                    $out .= "</option>";
                } 
            }
            
            echo $out;

            ?>
        </select>
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" value="<?php echo $result['image']; ?>">
    </div>
    <div>
        <input type="submit" name="submit" value="<?php echo $action; ?>">
    </div>
</form>