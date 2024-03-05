const form = document.getElementById('Form');
const username = document.getElementById('username');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.errorInfo');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('valid')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.errorInfo');

    errorDisplay.innerText = '';
    inputControl.classList.add('valid');
    inputControl.classList.remove('error');
};


//Check valid input
const validateInputs = () => {
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    var check, check2 = 0;

    //Check username
    if(usernameValue === '') {
        setError(username, 'Vui lòng nhập username');
        check++;
    } else if(usernameValue.length > 20) {
        setError(username, 'Username không được quá 20 ký tự!');
        check++;
    } else {
        setSuccess(username);
        check = 0;
    }

    //Check password
    if(passwordValue === '') {
        setError(password, 'Vui lòng nhập mật khẩu');
        check2++;
    } else if (passwordValue.length < 6 ) {
        setError(password, 'Mật khẩu phải chứa ít nhất 6 ký tự')
        check2++;
    } else {
        setSuccess(password);
        check2 = 0;
    }


    //RESULT
    // if (check + check2 === 0) {
    //     do something here!
    // }
};