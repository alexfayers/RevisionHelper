function delete_term(id)
{
    if(confirm("Are you sure you want to delete this keyword?")==true)
        window.location="?page=remove_term&term="+id;
    return false;
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}