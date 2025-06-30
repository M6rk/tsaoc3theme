<?php get_header(); ?>

<div class="main-content">
    <div class="search-results-container" style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">

        <header class="search-header">
            <h1 class="search-title"
                style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif; color: #CC0000; margin-bottom: 1rem;">
                <?php
                if (have_posts()) {
                    printf(__('Search Results for: %s', 'tsaoc3theme'), '<span style="color: #000;">"' . get_search_query() . '"</span>');
                } else {
                    printf(__('No Results Found for: %s', 'tsaoc3theme'), '<span style="color: #000;">"' . get_search_query() . '"</span>');
                }
                ?>
            </h1>

            <?php if (have_posts()): ?>
                <p style="color: #666; margin-bottom: 2rem;">
                    <?php
                    $result_count = $wp_query->found_posts;
                    printf(
                        _n('Found %d page', 'Found %d pages', $result_count, 'tsaoc3theme'),
                        $result_count
                    );
                    ?>
                </p>
            <?php endif; ?>
        </header>

        <div class="search-results">
            <?php if (have_posts()): ?>
                <?php while (have_posts()):
                    the_post(); ?>
                    <article class="search-result-item"
                        style="border-bottom: 1px solid #F5F5F5; padding: 2rem 0; margin-bottom: 2rem;">
                        <h2
                            style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size: 1.5rem; margin-bottom: 0.5rem;">
                            <a href="<?php the_permalink(); ?>" style="color: #CC0000; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="search-meta" style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                            <span><?php _e('Page', 'tsaoc3theme'); ?></span>
                            <?php
                            // Show parent page if this is a child page
                            $parent_id = wp_get_post_parent_id(get_the_ID());
                            if ($parent_id) {
                                echo ' • ' . __('Under: ', 'tsaoc3theme') . '<a href="' . get_permalink($parent_id) . '" style="color: #CC0000;">' . get_the_title($parent_id) . '</a>';
                            }
                            ?>
                            <?php if (get_the_modified_date() !== get_the_date()): ?>
                                <span> • </span>
                                <span><?php printf(__('Updated: %s', 'tsaoc3theme'), get_the_modified_date()); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="search-excerpt" style="line-height: 1.6; color: #333;">
                            <?php
                            // For pages, show a longer excerpt
                            $content = get_the_content();
                            $content = strip_tags($content);
                            $content = strip_shortcodes($content);
                            echo wp_trim_words($content, 50, '...');
                            ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="read-more"
                            style="color: #CC0000; font-weight: 600; text-decoration: none; display: inline-block; margin-top: 1rem;">
                            <?php _e('View Page →', 'tsaoc3theme'); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
                <?php if ($wp_query->max_num_pages > 1): ?>
                    <div class="search-pagination" style="margin-top: 3rem; text-align: center;">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => __('« Previous', 'tsaoc3theme'),
                            'next_text' => __('Next »', 'tsaoc3theme'),
                        ));
                        ?>
                    </div>
                <?php endif; ?>
                        <?php else: ?>
                  <div class="no-results" style="text-align: left; padding: 3rem 0;">
                    <!-- Back Button -->
                    <div style="margin-bottom: 2rem;">
                        <a href="javascript:history.back()" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #CC0000; text-decoration: none; font-weight: 600; padding: 0.75rem 1rem; border: 2px solid #CC0000; border-radius: 8px; transition: all 0.3s ease;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 19-7-7 7-7"/>
                                <path d="M19 12H5"/>
                            </svg>
                            <?php _e('Go Back', 'tsaoc3theme'); ?>
                        </a>
                    </div>
                    
                    <p style="font-size: 1.2rem; color: #666;">
                        <?php _e('No pages were found matching your search.', 'tsaoc3theme'); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>