// Skjuler menyen ved oppstart
function hideMenu() {
    document.getElementById('mainMenu').style.display = 'none';
}

// Åpner menyen ved klikk
function openMenu() {
    document.getElementById('mainMenu').style.display = 'flex';
}

function GetRandomQuestion(){
    var xhr = new XMLHttpRequest(),
    method = 'GET',
    url = './api/questions/read.php';

    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            RenderQuestionAndAddEventListeners(json);
        }
    };
    xhr.send();
}

function GetRandomQuestionFromCategory(category){
 var xhr = new XMLHttpRequest(),
    method = 'GET',
    url = './api/questions/read_by_category.php';
    url += '?category='+category;
    
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            RenderQuestionAndAddEventListeners(json);
        }
    };
    xhr.send();
}

var urlParams; //https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
(window.onpopstate = function () {
    var match,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    urlParams = {};
    while (match = search.exec(query))
       urlParams[decode(match[1])] = decode(match[2]);
})();

//Under sjekker vi om det ligger noe i url'en ( det er slik vi overfører data fra en side til den andre via javascript/html)
if(urlParams && urlParams.hasOwnProperty("category")){
    GetRandomQuestionFromCategory(urlParams.category);
} else {
    GetRandomQuestion();
}

function RenderQuestionAndAddEventListeners(response){
    // Laster inn API-calls
    var id = response.id;
    var altOne = response.first_alternative;
    var altOneScore = parseInt(response.first_alternative_score);
    var altTwo = response.second_alternative;
    var altTwoScore = parseInt(response.second_alternative_score);
    var category = response.category;

    var altTotal = altOneScore + altTwoScore

    var altOnePercentage = (altOneScore / altTotal) * 100;

    var altTwoPercentage = (altTwoScore / altTotal) * 100;


    // Elementene som blir vist til brukere
    document.getElementById('altOne').innerHTML = altOne;
    document.getElementById('altTwo').innerHTML = altTwo;

    // Hører etter clicks, for og så erstatte spørsmålet med statistikken
    document.getElementById('choiceOne').addEventListener('click', function (e) {
        postAnswer(id, true, Math.round(altOnePercentage) + "%", Math.round(altTwoPercentage) + "%");
    });

    document.getElementById('choiceTwo').addEventListener('click', function (e) {
        postAnswer(id, false, Math.round(altOnePercentage) + "%", Math.round(altTwoPercentage) + "%");
    });
}

//post the answer to a question
function postAnswer(id, first, firstScore, secondScore) {
    document.getElementById('choiceOne').innerHTML = firstScore;
    document.getElementById('choiceTwo').innerHTML = secondScore;

    var xhr = new XMLHttpRequest();
    var url = "./api/questions/update.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            console.log(json.email + ", " + json.password);
        }
    };
    var data = JSON.stringify({
        "id": id,
        "first": first
    });
    xhr.send(data);
}