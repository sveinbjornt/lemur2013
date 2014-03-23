<?php

/*
Template Name: Kort

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Kort
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

?>

<?php get_header(); ?>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="http://lemurinn.is/js/jquery.maphilight.min.js"></script>
<script src="http://lemurinn.is/js/jquery.rwdImageMaps.min.js"></script>

<link rel="stylesheet" href="http://lemurinn.is/js/jquery-jvectormap-1.2.2.css" type="text/css" media="screen"/>
<script src="http://lemurinn.is/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="http://lemurinn.is/js/jquery-jvectormap-world-mill-en.js"></script>

  <script>
    //$.getScript('http://lemurinn.is/country-tag-json/');
    var countryTagData = {
    'AQ': 6,
    'CA': 8,
    'US': 115,
    'MX': 14,
    'HT': 1,
    'DO': 3,
    'PR': 3,
    'CU': 4,
    'VE': 1,
    'CO': 1,
    'EC': 2,
    'PE': 7,
    'BO': 3,
    'PY': 1,
    'UY': 2,
    'AR': 18,
    'BR': 20,
    'GL': 6,
    'RU': 34,
    'CY': 1,
    'AL': 3,
    'GR': 3,
    'RS': 1,
    'HR': 0,
    'EE': 3,
    'LV': 2,
    'LT': 1,
    'RO': 5,
    'UA': 2,
    'HU': 2,
    'SK': 1,
    'CZ': 5,
    'CH': 2,
    'AT': 5,
    'IT': 13,
    'PT': 4,
    'ES': 9,
    'FR': 39,
    'LU': 1,
    'BE': 8,
    'NL': 11,
    'PL': 3,
    'IE': 2,
    'GB': 59,
    'DK': 12,
    'IS': 190,
    'NO': 21,
    'DE': 61,
    'FI': 8,
    'SE': 34,
    'GH': 3,
    'BJ': 1,
    'NG': 2,
    'GQ': 1,
    'GA': 1,
    'UG': 3,
    'RW': 0,
    'NA': 1,
    'BW': 1,
    'ZA': 3,
    'MR': 1,
    'ML': 2,
    'MG': 11,
    'SO': 1,
    'ET': 1,
    'SD': 3,
    'EG': 17,
    'LY': 7,
    'TN': 4,
    'MA': 4,
    'DZ': 1,
    'TM': 1,
    'AF': 6,
    'PK': 4,
    'GE': 1,
    'AZ': 2,
    'AM': 1,
    'IR': 17,
    'TR': 13,
    'JO': 1,
    'IL': 10,
    'LB': 4,
    'SY': 9,
    'IQ': 3,
    'QA': 1,
    'AE': 1,
    'YE': 2,
    'SA': 8,
    'NZ': 1,
    'AU': 7,
    'KG': 1,
    'UZ': 2,
    'MN': 1,
    'TW': 2,
    'PH': 1,
    'ID': 3,
    'MY': 2,
    'KH': 1,
    'VN': 3,
    'MM': 1,
    'NP': 1,
    'KR': 2,
    'KP': 14,
    'JP': 23,
    'CN': 14,
    'IN': 17,
    };
    
    var iso_map = {
        'AQ': { ice_name:'Suðurskautslandið', tag:'sudurskautslandid' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'US': { ice_name:'Bandaríkin', tag:'bandarikin' },
        'PA': { ice_name:'Panama', tag:'panama' },
        'CR': { ice_name:'Kostaríka', tag:'kostarika' },
        'NI': { ice_name:'Níkaragva', tag:'nikaragva' },
        'HN': { ice_name:'Hondúras', tag:'honduras' },
        'SV': { ice_name:'El Salvador', tag:'el-salvador' },
        'BZ': { ice_name:'Belís', tag:'belis' },
        'GT': { ice_name:'Gvatemala', tag:'gvatemala' },
        'MX': { ice_name:'Mexíkó', tag:'mexiko' },
        'HT': { ice_name:'Haítí', tag:'haiti' },
        'DO': { ice_name:'Dóminíska lýðveldið', tag:'dominiska-lydveldid' },
        'PR': { ice_name:'Púertó Ríkó', tag:'puerto-riko' },
        'JM': { ice_name:'Jamaíka', tag:'jamaika' },
        'CU': { ice_name:'Kúba', tag:'kuba' },
        'SR': { ice_name:'Súrínam', tag:'surinam' },
        'GF': { ice_name:'Franska Gvæjana', tag:'franska-gvaejana' },
        'GY': { ice_name:'Gvæjana', tag:'gvaejana' },
        'TT': { ice_name:'Trínidad og Tóbagó', tag:'trinidad-og-tobago' },
        'VE': { ice_name:'Venesúela', tag:'venesuela' },
        'CO': { ice_name:'Kólumbía', tag:'kolumbia' },
        'EC': { ice_name:'Ekvador', tag:'ekvador' },
        'PE': { ice_name:'Perú', tag:'peru' },
        'BO': { ice_name:'Bólivía', tag:'bolivia' },
        'CL': { ice_name:'Síle', tag:'sile' },
        'CL': { ice_name:'Síle', tag:'sile' },
        'CL': { ice_name:'Síle', tag:'sile' },
        'CL': { ice_name:'Síle', tag:'sile' },
        'PY': { ice_name:'Paragvæ', tag:'paragvae' },
        'UY': { ice_name:'Úrúgvæ', tag:'urugvae' },
        'AR': { ice_name:'Argentína', tag:'argentina' },
        'AR': { ice_name:'Argentína', tag:'argentina' },
        'AR': { ice_name:'Argentína', tag:'argentina' },
        'BR': { ice_name:'Brasilía', tag:'brasilia' },
        'BR': { ice_name:'Brasilía', tag:'brasilia' },
        'GL': { ice_name:'Grænland', tag:'graenland' },
        'GL': { ice_name:'Grænland', tag:'graenland' },
        'GL': { ice_name:'Grænland', tag:'graenland' },
        'RU': { ice_name:'Rússland', tag:'russland' },
        'CY': { ice_name:'Kýpur', tag:'kypur' },
        'ME': { ice_name:'Svartfjallaland', tag:'svartfjallaland' },
        'AL': { ice_name:'Albanía', tag:'albania' },
        'MK': { ice_name:'Makedónía', tag:'makedonia' },
        'GR': { ice_name:'Grikkland', tag:'grikkland' },
        'GR': { ice_name:'Grikkland', tag:'grikkland' },
        'BG': { ice_name:'Búlgaría', tag:'bulgaria' },
        'BA': { ice_name:'Bosnía og Hersegóvína', tag:'bosnia-og-hersegovina' },
        'RS': { ice_name:'Serbía', tag:'serbia' },
        'HR': { ice_name:'Króatía', tag:'kroatia' },
        'HR': { ice_name:'Króatía', tag:'kroatia' },
        'EE': { ice_name:'Eistland', tag:'eistland' },
        'LV': { ice_name:'Lettland', tag:'lettland' },
        'LT': { ice_name:'Litháen', tag:'lithaen' },
        'RO': { ice_name:'Rúmenía', tag:'rumenia' },
        'MD': { ice_name:'Moldóva', tag:'moldova' },
        'UA': { ice_name:'Úkraína', tag:'ukraina' },
        'BY': { ice_name:'Hvíta-Rússland', tag:'hvita-russland' },
        'HU': { ice_name:'Ungverjaland', tag:'ungverjaland' },
        'SK': { ice_name:'Slóvakía', tag:'slovakia' },
        'SI': { ice_name:'Slóvenía', tag:'slovenia' },
        'CZ': { ice_name:'Tékkland', tag:'tekkland' },
        'CH': { ice_name:'Sviss', tag:'sviss' },
        'AT': { ice_name:'Austurríki', tag:'austurriki' },
        'IT': { ice_name:'Ítalía', tag:'italia' },
        'IT': { ice_name:'Ítalía', tag:'italia' },
        'IT': { ice_name:'Ítalía', tag:'italia' },
        'PT': { ice_name:'Portúgal', tag:'portugal' },
        'ES': { ice_name:'Spánn', tag:'spann' },
        'FR': { ice_name:'Frakkland', tag:'frakkland' },
        'FR': { ice_name:'Frakkland', tag:'frakkland' },
        'LU': { ice_name:'Lúxemborg', tag:'luxemborg' },
        'BE': { ice_name:'Belgía', tag:'belgia' },
        'NL': { ice_name:'Holland', tag:'holland' },
        'PL': { ice_name:'Pólland', tag:'polland' },
        'IE': { ice_name:'Írland', tag:'irland' },
        'GB': { ice_name:'Bretland', tag:'bretland' },
        'GB': { ice_name:'Bretland', tag:'bretland' },
        'DK': { ice_name:'Danmörk', tag:'danmork' },
        'DK': { ice_name:'Danmörk', tag:'danmork' },
        'DK': { ice_name:'Danmörk', tag:'danmork' },
        'IS': { ice_name:'Ísland', tag:'island' },
        'NO': { ice_name:'Noregur', tag:'noregur' },
        'NO': { ice_name:'Noregur', tag:'noregur' },
        'NO': { ice_name:'Noregur', tag:'noregur' },
        'DE': { ice_name:'Þýskaland', tag:'thyskaland' },
        'DE': { ice_name:'Þýskaland', tag:'thyskaland' },
        'FI': { ice_name:'Finnland', tag:'finnland' },
        'SE': { ice_name:'Svíþjóð', tag:'svithjod' },
        'GM': { ice_name:'Gambía', tag:'gambia' },
        'GW': { ice_name:'Gínea-Bissá', tag:'ginea-bissa' },
        'GN': { ice_name:'Gínea', tag:'ginea' },
        'SL': { ice_name:'Síerra Leóne', tag:'sierra-leone' },
        'LR': { ice_name:'Líbería', tag:'liberia' },
        'CI': { ice_name:'Fílabeinsströndin', tag:'filabeinsstrondin' },
        'BF': { ice_name:'Búrkína Fasó', tag:'burkina-faso' },
        'GH': { ice_name:'Gana', tag:'gana' },
        'TG': { ice_name:'Tógó', tag:'togo' },
        'BJ': { ice_name:'Benín', tag:'benin' },
        'NG': { ice_name:'Nígería', tag:'nigeria' },
        'GQ': { ice_name:'Miðbaugs-Gínea', tag:'midbaugs-ginea' },
        'GA': { ice_name:'Gabon', tag:'gabon' },
        'CF': { ice_name:'Mið-Afríkulýðveldið', tag:'mid-afrikulydveldid' },
        'CM': { ice_name:'Kamerún', tag:'kamerun' },
        'CG': { ice_name:'Kongó-Brazzaville', tag:'kongo-brazzaville' },
        'CD': { ice_name:'Kongó-Kinshasa', tag:'kongo-kinshasa' },
        'UG': { ice_name:'Úganda', tag:'uganda' },
        'RW': { ice_name:'Rúanda', tag:'ruanda' },
        'BI': { ice_name:'Búrúndí', tag:'burundi' },
        'AO': { ice_name:'Angóla', tag:'angola' },
        'AO': { ice_name:'Angóla', tag:'angola' },
        'ZM': { ice_name:'Sambía', tag:'sambia' },
        'MW': { ice_name:'Malaví', tag:'malavi' },
        'NA': { ice_name:'Namibía', tag:'namibia' },
        'BW': { ice_name:'Botsvana', tag:'botsvana' },
        'ZW': { ice_name:'Simbabve', tag:'simbabve' },
        'SZ': { ice_name:'Svasíland', tag:'svasiland' },
        'KE': { ice_name:'Kenía', tag:'kenia' },
        'TZ': { ice_name:'Tansanía', tag:'tansania' },
        'MZ': { ice_name:'Mósambík', tag:'mosambik' },
        'LS': { ice_name:'Lesótó', tag:'lesoto' },
        'ZA': { ice_name:'Suður-Afríka', tag:'sudur-afrika' },
        'ZA': { ice_name:'Suður-Afríka', tag:'sudur-afrika' },
        'EH': { ice_name:'Vestur-Sahara', tag:'vestur-sahara' },
        'MR': { ice_name:'Máritanía', tag:'maritania' },
        'SN': { ice_name:'Senegal', tag:'senegal' },
        'ML': { ice_name:'Malí', tag:'mali' },
        'NE': { ice_name:'Níger', tag:'niger' },
        'TD': { ice_name:'Tsjad', tag:'tsjad' },
        'MG': { ice_name:'Madagaskar', tag:'madagaskar' },
        'DJ': { ice_name:'Djíbútí', tag:'djibuti' },
        'ER': { ice_name:'Erítrea', tag:'eritrea' },
        'SO': { ice_name:'Sómalía', tag:'somalia' },
        'ET': { ice_name:'Eþíópía', tag:'ethiopia' },
        'SD': { ice_name:'Súdan', tag:'sudan' },
        'EG': { ice_name:'Egyptaland', tag:'egyptaland' },
        'LY': { ice_name:'Líbýa', tag:'libya' },
        'TN': { ice_name:'Túnis', tag:'tunis' },
        'MA': { ice_name:'Marokkó', tag:'marokko' },
        'DZ': { ice_name:'Alsír', tag:'alsir' },
        'TJ': { ice_name:'Tadsjikistan', tag:'tadsjikistan' },
        'TM': { ice_name:'Túrkmenistan', tag:'turkmenistan' },
        'AF': { ice_name:'Afganistan', tag:'afganistan' },
        'PK': { ice_name:'Pakistan', tag:'pakistan' },
        'GE': { ice_name:'Georgía', tag:'georgia' },
        'AZ': { ice_name:'Aserbaídsjan', tag:'aserbaidsjan' },
        'AZ': { ice_name:'Aserbaídsjan', tag:'aserbaidsjan' },
        'AM': { ice_name:'Armenía', tag:'armenia' },
        'IR': { ice_name:'Íran', tag:'iran' },
        'TR': { ice_name:'Tyrkland', tag:'tyrkland' },
        'TR': { ice_name:'Tyrkland', tag:'tyrkland' },
        'JO': { ice_name:'Jórdanía', tag:'jordania' },
        'IL': { ice_name:'Ísrael', tag:'israel' },
        'LB': { ice_name:'Líbanon', tag:'libanon' },
        'SY': { ice_name:'Sýrland', tag:'syrland' },
        'IQ': { ice_name:'Írak', tag:'irak' },
        'KW': { ice_name:'Kúveit', tag:'kuveit' },
        'QA': { ice_name:'Katar', tag:'katar' },
        'AE': { ice_name:'Sameinuðu arabísku furstadæmin', tag:'sameinudu-arabisku-furstadaemin' },
        'OM': { ice_name:'Óman', tag:'oman' },
        'OM': { ice_name:'Óman', tag:'oman' },
        'YE': { ice_name:'Jemen', tag:'jemen' },
        'SA': { ice_name:'Sádi-Arabía', tag:'sadi-arabia' },
        'PG': { ice_name:'Papúa Nýja-Gínea', tag:'papua-nyja-ginea' },
        'PG': { ice_name:'Papúa Nýja-Gínea', tag:'papua-nyja-ginea' },
        'NZ': { ice_name:'Nýja-Sjáland', tag:'nyja-sjaland' },
        'NZ': { ice_name:'Nýja-Sjáland', tag:'nyja-sjaland' },
        'AU': { ice_name:'Ástralía', tag:'astralia' },
        'AU': { ice_name:'Ástralía', tag:'astralia' },
        'KG': { ice_name:'Kirgisistan', tag:'kirgisistan' },
        'UZ': { ice_name:'Úsbekistan', tag:'usbekistan' },
        'KZ': { ice_name:'Kasakstan', tag:'kasakstan' },
        'MN': { ice_name:'Mongólía', tag:'mongolia' },
        'RU': { ice_name:'Rússland', tag:'russland,sovetrikin' },
        'RU': { ice_name:'Rússland', tag:'russland' },
        'RU': { ice_name:'Rússland', tag:'russland' },
        'RU': { ice_name:'Rússland', tag:'russland' },
        'RU': { ice_name:'Rússland', tag:'russland' },
        'BN': { ice_name:'Brúnei', tag:'brunei' },
        'TW': { ice_name:'Taívan', tag:'taivan' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'MY': { ice_name:'Malasía', tag:'malasia' },
        'MY': { ice_name:'Malasía', tag:'malasia' },
        'TH': { ice_name:'Taíland', tag:'tailand' },
        'KH': { ice_name:'Kambódía', tag:'kambodia' },
        'LA': { ice_name:'Laos', tag:'laos' },
        'VN': { ice_name:'Víetnam', tag:'vietnam' },
        'MM': { ice_name:'Mjanmar (Búrma)', tag:'burma' },
        'LK': { ice_name:'Srí Lanka', tag:'sri-lanka' },
        'BD': { ice_name:'Bangladess', tag:'bangladesh' },
        'BT': { ice_name:'Bútan', tag:'butan' },
        'NP': { ice_name:'Nepal', tag:'nepal' },
        'KR': { ice_name:'Suður-Kórea', tag:'sudur-korea' },
        'KP': { ice_name:'Norður-Kórea', tag:'nordur-korea' },
        'JP': { ice_name:'Japan', tag:'japan' },
        'JP': { ice_name:'Japan', tag:'japan' },
        'JP': { ice_name:'Japan', tag:'japan' },
        'JP': { ice_name:'Japan', tag:'japan' },
        'CN': { ice_name:'Kína', tag:'kina' },
        'CN': { ice_name:'Kína', tag:'kina' },
        'IN': { ice_name:'Indland', tag:'indland' }
    };
    
    $(function(){
        $('#world-map').vectorMap({
          series: {
            regions: [{
              values: countryTagData,
              scale: ['#C8EEFF', '#0071A4'],
              normalizeFunction: 'polynomial'
            }]
          },
          onRegionLabelShow: function(e, el, code){
            var c = countryTagData[code] ? countryTagData[code] : 0;
            el.html(iso_map[code]['ice_name'] + ' ('+c+' greinar)');
          },
          onRegionClick: function(e, code) {
            var tag = iso_map[code]['tag'];
            var ice_name = iso_map[code]['ice_name'];
            
            $('#selected-country').text(ice_name);
            $("#country-article-results").html("Sæki færslur fyrir " + ice_name + "...");
            $("#country-article-results").load("./lemurskort-sidebar-item/?tag=" + tag);
          }
        });
    });
  </script>

        <div id="world-map" style="width: 600px; height: 400px"></div>
        <br>
        
        </div>
        
    <div class="col s1of3 sidebar">
        <p>Lorem ipsum <span class="cat-title">Lemúrskortið</span>, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
    </div>

</div>


<h2 id="selected-country"></h2>

<div id="country-article-results">


<br>
<br>
<div class="grid gutter collapse720">
    
    <div class="col s2of3">



<?php get_footer(); ?>
