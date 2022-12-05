<?php
$btn = "btn btn-sm";

if ($_SESSION['login-status']) {
    $is_login = true;
} else {
    $is_login = false;
}


function pageLive($page_name) {
    global $btn;
    if ($page_name == basename($_SERVER['REQUEST_URI'], '.php')) {
        return $page_name === 'login' ? 'bg-black text-white' : $btn;
    }
}

?>

<nav class="flex justify-between py-4 items-center">
    <a href="index.php" class="<?= pageLive('index') ?> font-semibold text-xl ">FLYHIGH</a>
    <ul class="flex gap-6 items-center">
        <li><a href="list_product.php" class="<?= pageLive('list_product') ?> font-semibold text-xl">SHOP</a></li>
        <?php if ($is_login) : ?>
        <li><a href="dashboard.php" class="<?= pageLive('dashboard') ?> font-semibold text-xl">DASHBOARD</a></li>
        <?php endif ?>
        <li><a href=" <?= $is_login ? 'logout' : 'login' ?>.php"
                class="<?= pageLive('login') ?> btn btn-sm btn-outline font-semibold text-xl"><?= $is_login ? 'LOGOUT' : 'LOGIN' ?></a>
        </li>
    </ul>
</nav>