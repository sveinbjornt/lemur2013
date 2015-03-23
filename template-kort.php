<?php
/*
    Template Name: Kort
*/
?>

<?php get_header(); ?>

        <div id="world-map" style="width: 100%; height: 350px;"></div>
        <br>
        
    </div>
        
    <div class="col s1of3">
        <div class="execphpwidget">
        <p><i class="icon-earth"></i> Á <span class="cat-title">Lemúrs&shy;kortinu</span> geta menn flakkað heims&shy;hornanna á milli. 
            <img src="http://lemurinn.is/images/whacky-lemur-small.jpg" title="Lemúrinn hefur séð ýmislegt um heiminn allan" alt="Lemúrinn hefur séð ýmislegt um heiminn allan" style="float: right;" width="80" height="94">
            Eins og sést hefur Lemúrinn farið um víðan völl gegnum árin. Smelltu á land til þess að fá upp tengdar greinar.</p>
            
        <p align="center" id="ajax-loader" style="display:none;">
            <br>
            <img src="http://lemurinn.is/images/ajax-loader.gif">
            <br>
        </p>
        </div>
    </div>

</div>

<!-- START OF CONTENT BELOW MAP -->

<?php get_template_part('template-kort-js'); ?>

<h2 id="selected-country"></h2>

<div id="country-article-results"></div>

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
