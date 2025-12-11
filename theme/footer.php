<?php
// Load selected footer style
dtb_load_component('footer');
?>

<?php
// Frontend Theme Selector Panel (only for logged in admins)
if (current_user_can('edit_theme_options')) :
?>
<div class="theme-selector-toggle" id="themeSelectorToggle" onclick="dtbToggleSelector()">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3"></circle>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
    </svg>
</div>

<div class="theme-selector-panel" id="themeSelectorPanel">
    <div class="selector-header">
        <h3>Tema Özelleştirici</h3>
        <button class="selector-close" onclick="dtbToggleSelector()">&times;</button>
    </div>

    <div class="selector-body">
        <div class="selector-section">
            <h4>Header Stili</h4>
            <div class="style-options" data-component="header">
                <?php foreach (dtb_get_component_options('header') as $key => $label) : ?>
                    <label class="style-option <?php echo dtb_get_component('header') == $key ? 'active' : ''; ?>">
                        <input type="radio" name="header" value="<?php echo esc_attr($key); ?>" <?php checked(dtb_get_component('header'), $key); ?>>
                        <span class="option-preview">
                            <span class="preview-icon"><?php echo $key; ?></span>
                        </span>
                        <span class="option-label"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="selector-section">
            <h4>Hero Stili</h4>
            <div class="style-options" data-component="hero">
                <?php foreach (dtb_get_component_options('hero') as $key => $label) : ?>
                    <label class="style-option <?php echo dtb_get_component('hero') == $key ? 'active' : ''; ?>">
                        <input type="radio" name="hero" value="<?php echo esc_attr($key); ?>" <?php checked(dtb_get_component('hero'), $key); ?>>
                        <span class="option-preview">
                            <span class="preview-icon"><?php echo $key; ?></span>
                        </span>
                        <span class="option-label"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="selector-section">
            <h4>İçerik Stili</h4>
            <div class="style-options" data-component="posts">
                <?php foreach (dtb_get_component_options('posts') as $key => $label) : ?>
                    <label class="style-option <?php echo dtb_get_component('posts') == $key ? 'active' : ''; ?>">
                        <input type="radio" name="posts" value="<?php echo esc_attr($key); ?>" <?php checked(dtb_get_component('posts'), $key); ?>>
                        <span class="option-preview">
                            <span class="preview-icon"><?php echo $key; ?></span>
                        </span>
                        <span class="option-label"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="selector-section">
            <h4>Footer Stili</h4>
            <div class="style-options" data-component="footer">
                <?php foreach (dtb_get_component_options('footer') as $key => $label) : ?>
                    <label class="style-option <?php echo dtb_get_component('footer') == $key ? 'active' : ''; ?>">
                        <input type="radio" name="footer" value="<?php echo esc_attr($key); ?>" <?php checked(dtb_get_component('footer'), $key); ?>>
                        <span class="option-preview">
                            <span class="preview-icon"><?php echo $key; ?></span>
                        </span>
                        <span class="option-label"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="selector-footer">
        <button class="btn-save" onclick="dtbSaveTheme()">Değişiklikleri Kaydet</button>
        <button class="btn-preview" onclick="dtbPreviewTheme()">Önizle</button>
    </div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
