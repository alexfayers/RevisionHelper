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
<img id ="image" width="10%" src="">
<br><br>

<button id="flip" onclick="flip()">Flip card</button>
<br>
<button id="prev" onclick="prevCard()">Previous Card</button>
<button id="next" onclick="nextCard()">Next Card</button>

<script>
    let deck = $termsArray;
    
    let keywords = [];
    let definitions = [];
    let images = [];
    let currentCard = 0;
    let deckSize = deck.length;
    
    HTMLkeyword = document.getElementById("keyword");
    HTMLdefinition = document.getElementById("definition");
    HTMLimage = document.getElementById("image");
    
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
        HTMLkeyword.innerHTML = keywords[currentCard];
    }
    
    function updateDefinition() {
      HTMLdefinition.innerHTML = definitions[currentCard];
    }
    
    function updateImage() {
        if (images[currentCard] !== '') {
            HTMLimage.src = 'uploads/' + images[currentCard];
        }
        else {
            HTMLimage.src = '';
        }
        
    }
    
    function updateAll() {
        if (HTMLkeyword.style.visibility === "hidden") {
            flip(); // make sure the keyword always shows first
        }
        
        updateKeyword();
        updateDefinition();
        updateImage()
    }
    
    function flip() {
        if (HTMLkeyword.style.visibility !== "hidden") {
            HTMLkeyword.style.visibility = "hidden";
            HTMLdefinition.style.visibility = "visible";
        } 
        else {
            HTMLkeyword.style.visibility = "visible";
            HTMLdefinition.style.visibility = "hidden";
        }
    }
    
    updateAll();
    HTMLdefinition.style.visibility = "hidden"; // hide the definition to begin with
</script>

PAGE;

include_once 'generateHTML.php';