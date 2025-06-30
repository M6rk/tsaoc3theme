document.addEventListener('DOMContentLoaded', function() {
    console.log('Theme JS loaded'); // Debug line
    
    // Search form management
    function clearSearchForm() {
        const searchInput = document.querySelector('.search-bar');
        if (searchInput) {
            // Only clear if not on a search results page
            if (!window.location.search.includes('s=') && !document.body.classList.contains('search')) {
                searchInput.value = '';
            }
        }
    }
    // Clear search form on page load
    clearSearchForm();
    // Clear search form when clicking navigation links
    const navLinks = document.querySelectorAll('nav a:not(.search-form a)');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            setTimeout(clearSearchForm, 100);
        });
    });
    // Handle browser navigation (back/forward)
    window.addEventListener('popstate', function() {
        setTimeout(clearSearchForm, 100);
    });
    // On tab return
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            clearSearchForm();
        }
    });
});