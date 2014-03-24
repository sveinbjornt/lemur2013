=== Smart YouTube PRO ===
Contributors: freediver
Donate link: https://www.networkforgood.org/donation/MakeDonation.aspx?ORGID2=520781390
Tags: youtube, video, play, media, Post, posts, admin, metacafe, liveleak, vimeo, facebook, thumbnails
Requires at least: 2.0
Tested up to: 3.5.1
Stable tag: trunk

Smart Youtube is a professional WordPress Video plugin that allows you to easily insert videos/playlists into your post, comments and in your RSS feed. The plugin is designed to be small and fast and not use any external resources.

== Description == 

Smart Youtube is one of the most popular WordPress plugins, with more than 1,000,000 downloads to date..

From version 4.0 Smart Youtube changed the name to Smart Youtube PRO and now also supports playback of **Youtube, Vimeo, Metacafe, Liveleak and Facebook** high quality videos, **works on iPhone & iPad**, produces xHTML valid code (unlike YouTube embed code), allows you to view videos in fullscreen, has **video thumbnails support**, has robust widget support and much more.

The plugin is designed to be small and fast and not use any external resources. It has a number of customizable options.

Main Features:

* Easily embeds YouTube, Vimeo, Metacafe, Liveleak and Facebook videos (normal/HD mode)
* Works on iPhone, iPad and iPod
* Embed YouTube playlist (normal/HD)
* Supports latest high definition video protocols
* Extract video thumbnails in your archive/category posts
* Provides a sidebar widget for videos as well
* Supports video deep linking (starting at desired point with &start=time parameter)
* Autoplay videos, autoplay only the first video on the page (if multiple vidoes)
* Show video in Colorbox
* Supports migrated blogs from Wordpress.com
* Supports migration from other Youtube plugins such as wp-youtube
* Produces xHTML valid code


Example:
http://www.youtube.com/watch?v=zlfKdbWwruY

**Related plugins:**

* [Theme Test Drive](http://wordpress.org/extend/plugins/theme-test-drive/)
* [WP Quick Deploy](http://wordpress.org/extend/plugins/wp-quick-deploy/)

If you like what I do in WordPress, you will also like [ManageWP](http://managewp.com "Manage WordPress sites") service.

For updates, you can check out [my blog](http://www.prelovac.com/vladimir/) or follow me on Twitter [@vprelovac](http://twitter.com/vprelovac).




== Changelog ==

= 4.2.0 =
* Updated to latest Colorbox libraries

= 4.1.9 =
* Fixed HTML validation
* Colorbox now displayed on archive pages as well

= 4.1.8 = 
* 3.5 compatiblity

= 4.1.7 =
* New playlist format supported

= 4.1.6 =
* Loop videos workaround

= 4.1.4 =
* Support for HTTPS in the dashboard (thanks to Mile Rosu)

= 4.1.3 =
* Fixed support for videos in RSS feed

= 4.1.2 =
* Playlists fixed, make sure to use the new format for playlist embed ie. httpvp://www.youtube.com/playlist?list=PL050E43A49BC5E5E5

= 4.1.1 =
* Logo-less mode fix

= 4.1.0 =
* Added wmode=transparent as default paramater
* Added support for new Playlist format

= 4.0.3 =
* More bug fixes
	
= 4.0.2 =
* Bug fix release

= 4.0 =
* Major release
* Added support for Vimeo, Metacafe, Liveleak and Facebook videos
* New, much better, sidebar Widget support
* Extract Video thumbnails to show in your excerpts on categories/archive pages
* Show video in Colorbox
* Now parses http:// and httpv:// videos just the same
* Option to autoplay only the first video on the page
* Plugin localization support

= 3.9.1 =
* Support for [WiziApp](http://www.wiziapp.com/ "WiziApp") 
* Bug fixes

= 3.9.0 =
* Support for no-branding player 
* Fixed a bug with two dashes in name

= 3.8.9 =
* Supports new youtube dark 'Cosmic panda' theme

= 3.8.8 =
* Fixed the problem with autoplaying iframe embed videos

= 3.8.7 =
* Now supports both youtube.com and youtu.be links
* Fixed single vs double dash problem

= 3.8.6 =
* Brought back the loop option (thanks to John Kennedy)

= 3.8.5 =
* Fixed transparency issues (thanks to John Landells)
* Added iframe playlist code

= 3.8.4 =
* WordPress 3.1 update

= 3.8.3 =
* Fixed a bug that caused video options not to be set to default

= 3.8.2 =
* Sometimes video won't show because template option is empty - now made sure that default template is used


= 3.8.1 =
* Support for new IFRAME embed code
* Support for HD playlists (httpvhp://)
* Support for new play formats (1280x745 & 960x745)

= 3.7.1 =
* Widget function now supports multi-languge plugins (thanks Emmanuel Gravel)
* Playlist link in the feeds correctly displayed

= 3.7 = 
* WP3.0 checked
* Fixed hd and related videos parameter option

= 3.6.1 =
* Added iPad compatibility

= 3.6 =
* Added compatibility with other Youtube plugins such as wp-youtube ([yt]...[/yt] type code)

= 3.5 =
* Fixed Iphone Issues

= 3.4.3 = 
* Fixed privacy option
* Supports new #! style Youtube URLs

= 3.4.1 =
* Fixed widget problem

= 3.4 = 
* Completely rewritten the plugin
* Added new HD video support (use vh now for all high quality videos)
* Added video privacy option


= 3.3.2 =
* Fixed xHTML validation for playlists (credit Dietmar)

= 3.3.1 =
* Fixed Iphone validation (credits to John Neumann)

= 3.3 =
* Supports migrated blogs from Wordpress.com

= 3.2 =
* Added title to widget, fixed HTML code issue with widget

= 3.1.1 =
* param closed properly for HTML validation (thanks Jan Eberl)


== Credits ==

Some of the functions of SmartYoutube plugin came from other plugins. So I can at least thank these people:

* [Oliver](http://www.deliciousdays.com/ "Oliver") for his [cforms II](http://www.deliciousdays.com/cforms-plugin "cforms II") plugin
* [Scott](http://www.plaintxt.org/ "Scott") for his excellent readme.txt file
* [YouTube](http://www.youtube.com/ "YouTube") folks for their service and javascript selector

Thanks.

== Installation ==

1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Go to the Plugins page and activate the plugin.
3. Use the Options page to change your options
4. When you want to display Youtube video in your post, copy the video URL to your post and change http:// to httpv:// (notice the 'v' character)

TTo use the video in your posts, paste YouTube video URL with httpv:// (notice the 'v').

Important: The URL should just be copied into your post normally and the letter 'v' added, do not create a clickable link!

Example: httpv://www.youtube.com/watch?v=OWfksMD4PAg

If you want to embed High/HD Quality video use httpvh:// instead (Video High Defintion).

Vimeo Example: httpv://vimeo.com/27287078

Metacafe Example: httpvh://vww.metacafe.com/watch/7815470/harry_potter_and_the_deathly_hallows_dvd_interview/

Live Leak Example: httpv://www.liveleak.com/view?i=cad_1322822486

To embed playlists use httpvp:// (eg. httpvp://www.youtube.com/view_play_list?p=528026B4F7B34094)

Smart Youtube also supports migrated blogs from Wordpress.com using [youtube=youtubeadresss]

    httpv:// - regular video
    httpvh:// - high/HD quality
    httpvp:// - playlist
    httpvhp:// - HD playlist
    [youtube=youtubeadresss] - supported for blogs migrated from wordpress.com



Additionally, you can set how do you want the video to be displayed in your RSS feed. Smart Youtube can show the preview image of the video (automatically grabbed from Youtube), the link to the video, or both. I recommend enabling only the preview image.

== Screenshots ==

1. Plugin Admin Panel
2. Plugin in action in your RSS feed

== License ==

This file is part of Smart YouTube.

Smart YouTube is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Smart YouTube is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Smart YouTube. If not, see <http://www.gnu.org/licenses/>.


== Frequently Asked Questions ==

= How do I correctly use this plugin? =

Copy the URL of YouTube video you want to watch. Paste it in your post anywhere. Example: httpv://www.youtube.com/watch?v=OWfksMD4PAg

= The plugin still does not show up a video! =

Make sure you copied the URL as text, do not create a link!


= Can I suggest an feature for the plugin? =

Of course, visit <a href="http://www.prelovac.com/vladimir/wordpress-plugins/smart-youtube#comments">Smart YouTube Home Page</a>

= I love your work, are you available for hire? =

Yes I am, visit my <a href="http://www.prelovac.com/vladimir/services">WordPress Consulting</a> page to find out more.
