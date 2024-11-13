<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Tarefas</h2>
    <a href="/tasks/create" class="btn btn-success mb-3">+ Nova Tarefa</a>

    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['id']); ?></td>
                    <td><?= htmlspecialchars($task['titulo']); ?></td>
                    <td><?= htmlspecialchars($task['descricao']); ?></td>
                    <td>
                        <?php
                        $statusClass = $task['status'] === 'concluida' ? 'badge-success' :
                                        ($task['status'] === 'em_progresso' ? 'badge-warning' : 'badge-secondary');
                        ?>
                        <span class="badge <?= $statusClass; ?>">
                            <?= htmlspecialchars($task['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="/tasks/<?= $task['id']; ?>/edit" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/tasks/<?= $task['id']; ?>/delete" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
