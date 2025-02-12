<section class="container p-2">

    <br>
    <h2><?= esc($title)?></h2>
    <br>

    <?= session()->getFlashdata("error") ?>
    <?= validation_list_errors()?>

    <!-- El action="URL del routes que ejecuta el -> post()" -->
    <form action="<?= base_url('admin/wonders/create') ?>" method="post" enctype="multipart/form-data">
        <!-- Necesario ** enctype="multipart/form-data" ** Para el $_FILES[][] -->
         
        <?= csrf_field() ?>

        <label for="wonder">Wonder</label>
        <input type="text" name="wonder" value="<?= set_value('wonder') ?>">
        <br>
        <label for="location">Location</label>
        <input type="text" name="location" value="<?= set_value('location') ?>">
        <br>
        <!-- Las imagenes type="file" no guardan la imaen anterior con set_value  -->
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen">
        <br><br>
        <div class="tex-center">
            <input type="submit" name="submit" value="Create">
        </div>

    </form>
</section>
<br><br>

<div class="container">
    <a href="<?=base_url('admin/wonders')?>">Back</a>
</div>