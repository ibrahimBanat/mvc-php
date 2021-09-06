
<?php
use app\models\Post;

/*
 * @var $post Post
 */

?>

<div class="container">

    <?php if($session->isLoggedIn()): ?>
    <a class="btn green" href="<?= URLROOT ?>/posts/create">
        Create Post
    </a>
    <?php endif; ?>

    <?php
    $data = json_decode(json_encode($data['posts']), true);


    foreach ($data as $post): ?>

    <div class="container-item">



        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
        <a class="" href="<?= URLROOT  . "/posts/update/" . $post['id'] ?>">Update</a>
            <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                <input type="submit" name="delete" value="Delete" class="btn red">
            </form>
        <?php endif; ?>




        <h2>
            <?= $post['title'] ?>
        </h2>
        <h3>
            <?= 'created on:' . date('F j h:m', strtotime($post['created_at'])) ?>
        </h3>
        <p>
            <?= $post['body'] ?>
        </p>
        <hr/>
    </div>

<?php endforeach ?>
</div>