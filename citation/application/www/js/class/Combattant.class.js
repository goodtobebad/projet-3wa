class Combattant {
    
    constructor(name, pv, attaque, spec){
        this.name = name;
        this.pv = pv;
        this.attaque = attaque;
        this.spec = spec;
    }
    
    attaquer(ennemie) {
        if(this.spec === 'guerrier'){
            let rand_int = this.GetRandomInteger(30, 100);
            ennemie.pv -= this.attaque;
            this.pv += rand_int;
            if(this.name === 'Barbe noire'){
                $('.fightInfos ul').append('<li class="red">'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+this.attaque+' points de dégats.'+this.name+ ' récupére '+ rand_int +' points de vie.<li>');
            }else{
                $('.fightInfos ul').append('<li>'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+this.attaque+' points de dégats.'+this.name+ 'récupére'+ rand_int +' points de vie.<li>');
            }
        }else if(this.spec === 'chasseur'){
            let rand_int = this.GetRandomInteger(1,4);
            ennemie.pv -= (this.attaque * rand_int);
            if(this.name === 'Barbe noire'){
                $('.fightInfos ul').append('<li class="red">'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+rand_int +' fois '+this.attaque+' points de dégats.<li>');
            }else{
                $('.fightInfos ul').append('<li>'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+rand_int +' fois '+this.attaque+' points de dégats.<li>');
            }
        }else{
            let rand_int = this.GetRandomInteger(40, 75);
            ennemie.pv -= (this.attaque + rand_int);
            if(this.name === 'Barbe noire'){
                $('.fightInfos ul').append('<li class="red">'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+this.attaque+'points de dégats et '+rand_int+' dégats magiques.<li>');
            }else{
                $('.fightInfos ul').append('<li>'+ this.name + ' a attaqué '+ ennemie.name + ' et lui a infligé '+this.attaque+'points de dégats et '+rand_int+' dégats magiques.<li>');
            }
        }
           
    }

    GetRandomInteger(min, max){
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    
}