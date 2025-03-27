<?
function theme_enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', [], null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_google_fonts');
