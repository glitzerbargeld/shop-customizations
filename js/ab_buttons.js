const ab_sorte = document.querySelectorAll('.anbaumethode');
const ab_select = document.getElementById("pa_anbau");
const ab_dropdownselect = jQuery("#pa_anbau");
const ab_selectoptions = ab_select.options;
var ab_selectoptionsarray = [];

for (var i = 0; i < ab_select.options.length; i++) {
    ab_selectoptionsarray.push(ab_select.options[i].value);
}

ab_sorte.forEach(el => {
    if (el.getAttribute("data-el") == ab_select.value) {
        el.style.backgroundColor = "rgb(136, 175, 136)"
    }
})




ab_sorte.forEach(el => el.addEventListener('click', event => {
    event.preventDefault();
    ab_select.value = event.target.getAttribute("data-el");
    ab_dropdownselect.change();
    ab_sorte.forEach(el => el.style.backgroundColor = "white");
    event.target.style.backgroundColor = "rgb(136, 175, 136)";


}));

ab_sorte.forEach(el => el.addEventListener('touchstart', event => {
    event.preventDefault();
    ab_select.value = event.target.getAttribute("data-el");
    ab_dropdownselect.change();
    ab_sorte.forEach(el => el.style.backgroundColor = "gray");
    event.target.style.backgroundColor = "rgb(136, 175, 136)";


}));