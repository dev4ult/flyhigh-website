<?php
$page_name = "list_product";
require '../src/functions.php';

$products = get_all_products();

if (isset($_POST['buy-btn'])) {
    $total_product = $_POST['product-total'];

    if ($total_product <= 0) {
        echo "<script>alert('Total product unknown value')</script>";
        header('Location: index.php');
        exit;
    }

    $buyer = htmlspecialchars($_POST['buyer']);
    $address = htmlspecialchars($_POST['address']);
    $phone_number = htmlspecialchars($_POST['phone-number']);
    $transaction_date = htmlspecialchars($_POST['transaction-date']);

    $product_category = htmlspecialchars($_POST['product-category']);
    $product_name = htmlspecialchars($_POST['product-name']);
    $product_price = htmlspecialchars($_POST['product-price']);

    $buy_values = "('', '$buyer', '$address', '$phone_number', '$transaction_date', '$product_category', '$product_name', $total_product, $product_price)";

    insert_buy_data($buy_values);

    echo "<script>alert('inserted')</script>";
}
?>

<?php require './templates/header.php' ?>
<main class="container max-w-6xl mx-auto">
    <?php require './templates/navbar.php' ?>
    <div class="show-all px-3 py-5 flex gap-3 justify-center flex-wrap">
        <?php foreach ($products as $product) : ?>
        <div class="card w-80 bg-base-100 shadow-xl">
            <figure><img src="./product-img/<?= $product["product_image"] ?>" class="h-72 object-cover w-full"
                    alt="Shoes" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">
                    <?= $product['product_name'] ?>
                    <div class="badge badge-secondary">NEW</div>
                </h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="card-actions justify-end">
                    <!-- The button to open modal -->
                    <label for="my-modal-6" class="btn btn-sm">buy now</label>
                </div>
            </div>
        </div>
        <input type="checkbox" id="my-modal-6" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <form class="modal-box" action="" method="post">
                <h3 class="font-bold text-lg"><?= $product['product_name'] ?></h3>
                <input type="text" value="<?= $product['product_name'] ?>" name="product-name" class="hidden">

                <h3 class="font-bold text-lg my-2">$<?= $products[$i]['product_price'] ?></h3>
                <input type="text" value="<?= $product['product_price'] ?>" name="product-price" class="hidden">

                <?php $category = get_category($product['category_id']) ?>
                <h3 class="font-bold text-lg btn btn-outline btn-sm"><?= $category['category_name'] ?></h3>
                <input type="text" value="<?= $category['category_name'] ?>" name="product-category" class="hidden" />

                <label for="total-product" class="ml-3">Total : </label>
                <input type="number" id="total-product" placeholder="1"
                    class="input input-bordered input-sm max-w-xs w-14" name="product-total" />

                <h3 class="font-bold text-lg mt-3">Buyer Credentials</h3>
                <div class="flex flex-col gap-3 mt-2">
                    <div class="flex justify-between">
                        <input type="text" placeholder="Full Name"
                            class="input input-bordered input-sm max-w-xs w-[49%]" name="buyer" required />
                        <input type="text" placeholder="Address" class="input input-bordered input-sm max-w-xs w-[49%]"
                            name="address" required />
                    </div>
                    <div class="flex justify-between">
                        <input type="text" placeholder="Phone Number"
                            class="input input-bordered input-sm max-w-xs w-[49%]" name="phone-number" required />
                        <input type="text" placeholder="Address" value="<?= date("Y/m/d") ?>"
                            class="input input-bordered input-sm max-w-xs w-[49%] hidden" name="transaction-date" />
                    </div>
                </div>
                <p class="py-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis nihil quae
                    voluptas consequuntur non qui.</p>
                <div class="modal-action">
                    <input for="my-modal-6" class="btn btn-sm" value="Buy" type="submit" name="buy-btn">
                </div>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</main>

</body>

</html>