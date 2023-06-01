window.onload = function (e) {
    var restNameInputElement = document.getElementById("_businessAddRest_restName");
    var previewRestNameElement = document.getElementById("_restaurantCard_infoNamePreview")
    var restLocInputElement = document.getElementById("_businessAddRest_restLoc");
    var previewRestLocElement = document.getElementById("_restaurantCard_infoLocPreview")


    function updateRestNamePreview() {
        let str = restNameInputElement.value;
        if (str == "")
            previewRestNameElement.innerHTML = "Estabelecimento";
        else
            previewRestNameElement.innerHTML = str;
    }
    restNameInputElement.addEventListener("keyup", updateRestNamePreview);

    function updateRestLocPreview() {
        let str = restLocInputElement.value;
        if (str == "")
            previewRestLocElement.innerHTML = "Localização";
        else
            previewRestLocElement.innerHTML = str;
    }
    restLocInputElement.addEventListener("keyup", updateRestLocPreview);


    document.getElementById("_businessAddRest_restImgInput").addEventListener('change', (event) => {
        console.log("Input:" + event.target.value);
        document.getElementById("_restaurantCard_infoImgPreview").style.backgroundImage = "url(" + URL.createObjectURL(event.target.files[0]) + ")";
      });

    updateRestLocPreview();
    updateRestNamePreview();
}

function browseImg() {
    document.getElementById("_businessAddRest_restImgInput").click()
}

function validateForm() {
    var valid = true;
    let restName = document.forms["_businessAddRest_form"]["_businessAddRest_restName"].value;
    let restLoc = document.forms["_businessAddRest_form"]["_businessAddRest_restLoc"].value;
    let restOpening = document.forms["_businessAddRest_form"]["_businessAddRest_restOpening"].value;
    let restClosing = document.forms["_businessAddRest_form"]["_businessAddRest_restClosing"].value;
    // console.log("restName: " + restName);
    // console.log("restLoc: " + restLoc);
    // console.log("restOpening: " + restOpening);
    // console.log("restClosing: " + restClosing);
    if (restName == "") {
        valid = false;
    }
    if (restLoc == "") {
        valid = false;
    }
    if (restOpening == "") {
        valid = false;
    }
    if (restClosing == "") {
        valid = false;
    }
    return valid;
}