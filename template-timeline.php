<?php

/*
Template Name: Timeline

 * @author        Sveinbjorn
 * @email        sveinbjornt@gmail.com
 * @web            sveinbjorn.org
 
 * @name        Timeline
 * @type        PHP page
 * @desc        Wordpress template

 * @requires    Wordpress
 * @install        Copy this file to the directory of the theme you wish to use, i.e. wp-content/themes/theme_name/
 * usage        
               1. Create a new Page in your Wordpress control panel
               2. Enter the URL (or local path, relative to your Wordpress directory) you want to redirect to as the only page content
               3. Set the Page Template to "Greinasafn"
               4. Publish
 */

?>

<?php get_header(); ?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="http://lemurinn.is/js/jquery.flot.min.js"></script>
<script type="text/javascript"  src="http://lemurinn.is/js/jquery.flot.resize.min.js"></script>

<script type="text/javascript">

$(function(){
    
    // Options for flot chart
    var options = {
        colors: ["#6185AB","#363636"],
        lines: {
            show: true
        },
        points: {
            show: true
        },
        grid: {
            clickable: true,
            hoverable: true,
            borderWidth: 1,
            borderColor: '#D0D0D0',
            color: '#A3A3A3',
            minBorderMargin: 8
        },
        legend: {
            show: true
        },
        enableHover: true
    };
    
    function yearToDescriptionString (year) {
        if (year < 1800) {
            return String(year+100).substr(0,2) + '. öld';
        }
        return year + '-' + (year + 10);
    }
    
    function yearToTag (year) {
        if (year < 1800) {
            return String(year+100).substr(0,2) + '-old';
        }
        return year + '-' + (year + 10);
    }
    
    var lemurimg = '<img src="http://lemurinn.is/wp-content/themes/lemur2013/assets/images/lemur-favicon-32.png" width="16" height="16" style="margin-bottom: -3px; margin-right: 5px; margin-left: 4px">';
    
    // Tooltop for hover
    $("<div id='tooltip'>"  + lemurimg + " <span id='tooltip-text'></span></div>").css({
        position: "absolute",
        display: "none",
        border: "1px solid black",
        padding: "3px",
        color: "white",
        "font-size": "smaller",
        "background-color": "#282828",
        "-webkit-border-radius": "3px",
        "-moz-border-radius": "3px",
        "border-radius": "3px",
        "font-family": "sans-serif, Verdana",
        
    }).appendTo("body");

    // Hover handler for flot chart
    $("#timeline").bind("plothover", function (event, pos, item) {
        if (item) {
            var x = item.datapoint[0],
                y = item.datapoint[1];

            $("#tooltip-text").html(yearToDescriptionString(x) + ' (' + y + ' greinar)')
            $("#tooltip").css({top: item.pageY+5, left: item.pageX+5})
                .fadeIn(200);
        } else {
            $("#tooltip").hide();
        }
    });

    // Click handler for flot chart
    $("#timeline").bind("plotclick", function (event, pos, item) {
        if (item) {
            var year = item.datapoint[0],
                desc = yearToDescriptionString(year),
                tag = yearToTag(year);
            console.log(tag);
            
            $('#selected-tag').text(desc + " – sæki greinar...");
            $("#article-results").html('');
            $("#more-articles").hide();
            $("#ajax-loader").show();
            $("#article-results").load("./lemurskort-sidebar-item/?tag=" + tag, function() {
                if ($("#article-results").data('count') == $("#article-results").data('max')) {
                    $("#more-articles").show();
                    $("#more-articles-link").attr('href', 'http://lemurinn.is/tag/' + tag);
                } else {
                    $("#more-articles").hide();
                }
                $("#ajax-loader").hide();
                $('#selected-tag').text(desc);
            });
        }
    });
    
    // Load data for graph synchronously, use the
    // data to init the flot chart
    $.ajaxSetup({async: false});
    $.getScript('http://lemurinn.is/timeline-tag-json/', function(response, status) {
        $.plot("#timeline", [ timelineTagCountData ], options);
        window.onresize = function(event) {
            $.plot("#timeline", [ timelineTagCountData ], options);
        }
    });
        $.ajaxSetup({async: true});
    });

</script>


        <div id="timeline" style="width: 100%; height: 300px;"></div>
        <br>
        
    </div>
        
    <div class="col s1of3">
        <p>
            <img src="http://lemurinn.is/images/lemur-timeline.jpg" title="Lemúrinn hefur séð ýmislegt gegnum aldirnar" alt="Lemúrinn hefur séð ýmislegt gegnum aldirnar" style="float: right;" width="80" height="94">
        
            <span class="cat-title">Tímalína Lemúrsins</span> sýnir greinar eftir
            öldum og áratugum. Eins og sést er Lemúrinn sannkallaður tímaflakkari. Smelltu á ártal til þess að sækja greinar um það tímabil.
        </p>
            
        <p align="center" id="ajax-loader" style="display:none;">
            <br>
            <img src="http://lemurinn.is/images/ajax-loader.gif">
            <br>
        </p>
    </div>

</div>

<!-- START OF CONTENT BELOW MAP -->

<h2 id="selected-tag"></h2>

<div id="article-results"></div>

<div class="pagination grid" id="more-articles" style="display: none;">
    <div class="col s1of1">
        <a id="more-articles-link" href="" class="nextpostslink">Fleiri greinar &gt;&gt;</a>
    </div>
</div>

<br>

<!-- END OF CONTENT BELOW MAP -->

<div class="grid gutter collapse720">
    
    <div class="col s2of3">



<?php get_footer(); ?>
