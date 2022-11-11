const cef=document.getElementById('cef');
const nom=document.getElementById('nom');
const prenom=document.getElementById('prenom');
const form=document.getElementById('form');
const error=document.getElementById('error');
const error2=document.getElementById('error2');
const error3=document.getElementById('error3');

let etat1=false
let etat2=false
let etat3=false

form.addEventListener("keyup",()=>{

   let cefValue=cef.value.trim()
   let nomValue=nom.value.trim()
   let prenomValue=prenom.value.trim()
   errorValue=error.value
  if(cefValue==''){
   error.innerText='cef obligatoir'
      
   etat1=false
  }
 else{
   error.innerHTML=''
   etat1=true
 }




 if(nomValue==''){
   error2.innerText='nom obligatoir'
      
   etat2=false
  }
 else{
   error2.innerHTML=''
   etat2=true
 }


 if(prenomValue==''){
   error3.innerText='prenom obligatoir'

   etat3=false
      
  }
 else{
   error3.innerHTML=''

   etat3=true
 }
})

nom.addEventListener('change', function() {
  
});



form.addEventListener('submit',(e)=>{
   if(etat1==false || etat2==false || etat3==false){
      e.preventDefault();
   }
})