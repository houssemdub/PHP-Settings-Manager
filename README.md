# ⚙️ PHP Settings Manager

**A lightweight WordPress plugin to configure PHP runtime settings including memory limits, execution time, and upload sizes directly from your admin dashboard.**

![Version](https://img.shields.io/badge/version-1.0-blue.svg)
![WordPress](https://img.shields.io/badge/wordpress-5.0%2B-brightgreen.svg)
![PHP](https://img.shields.io/badge/php-7.4%2B-purple.svg)
![License](https://img.shields.io/badge/license-GPL--2.0-orange.svg)

---

## 📋 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Settings Guide](#-settings-guide)
- [Use Cases](#-use-cases)
- [Troubleshooting](#-troubleshooting)
- [FAQs](#-faqs)
- [Technical Details](#-technical-details)
- [Roadmap](#-roadmap)
- [Contributing](#-contributing)
- [Credits](#-credits)
- [License](#-license)

---

## ✨ Features

### 🎯 **Core Functionality**
- **Memory Limit Control** - Increase PHP memory allocation on-the-fly
- **Execution Time Management** - Extend script execution time for long operations
- **Upload Size Configuration** - Adjust maximum file upload sizes
- **Post Size Settings** - Configure POST data size limits
- **Real-Time Monitoring** - View current PHP configuration values
- **Simple Interface** - User-friendly settings page

### 🔧 **Technical Features**
- **Runtime Configuration** - Uses `ini_set()` for immediate changes
- **Persistent Settings** - Saves configuration to WordPress database
- **Security First** - Requires admin capabilities
- **Nonce Validation** - CSRF protection on all forms
- **Safe Defaults** - Pre-configured recommended values
- **No PHP.ini Access Required** - Works without server file access

### 💡 **Developer-Friendly**
- **Clean Code** - Well-documented and organized
- **WordPress Standards** - Follows WP coding conventions
- **Lightweight** - Minimal resource footprint
- **Activation Defaults** - Sets optimal values on activation
- **No Database Overhead** - Single option entry

---

## 📸 Screenshots

### Settings Dashboard
![Settings Page](https://via.placeholder.com/800x400?text=PHP+Settings+Manager+Dashboard)

### Current Configuration View
![Configuration](https://via.placeholder.com/800x400?text=Current+PHP+Configuration)

---

## 💿 Installation

### Method 1: WordPress Admin Panel

1. Download the `php-settings-manager.php` file
2. Go to **Plugins > Add New > Upload Plugin**
3. Choose the downloaded file
4. Click **Install Now**
5. Click **Activate Plugin**

### Method 2: Manual Installation

1. Download the plugin file
2. Upload to `/wp-content/plugins/php-settings-manager/` directory
3. Activate through the **Plugins** menu in WordPress

### Method 3: FTP Upload

1. Download and extract the plugin
2. Upload via FTP to `/wp-content/plugins/`
3. Activate in WordPress admin panel

---

## 🚀 Quick Start

### Initial Setup (2 Minutes)

1. **Activate the Plugin**
   - Upon activation, the plugin automatically sets recommended defaults:
     - Memory Limit: `512M`
     - Max Execution Time: `300` seconds
     - Upload Max Filesize: `128M`
     - Post Max Size: `128M`

2. **Access Settings**
   - Navigate to **Settings > PHP Settings** in WordPress admin
   - View your current PHP configuration

3. **Adjust Settings** (if needed)
   - Modify any value based on your needs
   - Click **Save Settings**
   - Changes apply immediately

4. **Verify Changes**
   - Check "Current PHP Configuration" table
   - Settings should reflect your saved values

---

## 📖 Settings Guide

### Memory Limit

**What it does**: Controls the maximum amount of memory a PHP script can consume.

**Default**: `512M` (512 Megabytes)

**Recommended Values**:
- **Small Sites** (blogs, portfolios): `256M`
- **Medium Sites** (business, e-commerce): `512M`
- **Large Sites** (high traffic, complex): `1G` (1 Gigabyte)
- **Enterprise** (large databases, imports): `2G`

**Format**:
```
256M  = 256 Megabytes
512M  = 512 Megabytes
1G    = 1 Gigabyte
2G    = 2 Gigabytes
```

**When to Increase**:
- WordPress "Allowed memory size exhausted" errors
- Plugin installation failures
- Theme updates failing
- Large import/export operations
- WooCommerce with many products

**Example Error**:
```
Fatal error: Allowed memory size of 134217728 bytes exhausted
```

---

### Max Execution Time

**What it does**: Maximum time in seconds a script is allowed to run before being terminated.

**Default**: `300` seconds (5 minutes)

**Recommended Values**:
- **Standard Sites**: `300` (5 minutes)
- **Import/Export Operations**: `600` (10 minutes)
- **Database Migrations**: `900` (15 minutes)
- **Backup Operations**: `1800` (30 minutes)

**When to Increase**:
- "Maximum execution time exceeded" errors
- Large database operations
- Bulk data imports/exports
- Plugin/theme updates timing out
- Backup plugin failures

**Example Error**:
```
Fatal error: Maximum execution time of 30 seconds exceeded
```

**Note**: Some shared hosting providers may limit this setting.

---

### Upload Max Filesize

**What it does**: Maximum size of an individual file that can be uploaded via HTTP.

**Default**: `128M` (128 Megabytes)

**Recommended Values**:
- **Image-Heavy Sites**: `64M - 128M`
- **Video Content**: `256M - 512M`
- **Large Media Libraries**: `512M - 1G`
- **File Download Sites**: `1G - 2G`

**Common Sizes**:
```
32M   = Small images, documents
64M   = HD images, small videos
128M  = Large images, short videos
256M  = Long videos, presentations
512M  = Large video files
1G    = Very large media files
```

**When to Increase**:
- Cannot upload theme files
- Media upload failures
- "Exceeds maximum upload size" errors
- Video upload issues
- Large PDF upload failures

---

### Post Max Size

**What it does**: Maximum size of POST data that PHP will accept.

**Default**: `128M` (128 Megabytes)

**Important**: Should be **equal to or larger** than `upload_max_filesize`.

**Recommended**: Set to same value as Upload Max Filesize or slightly higher.

**Why it Matters**:
- Handles form data + file uploads combined
- Affects WordPress media uploader
- Impacts plugin/theme uploads
- Controls bulk operations

**Best Practice**:
```
If upload_max_filesize = 128M
Then post_max_size = 128M or 256M
```

---

## 🎯 Use Cases

### Use Case 1: E-Commerce Site Performance

**Scenario**: WooCommerce store with 5,000+ products experiencing slow admin dashboard.

**Solution**:
```
Memory Limit: 1G
Max Execution Time: 600
Upload Max Filesize: 256M
Post Max Size: 256M
```

**Result**: Faster product imports, smoother admin operations, larger product images supported.

---

### Use Case 2: Media-Heavy Portfolio Site

**Scenario**: Photography portfolio needs to upload high-resolution images (50MB+).

**Solution**:
```
Memory Limit: 512M
Max Execution Time: 300
Upload Max Filesize: 512M
Post Max Size: 512M
```

**Result**: Successful upload of RAW images, no timeout errors.

---

### Use Case 3: Database Migration

**Scenario**: Migrating site from staging to production with large database.

**Solution**:
```
Memory Limit: 2G
Max Execution Time: 1800
Upload Max Filesize: 512M
Post Max Size: 512M
```

**Result**: Migration completes without timeout or memory errors.

---

### Use Case 4: Plugin Development & Testing

**Scenario**: Developer testing import/export functionality.

**Solution**:
```
Memory Limit: 1G
Max Execution Time: 900
Upload Max Filesize: 256M
Post Max Size: 256M
```

**Result**: Reliable testing environment without PHP limitations.

---

## 🔧 Troubleshooting

### Settings Not Taking Effect

**Problem**: Changed settings but seeing no difference.

**Solutions**:
1. **Check Hosting Restrictions**
   - Some shared hosts disable `ini_set()`
   - Contact your hosting provider
   - May need VPS or dedicated hosting

2. **Server-Level Limits**
   - PHP.ini or .htaccess overrides plugin settings
   - Server-level limits take precedence
   - Request host to increase limits

3. **PHP Configuration**
   - Check if PHP is running in Safe Mode
   - Safe Mode restricts `ini_set()` usage
   - Upgrade hosting plan if necessary

4. **Cache Issues**
   - Clear WordPress cache
   - Clear browser cache
   - Refresh settings page

**Verification**:
```php
// Add to a test page
<?php
echo 'Memory Limit: ' . ini_get('memory_limit') . '<br>';
echo 'Max Execution Time: ' . ini_get('max_execution_time') . '<br>';
echo 'Upload Max: ' . ini_get('upload_max_filesize') . '<br>';
echo 'Post Max: ' . ini_get('post_max_size') . '<br>';
?>
```

---

### Settings Reverting After Deactivation

**Problem**: Settings reset when plugin is deactivated.

**Solution**:
- Settings are stored in database
- Deactivation doesn't delete options
- Reactivate plugin to restore settings
- Settings only deleted on plugin deletion

---

### "Settings Saved" But No Change

**Problem**: Success message appears but values unchanged.

**Solutions**:
1. Check "Current PHP Configuration" table on settings page
2. Verify hosting doesn't restrict `ini_set()`
3. Try lower values first (e.g., 256M instead of 2G)
4. Check PHP error logs for permission issues
5. Contact hosting support

---

### Upload Still Failing After Increase

**Problem**: Increased upload size but still can't upload files.

**Solutions**:
1. **Check Post Max Size**: Must be ≥ Upload Max Filesize
2. **Server Timeout**: Increase Max Execution Time
3. **Web Server Limits**: Nginx/Apache may have separate limits
4. **Check .htaccess**: May have conflicting directives
5. **Proxy Limits**: CloudFlare, reverse proxies may limit uploads

---

## ❓ FAQs

### **Q: Is this plugin safe to use?**
**A:** Yes! It uses WordPress-native functions and only admins can access settings. All changes are reversible.

### **Q: Will this work on shared hosting?**
**A:** It depends. Some shared hosts restrict `ini_set()`. If settings don't apply, contact your host.

### **Q: Can I break my site with this plugin?**
**A:** Unlikely. Worst case: PHP may hit server limits and show errors. Simply reduce values and save again.

### **Q: Do I need to edit PHP.ini or .htaccess?**
**A:** No! This plugin manages settings without file editing. However, server-level configs override plugin settings.

### **Q: What happens when I deactivate the plugin?**
**A:** Settings revert to server defaults. Your saved preferences remain in database for reactivation.

### **Q: Can I set unlimited memory/execution time?**
**A:** Not recommended. Use `-1` for unlimited, but this can crash servers. Stick to reasonable values.

### **Q: Why are my settings not saving?**
**A:** Check that:
- You have admin capabilities
- Hosting allows `ini_set()`
- Format is correct (e.g., 512M not 512MB)

### **Q: Does this work with multisite?**
**A:** Yes, but settings apply per-site, not network-wide. Configure separately for each site.

### **Q: Will this slow down my site?**
**A:** No. The plugin only runs during `init` hook and has minimal overhead.

### **Q: Can I use this with WP-CLI?**
**A:** Yes! Plugin works with WP-CLI. Settings apply to CLI operations too.

### **Q: Does it support custom PHP directives?**
**A:** Currently supports 4 common directives. Custom directive support planned for future versions.

---

## 🔬 Technical Details

### How It Works

1. **Plugin Activation**
   - Registers activation hook
   - Creates option in `wp_options` table
   - Sets default recommended values

2. **Settings Page**
   - Accessible at `Settings > PHP Settings`
   - Requires `manage_options` capability
   - CSRF protection via nonces
   - Real-time configuration display

3. **Runtime Application**
   - Hooks into WordPress `init` action (priority 1)
   - Retrieves settings from database
   - Applies settings via `ini_set()`
   - Runs on every page load

### Code Structure

```php
class PHP_Settings_Manager {
    private $settings_key = 'php_settings_manager';

    // Constructor registers hooks
    public function __construct() { ... }

    // Adds admin menu
    public function add_menu() { ... }

    // Registers settings
    public function register_settings() { ... }

    // Applies settings at runtime
    public function apply_settings() { ... }

    // Renders settings page
    public function settings_page() { ... }
}
```

### Database Storage

**Option Name**: `php_settings_manager`

**Structure**:
```php
array(
    'memory_limit' => '512M',
    'max_execution_time' => '300',
    'upload_max_filesize' => '128M',
    'post_max_size' => '128M'
)
```

### Filters & Hooks

Currently no custom hooks. Planned for v2.0:
```php
// Planned filters
apply_filters('php_settings_manager_defaults', $defaults);
apply_filters('php_settings_manager_max_values', $max_values);
apply_filters('php_settings_manager_allowed_directives', $directives);
```

### Security Features

1. **Capability Check**: `current_user_can('manage_options')`
2. **Nonce Verification**: `check_admin_referer()`
3. **Input Sanitization**: `sanitize_text_field()`, `intval()`
4. **Output Escaping**: `esc_attr()`, `esc_html()`
5. **Direct Access Prevention**: `defined('ABSPATH') || exit;`

### Performance Impact

- **Memory Overhead**: ~2KB
- **Database Queries**: 1 query per page load (cached)
- **Execution Time**: <1ms
- **Impact**: Negligible

---

## 🛣️ Roadmap

### Version 1.1 (Planned - Q1 2025)
- [ ] Export/Import settings
- [ ] Preset configurations (Small, Medium, Large sites)
- [ ] Settings validation and warnings
- [ ] Recommended values based on site size
- [ ] Reset to defaults button

### Version 1.2 (Planned - Q2 2025)
- [ ] Additional PHP directives (max_input_vars, max_input_time)
- [ ] Per-page/per-post override capability
- [ ] WP-CLI commands support
- [ ] Multisite network-wide settings
- [ ] Settings history/logging

### Version 2.0 (Future)
- [ ] Visual configuration wizard
- [ ] Automatic optimization recommendations
- [ ] Server compatibility check
- [ ] Before/after performance comparison
- [ ] Integration with popular performance plugins

---

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

### Ways to Contribute

1. **Report Bugs**: Open an issue with detailed information
2. **Suggest Features**: Share your ideas for improvements
3. **Submit Pull Requests**: Fork, code, and submit PRs
4. **Improve Documentation**: Help make docs clearer
5. **Test**: Try on different hosting environments and report findings

### Development Setup

```bash
# Clone the repository
git clone https://github.com/houssemdub/PHP-Settings-Manager.git

# Install in WordPress plugins directory
cp php-settings-manager.php /path/to/wordpress/wp-content/plugins/

# Activate via WordPress admin
# Start developing!
```

### Coding Standards

- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- Use proper escaping and sanitization
- Comment complex logic
- Test on PHP 7.4+
- Ensure backward compatibility

---

## 👨‍💻 Credits

**Developed by:** Mohamed Houssem Eddine SAIGHI  
**Version:** 1.0  
**License:** GPL-2.0-or-later  
**Requires PHP:** 7.4+  

### Technologies Used

- **WordPress** - Core CMS platform
- **PHP** - Server-side language
- **ini_set()** - Runtime configuration
- **WordPress Options API** - Settings storage

---

## 📄 License

This plugin is licensed under the **GPL v2 or later**.

```
PHP Settings Manager
Copyright (C) 2024 Mohamed Houssem Eddine SAIGHI

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

---

## 🔗 Links

- **GitHub Repository**: [https://github.com/houssemdub/PHP-Settings-Manager](https://github.com/houssemdub/PHP-Settings-Manager)
- **Issues & Bug Reports**: [https://github.com/houssemdub/PHP-Settings-Manager/issues](https://github.com/houssemdub/PHP-Settings-Manager/issues)
- **WordPress Plugin Page**: Coming Soon
- **Documentation**: [https://github.com/houssemdub/PHP-Settings-Manager/wiki](https://github.com/houssemdub/PHP-Settings-Manager/wiki)

---

## ⚠️ Important Warnings

### Server Restrictions

Not all hosting providers allow runtime PHP configuration changes:

**✅ Usually Works On:**
- VPS (Virtual Private Servers)
- Dedicated Servers
- Managed WordPress Hosting (varies)
- Cloud Hosting (AWS, DigitalOcean, etc.)

**❌ May Not Work On:**
- Shared Hosting with strict limits
- Hosts with `disable_functions` restrictions
- PHP Safe Mode environments
- Some budget hosting providers

**Recommendation**: Test on your hosting first. If settings don't apply, contact your host or upgrade your plan.

### Security Considerations

- Only admins should access settings
- Don't set unlimited values
- Monitor server resources after changes
- Keep backups before major adjustments

### Best Practices

1. **Start Conservative**: Begin with recommended values
2. **Increase Gradually**: Raise limits incrementally
3. **Monitor Performance**: Watch server resource usage
4. **Test Thoroughly**: Verify changes don't cause issues
5. **Document Changes**: Keep notes on what you changed and why

---

## 📞 Support

For support, questions, or feature requests:

- 📧 **Email**: contact@yourdomain.com
- 🐛 **GitHub Issues**: [Open an Issue](https://github.com/houssemdub/PHP-Settings-Manager/issues)
- 💬 **Discussions**: [GitHub Discussions](https://github.com/houssemdub/PHP-Settings-Manager/discussions)

---

## ⭐ Show Your Support

If this plugin helps you, please:
- ⭐ **Star the repository** on GitHub
- 🐛 **Report bugs** to help improve the plugin
- 💡 **Suggest features** you'd like to see
- 📢 **Share** with others who might benefit

---

<div align="center">

**Made with ❤️ by [Mohamed Houssem Eddine SAIGHI](https://github.com/houssemdub)**

*Simplifying PHP configuration for WordPress users*

</div>

---

## 📚 Additional Resources

### Useful Links
- [PHP ini_set() Documentation](https://www.php.net/manual/en/function.ini-set.php)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Understanding PHP Memory Limits](https://www.php.net/manual/en/ini.core.php#ini.memory-limit)

### Related Plugins
- WP Maximum Upload File Size
- Increase Maximum Upload File Size
- WordPress PHP Settings Configurator

---

**Last Updated:** October 2025  
**Documentation Version:** 1.0
