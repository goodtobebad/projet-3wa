'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////





if(window.location.href.indexOf('/') !== -1) {


    function submitForm(e){
        event.preventDefault();
        let id = this.dataset.id;
        let form = '#fav_form'+ id;
        $(form).submit();
    }
    
    $(document).on('click', '.heart', submitForm);

}


 if(window.location.href.indexOf('/comment') !== -1) {
//      pour pas que le formulaire s'envoie à chaque refresh
     
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
