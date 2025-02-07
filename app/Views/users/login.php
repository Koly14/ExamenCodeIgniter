<section class="container p-2">
    <?= $error?>
    <br>
        <h2><?= esc($title)?></h2>
    <br>

    <?= session()->getFlashdata("error") ?>
    <?= validation_list_errors()?>

    <form action="<?= base_url('admin/login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="text" name="username" value="<?= set_value('username') ?>">
        <br>
        <label for="password">Password</label>
        <input type="text" name="password" value="<?= set_value('password') ?>">
        <br><br>
        <div class="tex-center">
            <input type="submit" name="submit" value="login">
        </div>
    </form>
</section>
<br><br>

<div class="container">
        <a href="<?= base_url('admin/registerForm') ?>">Add User</a>
        <br><br>
        <a href="<?=base_url('/')?>">Back 7Wonders</a>

</div>