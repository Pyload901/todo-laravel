import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.editar = function(elementId) {
    console.log('Editing element with ID:', elementId);
    let el = document.getElementById(elementId);
    let todoId = elementId.replace('form-', '');
    let todoEl = document.getElementById('todo-' + todoId);
    
    if (el && todoEl) {
        el.classList.remove('hidden');
        todoEl.classList.add('hidden');
    }
};

window.cancelEdit = function(todoId) {
    console.log('Canceling edit for todo ID:', todoId);
    let formEl = document.getElementById('form-' + todoId);
    let todoEl = document.getElementById('todo-' + todoId);
    
    if (formEl && todoEl) {
        formEl.classList.add('hidden');
        todoEl.classList.remove('hidden');
    }
};
