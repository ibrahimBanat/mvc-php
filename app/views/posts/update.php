<div>
    <h1>Update post</h1>
    <form action="<?= URLROOT ?>/posts/update/<?= $data['post']->id ?>" method="post">
        <div class="form-item">
<!--            --><?php //print_r($data['post']) ?>
            <input type="text" name="title" value="<?= $data['post']->title ?>"/>
            <span class="invalidFeedBack">
                <?= $data['titleError']?>
            </span>
        </div>
        <div class="form-item">
            <textarea type="text" name="body"><?= $data['post']->body ?></textarea>
            <span class="invalidFeedBack">
                <?= $data['bodyError']?>
            </span>
        </div>
        <button name="submit" type="submit">
            Update
        </button>
    </form>
</div>