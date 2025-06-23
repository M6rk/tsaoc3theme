<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="navbar">
  <div class="logo">
    <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/main_logo.png" alt="Logo">
  </div>
  <form class="search-form" method="get" action="<?php echo home_url('/'); ?>">
    <input class="search-bar" type="search" name="s" placeholder="Search..." />
  </form>
  <nav>
    <?php
      wp_nav_menu(['theme_location' => 'primary']);
    ?>
  </nav>
  <div class="social-icons">
    <!-- icons here -->
  </div>
</div>
<hr>

</header>