<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">

            <h2 class="mt-2">List Orang</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($orang as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td><a href="" class="btn btn-primary">More Info</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang, orang_pagination'); ?>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>