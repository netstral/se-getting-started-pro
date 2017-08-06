# Getting Started Pro
A SocialEngine plugin that provides your members a simple getting started guide upon their first login.

## Requirements
- SocialEngine 3.20 or earlier
- [Netstral Core Library](https://github.com/netstral/se-core-library) 3.00 or earlier

## Installation Instructions

1. Upload all the source files and sub-directories inside the `src` directory to your root SocialEngine path
2. Ensure the `templates` directory has write permissions
3. Login to the SocialEngine administration panel and go to View Plugins under Network Management menu
4. Find Getting Started Pro Plugin and simply click Install Plugin
5. You can now remove the `install_getting_started.php` from your admin directory
6. Follow the modification instructions below

## Modification Instructions

A simple modification to your SocialEngine setup needs to be implemented in order to redirect users to the Getting Started guide when they login.

1. Open the `login.php` file using your favourite text editor
2. Find and replace all occurances of `user_home.php` with `user_getting_started.php`
3. If you have the Widgets plugin installed, find and replace all occurances of `user_widgets_home.php` with `user_getting_started.php`
