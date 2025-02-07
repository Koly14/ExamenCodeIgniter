<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-12 mx-auto p-2">
                <h1 class="fw-light">Seven Wonders</h1>
                <p class="lead text-body-secondary">The most Wonderful places to visit in the world</p>

                <!-- Replicar todas las maravillas para que cuando hagas click vayas a su metodo show detail -->
                <?php if ($wonders !== []): ?>
                    <?php foreach ($wonders as $wonder): ?>
                        <a href="<?= base_url('wonder/' . $wonder['id']) ?>" class="btn btn-outline-primary"><?= $wonder['wonder'] ?></a>
                    <?php endforeach ?>
                <?php else : ?>
                    <h4>ERORR AL CARGAR LOS ELEMENTOS</h4>
                <?php endif ?>
                <p>
                    <a href="<?= base_url() ?>" class="btn btn-success my-2">7 Wonders</a>
                </p>

            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container p-2">
            <div class="row mb-2">
                <?php if ($wonder_selected !== []): ?>
                    <div class="col-md-12">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col-auto d-none d-lg-block">
                                <img src="<?= base_url('assets/img/' . $wonder_selected['imagen']) ?>" class="bd-placeholder-img" width="300" height="250">
                            </div>
                            <div class="col p-4 d-flex flex-column position-static bg-dark">
                                <strong class="mb-0"><?= $wonder_selected['location'] ?></strong>
                                <h3 class="d-inline-block mb-2 text-primary-emphasis"><?= $wonder_selected['wonder'] ?></strong>
                                    <br>
                                    <h5>FACTS</h4>
                                        <!-- Hay que recorrer y recoger cada uno de los FACT-TEXT que tiene cada wonder -->
                                        <?php foreach ($wonder_facts as $fact): ?>
                                            <div>
                                                <?= $fact["fact_text"] ?>
                                            </div>
                                        <?php endforeach ?>
                            </div>

                        </div>
                    </div>
                <?php else: ?>
                    <h3>NO HAY NADA</h3>
                <?php endif ?>
            </div>

        </div>
    </div>
</main>