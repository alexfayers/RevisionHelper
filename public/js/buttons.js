function delete_term(id)
{
    if(confirm("Are you sure you want to delete this keyword?")==true)
        window.location="?page=remove_term&term="+id;
    return false;
}