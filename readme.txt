=== BuddyForms Custom Login ===
Contributors: svenl77, themekraft, buddyforms, gfirem
Tags: login form, login redirect, login page, custom login, login
Requires at least: 3.9
Tested up to: 5.9.3
Stable tag: 1.1.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

User a Custom Login and define the Login Redirect and Registration Link

== Description ==

This plugin enables you to create a global login and redirect the WordPress login to a page. A new settings tab will be created for you under BuddyForms in the admin settings to set up the login form.

> #### Options of the Settings Page
    > * Login Page
        ** Select the page you want to use for the redirect.
    > * Display Login Form?
        ** Overwrite the page content
        ** Above the content
        ** Under the content
        ** Use the Shortcode

> * Display Registration Link?
    ** Select a registration page to rewrite the registration Link

> * Redirect after Login
    ** Select a page you like to use for the redirect.
    ** redirect to the user profile or any custom URL

> * Enable a private site or network
    ** Redirect logged off users to a login and create a private site or network
    ** Select public Accessible Pages
    ** Select public Accessible Post Types

---

> #### Docs & Support
> * Find our Getting Started, How-to and Developer Docs on [docs.buddyforms.com](http://docs.buddyforms.com/)
> * or watch one of our Video Tutorials [Videos](https://themekraft.com/buddyforms-videos/)

---

> #### Submit Issues - Contribute
> * Pull request are welcome. BuddyForms is community driven and developed on [Github](https://github.com/BuddyForms/BuddyForms-Custom-Login/issues)


---

> #### Follow Us
> [Blog](https://themekraft.com/blog/) | [Twitter](https://twitter.com/buddyforms) | [Facebook](https://www.facebook.com/buddyforms/) | [Google+](https://plus.google.com/u/0/b/100975390423636463712/?pageId=100975390423636463712) | [YouTube](https://www.youtube.com/playlist?list=PLYPguOC5yk7_aB2Q2FTaktqHCXDc_mzqb)

---

> **Powered with ❤ by [ThemeKraft](https://themekraft.com)**

---

== Installation ==

Upload the entire plugin folder to the /wp-content/plugins/ directory or install the plugin through the WordPress plugins screen directly.
Activate the plugin through the 'Plugins' menu in WordPress.
Head to the 'BuddyForms' menu item in your admin sidebar and go to the Settings Page

== Documentation & Support ==

> #### Extensive Documentation and Support
> * All code is neat, clean and well documented (inline as well as in the documentation).
> * The BuddyForms Documentation with many how-to’s will help you on your way.
> * Find our Getting Started, How-to and Developer Docs on [docs.buddyforms.com](http://docs.buddyforms.com/)
> * or watch one of our [Video Tutorials](https://themekraft.com/buddyforms-videos/)
> * If you still get stuck somewhere, our support gets you back on the right track. You can find all help buttons in your BuddyForms Settings Panel in your WP Dashboard and the Help Center!

== Screenshots ==

1. **Settings Page** - Settings Page in the Admin under BuddyForms/ Settings/ Custom Login
2. **Login Form in the Frontend


== Changelog ==
= 1.1.10 - 17 May 2022 =
* Updated readme.txt

= 1.1.9 - 24 Mar 2022 =
* Added new option to use external url as redirection page.
* Tested up to WordPress 5.9

= 1.1.8 - 23 Sep 2021 =
* Added new option to set "Remember Me" checkbox as checked by default.
* Fixed validation on Public Accesibles Pages.
* Tested up with WordPress 5.8

= 1.1.7 - 1 Apr 2021 =
* Improvements on the custom login page redirection to take into account the WordPress admin email confirmation.

= 1.1.6 - 8 Mar 2021 =
* Tested up with WordPress 5.7

= 1.1.5 - 11 Sep 2020 =
* Fixed to avoid form login custom page redirection, redirect to custom page only when the user is loggin from a custom login page or wordpress default login page.

= 1.1.4 - 06 Jan 2020 =
* Fixed the login redirection for the post and contact form.
* Improved the compatibility with the setting pages of the core plugin.
* Integrated with tk scripts.

= 1.1.3 06. Oct. 2019 =
* Added support for the switching user plugin. There was an issue stopping the plugin from switching the user.

= 1.1.2 04. May. 2019 =
* Added a filter to override the lost password link
* Added the git templates
* Update the readme.txt to point to the correct plugin url to open issues or features request
* Remove WordPress default from the select. Its not needed and just confuses.
* Update the git templates to submit issues or feature requests.

= 1.1.1 21. Nov. 2018 =
* Added one extra check to make sure also pages with child pages or endpoints are recognised

= 1.1 20. Nov. 2018 =
* Added 3 new options to enable a private site or network
** Redirect logged off users to a login and create a private site or network
** Select public Accessible Pages
** Select public Accessible Post Types

= 1.0.1 30. Mar. 2018 =
* Added freemius integration
* Add banner image and thumbnail to wordpress.org assets


= 1.0 21. Mar. 2018 =
first version
