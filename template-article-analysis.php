<?php
/*
    Template Name: Article Analysis
 */
?>

<?php get_header(); ?>

<!-- jQuery UI assets -->
<link rel="stylesheet" href="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.css">
<script src="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.js"></script>

<!-- Country slugs -->
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

<!-- Post count stats -->
<?php
    $post_count = wp_count_posts()->publish;    
    $has_tags_count = 0;
    $has_date_count = 0;
    $has_country_count = 0;
    
?>

<?php query_posts('posts_per_page=10000'); ?>

<h2>Greinasafn - Yfirlit</h2>

<table border="1" cellpadding="4">
    <tr>
       <td><small><strong>Nafn</strong></small></td>
       <td><small><strong>Tögg</strong></small></td>
       <td><small><strong>Dags</strong></small></td>
       <td><small><strong>Land</strong></small></td>
    </tr>

<!-- Generate table entries -->
<?php if (have_posts()) : ?>
     <?php while(have_posts()) : the_post(); ?>
        
        <?php
            # Read tags
            $tags_array = wp_get_post_tags(get_the_ID());

            $tag_count = count($tags_array);
            $date_match = 0;
            $country_match = 0;
            $tags_desc_str = '';

            # Loop through tags, see if they contain date or country
            foreach ( $tags_array as $tag ) {

                # Date
                $date_match += preg_match('/^\d\d\d\d\-/', $tag->slug);
                $date_match += preg_match('/^\d+\-old/', $tag->slug);
                $date_match += preg_match('/^fornold|^midaldir/', $tag->slug);
                
                # Country
                $country_match += in_array($tag->slug, $countries_array);
                
                $tags_desc_str .= ($tag->name . ', ');
            }

            # Increment count for stats
            if ($tag_count) {
                $has_tags_count += 1;
            }
            if ($date_match) {
                $has_date_count += 1;
            }
            if ($country_match) {
                $has_country_count += 1;
            }
         
        ?>
         
        <tr>
            <td>
                <small><a href="<?php echo '/wp-admin/post.php?post=' . get_the_ID() . '&action=edit' ?>" target="_link">
                    <?php echo the_title();?>
                </a></small>
            </td>
            <td bgcolor="<?php echo $tag_count ? '#0f0' : '#f00' ?>">
                <small><a href="#" class="analysis-tag-count" data-tags="<?php echo $tags_desc_str; ?>">
                    <?php echo $tag_count; ?>
                </a></small>
            </td>
            <td bgcolor="<?php echo $date_match > 0 ? '#0f0' : '#f00'; ?>">
                <small><a href="#" class="analysis-date" data-id="<?php the_ID(); ?>">
                    <?php echo $date_match; ?>
                </a></small>
            </td>
            <td bgcolor="<?php echo $country_match > 0 ? '#0f0' : '#f00'; ?>">
                <small><a href="#" class="analysis-country" data-id="<?php the_ID(); ?>">
                    <?php echo $country_match; ?>
                </a></small>
            </td>
        </tr>
        
    <?php endwhile; ?>
<?php endif; ?>

</table>

<script type="text/javascript">

    // Tags qtip
    $('a.analysis-tag-count').qtip({
        content: {
            attr: 'data-tags'
        }
    });
    
    // Date suggestions qtip
    $('a.analysis-date').qtip({
        content: {
            text: function(event, api) {
                $.ajax({
                            url: 'greining-suggestions/?suggestion_type=date&id=' + this.data('id')
                        })
                        .then(function(content) {
                            api.set('content.text', content);
                        }, function(xhr, status, error) {
                            api.set('content.text', status + ': ' + error);
                        });
                return 'Hleð...';
            }
        }
    });
    
    // Country suggestions qtip
    $('a.analysis-country').qtip({
        content: {
            text: function(event, api) {
                $.ajax({
                            url: 'greining-suggestions/?suggestion_type=country&id=' + this.data('id')
                        })
                        .then(function(content) {
                            api.set('content.text', content);
                        }, function(xhr, status, error) {
                            api.set('content.text', status + ': ' + error);
                        });
                return 'Hleð...';
            }
        }
    });
</script>

<br>
<br>

<!-- Statistics-->

<h2>Tölfræði</h2>

<?php
    # Calculate percentage with tags/date/country
    $has_tags_perc = round(($has_tags_count/$post_count) * 100, 1);
    $has_date_perc = round(($has_date_count/$post_count) * 100, 1);
    $has_country_perc = round(($has_country_count/$post_count) * 100, 1);
    
    # Print results
    echo "Samtals $post_count greinar<br>";
    echo "$has_tags_perc% eru með tögg<br>";
    echo "$has_date_perc% eru með dagsetningu<br>";
    echo "$has_country_perc% eru með land<br>";
?>

<br>
<br>
<br>


<?php get_footer(); ?>
