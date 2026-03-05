<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced Todo</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-6">
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">📝 Todo Manager</h1>
        <button onclick="openModal()"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Add Todo
        </button>
    </div>

    <!-- SEARCH + FILTER -->
    <div class="flex flex-wrap gap-3 mb-4">
        <input id="search"
            oninput="renderTodos()"
            placeholder="Search todo..."
            class="border rounded-lg px-3 py-2 flex-1">

        <select id="filter"
            onchange="renderTodos()"
            class="border rounded-lg px-3 py-2">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <!-- PROGRESS -->
    <div class="mb-4">
        <div class="flex justify-between text-sm mb-1">
            <span>Progress</span>
            <span id="progressText">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div id="progressBar"
                class="bg-green-500 h-3 rounded-full transition-all"
                style="width:0%"></div>
        </div>
    </div>

    <!-- TODO LIST -->
    <ul id="todoList" class="space-y-2"></ul>

    <!-- PAGINATION -->
    <div class="flex justify-center gap-2 mt-6" id="pagination"></div>
</div>

<!-- ADD / EDIT MODAL -->
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-full max-w-md">
        <h2 id="modalTitle" class="text-xl font-bold mb-4">Add Todo</h2>
        <input id="todoInput"
            class="border w-full rounded-lg p-2 mb-4"
            placeholder="Todo title">
        <div class="flex justify-end gap-2">
            <button onclick="closeModal()" class="border px-4 py-2 rounded-lg">Cancel</button>
            <button onclick="saveTodo()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Save
            </button>
        </div>
    </div>
</div>

<script>
let todos = JSON.parse(localStorage.getItem('todos')) || [];
let page = 1;
let perPage = 5;
let editIndex = null;
let dragIndex = null;

function saveStorage() {
    localStorage.setItem('todos', JSON.stringify(todos));
}

function openModal() {
    editIndex = null;
    todoInput.value = '';
    modalTitle.innerText = 'Add Todo';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    modal.classList.add('hidden');
}

function saveTodo() {
    const value = todoInput.value.trim();
    if (!value) return;

    if (editIndex !== null) {
        todos[editIndex].title = value;
        showToast('Todo updated successfully ✨', 'info');
    } else {
        todos.push({ title: value, completed: false });
        showToast('Todo added successfully ✅');
    }

    localStorage.setItem('todos', JSON.stringify(todos));
    closeModal();
    renderTodos();
}

function renderTodos() {
    const list = document.getElementById('todoList');
    const search = document.getElementById('search').value.toLowerCase();
    const filter = document.getElementById('filter').value;

    let filtered = todos.filter(t =>
        t.title.toLowerCase().includes(search)
    );

    if (filter === 'active') filtered = filtered.filter(t => !t.completed);
    if (filter === 'completed') filtered = filtered.filter(t => t.completed);

    const totalPages = Math.ceil(filtered.length / perPage);
    page = Math.min(page, totalPages || 1);

    const start = (page - 1) * perPage;
    const paginated = filtered.slice(start, start + perPage);

    list.innerHTML = '';
    paginated.forEach((todo, index) => {
        const realIndex = todos.indexOf(todo);

        list.innerHTML += `
        <li draggable="true"
            ondragstart="dragIndex=${realIndex}"
            ondragover="event.preventDefault()"
            ondrop="dropTodo(${realIndex})"
            class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
            <div class="flex items-center gap-3">
                <input type="checkbox"
                    ${todo.completed ? 'checked' : ''}
                    onchange="toggle(${realIndex})">
                <span class="${todo.completed ? 'line-through text-gray-400' : ''}">
                    ${todo.title}
                </span>
            </div>
            <div class="flex gap-2">
                <button onclick="edit(${realIndex})" class="text-blue-600">Edit</button>
                <button onclick="del(${realIndex})" class="text-red-600">Delete</button>
            </div>
        </li>`;
    });

    renderPagination(totalPages);
    updateProgress();
}

function toggle(i) {
    todos[i].completed = !todos[i].completed;
    saveStorage();
    renderTodos();
}

function edit(i) {
    editIndex = i;
    todoInput.value = todos[i].title;
    modalTitle.innerText = 'Edit Todo';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function del(i) {
    todos.splice(i, 1);
    localStorage.setItem('todos', JSON.stringify(todos));
    showToast('Todo deleted 🗑️', 'info');
    renderTodos();
}

function dropTodo(i) {
    const temp = todos[dragIndex];
    todos.splice(dragIndex, 1);
    todos.splice(i, 0, temp);
    saveStorage();
    renderTodos();
}

function renderPagination(total) {
    const p = document.getElementById('pagination');
    p.innerHTML = '';
    for (let i = 1; i <= total; i++) {
        p.innerHTML += `
            <button onclick="page=${i};renderTodos()"
                class="px-3 py-1 rounded-lg
                ${page === i ? 'bg-blue-600 text-white' : 'border'}">
                ${i}
            </button>`;
    }
}

function updateProgress() {
    const done = todos.filter(t => t.completed).length;
    const percent = todos.length ? Math.round((done / todos.length) * 100) : 0;
    progressBar.style.width = percent + '%';
    progressText.innerText = percent + '%';
}


function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const msg = document.getElementById('toastMessage');

    toast.className =
        'fixed top-5 right-5 px-4 py-3 rounded-lg shadow-lg text-white transition-all';

    toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-blue-600');
    msg.innerText = message;

    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 2000);
}

renderTodos();
</script>

<!-- TOASTER -->
<div id="toast"
    class="fixed top-5 right-5 hidden px-4 py-3 rounded-lg shadow-lg text-white transition-all">
    <span id="toastMessage"></span>
</div>
</body>
</html>
