<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Comics/create" class="btn btn-info mb-2 mt-4 text-white">Add Assignment</a>
            <h2 class="mt-2">List Assignment</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>

                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>

            <?php endif; ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Task</th>
                        <th scope="col">id Course</th>
                        <th scope="col">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($Assignment as $a) : ?>
                        <tr>
                            <td><?= $a['assignment_id']; ?></td>
                            <td><?= $a['description']; ?></td>
                            <td><?= $a['id']; ?></td>
                            <td><?= $a['due_date']; ?></td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>