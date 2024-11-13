<?php displayFlashMessage(); ?>

<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
<?php displayFlashMessage(); ?>
    <h2>Criar Novo Usuário</h2>
    <form action="/users/store" method="POST">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success">Criar Usuário</button>
        <a href="/users" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
