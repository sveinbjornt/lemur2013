<?php
/*
Template Name: Timeline Tag JSON

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Timeline Tag JSON
 * @type		PHP page
 * @desc		Wordpress template

 * @requires	Wordpress
 * @install		Copy this file to the directory of the theme you wish to use, i.e. wp-content/themes/theme_name/
 * usage		
			   1. Create a new Page in your Wordpress control panel
			   2. Enter the URL (or local path, relative to your Wordpress directory) you want to redirect to as the only page content
			   3. Set the Page Template to "Greinasafn"
			   4. Publish
 */

$time_series = array(
'14-old' => '1300',
'15-old' => '1400',
'16-old' => '1500',
'17-old' => '1600',
'18-old' => '1700',
'1800-1810' => '1800',
'1810-1820' => '1810',
'1820-1830' => '1820',
'1830-1840' => '1830',
'1840-1850' => '1840',
'1850-1860' => '1850',
'1860-1870' => '1860',
'1870-1880' => '1870',
'1880-1890' => '1880',
'1890-1900' => '1890',
'1900-1910' => '1900',
'1910-1920' => '1910',
'1920-1930' => '1920',
'1930-1940' => '1930',
'1940-1950' => '1940',
'1950-1960' => '1950',
'1960-1970' => '1960',
'1970-1980' => '1970',
'1980-1990' => '1980',
'1990-2000' => '1990',
'2000-2010' => '2000',
'2010-2020' => '2010'
);


$data = array();

/* Create array mapping tag to post count */
$i = 0;
foreach ($time_series as $key => $value) {
    $i++;
    $count = 0;
    $term = get_term_by('slug', $key, 'post_tag');
    if ($term->count) {
        $count += $term->count;
    }
    $data[$i] = array($value, $count);    
}

/* Print out JSON for tag2count array */

header('Content-type: application/json');
echo "var timelineTagCountData = [\n";
foreach ($data as $key => $value) {
    echo "[$value[0], " . "$value[1]],\n";
}
echo "];\n";

?>