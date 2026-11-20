<?php require __DIR__ . '/../layout/header.php'; ?>

<h2><?= $editCourse ? 'Edit Mata Kuliah' : 'Data Mata Kuliah' ?></h2>
<form method="POST" action="index.php?page=courses&action=<?= $editCourse ? 'update' : 'store' ?>">
    <?php if ($editCourse): ?>
        <input type="hidden" name="id" value="<?= (int) $editCourse['id'] ?>">
    <?php endif; ?>

    <select name="lecturer_id" required>
        <option value="">-- Pilih Dosen Pengampu --</option>
        <?php foreach ($lecturers as $lecturer): ?>
            <?php $selectedId = $editCourse['lecturer_id'] ?? null; ?>
            <option value="<?= (int) $lecturer['id'] ?>" <?= ((int) $selectedId === (int) $lecturer['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($lecturer['name']) ?> (<?= htmlspecialchars($lecturer['department']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="course_code" placeholder="Kode MK"
           value="<?= htmlspecialchars($editCourse['course_code'] ?? '') ?>" required>
    <input type="text" name="course_name" placeholder="Nama Mata Kuliah"
           value="<?= htmlspecialchars($editCourse['course_name'] ?? '') ?>" required>
    <input type="number" name="credits" min="1" max="10"
           value="<?= htmlspecialchars($editCourse['credits'] ?? 2) ?>" required>
    <input type="text" name="semester" placeholder="Semester (mis. Ganjil 2026/2027)"
           value="<?= htmlspecialchars($editCourse['semester'] ?? '') ?>" required>

    <button type="submit"><?= $editCourse ? 'Simpan Perubahan' : 'Tambah Mata Kuliah' ?></button>
    <?php if ($editCourse): ?>
        <a href="index.php?page=courses">Batal</a>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Dosen Pengampu</th>
            <th>Departemen</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= htmlspecialchars($course['id']) ?></td>
                <td><?= htmlspecialchars($course['course_code']) ?></td>
                <td><?= htmlspecialchars($course['course_name']) ?></td>
                <td><?= htmlspecialchars($course['credits']) ?></td>
                <td><?= htmlspecialchars($course['semester']) ?></td>
                <td><?= htmlspecialchars($course['lecturer_name']) ?></td>
                <td><?= htmlspecialchars($course['department']) ?></td>
                <td>
                    <a href="index.php?page=courses&edit_id=<?= (int) $course['id'] ?>">Edit</a> |
                    <a href="index.php?page=courses&action=delete&id=<?= (int) $course['id'] ?>"
                       onclick="return confirm('Hapus mata kuliah ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>