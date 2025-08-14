<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Okanagan Central Salvation Army</title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="navbar">
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo2.png" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo">
        </a>
      </div>
      <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="search-container">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
          <input class="search-bar" type="search" name="s" placeholder="<?php _e('Search...', 'tsaoc3theme'); ?>"
            value="<?php echo get_search_query(); ?>" />
        </div>
      </form>
      <div class="navbar-right">
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
      <!-- Desktop Navigation -->
      <div class="nav-menu-container">
        <?php wp_nav_menu(['theme_location' => 'primary']); ?>
      </div>

      <!-- Mobile Hamburger Menu -->
      <div class="hamburger-menu" id="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <a href="https://donate.salvationarmy.ca/page/62730/donate/1?location=Kelowna%20Community%20Church%2C%20Family%20Life&_ga=2.4114931.256822489.1595245103-509954737.1571324167" target="_blank" class="donate-button">Donate</a>
    </nav>
  </header>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobile-menu">
    <button class="mobile-menu-close" id="mobile-menu-close">&times;</button>
    
    <!-- Search form in mobile menu -->
    <div class="mobile-search">
      <form class="mobile-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="mobile-search-container">
          <svg class="mobile-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
          <input class="mobile-search-bar" type="search" name="s" placeholder="<?php _e('Search...', 'tsaoc3theme'); ?>" value="<?php echo is_search() ? get_search_query() : ''; ?>" />
        </div>
      </form>
    </div>
    
    <!-- Navigation menu -->
    <?php wp_nav_menu([
      'theme_location' => 'primary',
      'container' => false,
      'menu_class' => 'mobile-nav-menu'
    ]); ?>
  </div>