'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////





if(window.location.href.indexOf('/') !== -1 && window.location.href.indexOf('/favorite') == -1 ) {

    function sendToBackend(){
        let id = $(this).data('id');
        $.ajax({
            url: getRequestUrl()+'/favorite/addtofavorite',
            type: "POST",
            data: 'citationId='+id
        });
        $(this).toggleClass('red');
        return false;
    }
    
    
    $(document).on('click', '.heart', sendToBackend);
}

if(window.location.href.indexOf('/favorite') !== -1) {

    function sendToBackend(){
        let id = $(this).data('id');
        $.ajax({
            url: getRequestUrl()+'/favorite/addtofavorite',
            type: "POST",
            data: 'citationId='+id
        });
        $(this).toggleClass('red');
        
        if($(this).css('color') !== 'rgb(255, 0, 0)'){
            $(this).parent().parent().parent().remove();
        }
        return false;
    }
    
    
    $(document).on('click', '.heart', sendToBackend);
    
}


if(window.location.href.indexOf('/comment') !== -1) {
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    
}


if(window.location.href.indexOf('/game') !== -1) {
    $('.ennemie_img').css('cursor', 'url('+getWwwUrl()+'/images/cursor/spo15.cur), auto');

    function hideForm(event){
        event.preventDefault();
        if($('.createPlayer input').val() !== ''){
            $('.createPlayer').addClass('hide');
            $('.fightInfos').removeClass('hide');
            let fight = new Program();
            fight.infos();
        }
    }

    $('.createPlayer button').on('click', hideForm);
}
