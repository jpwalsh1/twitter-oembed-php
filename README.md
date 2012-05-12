twitter-oembed-php
==================

PHP function to cache Twitter Oembed API calls.

# Database structure #
    CREATE TABLE `twitter` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `tweetid` bigint(30) unsigned NOT NULL,
      `html` text NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='tweet cache';
