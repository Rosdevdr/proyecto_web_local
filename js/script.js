// Búsqueda en libros
const searchBooks = document.getElementById('searchBooks');
if (searchBooks) {
    searchBooks.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('#librosTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });
}

// Búsqueda en autores
const searchAuthors = document.getElementById('searchAuthors');
if (searchAuthors) {
    searchAuthors.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('#autoresTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });
}

// Marcar nav activo
document.querySelectorAll('.nav-link').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active');
    }
});