<div>
    <h1>Create new post</h1>
    <form action="<?= URLROOT ?>/posts/create" method="post">
        <div class="form-item">
            <input type="text" name="title" placeholder="Ttile ..."/>
            <span class="invalidFeedBack">
                <?= $data['titleError']?>
            </span>
        </div>
        <div class="form-item">
            <textarea type="text" name="body" placeholder="Enter your post"></textarea>
            <span class="invalidFeedBack">
                <?= $data['bodyError']?>
            </span>
        </div>
        <button name="submit" type="submit">
        Create
        </button>
    </form>
</div>