<section class="container p-3">

    <h2><?= esc($title)?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors()?>
    <br><br>

    <!-- Dentro del action ponemos la ruta a la que mediante post ejecutará la inserción -->
    <form action="<?= base_url('admin/facts/create')?>" method="post" enctype="multipart/form-data">
        <?= csrf_field()?>

        <label for="facts">Facts</label>
        <input type="input" name="fact_text" value="<?= set_value('fact_text')?>">
        <br>

        <label for="wonders">Wonder</label>
        <select name="wonder_id"> <!--Lo que añadimos realmente en FACTS, es el ID de la maravilla ['wonder_id']-->
        <?php if($wonders !== []):?>
            <?php foreach($wonders as $wonder):?>
                <option value="<?= $wonder['id']?>"> <!--el id la maravilla como valor a añadir en FACTS-->
                    <?= $wonder['wonder']?> <!--Nombre de la maravilla para mostrar-->
                </option>
            <?php endforeach?>
        <?php endif?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="create a new fact">
    </form>

    <br><br>
    <a href="<?= base_url('admin/facts')?>">Back</a>

</section>