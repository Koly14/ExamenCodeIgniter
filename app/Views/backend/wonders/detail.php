<section class="container p-4">


    <h2><?= esc($wonder_selected['wonder'])?></h2>
    <p><?= esc($wonder_selected['location'])?></p>
    <p><img src="<?= base_url('assets/img/'.$wonder_selected['imagen'])?>" width="400"></p>

    <p>
        <a href="<?=base_url('admin/wonders/delete/'.$wonder_selected['id'])?>">Delete Wonder</a>
        &nbsp;
        <a href="<?=base_url('admin/wonders/update/'.$wonder_selected['id'])?>">Update Wonder</a>
    </p>

    <br><br>
    <a href="<?= base_url('admin/wonders')?>">Back</a>

</section>