<?php
/*
    Template Name: Hlaðvarp Feed
*/

header('Content-type: text/xml');
echo '

<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>

    <title>Útvarp Lemúr</title>
    <description>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</description>
    <link>http://lemurinn.is/utvarp/</link>
    <language>is-is</language>
    <lastBuildDate>Sat, 25 Mar 2006 11:30:00 -0500</lastBuildDate>
    <pubDate>Sat, 25 Mar 2006 11:30:00 -0500</pubDate>
    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
    <webMaster>lemurinn@lemurinn.is</webMaster>

    <itunes:author>Lemúrinn</itunes:author>
    <itunes:subtitle>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</itunes:subtitle>
    <itunes:summary>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</itunes:summary>
    <itunes:owner>
           <itunes:name>Lemúrinn</itunes:name>
           <itunes:email>lemurinn@lemurinn.is</itunes:email>
    </itunes:owner>
    <itunes:explicit>No</itunes:explicit>
    <itunes:image href="http://lemurinn.is/wp-content/themes/lemur2013/assets/images/lemur-fb-icon-highres.jpg"/>
    <itunes:category text="History">
        <itunes:category text="Podcasting"/>
    </itunes:category>

    <item>
    <title>411 Item 138 ZedCast with Bruce Murray - Voicemail line 206-666-4357 </title>
    <link>http://podcast411.com/forums/viewtopic.php?t=451</link>
    <guid>http://media.libsyn.com/media/podcast411/411_060325.mp3</guid>
    <description> Welcome to the show it is March 25th and this is our 138th 
       show.  Today will be an interview with Bruce Murray from the Zedcast 
       podcast. Please visit this podcast at http://www.zedcast.com/ </description>
    <enclosure url="http://media.libsyn.com/media/podcast411/411_060325.mp3" length="11779397" type="audio/mpeg"/>
    <category>Podcasts</category>
    <pubDate>Sat, 25 Mar 2006 11:30:00 -0500</pubDate>

    <itunes:author>Rob @ podCast411</itunes:author>

    <itunes:explicit>No</itunes:explicit>
    <itunes:subtitle>Welcome to the show it is March 25th and this is our 138th 
       show.  Today will be an interview with Bruce Murray from the Zedcast 
       podcast. Please visit this podcast at http://www.zedcast.com/ </itunes:subtitle>
    <itunes:summary> Welcome to the show it is March 25th and this is our 
       138th show.  Today will be an interview with Bruce Murray from the 
       Zedcast podcast. Please visit this podcast at http://www.zedcast.com/ </itunes:summary>
    <itunes:duration>00:24:30</itunes:duration>
    <itunes:keywords>podCast411, podcast, podcasting, podcaster, Interviews, Bruce Murray, Zedcast</itunes:keywords>

    </item>
</channel>

</rss>

';

?>
