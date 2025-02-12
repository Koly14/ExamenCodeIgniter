<section class="container p-3">

    <h2><?= esc($title)?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors()?>
    <br><br>

    <?php if($fact !== []):?>
<!-- Dentro del action ponemos la ruta a la que mediante post ejecutará la inserción -->
        <form action="<?= base_url('admin/facts/update/updated/'.$fact['fact_id'])?>" method="post">
            <?= csrf_field()?>

            <label for="fact">Fact</label>
            <input type="input" name="fact_text" size="150" value="<?= esc($fact['fact_text'])?>">
            <br>

<!-- El Select es de la tabla Wonders pero insertamos el numero del wonder con el nombre que tiene en Facts -->
            <label for="wonders">Wonder</label>
<!--Lo que añadimos realmente en FACTS, es el ID de la maravilla ['wonder_id'] de Facts y no ['id'] que es como se llama en Wonders-->
            <select name="wonder_id">
            <?php if($wonders !== []):?>
                <?php foreach($wonders as $wonder):?> 
                    <option value="<?= $wonder['id']?>" <?= $wonder['id'] == $fact['wonder_id']? 'selected' : '' ?> >
                    <!--Nombre de la maravilla para mostrar-->
                        <?= $wonder['wonder']?>
                    </option>
                <?php endforeach?>
            <?php endif?>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Update fact">
        </form>
    <?php endif ?>

    <br><br>
    <a href="<?= base_url('admin/facts')?>">Back</a>

</section>