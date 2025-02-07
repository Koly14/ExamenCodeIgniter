
<section class="container p-2">
    
    <br>
        <h2><?= esc($title)?></h2>
    <br>

    <?= session()->getFlashdata('error')?>
    <?= validation_list_errors()?>

<!-- La base_url ejecuta el $routes del archivo de rutas -->
<form action="<?= base_url('admin/create')?>" method="post">
    <?= csrf_field()?>

    <label for="username">Username</label>
    <input type="text" name="username" value="<?= set_value('username')?>">
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" value="<?= set_value('password')?>">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" value="<?= set_value('email')?>">
    <br>
    <label for="rol">Rol</label>
    <input type="number" name="rol" value="<?= set_value('rol')?>">
    <br><br>
    <input type="submit" name="submit" value="Create User" >
</form>

<br><br>

<div class="container p-2">
    <a href="<?=base_url('admin/loginForm')?>">Back Login</a>
    <br><br>
    <a href="<?=base_url('/')?>">Back 7Wonders</a>
</div>


</section>