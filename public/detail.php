<?php
session_start();

if (!isset($_SESSION['login-status'])) {
    $_SESSION['login-status'] = false;
    header('Location: login.php');
    exit;
}

if (!$_SESSION['login-status']) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

require '../src/functions.php';

$ts_detail = get_one_data('alyassar', 'id_pembeli', $_GET['id']);

if (isset($_POST['submit-save-btn'])) {
    if (update_transaction_status($_POST, $_GET['id']) > 0) {
        echo "<script>window.location.href='detail.php?id=" . $_GET['id'] . "'</script>";
    };
}

?>


<?php require './templates/header.php' ?>
<div class="min-h-[85vh] flex flex-col gap-3 items-center justify-center">
    <a class="btn btn-sm btn-outline" href="dashboard.php">go back</a>
    <div class="stats shadow grid grid-flow-row ">
        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-title">Buyer Detail</div>
            <div class="stat-value"><?= $ts_detail['nama'] ?></div>
            <div class="stat-desc">
                <p>Phone Number : <?= $ts_detail['hp'] ?></p>
                <p>Address : <?= $ts_detail['alamat'] ?></p>
            </div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
            </div>
            <div class="stat-title">Product Detail</div>
            <div class="stat-value"><?= $ts_detail['nama_barang'] ?></div>
            <div class="stat-desc">
                <p>Category : <?= $ts_detail['jenis_barang'] ?></p>
                <p>Total : <?= $ts_detail['jumlah'] ?></p>
                <p>Total Price : $<?= $ts_detail['jumlah'] * $ts_detail['harga'] ?></p>
            </div>
        </div>

        <div class="stat">

            <div class="stat-title">Status</div>
            <div class="stat-value ">
                <?php
                $transaction_status_list = ["pending", "paid out", "successful", "failed", "refunded"];
                ?>
                <form action="" method="post" class="flex flex-col gap-3">
                    <select name="ts-status" title="ts-status">
                        <?php foreach ($transaction_status_list as $status) : ?>
                        <option class="focus:outline-none focus:border-none active:outline-none"
                            <?= ($status == $ts_detail['status']) ? 'selected' : '' ?> value="<?= $status ?>">
                            <?= strtoupper($status) ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" name="submit-save-btn" class="btn btn-sm">save change</button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php require './templates/footer.php' ?>