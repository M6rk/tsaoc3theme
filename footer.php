<footer>
    <div class="footer-container">
        <div class="footer-columns">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <!-- Customizable link columns (1-3) -->
                <div class="footer-column">
                    <h3><?php echo esc_html(get_theme_mod("footer_col_{$i}_heading", "Column {$i}")); ?></h3>
                    <ul>
                        <?php for ($j = 1; $j <= 5; $j++): ?>
                            <?php
                            $link_text = get_theme_mod("footer_col_{$i}_link_{$j}_text");
                            $link_url = get_theme_mod("footer_col_{$i}_link_{$j}_url", '#');
                            if (!empty($link_text)): ?>
                                <li><a href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endfor; ?>
            <!-- Contact column -->
            <div class="footer-column">
                <h3>CONTACT US</h3>
                <ul>
                    <?php
                    $business_name = get_theme_mod('footer_contact_business_name');
                    $city = get_theme_mod('footer_contact_city');
                    $address = get_theme_mod('footer_contact_address');
                    $phone = get_theme_mod('footer_contact_phone');
                    $donate_text = get_theme_mod('footer_contact_donate_text', 'Donate');
                    $donate_url = get_theme_mod('footer_contact_donate_url', '#');
                    ?>

                    <?php if ($business_name): ?>
                        <li style="font-weight: 600; color: #333;"><?php echo esc_html($business_name); ?></li>
                    <?php endif; ?>

                    <?php if ($city): ?>
                        <li><?php echo esc_html($city); ?></li>
                    <?php endif; ?>

                    <?php if ($address): ?>
                        <li><?php echo nl2br(esc_html($address)); ?></li>
                    <?php endif; ?>

                    <?php if ($phone): ?>
                        <li>Phone: <?php echo esc_html($phone); ?></li>
                        
                    <?php endif; ?>
                          <?php if ($donate_text && $donate_url && $donate_url !== '#'): ?>
                        <li class="footer-donate-button">
                            <a href="<?php echo esc_url($donate_url); ?>" class="donate-btn" target="_blank">
                                <?php echo esc_html($donate_text); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Social Icons Section -->
        <div class="footer-social">
            <?php
            $social_platforms = get_social_platforms();
            foreach ($social_platforms as $platform => $data):
                $social_url = get_theme_mod("social_{$platform}_url");
                if ($social_url && $social_url !== '#'): ?>
                    <a href="<?php echo esc_url($social_url); ?>" class="footer-social-link" target="_blank"
                        aria-label="<?php echo esc_attr($data['label']); ?>">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="<?php echo esc_attr($data['path']); ?>" />
                        </svg>
                    </a>
                <?php endif;
            endforeach; ?>
        </div>
    </div>

        <div class="footer-bottom">
        <div class="footer-bottom-content">
            <p class="copyright">&copy; <?php echo date('Y'); ?> The Salvation Army - Okanagan Central. All rights reserved.</p>
            <p class="charitable-registration">Charitable Registration Number: 10795 1618 RR0001</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>