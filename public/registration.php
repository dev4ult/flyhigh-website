<?php

session_start();

if (!isset($_SESSION['login-status'])) {
    $_SESSION['login-status'] = false;
}

require '../src/functions.php';

if (isset($_POST['btn-submit'])) {
    if (register($_POST) > 0) {
        header('Location: index.php');
        exit;
    }
}

?>

<?php require './templates/header.php' ?>
<?php require './templates/navbar.php' ?>
<div class="hero min-h-screen">
    <div class="hero-content flex-col">
        <div class="text-center ">
            <h1 class="text-5xl font-bold">Register a new Admin</h1>
            <p class="py-6 text-xl max-w-2xl">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
                excepturi
                exercitationem
                quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
        </div>
        <div class="card flex-shrink-0 w-fit shadow-2xl bg-base-100">
            <form action="" method="post" class="card-body">
                <div class="flex gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" placeholder="username" class="input input-bordered" name="username"
                            required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" placeholder="email" class="input input-bordered" name="email" required />
                    </div>
                </div>
                <div class="flex gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" placeholder="password" class="input input-bordered" name="password"
                            required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password Confirmation</span>
                        </label>
                        <input type="password" placeholder="password confirmation" class="input input-bordered"
                            name="password-confirmation" required />

                    </div>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary" name="btn-submit">Sign Up</button>
                    <label class="label">
                        <a href="login.php" class="label-text-alt link link-hover text-base">Already have an account?
                            Login</a>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require './templates/footer.php' ?>