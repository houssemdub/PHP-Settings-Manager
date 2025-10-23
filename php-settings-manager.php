<?php
/**
 * Plugin Name: PHP Settings Manager
 * Description: Configure PHP memory limits and execution settings
 * Version: 1...
 * Author: Mohamed Houssem Eddine SAIGHI
 * Requires PHP: 7.4
 */

// Prevent direct access
defined('ABSPATH') || exit;

// Main plugin class
class PHP_Settings_Manager {

    private $settings_key = 'php_settings_manager';

    public function __construct() {
        add_action('admin_menu', array($this, 'add_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('init', array($this, 'apply_settings'), 1);
    }

    public function add_menu() {
        add_options_page(
            'PHP Settings',
            'PHP Settings',
            'manage_options',
            'php-settings-manager',
            array($this, 'settings_page')
        );
    }

    public function register_settings() {
        register_setting($this->settings_key . '_group', $this->settings_key);
    }

    public function apply_settings() {
        $options = get_option($this->settings_key);

        if (!empty($options)) {
            if (!empty($options['memory_limit'])) {
                @ini_set('memory_limit', $options['memory_limit']);
            }
            if (!empty($options['max_execution_time'])) {
                @ini_set('max_execution_time', $options['max_execution_time']);
            }
            if (!empty($options['upload_max_filesize'])) {
                @ini_set('upload_max_filesize', $options['upload_max_filesize']);
            }
            if (!empty($options['post_max_size'])) {
                @ini_set('post_max_size', $options['post_max_size']);
            }
        }
    }

    public function settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        // Save settings
        if (isset($_POST['php_settings_submit'])) {
            check_admin_referer('php_settings_save', 'php_settings_nonce');

            $options = array(
                'memory_limit' => sanitize_text_field($_POST['memory_limit']),
                'max_execution_time' => intval($_POST['max_execution_time']),
                'upload_max_filesize' => sanitize_text_field($_POST['upload_max_filesize']),
                'post_max_size' => sanitize_text_field($_POST['post_max_size'])
            );

            update_option($this->settings_key, $options);
            echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
        }

        $options = get_option($this->settings_key, array(
            'memory_limit' => '512M',
            'max_execution_time' => '300',
            'upload_max_filesize' => '128M',
            'post_max_size' => '128M'
        ));

        ?>
        <div class="wrap">
            <h1>PHP Settings Manager</h1>

            <div style="background: white; border: 1px solid #ccc; padding: 20px; margin: 20px 0;">
                <h2>Current PHP Configuration</h2>
                <table class="widefat">
                    <tr>
                        <td><strong>PHP Version</strong></td>
                        <td><?php echo PHP_VERSION; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Current Memory Limit</strong></td>
                        <td><?php echo ini_get('memory_limit'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Max Execution Time</strong></td>
                        <td><?php echo ini_get('max_execution_time'); ?> seconds</td>
                    </tr>
                    <tr>
                        <td><strong>Upload Max Filesize</strong></td>
                        <td><?php echo ini_get('upload_max_filesize'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Post Max Size</strong></td>
                        <td><?php echo ini_get('post_max_size'); ?></td>
                    </tr>
                </table>
            </div>

            <form method="post" action="">
                <?php wp_nonce_field('php_settings_save', 'php_settings_nonce'); ?>

                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="memory_limit">Memory Limit</label>
                        </th>
                        <td>
                            <input type="text" 
                                   id="memory_limit" 
                                   name="memory_limit" 
                                   value="<?php echo esc_attr($options['memory_limit']); ?>" 
                                   class="regular-text">
                            <p class="description">Example: 512M or 1G</p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <label for="max_execution_time">Max Execution Time</label>
                        </th>
                        <td>
                            <input type="number" 
                                   id="max_execution_time" 
                                   name="max_execution_time" 
                                   value="<?php echo esc_attr($options['max_execution_time']); ?>" 
                                   class="regular-text">
                            <p class="description">Maximum time in seconds (default: 300)</p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <label for="upload_max_filesize">Upload Max Filesize</label>
                        </th>
                        <td>
                            <input type="text" 
                                   id="upload_max_filesize" 
                                   name="upload_max_filesize" 
                                   value="<?php echo esc_attr($options['upload_max_filesize']); ?>" 
                                   class="regular-text">
                            <p class="description">Example: 128M</p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <label for="post_max_size">Post Max Size</label>
                        </th>
                        <td>
                            <input type="text" 
                                   id="post_max_size" 
                                   name="post_max_size" 
                                   value="<?php echo esc_attr($options['post_max_size']); ?>" 
                                   class="regular-text">
                            <p class="description">Example: 128M</p>
                        </td>
                    </tr>
                </table>

                <?php submit_button('Save Settings', 'primary', 'php_settings_submit'); ?>
            </form>

            <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 15px; margin: 20px 0;">
                <h3>Important Notes:</h3>
                <ul>
                    <li>Some settings may not work if your hosting provider restricts ini_set()</li>
                    <li>Memory values should be formatted as: 256M, 512M, 1G</li>
                    <li>Changes take effect immediately after saving</li>
                </ul>
            </div>
        </div>
        <?php
    }
}

// Initialize plugin
function php_settings_manager_init() {
    new PHP_Settings_Manager();
}
add_action('plugins_loaded', 'php_settings_manager_init');

// Activation
register_activation_hook(__FILE__, 'php_settings_manager_activate');
function php_settings_manager_activate() {
    add_option('php_settings_manager', array(
        'memory_limit' => '512M',
        'max_execution_time' => '300',
        'upload_max_filesize' => '128M',
        'post_max_size' => '128M'
    ));
}

// Deactivation
register_deactivation_hook(__FILE__, 'php_settings_manager_deactivate');
function php_settings_manager_deactivate() {
    // Cleanup if needed
}
