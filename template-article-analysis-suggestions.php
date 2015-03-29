<?php
/*
    Template Name: Article Analysis - Suggestions
 */
?>

<?php
    $my_id = $_GET['id'];
    $suggestion_type = $_GET['suggestion_type'];
    
    # Read post text only content
    $my_post = get_post($my_id); 
    $content = strip_tags(apply_filters('the_content', $my_post->post_content));
    $results_str = '';

    # Generate some suggestions
    
    # Country suggestions
    if ($suggestion_type == 'country') {
        $countries = array('Suðurskautslandið', 'Kanada', 'Bandaríkin', 'Panama', 'Kostaríka', 'Níkaragva', 'Hondúras', 'El Salvador', 'Belís', 'Gvatemala', 'Mexíkó', 'Haítí', 'Dóminíska lýðveldið', 'Púertó Ríkó', 'Jamaíka', 'Kúba', 'Súrínam', 'Franska Gvæjana', 'Gvæjana', 'Trínidad og Tóbagó', 'Venesúela', 'Kólumbía', 'Ekvador', 'Perú', 'Bólivía', 'Síle', 'Paragvæ', 'Úrúgvæ', 'Argentína', 'Argentína', 'Argentína', 'Brasilía', 'Brasilía', 'Grænland', 'Grænland', 'Grænland', 'Rússland', 'Kýpur', 'Svartfjallaland', 'Albanía', 'Makedónía', 'Grikkland', 'Grikkland', 'Búlgaría', 'Bosnía og Hersegóvína', 'Serbía', 'Króatía', 'Króatía', 'Eistland', 'Lettland', 'Litháen', 'Rúmenía', 'Moldóva', 'Úkraína', 'Hvíta-Rússland', 'Ungverjaland', 'Slóvakía', 'Slóvenía', 'Tékkland', 'Sviss', 'Austurríki', 'Ítalía', 'Ítalía', 'Ítalía', 'Portúgal', 'Spánn', 'Frakkland', 'Frakkland', 'Lúxemborg', 'Belgía', 'Holland', 'Pólland', 'Írland', 'Bretland', 'Danmörk', 'Ísland', 'Noregur', 'Þýskaland', 'Finnland', 'Svíþjóð', 'Gambía', 'Gínea-Bissá', 'Gínea', 'Síerra Leóne', 'Líbería', 'Fílabeinsströndin', 'Búrkína Fasó', 'Gana', 'Tógó', 'Benín', 'Nígería', 'Miðbaugs-Gínea', 'Gabon', 'Mið-Afríkulýðveldið', 'Kamerún', 'Kongó-Brazzaville', 'Kongó', 'Úganda', 'Rúanda', 'Búrúndí', 'Angóla', 'Sambía', 'Malaví', 'Namibía', 'Botsvana', 'Simbabve', 'Svasíland', 'Kenía', 'Tansanía', 'Mósambík', 'Lesótó', 'Suður-Afríka', 'Suður-Afríka', 'Vestur-Sahara', 'Máritanía', 'Senegal', 'Malí', 'Níger', 'Tsjad', 'Madagaskar', 'Djíbútí', 'Erítrea', 'Sómalía', 'Eþíópía', 'Súdan', 'Suður-Súdan', 'Egyptaland', 'Líbýa', 'Túnis', 'Marokkó', 'Alsír', 'Tadsjikistan', 'Túrkmenistan', 'Afganistan', 'Pakistan', 'Georgía', 'Aserbaídsjan', 'Armenía', 'Íran', 'Tyrkland', 'Jórdanía', 'Ísrael', 'Líbanon', 'Sýrland', 'Írak', 'Kúveit', 'Katar', 'Sameinuðu arabísku furstadæmin', 'Óman', 'Jemen', 'Sádi-Arabía', 'Papúa Nýja-Gínea', 'Nýja-Sjáland', 'Nýja-Sjáland', 'Ástralía', 'Ástralía', 'Kirgisistan', 'Úsbekistan', 'Kasakstan', 'Mongólía', 'Rússland', 'Brúnei', 'Taívan', 'Filippseyjar', 'Indónesía', 'Malasía', 'Taíland', 'Kambódía', 'Laos', 'Víetnam', 'Mjanmar (Búrma)', 'Srí Lanka', 'Bangladess', 'Bútan', 'Nepal', 'Suður-Kórea', 'Norður-Kórea', 'Japan', 'Kína', 'Indland', 'Palestína', 'Fíjíeyjar', 'Falklandseyjar', 'Sólomon-eyjar', 'Austur-Tímor', 'Bahamaeyjar', 'Vanuatú', 'Nýja Kaledónía', 'Sómalíland', 'Vestur-Sahara', 'Kósóvó', 'Norður-Kýpur');

        $country_matches = array();
        foreach ($countries as $country) {
            $m_array = array();
            preg_match('/' . $country . '/', $content, $m_array);
            $country_matches = array_merge($country_matches, $m_array); 
        }
        
        # Generate results string
        foreach (array_unique($country_matches) as $m) {
            $results_str .= ($m . ', ');
        }
        
    } else {
        $date_matches = array();
        preg_match_all('/\d\d\d\d|\d\d\. öld|\d\d. aldar/', $content, $date_matches);
        $date_matches = array_unique($date_matches[0], SORT_REGULAR);

        # Generate results string
        foreach ($date_matches as $m) {
            $results_str .= ($m . ', ');
        }
    }
    
    $results_str = $results_str == '' ? 'Engar uppástungur' : '<strong>Uppástungur:</strong> &nbsp;' . $results_str;
    
?>


<html>
<body>
    <span style="font-size: 1.5em; line-height: 1.5em;">
    <?php echo $results_str;  ?>
    </span>
</body>
</html>