<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>


<div class="container">
    <h1>Assignment</h1>
    <a href="/Comics/create" class="btn btn-info mb-2 mt-4 text-white">Add Assigment</a>
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $Comics['sampul']; ?>" alt="" class="sampul" style="width: 100px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $Comics['judul']; ?></h5>

                            <p class="card-text"><b>Penulis :</b><?= $Comics['penulis']; ?></p>
                            <p class="card-text text-muted"><b>penerbit :</b> <?= $Comics['penerbit']; ?></p>
                            <a href="/Comics/edit/<?= $Comics['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/Comics/<?= $Comics['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>