document.addEventListener('DOMContentLoaded', function() {
    console.log('Theme JS loaded'); // Debug line
    
    // Search form management
    function clearSearchForm() {
        const searchInput = document.querySelector('.search-bar');
        if (searchInput) {
            // Only clear if we're not on a search results page
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
    
    // Handle page visibility change (when returning to tab)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            clearSearchForm();
        }
    });

    // Mobile Hamburger Menu Functionality
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const body = document.body;

    function openMobileMenu() {
        hamburgerMenu.classList.add('active');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        body.classList.add('menu-open'); // Prevent scrolling
    }

    function closeMobileMenu() {
        hamburgerMenu.classList.remove('active');
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        body.classList.remove('menu-open'); // Re-enable scrolling
    }

    // Hamburger menu click
    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function() {
            if (mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    // Close button click
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }

    // Overlay click
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }

    // Close menu when clicking mobile nav links
    const mobileNavLinks = document.querySelectorAll('.mobile-menu a');
    mobileNavLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMobileMenu();
            setTimeout(clearSearchForm, 100);
        });
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Close menu on window resize if it gets too wide
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
});