<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Comics/create" class="btn btn-info mb-2 mt-4 text-white">Add Course</a>
            <h2 class="mt-2">List Course</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>

                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>

            <?php endif; ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">List</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($Comics as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $c['sampul']; ?>" alt="sampul" class="cover"></td>
                            <td><?= $c['judul']; ?></td>
                            <td><a href="/comics/<?= $c['slug']; ?>" class="btn btn-primary">Assignment</a></td>
                            <td> <a href="/Comics/edit/<?= $c['slug']; ?>" class="btn btn-warning">Edit Course</a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>