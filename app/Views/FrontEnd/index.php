<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-12 col-md-12 mx-auto">
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
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php if ($wonders !== []): ?>
          <?php foreach ($wonders as $wonder): ?>
            <div class="col">
              <div class="card shadow">
                <a href="<?= base_url('wonder/' . $wonder['id']) ?>">
                  <img class="bd-placeholder-img card-img-top" width="100%" height="200" src="<?= base_url('assets/img/' . $wonder['imagen']) ?>">
                </a>
                <div class="card-body">
                  <h5 class="card-text"><?= $wonder["wonder"] ?></h5>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        <?php else: ?>
          <h2>NO SE ENCUENTRAN ELEMENTOS</h2>
        <?php endif ?>
      </div>
    </div>
  </div>

</main>