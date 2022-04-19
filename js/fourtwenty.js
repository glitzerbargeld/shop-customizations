function copyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(element).text()).select();
    document.execCommand("copy");
    jQuery('#fourtwenty').html("<p>Dein Gutscheindcode wurde kopiert! Einfach beim Bestellvorgang einfügen und die 20% sind Dir sicher! &#128521; </p> <a id=\"close-btn\" aria-label=\"Close Account Info Modal Box\">X</a>");
    document.getElementById("close-btn").addEventListener("click", () => {
        document.getElementById("fourtwenty").style.display = "none";
    })
    $temp.remove();
  }


var countDownDate = new Date("April 20, 2022 23:59:59").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("countdown").innerHTML = hours + ":"
  + minutes + ":" + seconds;

  // If the count down is finished, delete banner
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("fourtwenty").style.display = "none";
  }
}, 1000);