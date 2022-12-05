<?php

session_start();

if (!isset($_SESSION['login-status'])) {
    $_SESSION['login-status'] = false;
    header('Location: login.php');
    exit;
}



require '../src/functions.php';

$products = get_all_data("products");

if (isset($_POST['buy-btn'])) {
    if (insert_buy_data($_POST)) {
        echo "<script>alert('Thank you for purchasing our product')</script>";
    }
}
?>

<?php require './templates/header.php' ?>
<?php require './templates/navbar.php' ?>
<div class="show-all px-3 py-5 flex gap-5 justify-center flex-wrap">
    <?php $i = 1; ?>
    <?php foreach ($products as $product) : ?>
    <div class="card w-60 bg-base-100 shadow-xl">
        <figure><img src="./product-img/<?= $product["product_image"] ?>" class="h-40 object-cover w-full"
                alt="Shoes" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">
                <span class="text-base"><?= $product['product_name'] ?></span>
                <!-- <div class="badge badge-secondary">NEW</div> -->
            </h2>
            <p class="text-sm">If a dog chews shoes whose shoes does he choose?</p>
            <div class="card-actions justify-end">
                <label for="add-modal-<?= $i ?>" class="btn btn-sm text-sm">buy now</label>
            </div>
        </div>
    </div>

    <input type="checkbox" id="add-modal-<?= $i ?>" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <form class="modal-box relative" action="" method="post">
            <h3 class="font-bold text-lg"><?= $product['product_name'] ?></h3>
            <input type="text" value="<?= $product['product_name'] ?>" name="product-name" class="hidden">

            <h3 class="font-bold text-lg my-2">$<?= $product['product_price'] ?></h3>
            <input type="text" value="<?= $product['product_price'] ?>" name="product-price" class="hidden">

            <?php $category = get_category($product['category_id']) ?>
            <h3 class="font-bold text-lg btn btn-outline btn-sm"><?= $category['category_name'] ?></h3>
            <input type="text" value="<?= $category['category_name'] ?>" name="product-category" class="hidden" />

            <label for="total-product" class="ml-3">Total : </label>
            <input type="number" id="total-product" placeholder="1" class="input input-bordered input-sm max-w-xs w-14"
                name="product-total" />

            <h3 class="font-bold text-lg mt-3">Buyer Credentials</h3>
            <div class="flex flex-col gap-3 mt-2">
                <div class="flex justify-between">
                    <input type="text" placeholder="Full Name" class="input input-bordered input-sm max-w-xs w-[49%]"
                        name="buyer" required />
                    <input type="text" placeholder="Address" class="input input-bordered input-sm max-w-xs w-[49%]"
                        name="address" required />
                </div>
                <div class="flex justify-between">
                    <input type="text" placeholder="Phone Number" class="input input-bordered input-sm max-w-xs w-[49%]"
                        name="phone-number" required />
                    <input type="text" placeholder="Address" value="<?= date("Y/m/d") ?>"
                        class="input input-bordered input-sm max-w-xs w-[49%] hidden" name="transaction-date" />
                </div>
            </div>
            <p class="py-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis nihil quae
                voluptas consequuntur non qui.</p>
            <div class="modal-action">
                <label for="add-modal-<?= $i ?>" class="btn btn-square btn-sm btn-outline absolute top-0 right-0 m-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
                <input for="add-modal-<?= $i ?>" class="btn btn-sm" value="Buy" type="submit" name="buy-btn">
            </div>
        </form>
    </div>
    <?php $i++ ?>
    <?php endforeach; ?>
</div>
<?php require './templates/footer.php';