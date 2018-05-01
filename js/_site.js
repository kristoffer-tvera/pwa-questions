

document.getElementById('choiceOne').addEventListener('click', answered)

function answered() {
    
    document.getElementById('choiceOne').innerHTML = '1st%';

    document.getElementById('choiceTwo').innerHTML = '2nd%';
}