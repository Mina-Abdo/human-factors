const loginForm = document.getElementById('login');
loginForm.addEventListener('submit', function(event){
    event.preventDefault();
    //perform input validation
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    if(email && password){
        window.location.href = "therapistIndex.php";
    }else{
        let errorMessage = document.createElement('div');
        errorMessage.id = 'errorMessage';
        errorMessage.textContent = "Invalid email or password";
        errorMessage.style.color = 'red';
        errorMessage.style.marginTop = '15px';
        errorMessage.style.fontSize = '20px';
        errorMessage.style.textAlign = 'center';
        document.getElementById('login').appendChild(errorMessage);
        setTimeout(() => {
            errorMessage.remove();
        }, 2000);
    }
})