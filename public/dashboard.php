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

require '../src/functions.php';

$order_list = get_all_data('alyassar');

if (isset($_POST['submit-delete-btn'])) {
    delete_transaction($_POST['transaction-id']);
}

?>

<?php require './templates/header.php'; ?>
<?php require './templates/navbar.php'; ?>
<div class="overflow-x-auto min-h-[85vh]">
    <table class="table table-zebra w-full">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Product</th>
                <th>Total Product</th>
                <th>Transaction Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; ?>
            <?php foreach ($order_list as $order) : ?>
            <tr>
                <th><?= $index ?></th>
                <td><?= $order['nama'] ?></td>
                <td><?= $order['nama_barang'] ?></td>
                <td><?= $order['jumlah'] ?></td>
                <td><?= $order['tgl_transaksi'] ?></td>
                <?php $status = $order['status'];
                    if ($status == "pending") {
                        $btn_color = "btn-error";
                    } else if ($status == "paid out") {
                        $btn_color = "btn-info";
                    } else if ($status == "successful") {
                        $btn_color = "btn-success";
                    } else if ($status == "refunded") {
                        $btn_color = "btn-disabled";
                    } else {
                        $btn_color = "btn-warning";
                    }
                    ?>
                <td><span class="capitalize btn btn-sm cursor-auto <?= $btn_color ?>"><?= $status ?></span></td>
                <td>
                    <label for="delete-modal-<?= $index ?>" class="btn btn-sm btn-ghost">delete</label>
                    <a href="detail.php?id=<?= $order['id_pembeli'] ?>" class="btn btn-sm">detail</a>
                </td>
            </tr>


            <input type="checkbox" id="delete-modal-<?= $index ?>" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle">
                <div action="" method="post" class="modal-box">
                    <h3 class="font-bold text-xl">Delete Confirmation</h3>
                    <p class="py-4 text-lh">WARNING! Are you sure you want to delete this transaction data</p>
                    <div class="modal-action">
                        <form action="" method="post">
                            <input type="number" name="transaction-id" class="hidden"
                                value="<?= $order['id_pembeli'] ?>" />
                            <button type="submit" class="btn btn-sm btn-ghost" name="submit-delete-btn">Yes</button>
                        </form>
                        <label for="delete-modal-<?= $index ?>" class="btn btn-sm">No</label>
                    </div>
                </div>
            </div>
            <?php $index++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php require './templates/footer.php'; ?>