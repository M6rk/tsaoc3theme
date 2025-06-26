<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="navbar">
      <div class="logo">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/main_logo.png" alt="Logo">
      </div>
      <form class="search-form" method="get" action="<?php echo home_url('/'); ?>">
        <div class="search-container">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
          <input class="search-bar" type="search" name="s" placeholder="Search..." />
        </div>
      </form>
      <div class="navbar-right">
        <div class="language-switcher">
          <a href="#" class="lang-btn active" data-lang="en">EN</a>
          <div class="lang-separator"></div>
          <a href="#" class="lang-btn" data-lang="fr">FR</a>
        </div>
        <div class="social-icons">
          <?php
          $social_platforms = get_social_platforms();
          foreach ($social_platforms as $platform => $data):
            $social_url = get_theme_mod("social_{$platform}_url");
            if ($social_url && $social_url !== '#'): ?>
              <a href="<?php echo esc_url($social_url); ?>" class="social-link" target="_blank"
                aria-label="<?php echo esc_attr($data['label']); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                  <path d="<?php echo esc_attr($data['path']); ?>" />
                </svg>
              </a>
            <?php endif;
          endforeach; ?>
        </div>
      </div>
    </div>
    <hr>
    <nav>
      <div class="nav-menu-container">
        <?php wp_nav_menu(['theme_location' => 'primary']); ?>
      </div>
      <a href="#" class="donate-button">Donate</a>
    </nav>
  </header>
  <script>
    // Language selection logic
    document.addEventListener('DOMContentLoaded', function () {
      const langButtons = document.querySelectorAll('.lang-btn');

      langButtons.forEach(button => {
        button.addEventListener('click', function (e) {
          e.preventDefault();
          langButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          // TODO: Language preference logic
          // const selectedLang = this.getAttribute('data-lang');
          // localStorage.setItem('selectedLanguage', selectedLang);
        });
      });
    });
  </script>