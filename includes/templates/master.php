<?php

/**
 * @var string|null $pageTitle
 * @var string|null $content
 */
?>
<!doctype html>
<html lang="en">

<head>
    <title>Music Collection | <?= $pageTitle ?? ''; ?></title>
    <meta charset="utf-8" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto">
        <?= $content ?? ''; ?>
    </div>
</body>

</html>