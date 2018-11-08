$(function(){
    $('#teleporter').click(function() {
        window.scroll({
            top: $('#headerContainer').height() + $('#banniereContainer').height(), 
            left: 0, 
            behavior: 'smooth' 
        });
    });
})