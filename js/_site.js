

// Skjuler menyen ved oppstart
function hideMenu() {
    document.getElementById('mainMenu').style.display = 'none';
}

// Åpner menyen ved klikk
function openMenu() {
    document.getElementById('mainMenu').style.display = 'flex';

}








// GETS random questions for user to vote on.

var xmlhttp = new XMLHttpRequest(),
    method = 'GET',
    url = 'http://localhost:8000/api/questions/read.php';
console.log(url);

xmlhttp.open(method, url, true);
xmlhttp.onload = function questions() {
    // Laster inn API-calls
    var response = JSON.parse(this.responseText);
    var altOne = response.first_alternative;
    var altOneScore = response.first_alternative_score;
    console.log(altOne);
    console.log(altOneScore);
    var altTwo = response.second_alternative;
    var altTwoScore = response.second_alternative_score;
    console.log(altTwo);
    console.log(altTwoScore);
    var category = response.category;
    console.log(category);



    // Elementene som blir vist til brukere
    document.getElementById('altOne').innerHTML = altOne;
    document.getElementById('altTwo').innerHTML = altTwo;




    // Hører etter clicks, for og så erstatte spørsmålet med statistikken
    document.getElementById('choiceOne').addEventListener('click', showStats)
    document.getElementById('choiceTwo').addEventListener('click', showStats)

    // the Stat swap function
    function showStats() {

        document.getElementById('choiceOne').innerHTML = altOneScore;

        document.getElementById('choiceTwo').innerHTML = altTwoScore;
    }

}

xmlhttp.send();


