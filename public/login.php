<?php

?>

<?php require "./templates/header.php" ?>
<?php require "./templates/navbar.php" ?>
<div class="hero min-h-screen">
    <div class="hero-content flex-col">
        <div class="text-center ">
            <h1 class="text-5xl font-bold">Admin Login</h1>
            <p class="py-6 text-xl max-w-2xl">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
                excepturi
                exercitationem
                quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
        </div>
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="text" placeholder="email" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="text" placeholder="password" class="input input-bordered" />
                    <label class="label">
                        <a href="#" class="label-text-alt link link-hover">New user admin?</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "./templates/footer.php" ?>