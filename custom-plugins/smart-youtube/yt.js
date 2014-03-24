function toggleClass(element, className) {
    var e = ref(element);
    if (!e) return;
    if (hasClass(e, className)) {
        removeClass(e, className);
    } else {
        addClass(e, className);
    }
}
function hasClass(element, _className) {
    if (!element) {
        return;
    }
    var upperClass = _className.toUpperCase();
    if (element.className) {
        var classes = element.className.split(' ');
        for (var i = 0; i < classes.length; i++) {
            if (classes[i].toUpperCase() == upperClass) {
                return true;
            }
        }
    }
    return false;
}
function addClass(element, _class) {
    if (!hasClass(element, _class)) {
        element.className += element.className ? (" " + _class) : _class;
    }
}
function getClassList(element) {
    if (element.className) {
        return element.className.split(' ');
    } else {
        return [];
    }
}
function removeClass(element, _class) {
    var upperClass = _class.toUpperCase();
    var remainingClasses = [];
    if (element.className) {
        var classes = element.className.split(' ');
        for (var i = 0; i < classes.length; i++) {
            if (classes[i].toUpperCase() != upperClass) {
                remainingClasses[remainingClasses.length] = classes[i];
            }
        }
        element.className = remainingClasses.join(' ');
    }
}
function findAncestorByClass(element, className) {
    var temp = element;
    while (temp != document) {
        if (hasClass(temp, className)) return temp;
        temp = temp.parentNode;
    }
    return null;
}

var selectedThemeColor='blank';
function onChangeColor(color){
    var oldTheme=document.getElementById('theme_color_'+selectedThemeColor+'_img');
    var newTheme=document.getElementById('theme_color_'+color+'_img');

    var embedColor=document.getElementById('embedColor');
    embedColor.value=color;

    removeClass(oldTheme,'radio_selected');
    addClass(newTheme,'radio_selected');
    selectedThemeColor=color;
    onUpdatePreviewImage();
    return false;
}

function onUpdatePreviewImage(){
    var previewImage=document.getElementById('watch-customize-embed-theme-preview');
    var showBorderCheckBox=document.getElementById('show_border_checkbox');
    var embedColor=document.getElementById('embedColor');
    var border=(!showBorderCheckBox.checked?'_nb':'');
    var prevUrl=document.getElementById('prevUrl');

    selectedThemeColor=embedColor.value;
    previewImage.src=prevUrl.value+'preview_embed_'+selectedThemeColor+'_sm'+border+'.gif';
    //previewImage.src='http://www.youtube.com/img/preview_embed_'+selectedThemeColor+'_sm'+border+'.gif';
}

function loaded()
{
    var previewImage=document.getElementById('watch-customize-embed-theme-preview');
    var showBorderCheckBox=document.getElementById('show_border_checkbox');
    var embedColor=document.getElementById('embedColor');
    var prevUrl=document.getElementById('prevUrl');
    var border=(!showBorderCheckBox.checked?'_nb':'');

    selectedThemeColor="blank";

    onChangeColor(embedColor.value);
    previewImage.src=prevUrl.value+'preview_embed_'+selectedThemeColor+'_sm'+border+'.gif';	
}
window.onload = loaded;

jQuery(function($){
	$(".size-chooser a").click(function(e){
		e.preventDefault();
		vwidth = $(this).attr('v-width');
		vheight = $(this).attr('v-height');
		$(this).addClass("chosen").siblings().removeClass("chosen");
		target = "#" + $(this).parent("div").attr("forDiv");
		$(target).find("input.width").val(vwidth);
		$(target).find("input.height").val(vheight);
	}).each(function(){
		vwidth = $(this).attr('v-width');
		vheight = $(this).attr('v-height');
		thumb_width = Math.round(vwidth/8);
		thumb_height = Math.round(vheight/8);
		
		$(this).find(".outer").css("width", thumb_width + "px").css("height", thumb_height + "px");
		$(this).find("span").text(vwidth + "x" + vheight);
	});
	
	$("#usageHeader a").click(function(e){
		e.preventDefault();
		$("#usage").slideToggle("fast");
	});
});
