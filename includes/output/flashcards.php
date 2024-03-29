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
<h2>Learn - Flashcards</h2>

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

<button id="flip" onclick="flip()">Flip card</button>
<br><br>
<button id="prev" onclick="prevCard()">Previous Card</button>
<button id="next" onclick="nextCard()">Next Card</button>
<br><br>
<!--<button id="shuffle" onclick="shuffleDeck()" disabled>Shuffle Deck (in progress)</button>-->
<button id="toggleImages" onclick="toggleImages()">Turn Image Display Off</button>

<script>
    let deck = $termsArray;
    
    let keywords = [];
    let definitions = [];
    let images = [];
    let currentCard = 0;
    let deckSize = deck.length;
    
    let imageDisplay = 1;
    
    HTMLKeyword = document.getElementById("keyword");
    HTMLDefinition = document.getElementById("definition");
    HTMLImage = document.getElementById("image");
    HTMLToggleImages = document.getElementById("toggleImages");
    
    shuffleArray(deck);
    
    for (let card = 0; card < deckSize; card++) {
        keywords.push(deck[card][0]);
        definitions.push(deck[card][1]);
        images.push(deck[card][2]);
    }
    
    function nextCard() {
        if (currentCard < (deckSize - 1)) {
            currentCard += 1;
        }
        else if (currentCard >= (deckSize - 1)) {
            currentCard = 0;
        }
        
        updateAll();
    }
    
    function prevCard() {
      if (currentCard > 0) {
            currentCard -= 1;
        }
        else if (currentCard <= 0) {
            currentCard = deckSize - 1;
        }
        
        updateAll();
    }
    
    function updateKeyword() {
        HTMLKeyword.innerHTML = keywords[currentCard];
    }
    
    function updateDefinition() {
      HTMLDefinition.innerHTML = definitions[currentCard];
    }
    
    function updateImage() {
        if (images[currentCard] !== '') {
            HTMLImage.src = 'uploads/' + images[currentCard];
        }
        else {
            console.log("no image");
            HTMLImage.src = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";
        }
    }
    
    function updateAll() {
        //if (HTMLkeyword.style.visibility === "hidden") {
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
        console.log(deck);
        shuffleArray(deck);
        console.log(deck);
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
    
</script>

PAGE;

include_once 'generateHTML.php';