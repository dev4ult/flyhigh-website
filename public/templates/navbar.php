<?php
$btn = "btn btn-sm";

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
        <li><a href="login.php" class="<?= pageLive('login') ?> btn btn-sm btn-outline font-semibold text-xl">LOGIN</a>
        </li>
    </ul>
</nav>