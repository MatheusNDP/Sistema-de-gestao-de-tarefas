<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Editar Tarefa</h2>
<form action="/tasks/<?= $task['id'] ?>" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" value="<?= htmlspecialchars($task['titulo']) ?>" required>
    <br>
    <label for="descricao">Descrição:</label>
    <textarea name="descricao"><?= htmlspecialchars($task['descricao']) ?></textarea>
    <br>
    <label for="status">Status:</label>
    <select name="status">
        <option value="pendente" <?= $task['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
        <option value="em_progresso" <?= $task['status'] == 'em_progresso' ? 'selected' : '' ?>>Em Progresso</option>
        <option value="concluida" <?= $task['status'] == 'concluida' ? 'selected' : '' ?>>Concluída</option>
    </select>
    <br>
    <button type="submit">Atualizar Tarefa</button>
</form>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
