function copyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(element).text()).select();
    document.execCommand("copy");
    jQuery('#fourtwenty').html("<p>Dein Gutscheindcode wurde kopiert! Einfach beim Bestellvorgang einfügen und die 20% sind dir sicher! &#128521; </p> <a id=\"close-btn\" aria-label=\"Close Account Info Modal Box\">X</a>");
    document.getElementById("close-btn").addEventListener("click", () => {
        document.getElementById("fourtwenty").style.display = "none";
    })
    $temp.remove();
  }


  