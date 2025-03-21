=== SaaSPress ===
Contributors: SaaSPress
Tags: plugin, saas, dashboard, management, WordPress
Requires at least: 5.0
Tested up to: 6.7.2
Stable tag: 1.1.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

SaaSPress is a WordPress plugin designed to help manage and organize resources and tools for SaaS products. It provides an admin dashboard to easily access and control all SaaSPress features.

== Features ==

- **Admin Dashboard**: Access a centralized hub to manage your SaaS tools and resources.
- **Easy Menu Integration**: The plugin adds a menu item to your WordPress admin panel for quick navigation.
- **Customizable**: The plugin can be extended with custom functions to suit your needs.

== Installation ==

1. Download the plugin.
2. Upload the `saaspress` folder to the `/wp-content/plugins/` directory.
3. Go to the WordPress admin dashboard and navigate to **Plugins**.
4. Find the "SaaSPress" plugin and click **Activate**.

== How to Use ==

Once activated, you will see a new item in the WordPress admin menu called **SaaSPress**. Click on it to access the **SaaSPress Dashboard**, where you can manage all your resources and tools related to SaaSPress.

== Frequently Asked Questions ==

= Do I need to create the functions.php file? =

Yes, the plugin includes a helper file (`inc/functions.php`). You can create this file to add custom functions or remove the line that includes it if not needed.

= Can I modify the admin dashboard? =

Yes, the plugin's dashboard page is customizable. You can edit the `render_dashboard` method to change the content that is displayed.

== Changelog ==

= 1.0 =
* Initial release with basic functionality for adding a menu and displaying a dashboard.

= 1.0.1 =
* Adding a library for automatic updates;
* Fixing bugs with update-checker.php;
* Removing unnecessary lines of code.

= 1.0.2 =
* Small change in version number for testing.

= 1.0.3 =
* Small change in version number for testing.

= 1.1.0 =
* New styling;
* Functionality testing in the script.js file;
* Addition of a new tab called "Help" in the WordPress plugin's admin panel.

== Upgrade Notice ==

No upgrade notices at this time.