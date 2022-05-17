const budContainer = document.querySelectorAll('.bud-container');

    const select = document.getElementById("pa_menge");
    const dropdownselect = jQuery("#pa_menge");
    const selectoptions = select.options;
    var selectoptionsarray = [];

    for (var i = 0; i < select.options.length; i++) {
        selectoptionsarray.push(select.options[i].value);
    }

    budContainer.forEach(el => {
        if (selectoptionsarray.includes(el.getAttribute("data-el"))) {
            el.parentElement.style.display = "flex";
        }
        if (el.getAttribute("data-el") == select.value) {
            el.style.backgroundColor = "rgb(136, 175, 136)"
        }
    })




    budContainer.forEach(el => el.addEventListener('click', event => {
        event.preventDefault();
        var attribute = event.target.getAttribute("data-el");
        select.value = attribute; 
        dropdownselect.change();
        budContainer[0].parentElement.style.backgroundColor = "gray";
        budContainer.forEach(el => el.style.backgroundColor = "gray");

        if(attribute != "1g") {
            event.target.style.backgroundColor = "rgb(136, 175, 136)";
        }
        else {
            event.target.parentElement.style.backgroundColor = "#b89d79";
        }

    }));

    budContainer.forEach(el => el.addEventListener('touchstart', event => {
        event.preventDefault();
        select.value = event.target.getAttribute("data-el");
        dropdownselect.change();
        budContainer.forEach(el => el.style.backgroundColor = "gray");
        event.target.style.backgroundColor = "rgb(136, 175, 136)";


    }));