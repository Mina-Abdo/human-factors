const registerForm = document.getElementById('register')
registerForm.addEventListener('submit', function(event){
    event.preventDefault();
    //perform input validation
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    if(name && email && password){
        let successMessage = document.createElement('div');
        successMessage.id = 'successfullyRegistered';
        successMessage.textContent = "Successfully registered"
        successMessage.style.color = 'green';
        successMessage.style.marginTop = '20px';
        successMessage.style.fontSize = '20px';
        successMessage.style.textAlign = 'center';
        registerForm.insertBefore(successMessage, registerForm.firstChild);
        registerForm.appendChild(successMessage)
        setTimeout(() => {
            window.location.href = "therapistIndex.html";
        }, 2000);
    }else{
        let errorMessage = document.createElement('div');
        errorMessage.id = 'errorMessage';
        errorMessage.textContent = "Invalid email or password";
        errorMessage.style.color = 'red';
        errorMessage.style.marginTop = '15px';
        errorMessage.style.fontSize = '20px';
        errorMessage.style.textAlign = 'center';
        registerForm.appendChild(errorMessage);
        setTimeout(() => {
            errorMessage.remove();
        }, 2000);
    }
})