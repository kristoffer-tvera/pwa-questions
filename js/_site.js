

// Skjuler menyen ved oppstart
function hideMenu() {
    document.getElementById('mainMenu').style.display = 'none';
}

// Åpner menyen ved klikk
function openMenu() {
    document.getElementById('mainMenu').style.display = 'flex';

}








// GET random spørsmål for brukerne.

var xmlhttp = new XMLHttpRequest(),
    method = 'GET',
    url = 'http://localhost:8000/api/questions/read.php';

xmlhttp.open(method, url, true);
xmlhttp.onload = function questions() {
    // Laster inn API-calls
    var response = JSON.parse(this.responseText);
    var id = response.id;
    var altOne = response.first_alternative;
    var altOneScore = parseInt(response.first_alternative_score);
    var altTwo = response.second_alternative;
    var altTwoScore = parseInt(response.second_alternative_score);
    var category = response.category;

    var altTotal = altOneScore + altTwoScore

    var altOnePercentage = (altOneScore / altTotal) * 100;

    var altTwoPercentage = (altTwoScore / altTotal) * 100;

    console.log(altOnePercentage);

    console.log(altTwoPercentage);

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

xmlhttp.send();


//post the answer to a question
function postAnswer(id, first, firstScore, secondScore) {
    document.getElementById('choiceOne').innerHTML = firstScore;
    document.getElementById('choiceTwo').innerHTML = secondScore;

    var xhr = new XMLHttpRequest();
    var url = "/api/questions/update.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            console.log(json.email + ", " + json.password);
        }
    };
    var data = JSON.stringify({ "id": id, "first": first });
    xhr.send(data);
}