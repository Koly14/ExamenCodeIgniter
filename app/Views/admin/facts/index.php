<section>
    <!-- TO DO  -->
    <h2><?= esc($title) ?></h2> <!-- Aqui accede a $data['title'] que es igual a = 'News archive' -->

    <?php if ($facts !== []): ?>

        <?php foreach ($facts as $fact): ?>    <!-- Aqui accede a $data['news_list'] que es la que tiene la función de todas las noticias en News.php function index -->

            <h3><?= esc($fact['fact_text']) ?></h3>    

            <div class="main">
                <?= esc($fact['body']) ?>
            </div>

            <h4>Category: <?=esc($fact["category"])?></h4>

            <p>
                <a href="<?= base_url('news/'.$fact['slug']) ?>">View article</a>
                &nbsp;  <!-- Es una espaciado como la barra espaciadora -->

                <a href="<?=base_url('news/delete/'.$fact['id'])?>">Delete New</a>
                &nbsp;  <!-- Es una espaciado como la barra espaciadora -->

                <a href="<?=base_url('news/update/'.$newfacts_item['id'])?>">Update New</a>
            </p>

        <?php endforeach ?>

    <?php else: ?>

        <h3>No News</h3>

        <p>Unable to find any news for you.</p>

    <?php endif ?>

    <br><br>
    <a href="<?= base_url('news/new')?>"> Add New</a>

</section>