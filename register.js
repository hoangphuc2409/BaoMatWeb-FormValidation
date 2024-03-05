const form = document.getElementById('Form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

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

const validEmail = email => {
    const valid = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return valid.test(String(email).toLowerCase());
}

const validPhoneNumber = str => {
    const regex = /^0\d+$/;
    return regex.test(str);
}

//Check valid input
const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    var check, check2, check3, check4, check5 = 0;

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

    //Check email
    if(emailValue === '') {
        setError(email, 'Vui lòng nhập email');
        check2++;
    } else if (!validEmail(emailValue)) {
        setError(email, 'Email không hợp lệ!');
        check2++;
    } else {
        setSuccess(email);
        check2 = 0;
    }

    //Check phone number
    if(validPhoneNumber(phoneValue) === true && phoneValue.length === 10) {
        setSuccess(phone);
        check3 = 0;
    } else if(phoneValue ==='') {
        setError(phone, 'Vui lòng nhập số điện thoại');
    } else {
        setError(phone, 'Số điện thoại không hợp lệ!');
        check3++;
    }

    //Check password
    if(passwordValue === '') {
        setError(password, 'Vui lòng nhập mật khẩu');
        check4++;
    } else if (passwordValue.length < 6 ) {
        setError(password, 'Mật khẩu phải chứa ít nhất 6 ký tự')
        check4++;
    } else {
        setSuccess(password);
        check4 = 0;
    }

    //Check confirmed password
    if(password2Value === '') {
        setError(password2, 'Vui lòng nhập lại mật khẩu');
        check5++;
    } else if (password2Value !== passwordValue) {
        setError(password2, "Mật khẩu không chính xác!");
        check5++;
    } else if (password2Value == passwordValue && passwordValue.length < 6 ) {
        setError(password2, "Mật khẩu phải chứa ít nhất 6 ký tự");
        check5++;
    } else {
        setSuccess(password2);
        check5 = 0;
    }

    //RESULT
    if (check + check2 + check3 + check4 + check5 === 0) {
        alert("Đăng ký thành công!");
        window.location.href ='login.html';
    }
};