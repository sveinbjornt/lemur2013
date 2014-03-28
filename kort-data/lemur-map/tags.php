<?php
$tags = get_tags(array(
'orderby' => 'count',
'order' => 'DESC',
'number' => 3000,
) );
foreach ($tags as $tag) {
echo $tag->name . ',' . $tag->count . '<br>';
} 
?>