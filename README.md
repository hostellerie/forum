# Geeklog Forum plugin - version 2.9.1

* Current Maintainers: [Geeklog Community Members](https://github.com/orgs/Geeklog-Plugins/people)
* Original Author: Blaine Lang
* Release Date: November 2, 2015

**Requires Geeklog 2.2.2 or later and MySQL 4.1+.**

Maintenance branch targeting PHP 5.6.40 with Geeklog 2.2.2. PHP 5.6 is end-of-life; migrate to a supported PHP release when possible. Runtime validation is required before deployment.

### Geeklog 2.2.2 compatibility update

- Use the Geeklog `user_attributes` table for the member list and topic author information, including online status.
- Drop support for Geeklog versions below 2.2.2.
- Preserve existing Forum data; no Forum database schema changes are required for this compatibility patch.

* Features
* Changelog
* Installing
* Upgrading
* Configuration
* Profile Integration

## Summary of features

This plugin provides a full featured discussion forum with integrated Geeklog features for your community website. The initial version of this plugin was released in 2002.

* Integrated Geeklog group security to create restricted forums
* Support for Read-only Forums
* Support for RSS Feeds - now with enhanced formatting and rich content
* Advanced Moderation features like splitting topics, moving, making sticky
* Integrated BBcode supports using text mode and bbcode tags to format content
* Able to now safely just use text mode for posting and still use bbocode and advanced formatting features
* Enhanced Code Formatting using the Geshi library
* Automatic notification support for complete forums or topics. Able subscribe to a forum but then selectively un-subscribe to topics
* Member listing page - able to view all members or just those with forum activity
* Centerblock for site frontpage or sideblock for users to monitor new posts
* Support for autotags in topic content and can reference other forum topics using an autotag [forum: topicid]
* Integrated SPAMX and content filtering
* Integrated support for Captcha 2.0 and reCAPTCHA 1.0 and higher versions
* Integration with glMessenger for member private messaging and online smilie admin
* Easy online administration and member control
* Supports MySql 5

If you've enjoyed this plugin, please consider supporting Geeklog and the Geeklog Forum plugin. These projects require considerable time and effort to create and any help we get is appreciated. You do not have to be a programmer to help out either, we can always use help in testing, graphics, themes and writing documentation. If you are interested in helping out, please drop by [our GitHub site](https://github.com/Geeklog-Plugins) and post a message letting us know what you want to do.
