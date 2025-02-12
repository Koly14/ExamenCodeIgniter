<section class="container p-2">

    <br>
    <h2><?= esc($title)?></h2>
    <br>

    <?= session()->getFlashdata("error") ?>
    <?= validation_list_errors()?>

    <!-- El action="URL del routes que ejecuta el -> post()" -->
    <form action="<?= base_url('admin/wonders/update/updated/'.$wonder['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="wonder">Wonder</label>
        <input type="text" name="wonder" value="<?= esc($wonder['wonder']) ?>">
        <br>

        <label for="location">Location</label>
        <input type="text" name="location" value="<?= esc($wonder['location']) ?>">
        <br><br>

        <h3>IMAGEN ACTUAL</h3>
        <img src="<?= base_url('assets/img/'.$wonder['imagen'])?>" width="200">
        <input type="hidden" name="img_actual" value="<?=$wonder['imagen']?>">

        <br><br>
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen">

        <br><br>
        <div class="tex-center">
            <input type="submit" name="submit" value="Edit">
        </div>
    </form>
</section>
<br><br>

<div class="container">
    <a href="<?=base_url('admin/wonders')?>">Back</a>
</div>