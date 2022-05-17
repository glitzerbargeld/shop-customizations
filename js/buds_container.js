const container = document.querySelectorAll('.bud-container');

    const select = document.getElementById("pa_menge");
    const dropdownselect = jQuery("#pa_menge");
    const selectoptions = select.options;
    var selectoptionsarray = [];

    for (var i = 0; i < select.options.length; i++) {
        selectoptionsarray.push(select.options[i].value);
    }

    container.forEach(el => {
        if (selectoptionsarray.includes(el.getAttribute("data-el"))) {
            el.parentElement.style.display = "flex";
        }
        if (el.getAttribute("data-el") == select.value) {
            el.style.backgroundColor = "rgb(136, 175, 136)"
        }
    })




    container.forEach(el => el.addEventListener('click', event => {
        event.preventDefault();
        var attribute = event.target.getAttribute("data-el");
        select.value = attribute; 
        dropdownselect.change();
        if(attribute != "1g") {
        container.forEach(el => el.style.backgroundColor = "gray");
        event.target.style.backgroundColor = "rgb(136, 175, 136)";
        }
        else {
            container.parentElement.style.backgroundColor = "gray";
            event.target.parentElement.style.backgroundColor = "rgb(136, 175, 136)";
        }


    }));

    container.forEach(el => el.addEventListener('touchstart', event => {
        event.preventDefault();
        select.value = event.target.getAttribute("data-el");
        dropdownselect.change();
        container.forEach(el => el.style.backgroundColor = "gray");
        event.target.style.backgroundColor = "rgb(136, 175, 136)";


    }));