

// Hides menu from the start
function hideMenu() {
    document.getElementById('mainMenu').style.display = 'none';
}

// Opens up the menu on click
function openMenu() {
    // document.getElementById('menuBtn').addEventListener('click', function (e) {
    document.getElementById('mainMenu').style.display = 'flex';
    // document.getElementById('mainContainer').style.display = 'none';
    // });
}




// Listens to click, replaces the choices with stats of what people chose
document.getElementById('choiceOne').addEventListener('click', showStats)
document.getElementById('choiceTwo').addEventListener('click', showStats)


// the Stat swap function
function showStats() {

    document.getElementById('choiceOne').innerHTML = '1st%';

    document.getElementById('choiceTwo').innerHTML = '2nd%';
}