    var file = document.getElementById('file')
    var lbimport = document.getElementById('lbimport')
    function vk()
    {
        var etat;
        if(file.value =='')
        {
            etat =false
            lbimport.innerHTML='please check your import file '
        }
        else{
            etat =true
        }
        return etat 
    }


    var annéescolaire = document.getElementById('année-scolaire')
    var année = document.getElementById('année')
    function checkobligatoire()
    {
        var etat1,etat2;
        if(annéescolaire.value =='')
        {
            etat1 =false
            annéescolaire.style.border='2px solid red'
        }
        else{
            etat1 =true
            annéescolaire.style.border='2px solid var(--color2)'
        }
       
       
    }