document.addEventListener('DOMContentLoaded', () => {
    // Função para criar uma nova tarefa
    const createTaskForm = document.getElementById('createTaskForm');
    if (createTaskForm) {
        createTaskForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(createTaskForm);
            const data = Object.fromEntries(formData.entries());

            const response = await fetch('/tasks', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert("Tarefa criada com sucesso!");
                window.location.href = '/tasks';
            } else {
                alert("Erro ao criar tarefa.");
            }
        });
    }

    // Função para atualizar uma tarefa
    const editTaskForm = document.getElementById('editTaskForm');
    if (editTaskForm) {
        editTaskForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const taskId = editTaskForm.dataset.taskId;
            const formData = new FormData(editTaskForm);
            const data = Object.fromEntries(formData.entries());

            const response = await fetch(`/tasks/${taskId}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert("Tarefa atualizada com sucesso!");
                window.location.href = '/tasks';
            } else {
                alert("Erro ao atualizar tarefa.");
            }
        });
    }

    // Função para excluir uma tarefa
    document.querySelectorAll('.delete-task').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const taskId = button.dataset.taskId;
            if (confirm("Tem certeza que deseja excluir esta tarefa?")) {
                const response = await fetch(`/tasks/${taskId}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert("Tarefa deletada com sucesso!");
                    button.closest('tr').remove(); // Remove a linha da tabela
                } else {
                    alert("Erro ao deletar tarefa.");
                }
            }
        });
    });
});
