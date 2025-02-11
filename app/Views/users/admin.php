<section class="container p-2">

    <div class="row p-2">
        <?php 
                $session = session();
                echo "Bienvenido ".$session->get('user');
        ?>
    </div>

    <div class="row p-2">
        <div class="d-flex justify-content-center">
            <img src="<?= base_url('assets/img/login.jpg')?>" alt="">
        </div>
    </div>
    <br><br>
    <div class="row p-2">
        <h3 class="text-center">TABLES MANAGEMENT</h3>
        <br><br>
        <div class="d-flex align-content-center justify-content-center">
            <a href="<?= base_url('admin/wonders') ?>" class="btn btn-outline-primary">WONDERS</a>
            <a href="<?= base_url('admin/facts') ?>" class="btn btn-outline-primary">FACTS</a>
            <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-primary">USERS</a>
        </div>
    </div>

</section>