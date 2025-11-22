 const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('reservasiTable');
    const rows = tableBody.querySelectorAll('tr');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });