<section class="container p-4">

    <h2 class="text-center"><?= esc($title) ?></h2>
    <br><br>
    <?php if ($wonders !== []): ?>

        <?php foreach ($wonders as $wonder): ?>

            <h3><?= esc($wonder['wonder']) ?></h3>
            <img src="<?= base_url('/assets/img/'.$wonder['imagen'])?>" width="200" alt="<?=$wonder['imagen']?>">
            <br>
            <p>
                <?= esc($wonder['location']) ?>
            </p>
            <br>
            <p>
                <a href="<?= base_url('admin/wonders/detail/'.$wonder['id']) ?>">View Wonder</a>
            </p>

        <?php endforeach ?>

    <?php else: ?>

        <h3>No Wonders</h3>

        <p>Unable to find any Wonders for you.</p>

    <?php endif ?>

    <br><br><br>
    <a href="<?= base_url('admin/wonders/newForm')?>">Add Wonder</a>
    <br><br><br>
    <a href="<?= base_url('admin/adminArea')?>">Back</a>

    
</section>