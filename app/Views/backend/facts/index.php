<section class="container p-3">
    <!-- TO DO  -->
     <div class="text-center">
        <h2><?= esc($titulo) ?></h2> <!-- Aqui accede a $data['title'] que es igual a = 'News archive' -->
     </div>
    <br><br>

    <?php if ($facts !== []): ?>

        <?php foreach ($facts as $fact): ?>    <!-- Aqui accede a $data['news_list'] que es la que tiene la función de todas las noticias en News.php function index -->

            <h3><?= esc($fact['fact_text']) ?></h3>    
            <div class="main">
                <!-- Gracias al Join podemos acceder al nombre de la Maravilla -->
                <?= esc($fact['wonder']) ?>
            </div>
            <br>
            <?php
            $session = session();
            if(!empty($session->get('user'))): ?>

                <p>
                    <a href="<?=base_url('admin/facts/delete/'.$fact['fact_id'])?>">Delete Fact</a>
                    &nbsp;  <!-- Es una espaciado como la barra espaciadora -->

                    <a href="<?=base_url('admin/facts/update/'.$fact['fact_id'])?>">Update Fact</a>
                </p>
                
            <?php endif ?>
            <br>
        <?php endforeach ?>

    <?php else: ?>

        <h3>No Facts</h3>

        <p>Unable to find any Facts for you.</p>

    <?php endif ?>

    <br><br>
    <a href="<?= base_url('admin/facts/newForm')?>"> Add Fact</a>

</section>