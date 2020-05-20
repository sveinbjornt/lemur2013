<?php
/*
    Template Name: Hlaðvarp Feed
*/

header('Content-type: text/xml');
echo '

<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="https://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>

    <title>Útvarp Lemúr</title>
    <description>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</description>
    <link>https://lemurinn.is/utvarp/</link>
    <language>is-is</language>
    <lastBuildDate>Sat, 25 Mar 2006 11:30:00 -0500</lastBuildDate>
    <pubDate>Sat, 25 Mar 2006 11:30:00 -0500</pubDate>
    <webMaster>lemurinn@lemurinn.is</webMaster>

    <itunes:author>Lemúrinn</itunes:author>
    <itunes:subtitle>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</itunes:subtitle>
    <itunes:summary>Útvarp Lemúr geymir útvarpsþætti Lemúrsins. Hér má finna alla þættina á einum stað, en þeir fjalla um nánast allt milli himins og jarðar.</itunes:summary>
    <itunes:owner>
           <itunes:name>Lemúrinn</itunes:name>
           <itunes:email>lemurinn@lemurinn.is</itunes:email>
    </itunes:owner>
    <itunes:explicit>No</itunes:explicit>
    <itunes:image href="https://lemurinn.is/wp-content/themes/lemur2013/assets/images/lemur-fb-icon-highres.jpg"/>
    <itunes:category text="History">
        <itunes:category text="Podcasting"/>
    </itunes:category>

</channel>

</rss>

';

?>
