<?php
session_start();

if (!isset($_SESSION['login-status'])) {
    $_SESSION['login-status'] = false;
}

require '../src/functions.php';

if (isset($_POST['btn-submit'])) {
    $admin = login($_POST);
    if ($admin) {
        $_SESSION['login-status'] = true;
        $_SESSION['a_global'] = $admin;
        $_SESSION['id'] = $admin->admin_id;
        header('Location: dashboard.php');
        exit;
    }
}

$captcha_code = substr(md5(rand()), 0, 7);

?>

<?php require "./templates/header.php" ?>
<?php require "./templates/navbar.php" ?>
<div class="hero min-h-screen">
    <div class="hero-content flex-col lg:flex-row-reverse lg:gap-10">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Admin Login</h1>
            <p class="py-6 text-xl max-w-2xl">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
                excepturi
                exercitationem
                quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
        </div>
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <form action="" method="post" class="card-body">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username / Email</span>
                    </label>
                    <input type="text" placeholder="username / email" class="input input-bordered" name="umail"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="password" class="input input-bordered" name="password"
                        required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg"><s><?= $captcha_code ?></s></span>
                    </label>
                    <input type="text" class="hidden" value="<?= $captcha_code ?>" name="captcha-code">
                    <input type="text" placeholder="captcha code" class="input input-bordered" name="captcha-input"
                        required />
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary" name="btn-submit">Login</button>
                    <label class="label">
                        <a href="registration.php" class="label-text-alt link link-hover text-base">New user admin? Sign
                            Up</a>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "./templates/footer.php" ?>