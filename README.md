# Sistema de Gerenciamento de Tarefas

Um sistema desenvolvido em **PHP** para auxiliar na organização de atividades diárias, promovendo produtividade e facilitando o acompanhamento de pendências para indivíduos e pequenas equipes.

---

## 📜 Proposta

O **Sistema de Gerenciamento de Tarefas** oferece uma plataforma simples e eficiente para criação, edição e monitoramento de atividades. Ideal para quem busca melhorar sua organização pessoal ou para pequenas equipes que precisam de uma ferramenta acessível de gestão.

---

## 🌟 Recursos Principais

- **📝 Criação de Tarefas**: Adicione novas tarefas com descrições e prioridades.
- **📋 Listagem de Tarefas**: Visualize todas as tarefas em uma lista organizada.
- **✏️ Edição e Atualização**: Edite detalhes de uma tarefa a qualquer momento.
- **✅ Marcação de Status**: Marque tarefas como "Concluídas" ou "Pendentes".
- **🔍 Filtro por Prioridade e Data**: Visualize rapidamente tarefas de alta prioridade.

---

## 🎯 Público-Alvo

Este sistema é ideal para:
- Usuários individuais que buscam melhorar a organização e produtividade.
- Pequenas equipes que precisam de uma maneira simples e eficaz de acompanhar atividades e cumprir prazos.

---

## 🛠️ Tecnologias Utilizadas

- **Linguagem**: PHP
- **Banco de Dados**: MySQL
- **Front-end**: HTML, CSS e JavaScript (opcionalmente, com Bootstrap para responsividade)

---

## 🧩 Diagrama ER do Banco de Dados

![Modelo Lógico](https://github.com/user-attachments/assets/e60d7863-9e55-4f8b-928b-1919abff97eb)

---

# Documentação da API

Esta API permite gerenciar usuários e tarefas em um sistema de gestão de tarefas. A API está dividida em dois principais grupos de endpoints: **Usuários** e **Tarefas**.

## Endpoints de Usuários

### 1. Listar Todos os Usuários

- **Rota**: `/users`
- **Método HTTP**: `GET`
- **Descrição**: Retorna uma lista com todos os usuários cadastrados.

### 2. Obter Detalhes de um Usuário

- **Rota**: `/users/{id}`
- **Método HTTP**: `GET`
- **Descrição**: Retorna as informações de um usuário específico.
- **Parâmetros**:
  - `id` (integer) - ID do usuário que deseja consultar.

### 3. Criar um Novo Usuário

- **Rota**: `/users`
- **Método HTTP**: `POST`
- **Descrição**: Cria um novo usuário no sistema.
- **Corpo da Requisição (JSON)**:
  ```json
  {
    "nome": "Nome do Usuário",
    "email": "usuario@example.com",
    "senha": "senha_do_usuario"
  }

### 4. Atualizar um Usuário

- **Rota**: `/users/{id}`
- **Método HTTP**: `PUT`
- **Descrição**: Atualiza as informações de um usuário existente.
- **Parâmetros**:
  - `id` (integer) - ID do usuário que deseja atualizar.
- **Corpo da Requisição (JSON)**:
  ```json
  {
    "nome": "Novo Nome",
    "email": "novo_email@example.com",
    "senha": "nova_senha"
  }

## Endpoints de Tarefas

### 1. Listar Tarefas por Usuário

- **Rota**: `/tasks/{id}`
- **Método HTTP**: `GET`
- **Descrição**: Retorna todas as tarefas associadas a um usuário específico.
- **Parâmetros**:
  - `id` (integer) - ID do usuário cujas tarefas deseja listar.

### 2. Obter Detalhes de uma Tarefa

- **Rota**: `/task/{id}`
- **Método HTTP**: `GET`
- **Descrição**: Retorna as informações de uma tarefa específica.
- **Parâmetros**:
  - `id` (integer) - ID da tarefa que deseja consultar.

### 3. Criar uma Nova Tarefa

- **Rota**: `/tasks`
- **Método HTTP**: `POST`
- **Descrição**: Cria uma nova tarefa no sistema.
- **Corpo da Requisição (JSON)**:
  ```json
  {
    "titulo": "Título da Tarefa",
    "descricao": "Descrição detalhada da tarefa",
    "usuario_id": 1,
    "status": "pendente"
  }

