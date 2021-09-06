<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Contact Us</h2>
            <?php foreach ($alamat as $a) : ?>
                <ul>
                    <li>
                        <?= $a['tipe']; ?>
                        <?= $a['alamat']; ?>
                        <?= $a['kota']; ?>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>