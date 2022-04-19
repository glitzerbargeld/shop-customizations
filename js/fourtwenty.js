function copyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(element).text()).select();
    document.execCommand("copy");
    jQuery('#fourtwenty').html("<p>Dein Gutscheindcode wurde kopiert! Einfach beim Bestellvorgang einfügen und die 20% sind dir sicher! &#128521; </p> <button aria-label=\"Close Account Info Modal Box\">×</button>");
    $temp.remove();
  }
  