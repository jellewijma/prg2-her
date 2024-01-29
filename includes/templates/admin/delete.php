<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Album $album
 */
?>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (isset($blog)): ?>
    <h1 class="title mt-4">Are you sure you want to delete <?= $blog->title?>?</h1>
    <a class="button is-danger mt-4" href="./delete?id=<?= $blog->id; ?>&continue">Yes, delete!</a>
    <a class="button mt-4" href="./admin">Go back to the list</a>
<?php endif; ?>

