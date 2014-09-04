<?php
/*
    Template Name: Timeline Tag JSON
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