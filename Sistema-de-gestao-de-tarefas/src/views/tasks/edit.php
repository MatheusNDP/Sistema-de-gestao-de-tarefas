<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <h2>Editar Tarefa</h2>
    <form id="editTaskForm" data-task-id="<?= $task['id']; ?>">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($task['titulo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= htmlspecialchars($task['descricao']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pendente" <?= $task['status'] === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                <option value="em_progresso" <?= $task['status'] === 'em_progresso' ? 'selected' : ''; ?>>Em Progresso</option>
                <option value="concluida" <?= $task['status'] === 'concluida' ? 'selected' : ''; ?>>Concluída</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
        <a href="/tasks" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
