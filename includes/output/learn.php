<?php

$db = new database();

$db->query('SELECT keyword_number, keyword, definition, image FROM terms');
$rows = $db->resultArray(); // get all terms, definitions, and images

$termsArray = "[ ";
foreach ($rows as $term) {
    $keywordID = $term['keyword_number'];
    $keyword = $term['keyword'];
    $definition = $term['definition'];

    if (isset($term['image'])) {
        $image =$term['image'];
        $imgSource = '/uploads/' . $image;

        // do stuff if image
    }
    else {
        $image = '';
    }

    $termsArray .= "['$keyword','$definition','$image'], ";
}
$termsArray .= "]";

$page = <<< PAGE
<h2>Learn - Test</h2>

<table style='width:50%; text-align:center'>
    <tr>
        <th>Keyword</th>
        <th>Definition</th>
    </tr>
    <tr>
        <td id="keyword"></td>
        <td id="definition"></td>
    </tr>
</table>
<br>
<img id ="image" height="30%" src="">
<br><br>

<input id="answer" placeholder="Answer">

<br><br>
<button id="submit" onclick="submit()">submit</button>
<br><br>
<hr>
<p>Controls</p>
<button id="toggleImages" onclick="toggleImages()">Turn Image Display Off</button>
<button id="flip" onclick="flip()">Toggle Keyword or Definition</button>
<br>

<script>
    let deck = $termsArray;
    
    let keywords = [];
    let definitions = [];
    let images = [];
    let currentTerm = 0;
    let deckSize = deck.length;
    
    let imageDisplay = 1;
    
    let HTMLKeyword = document.getElementById("keyword");
    let HTMLDefinition = document.getElementById("definition");
    let HTMLImage = document.getElementById("image");
    let HTMLToggleImages = document.getElementById("toggleImages");
    
    let answer = '';
    
    shuffleArray(deck);
    
    for (let card = 0; card < deckSize; card++) {
        keywords.push(deck[card][0]);
        definitions.push(deck[card][1]);
        images.push(deck[card][2]);
    }
    
    function nextCard() {
        if (currentTerm < (deckSize - 1)) {
            currentTerm += 1;
        }
        else if (currentTerm >= (deckSize - 1)) {
            alert("That's all of your terms - nice!");
            currentTerm = 0;
        }
        
        updateAll();
    }
    
    function submit() {
        let answer = document.getElementById("answer").value;
        let correctAnswer = '';
        
        if (HTMLKeyword.style.visibility !== "hidden") { // keyword visible
            correctAnswer = definitions[currentTerm].replace(/(<([^>]+)>)/ig,"");
        } 
        else { // definition visible
            correctAnswer = keywords[currentTerm].replace(/(<([^>]+)>)/ig,"");
        }
        
        if (answer.toLowerCase() === correctAnswer.toLowerCase()) {
                alert("That's correct, well done!");
                document.getElementById("answer").value = '';
                nextCard();
                // do something to do with database here
            }
            else {
                alert("Unfortunately that's not quite right. Try again :)");
                console.log(correctAnswer);
                console.log(answer);
            }
        
    }
    
    function updateKeyword() {
        HTMLKeyword.innerHTML = keywords[currentTerm];
    }
    
    function updateDefinition() {
      HTMLDefinition.innerHTML = definitions[currentTerm];
    }
    
    function updateImage() {
        if (images[currentTerm] !== '') {
            HTMLImage.src = 'uploads/' + images[currentTerm];
        }
        else {
            console.log("no image");
            HTMLImage.src = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";
        }
    }
    
    function updateAll() {
        //if (HTMLKeyword.style.visibility === "hidden") {
        //    flip(); // make sure the keyword always shows first
        //}
        
        updateKeyword();
        updateDefinition();
        updateImage()
    }
    
    function flip() {
        if (HTMLKeyword.style.visibility !== "hidden") {
            HTMLKeyword.style.visibility = "hidden";
            HTMLDefinition.style.visibility = "visible";
        } 
        else {
            HTMLKeyword.style.visibility = "visible";
            HTMLDefinition.style.visibility = "hidden";
        }
    }
    
    function shuffleDeck() {
        shuffleArray(deck);
        nextCard();
        alert("Deck Shuffled!");
    }
    
    function toggleImages() {
        if (HTMLImage.style.visibility === "visible") {
            HTMLImage.style.visibility = "hidden";
            HTMLToggleImages.innerHTML = "Turn Image Display On";
        }
        else {
            HTMLImage.style.visibility = "visible";
            HTMLToggleImages.innerHTML = "Turn Image Display Off";
            updateImage();
        }
    }
    
    updateAll();
    HTMLImage.style.visibility = "visible"; // enable images by default
    HTMLDefinition.style.visibility = "hidden"; // hide the definition to begin with
    
    addEventListener("keyup", function(event) {
      // Number 13 is the "Enter" key on the keyboard
      if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("submit").click();
      }
    });
    
</script>

PAGE;

include_once 'generateHTML.php';