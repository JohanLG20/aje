function toggleFilterModal() {
    document.getElementById('filterModal').classList.toggle('hidden');
    document.getElementById('filterModal').classList.toggle('visible');
    document.getElementById('filterOverlay').classList.toggle('hidden');
    document.getElementById('filterOverlay').classList.toggle('visible');
}

function applyFilters() {
    toggleFilterModal();
}