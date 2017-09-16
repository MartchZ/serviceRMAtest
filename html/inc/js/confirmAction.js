//When an action is made by a user (e.g. button clicked), confirm the action.
function confirmAction(formID)
{
    if(confirm("Really do the thing?"))
    {
        document.getElementById(formID).submit();
    }
    return false;
    
}