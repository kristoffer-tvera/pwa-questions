
function menuOpen(sender){
    var menu = document.querySelector('[data-menu-id="'+sender+'"]');
    if(menu && menu.style){
        menu.style.display = 'flex';
    }
    // sender.querySelector('.popMenu').style.display = 'flex';
}

function menuClose(sender){
    sender.parentElement.style.display = 'none';
}

function newQuestionFormSubmit(form){
    form.style.display = 'none';
    
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest;
    xhr.open('POST', './api/questions/create.php', true);
    xhr.send(formData);

    location.reload();
    return false;
}

// var newQuestionForm = document.getElementById('xxx');
// if (newQuestionForm.attachEvent) {
//     newQuestionForm.attachEvent("submit", newQuestionFormSubmit);
// } else {
//     newQuestionForm.addEventListener("submit", newQuestionFormSubmit);
// }

function populateCategories(categorylist){
    var categoryListElement = document.querySelector('[data-category-list]');
    if(!categoryListElement){
        return;
    }

    if(categorylist && categorylist.length > 0){
        for(var i = 0; i < categorylist.length; i++){
            var categoryName = categorylist[i];

            var category = document.createElement('a');
            category.classList.add('popMenu__options');
            category.innerText = categoryName;
            category.setAttribute('href', '?category='+categoryName);

            categoryListElement.appendChild(category);
        }
    }

}

function getCategoriesFromApi(){
    var xhr = new XMLHttpRequest();
    var url = "./api/questions/read_categories.php";
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            populateCategories(json);
        }
    };
    xhr.send();
}

getCategoriesFromApi();