<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <h2>Criar Nova Tarefa</h2>
    <form id="createTaskForm">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pendente">Pendente</option>
                <option value="em_progresso">Em Progresso</option>
                <option value="concluida">Concluída</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Criar Tarefa</button>
        <a href="/tasks" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
