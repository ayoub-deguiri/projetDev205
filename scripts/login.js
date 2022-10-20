const form=document.getElementById('form');
const matricule=document.getElementById('matricule');
const password=document.getElementById('password');



form.addEventListener('submit',e =>{
    e.preventDefault();

    checkInputs();
})

const setError=(element,message)=>{
    const formControl=element.parentElement;
    const errorDisplay=formControl.querySelector('.error');

    errorDisplay.innerText=message;
    formControl.classList.add('error');
    formControl.classList.remove('success');
}

const setSuccess=element=>{
    const formControl=element.parentElement;
    const errorDisplay=formControl.querySelector('.error');

    errorDisplay.innerText='';
    formControl.classList.add('success');
    formControl.classList.remove('error');

}



const checkInputs=()=>{
    const matriculeValue=matricule.value.trim();
    const passwordValue=password.value.trim(); 

    if(matriculeValue===''){
        setError(matricule,'matricule est obligatoir')
    } 
    else{
        setSuccess(matricule)
     
    }


    if(passwordValue===''){
        setError(password,'mot de passe est obligatoir')
    }
    else{
        setSuccess(password)
    }
}




