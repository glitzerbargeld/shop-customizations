const buds = document.querySelectorAll('.buds');
    const select = document.getElementById("pa_menge");
    const dropdownselect = jQuery("#pa_menge");
    const selectoptions = select.options;
    var selectoptionsarray = [];

    for (var i = 0; i < select.options.length; i++) {
        selectoptionsarray.push(select.options[i].value);
    }

    buds.forEach(el => {
        if (selectoptionsarray.includes(el.getAttribute("data-el"))) {
            el.parentElement.style.display = "block";
        }
        if (el.getAttribute("data-el") == select.value) {
            el.style.backgroundColor = "rgb(136, 175, 136)"
        }
    })




    buds.forEach(el => el.addEventListener('click', event => {
        event.preventDefault();
        select.value = event.target.getAttribute("data-el");
        dropdownselect.change();
        buds.forEach(el => el.style.backgroundColor = "gray");
        event.target.style.backgroundColor = "rgb(136, 175, 136)";


    }));

    buds.forEach(el => el.addEventListener('touchstart', event => {
        event.preventDefault();
        select.value = event.target.getAttribute("data-el");
        dropdownselect.change();
        buds.forEach(el => el.style.backgroundColor = "gray");
        event.target.style.backgroundColor = "rgb(136, 175, 136)";


    }));