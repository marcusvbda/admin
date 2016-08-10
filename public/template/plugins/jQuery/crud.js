$( document ).ready(function()
{
    $("#btn-filtro").click();
});
$("#filtro").keyup(function(event)
{
    if(event.keyCode == 13)
    {
        $("#btn-filtro").click();
    }
});