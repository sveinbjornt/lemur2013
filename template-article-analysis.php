<?php
/*
    Template Name: Article Analysis
 */
?>

<?php get_header(); ?>

<?php
$countries_array = array(
'sudurskautslandid',
'kanada',
'bandarikin',
'panama',
'kostarika',
'nikaragva',
'honduras',
'el-salvador',
'belis',
'gvatemala',
'mexiko',
'haiti',
'dominiska-lydveldid',
'puerto-riko',
'jamaika',
'kuba',
'surinam',
'franska-gvaejana',
'gvaejana',
'trinidad-og-tobago',
'venesuela',
'kolumbia',
'ekvador',
'peru',
'bolivia',
'sile',
'paragvae',
'urugvae',
'argentina',
'brasilia',
'graenland',
'russland',
'sovetrikin',
'kypur',
'svartfjallaland',
'albania',
'makedonia',
'grikkland',
'bulgaria',
'bosnia-og-hersegovina',
'serbia',
'kroatia',
'eistland',
'lettland',
'lithaen',
'rumenia',
'moldova',
'ukraina',
'hvita-russland',
'ungverjaland',
'slovakia',
'slovenia',
'tekkland',
'sviss',
'austurriki',
'italia',
'portugal',
'spann',
'frakkland',
'luxemborg',
'belgia',
'holland',
'polland',
'irland',
'bretland',
'skotland',
'danmork',
'island',
'noregur',
'thyskaland',
'austur-thyskaland',
'finnland',
'svithjod',
'gambia',
'ginea-bissa',
'ginea',
'sierra-leone',
'liberia',
'filabeinsstrondin',
'burkina-faso',
'gana',
'togo',
'benin',
'nigeria',
'midbaugs-ginea',
'gabon',
'mid-afrikulydveldid',
'kamerun',
'kongo-brazzaville',
'kongo',
'uganda',
'ruanda',
'burundi',
'angola',
'sambia',
'malavi',
'namibia',
'botsvana',
'zimbabwe',
'svasiland',
'kenia',
'tansania',
'mosambik',
'lesoto',
'sudur-afrika',
'vestur-sahara',
'maritania',
'senegal',
'mali',
'niger',
'tsjad',
'madagaskar',
'djibuti',
'eritrea',
'somalia',
'ethiopia',
'sudan',
'sudur-sudan',
'egyptaland',
'libya',
'tunis',
'marokko',
'alsir',
'tadsjikistan',
'turkmenistan',
'afganistan',
'pakistan',
'georgia',
'aserbaidsjan',
'armenia',
'iran',
'tyrkland',
'ottoman-veldid',
'jordania',
'israel',
'libanon',
'syrland',
'irak',
'kuveit',
'katar',
'sameinudu-arabisku-furstadaemin',
'oman',
'jemen',
'sadi-arabia',
'papua-nyja-ginea',
'nyja-sjaland',
'astralia',
'kirgisistan',
'usbekistan',
'kasakstan',
'mongolia',
'brunei',
'taivan',
'filippseyjar',
'indonesia',
'malasia',
'tailand',
'kambodia',
'laos',
'vietnam',
'burma',
'sri-lanka',
'bangladess',
'butan',
'nepal',
'sudur-korea',
'nordur-korea',
'japan',
'kina',
'indland',
'palestina',
'fijieyjar',
'falklandseyjar',
'solomon-eyjar',
'austur-timor',
'bahamaeyjar',
'vanuatu',
'nyja-kaledonia',
'somaliland',
'vestur-sahara',
'kosovo',
'nordur-kypur');
?>


<!-- Post count -->
<p>
<?php
    $count = wp_count_posts()->publish;
    echo $count;
    
    $has_tags_count = 0;
    $has_date_count = 0;
    $has_country_count = 0;
    
?>
 greinar
</p>


<?php query_posts('posts_per_page=10000'); ?>

<table border="1" cellpadding="4">
    <tr>
       <td><small><strong>Name</strong></small></td>
       <td><small><strong>Tögg</strong></small></td>
       <td><small><strong>Dags</strong></small></td>
       <td><small><strong>Land</strong></small></td>
    </tr>

<?php if (have_posts()) : ?>
     <?php while(have_posts()) : the_post(); ?>
         
         <?php
             $tags_array = wp_get_post_tags(get_the_ID());
             $tag_count = count($tags_array);
             $date_match = 0;
             $country_match = 0;

             foreach ( $tags_array as $tag ) {
                $date_match += preg_match('/^\d\d\d\d\-/', $tag->slug);
                $date_match += preg_match('/^\d+\-old/', $tag->slug);
                $date_match += preg_match('/^[fornold|midaldir]/', $tag->slug);
                $country_match += in_array($tag->slug, $countries_array);
                #$date_match += preg_match('/^\d\d\d\d/', $tag->slug);
             }
         
             $has_tags = $tag_count ? '#0f0' : '#f00';
             $has_date = $date_match > 0 ? '#0f0' : '#f00';
             $has_country = $country_match > 0 ? '#0f0' : '#f00';;
         
             if ($tag_count) {
                 $has_tags_count += 1;
             }
         
         ?>
         
         <tr>
            <td><small><a href="<?php the_permalink(); ?>" target="_link"><?php echo the_title();?></a></small></td>
            <td bgcolor="<?php echo $has_tags; ?>" onhover="alert('hey');"><small><?php echo $tag_count; ?></small></td>
            <td bgcolor="<?php echo $has_date; ?>"><small><?php echo $date_match; ?></small></td>
            <td bgcolor="<?php echo $has_country; ?>"><small><?php echo $country_match; ?></small></td>
         </tr>
     <?php endwhile; ?>
<?php endif; ?>

</table>

<?php
    # Calculate percentage with tags/date/country


    # Print results

?>

<?php get_footer(); ?>
