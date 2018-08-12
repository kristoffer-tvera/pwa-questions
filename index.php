<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/site.min.css">

    <title>This or That</title>
</head>

<body>


<div class="gameChoices__container" id="mainContainer">
            <div class="gameChoices__background">
            <a class="button__one h1" id="choiceOne">
                <h1 id='altOne'></h1>
            </a>
            </div>
            <div class="gameChoices__background">
            <a class="button__two h1" id="choiceTwo">
                <h1 id='altTwo'></h1>
            </a>
            </div>

         <div class="bottomBar">
            </a>
            <a class="bottomBtn__menu" id="menuBtn" onclick="openMenu()">
                <h5>Menu</h5>
            </a>
            </a>
            <a class="bottomBtn__next" href="index.php">
                <h5>Next</h5>
            </a>
        </div>
</div>

    <div class="popMenu" id="mainMenu" data-menu-id="0">
        <a class="popMenu__options" onclick="menuOpen(1)" href="#">
            <h4>Ask a Question!</h4>
        </a>
        <form action="/vg" method="post" class="popMenu" data-menu-id="1" id="xxx" onSubmit="return newQuestionFormSubmit(this)">
            <input type="text" name="category" class="new-question__textBox" placeholder="Question category">
            <textarea name="first" class="new-question__textArea" placeholder="First Option"></textarea>
            <textarea name="second" class="new-question__textArea" placeholder="Second Option"></textarea>
            <!-- <a class="popMenu__options" onclick="menuClose(this)" href="#">
                <h4>Send</h4>
            </a> -->

            <button class="popMenu__options" type="submit">
                Send
            </button>

            <a class="popMenu__options" onclick="menuClose(this)" href="#">
                <h4>Back</h4>
            </a>
        </form>
        <!-- <div class="popMenu__options"><h4>My Questions</h4></div> -->
        <a class="popMenu__options" onclick="menuOpen(2)" href="#">
            <h4>Categories</h4>
        </a>
        <div class="popMenu" data-menu-id="2" data-category-list="true">
            <a class="popMenu__options" onclick="menuClose(this)" href="#">
                <h4>Back</h4>
            </a>
        </div>
        <!-- <div class="popMenu__options"><h4>Friends</h4></div> -->
        <a class="popMenu__options" onclick="menuOpen(3)" href="#">
            <h4>Options</h4>
        </a>

        <div class="popMenu" data-menu-id="3">
            <a class="popMenu__options" onclick="menuClose(this)" href="#">
                <h4>Back</h4>
            </a>

            <div class="popMenu__options">
                <h4>options here?</h4>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <!-- <script src="js/site.min.js?v=1"></script> -->
    <script src="js/_site.js"></script>
    <script src="js/_menu.js"></script>
</body>

</html>