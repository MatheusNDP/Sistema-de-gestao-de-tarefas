// src/routes/routes.php
<?php


function route($method, $uri, $callback) {
    $uri = trim($uri, '/');
    if ($_SERVER['REQUEST_METHOD'] === strtoupper($method) && $_SERVER['REQUEST_URI'] === "/$uri") {
        $callback();
    }
}


route('GET', '', function() {
    include '../src/views/home.php'; // Página inicial
});

route('GET', 'tasks', function() {
    include '../src/views/tasks.php'; // Página de tarefas
});


