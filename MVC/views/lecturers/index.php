<?php require __DIR__ . '/../layout/header.php'; ?>

<h2><?= $editLecturer ? 'Edit Data Dosen' : 'Data Dosen' ?></h2>
<form method="POST" action="index.php?page=lecturers&action=<?= $editLecturer ? 'update' : 'store' ?>">
    <?php if ($editLecturer): ?>
        <input type="hidden" name="id" value="<?= (int) $editLecturer['id'] ?>">
    <?php endif; ?>

    <input type="text" name="name" placeholder="Nama Dosen"
           value="<?= htmlspecialchars($editLecturer['name'] ?? '') ?>" required>
    <input type="text" name="nidn" placeholder="NIDN"
           value="<?= htmlspecialchars($editLecturer['nidn'] ?? '') ?>" required>
    <input type="email" name="email" placeholder="Email"
           value="<?= htmlspecialchars($editLecturer['email'] ?? '') ?>" required>
    <input type="text" name="department" placeholder="Program Studi / Departemen"
           value="<?= htmlspecialchars($editLecturer['department'] ?? '') ?>" required>
    <input type="text" name="phone" placeholder="No. Telepon"
           value="<?= htmlspecialchars($editLecturer['phone'] ?? '') ?>" required>
    <input type="date" name="join_date"
           value="<?= htmlspecialchars($editLecturer['join_date'] ?? '') ?>" required>

    <button type="submit"><?= $editLecturer ? 'Simpan Perubahan' : 'Tambah Dosen' ?></button>
    <?php if ($editLecturer): ?>
        <a href="index.php?page=lecturers">Batal</a>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIDN</th>
            <th>Email</th>
            <th>Departemen</th>
            <th>Telepon</th>
            <th>Tanggal Bergabung</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lecturers as $lecturer): ?>
            <tr>
                <td><?= htmlspecialchars($lecturer['id']) ?></td>
                <td><?= htmlspecialchars($lecturer['name']) ?></td>
                <td><?= htmlspecialchars($lecturer['nidn']) ?></td>
                <td><?= htmlspecialchars($lecturer['email']) ?></td>
                <td><?= htmlspecialchars($lecturer['department']) ?></td>
                <td><?= htmlspecialchars($lecturer['phone']) ?></td>
                <td><?= htmlspecialchars($lecturer['join_date']) ?></td>
                <td>
                    <a href="index.php?page=lecturers&edit_id=<?= (int) $lecturer['id'] ?>">Edit</a> |
                    <a href="index.php?page=lecturers&action=delete&id=<?= (int) $lecturer['id'] ?>"
                       onclick="return confirm('Hapus dosen ini? Mata kuliah & penelitian terkait juga akan terhapus.')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>