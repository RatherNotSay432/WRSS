document.getElementById('showPassword').addEventListener('change', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm-password')
    if (this.checked) {
        passwordInput.setAttribute('type', 'text');
        confirmInput.setAttribute('type', 'text'); 
    } else {
        passwordInput.setAttribute('type', 'password');
        confirmInput.setAttribute('type', 'password');  
    }
});