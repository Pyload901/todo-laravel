import './bootstrap';

window.editar = function(elementId) {
    console.log('Editing element with ID:', elementId);
    let form = document.getElementById(`form-${elementId}`);
    let todo = document.getElementById(`todo-${elementId}`);
    if (form) {
        form.classList.toggle('hidden');
    }
    if (todo) {
        todo.classList.toggle('hidden');
    }
};