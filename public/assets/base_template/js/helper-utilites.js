function passwordValidation(password) {
    const regex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{6,}$/;
    return regex.test(password);
}

function usernameValidation(username) {
    const regex = /^[a-zA-Z]{6,30}$|^[a-zA-Z0-9]{6,30}$/;
    return regex.test(username);
}

function emailValidation(email) {
    const regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    return regex.test(email);
}

function onlyIntegersValidation(string) {
    const regex = /^[0-9]+$/;
    return regex.test(string);
}
