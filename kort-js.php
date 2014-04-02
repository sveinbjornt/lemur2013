
<script src="http://lemurinn.is/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="http://lemurinn.is/js/jquery-jvectormap-world-mill-en.js"></script>

<script>

    var iso_map = {
        'AQ': { ice_name:'Suðurskautslandið', tag:'sudurskautslandid' },
        'CA': { ice_name:'Kanada', tag:'kanada' },
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
        'RU': { ice_name:'Rússland', tag:'russland,sovetrikin' },
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
        'DK': { ice_name:'Danmörk', tag:'danmork' },
        'IS': { ice_name:'Ísland', tag:'island' },
        'NO': { ice_name:'Noregur', tag:'noregur' },
        'DE': { ice_name:'Þýskaland', tag:'thyskaland,austur-thyskaland' },
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
        'CD': { ice_name:'Kongó', tag:'kongo' },
        'UG': { ice_name:'Úganda', tag:'uganda' },
        'RW': { ice_name:'Rúanda', tag:'ruanda' },
        'BI': { ice_name:'Búrúndí', tag:'burundi' },
        'AO': { ice_name:'Angóla', tag:'angola' },
        'ZM': { ice_name:'Sambía', tag:'sambia' },
        'MW': { ice_name:'Malaví', tag:'malavi' },
        'NA': { ice_name:'Namibía', tag:'namibia' },
        'BW': { ice_name:'Botsvana', tag:'botsvana' },
        'ZW': { ice_name:'Simbabve', tag:'zimbabwe' },
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
        'SS': { ice_name:'Suður-Súdan', tag:'sudur-sudan'},
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
        'AM': { ice_name:'Armenía', tag:'armenia' },
        'IR': { ice_name:'Íran', tag:'iran' },
        'TR': { ice_name:'Tyrkland', tag:'tyrkland,ottoman-veldid' },
        'JO': { ice_name:'Jórdanía', tag:'jordania' },
        'IL': { ice_name:'Ísrael', tag:'israel' },
        'LB': { ice_name:'Líbanon', tag:'libanon' },
        'SY': { ice_name:'Sýrland', tag:'syrland' },
        'IQ': { ice_name:'Írak', tag:'irak' },
        'KW': { ice_name:'Kúveit', tag:'kuveit' },
        'QA': { ice_name:'Katar', tag:'katar' },
        'AE': { ice_name:'Sameinuðu arabísku furstadæmin', tag:'sameinudu-arabisku-furstadaemin' },
        'OM': { ice_name:'Óman', tag:'oman' },
        'YE': { ice_name:'Jemen', tag:'jemen' },
        'SA': { ice_name:'Sádi-Arabía', tag:'sadi-arabia' },
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
        'BN': { ice_name:'Brúnei', tag:'brunei' },
        'TW': { ice_name:'Taívan', tag:'taivan' },
        'PH': { ice_name:'Filippseyjar', tag:'filippseyjar' },
        'ID': { ice_name:'Indónesía', tag:'indonesia' },
        'MY': { ice_name:'Malasía', tag:'malasia' },
        'TH': { ice_name:'Taíland', tag:'tailand' },
        'KH': { ice_name:'Kambódía', tag:'kambodia' },
        'LA': { ice_name:'Laos', tag:'laos' },
        'VN': { ice_name:'Víetnam', tag:'vietnam' },
        'MM': { ice_name:'Mjanmar (Búrma)', tag:'burma' },
        'LK': { ice_name:'Srí Lanka', tag:'sri-lanka' },
        'BD': { ice_name:'Bangladess', tag:'bangladess' },
        'BT': { ice_name:'Bútan', tag:'butan' },
        'NP': { ice_name:'Nepal', tag:'nepal' },
        'KR': { ice_name:'Suður-Kórea', tag:'sudur-korea' },
        'KP': { ice_name:'Norður-Kórea', tag:'nordur-korea' },
        'JP': { ice_name:'Japan', tag:'japan' },
        'CN': { ice_name:'Kína', tag:'kina' },
        'IN': { ice_name:'Indland', tag:'indland' },
        
        'PS': { ice_name:'Palestína', tag:'palestina' },
        'FJ': { ice_name:'Fíjíeyjar', tag:'fijieyjar' },
        'FK': { ice_name:'Falklandseyjar', tag:'falklandseyjar' },
        'SB': { ice_name:'Sólomon-eyjar', tag:'solomon-eyjar' },
        'TL': { ice_name:'Austur-Tímor', tag:'austur-timor' },
        'BS': { ice_name:'Bahamaeyjar', tag:'bahamaeyjar' },
        'VU': { ice_name:'Vanuatú', tag:'vanuatu' },
        'NC': { ice_name:'Nýja Kaledónía', tag:'nyja-kaledonia'},
        '_3': { ice_name:'Sómalíland', tag:'somaliland' },
        '_2': { ice_name:'Vestur-Sahara', tag:'vestur-sahara' },
        '_1': { ice_name:'Kósóvó', tag:'kosovo' },
        '_0': { ice_name:'Norður-Kýpur', tag:'nordur-kypur' }
    };
    
    function articleQuantityDescription (code) {
        var c = countryTagData[code] ? countryTagData[code] : 'Engar';
        var quant = c+' grein' + (String(c).slice(-1) != '1' ? 'ar' : '');
        return quant;
    }
    
    function initVectorMap (data) {
        $('#world-map').vectorMap({
            regionsSelectable: true,
            regionsSelectableOne: true,
            regionStyle: {
                  initial: {
                    fill: '#f8f4d8'
                  },
                  selected: {
                    fill: '#a00'
                  }
                },
            backgroundColor: '#282828',
          series: {
            regions: [{
              values: data,
              scale: ['#fcfeff', '#005277'], //['#cbffc8', '#006c24'],//
              normalizeFunction: 'polynomial'
            }]
          },
          onRegionLabelShow: function(e, el, code){
              var c = countryTagData[code] ? countryTagData[code] : 0;
              var lemurimg = c == 0 ? '' : '<img src="http://lemurinn.is/wp-content/themes/lemur2013/assets/images/lemur-favicon-32.png" width="16" height="16" style="margin-bottom: -3px; margin-right: 5px; margin-left: 4px">';
              el.html(lemurimg + iso_map[code]['ice_name'] + ' (' + articleQuantityDescription(code) + ')');
          },
          onRegionClick: function(e, code) {
            var tag = iso_map[code]['tag'];
            var ice_name = iso_map[code]['ice_name'];
            $('#selected-country').text(ice_name + " – sæki greinar...");
            $("#country-article-results").html('');
            $("#more-articles").hide();
            $("#ajax-loader").show();
            $("#country-article-results").load("./query-result-items/?tag=" + tag, function() {
                if ($("#lemurmap-results").data('count') == $("#lemurmap-results").data('max')) {
                    $("#more-articles").show();
                    $("#more-articles-link").attr('href', 'http://lemurinn.is/tag/' + tag);
                } else {
                    $("#more-articles").hide();
                }
                $("#ajax-loader").hide();
                $('#selected-country').text(ice_name + ' – ' + articleQuantityDescription(code));
            });
            
          }
        });        
    }
    
    $(function(){
        // Load data for map coloring synchronously, use the
        // data to init the vector map
        $.ajaxSetup({async: false});
        $.getScript('http://lemurinn.is/country-tag-json/', function(response, status) {
            initVectorMap(countryTagData);
        });
        $.ajaxSetup({async: true});
    });
</script>
