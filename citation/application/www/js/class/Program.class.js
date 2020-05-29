 class Program {
    constructor(){
        if($('.createPlayer select').find('option:selected').text() === 'Guerrier' ){

            this.combattant = new Combattant(this.capitalizeFirstLetter($('.createPlayer input').val()), 2000 , 120, 'guerrier');
        
        }else if($('.createPlayer select').find('option:selected').text() === 'Chasseur'){

            this.combattant = new Combattant(this.capitalizeFirstLetter($('.createPlayer input').val()), 1800 , 70, 'chasseur');
        
        }else{

            this.combattant = new Combattant(this.capitalizeFirstLetter($('.createPlayer input').val()), 1600 , 80, 'mage');
        
        }
        
        this.ennemie = new Combattant('Barbe noire', 2000, 120, 'guerrier');
        $('.ennemie_img').on('click', this.fight.bind(this));
    }
    
    infos(){
            if(this.combattant.pv<=0 || this.ennemie.pv<=0){
                $('.fightInfos').addClass('hide');
                if(this.combattant.pv<this.ennemie.pv){
                    $('.winner').removeClass('hide');
                    $('.winner h1').text('Vous avez perdue.');
                    $('.winner img').attr('src', getWwwUrl()+'/images/fight/lose.png');
                }else{
                    $('.winner').removeClass('hide');
                    $('.winner h1').text('Bien joué, vous avez gagné !');
                    $('.winner img').attr('src', getWwwUrl()+'/images/fight/win.png');
                }
            }else{
            if(this.combattant.spec === 'guerrier'){
                $('.combattant_img').attr('src', getWwwUrl()+'/images/fight/barbe_blanche.png');
            }else if(this.combattant.spec === 'chasseur'){
                $('.combattant_img').attr('src', getWwwUrl()+'/images/fight/zoro.jpg');
            }else{
                $('.combattant_img').attr('src', getWwwUrl()+'/images/fight/ace.png');
            }    
            $('.combattant_pv').text(this.combattant.pv);
            $('.ennemie_pv').text(this.ennemie.pv);
            $('.combattant_name').text(this.combattant.name);
            }
        }
    
    
    fight() {
        this.combattant.attaquer(this.ennemie);
        this.ennemie.attaquer(this.combattant);
        $('.degats ul').append('<br>');
        this.infos();
    }

    capitalizeFirstLetter(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    
}