<?php require __DIR__ . '/../layout/header.php'; ?>

<h2><?= $editProject ? 'Edit Penelitian Dosen' : 'Data Penelitian Dosen' ?></h2>
<form method="POST" action="index.php?page=research&action=<?= $editProject ? 'update' : 'store' ?>">
    <?php if ($editProject): ?>
        <input type="hidden" name="id" value="<?= (int) $editProject['id'] ?>">
    <?php endif; ?>

    <select name="lecturer_id" required>
        <option value="">-- Pilih Ketua Peneliti --</option>
        <?php foreach ($lecturers as $lecturer): ?>
            <?php $selectedId = $editProject['lecturer_id'] ?? null; ?>
            <option value="<?= (int) $lecturer['id'] ?>" <?= ((int) $selectedId === (int) $lecturer['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($lecturer['name']) ?> (<?= htmlspecialchars($lecturer['department']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="title" placeholder="Judul Penelitian"
           value="<?= htmlspecialchars($editProject['title'] ?? '') ?>" required>
    <input type="number" name="year" min="1990" max="2099"
           value="<?= htmlspecialchars($editProject['year'] ?? date('Y')) ?>" required>
    <input type="text" name="funding_source" placeholder="Sumber Dana"
           value="<?= htmlspecialchars($editProject['funding_source'] ?? '') ?>" required>

    <?php $currentStatus = $editProject['status'] ?? 'planned'; ?>
    <select name="status">
        <option value="planned" <?= $currentStatus === 'planned' ? 'selected' : '' ?>>planned</option>
        <option value="ongoing" <?= $currentStatus === 'ongoing' ? 'selected' : '' ?>>ongoing</option>
        <option value="completed" <?= $currentStatus === 'completed' ? 'selected' : '' ?>>completed</option>
    </select>

    <button type="submit"><?= $editProject ? 'Simpan Perubahan' : 'Tambah Penelitian' ?></button>
    <?php if ($editProject): ?>
        <a href="index.php?page=research">Batal</a>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul Penelitian</th>
            <th>Tahun</th>
            <th>Sumber Dana</th>
            <th>Status</th>
            <th>Dosen</th>
            <th>Departemen</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project['id']) ?></td>
                <td><?= htmlspecialchars($project['title']) ?></td>
                <td><?= htmlspecialchars($project['year']) ?></td>
                <td><?= htmlspecialchars($project['funding_source']) ?></td>
                <td><?= htmlspecialchars($project['status']) ?></td>
                <td><?= htmlspecialchars($project['lecturer_name']) ?></td>
                <td><?= htmlspecialchars($project['department']) ?></td>
                <td>
                    <a href="index.php?page=research&edit_id=<?= (int) $project['id'] ?>">Edit</a> |
                    <a href="index.php?page=research&action=delete&id=<?= (int) $project['id'] ?>"
                       onclick="return confirm('Hapus penelitian ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>