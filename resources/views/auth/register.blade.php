@extends('template.layouts.auth-layout')
@section('page_title')
    Register
@endsection

@section('main_content')
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <div class="text-center mb-3">
                    <img src="" alt="">
                </div>
                <h4 class="text-center mb-4">Create an account</h4>
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Reference Code</strong>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter (if any)" name="invitation_code"
                                value="{{ old('invitation_code') }}">
                        </div>
                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Username</strong>
                                <sup class="text-danger">*</sup>
                            </label>
                            <input id="usernameField" required type="text" class="form-control"
                                placeholder="Enter 6~30 letters or letters with numbers" name="username"
                                value="{{ old('username') }}">
                        </div>
                        <small id="usernameErrorText" class="error-text"></small>
                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Login Password</strong>
                                <sup class="text-danger">*</sup>
                            </label>
                            <input id="pwdField" required type="password" class="form-control password-field passwordInput"
                                value="" placeholder="Minimum 6 digits with letters and numbers" name="password">
                            <span class="togglePasswordInput password-eye-icon">
                                <i class="fa-solid fa-eye-slash "></i>
                            </span>
                        </div>
                        <small id="pwdErrorText" class="error-text"></small>
                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Confirm Password</strong>
                                <sup class="text-danger">*</sup>
                            </label>
                            <input id="pwdConfirmField" required type="password"
                                class="form-control password-field passwordInput" placeholder="Re-enter password"
                                name="password_confirmation">
                            <span class="togglePasswordInput password-eye-icon">
                                <i class="fa-solid fa-eye-slash "></i>
                            </span>
                        </div>
                        <small id="pwdConfirmErrorText" class="error-text"></small>

                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Telegram</strong>
                                <sup class="text-danger">*</sup>
                            </label>
                            <input id="whatsappField" required type="text" class="form-control"
                                placeholder="Enter your Telegram" name="whatsapp" value="{{ old('whatsapp') }}">
                        </div>
                        <small id="whatsappErrorText" class="error-text"></small>
                        <div class="form-group col-12">
                            <label class="mb-1">
                                <strong>Email</strong>
                            </label>
                            <input id="emailField" type="email" class="form-control" placeholder="Enter your Email"
                                name="email" value="{{ old('email') }}">
                        </div>
                        <small id="emailErrorText" class="error-text"></small>

                        <div class="text-center mt-4 col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register
                                now</button>
                        </div>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p><small>Already have an account?</small>
                        <a class="text-primary text-under" href="{{ route('login') }}">
                            <small><u>Login here</u></small>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        const passwordInput = document.querySelectorAll('.passwordInput');
        const togglePasswordInput = document.querySelectorAll('.togglePasswordInput');
        const pwdField = document.getElementById('pwdField');
        const pwdErrorText = document.getElementById('pwdErrorText');
        const pwdConfirmField = document.getElementById('pwdConfirmField');
        const pwdConfirmErrorText = document.getElementById('pwdConfirmErrorText');
        const usernameField = document.getElementById('usernameField');
        const usernameErrorText = document.getElementById('usernameErrorText');
        const emailField = document.getElementById('emailField');
        const emailErrorText = document.getElementById('emailErrorText');
        const whatsappField = document.getElementById('whatsappField');
        const whatsappErrorText = document.getElementById('whatsappErrorText');
        const registerForm = document.getElementById('registerForm');
        let hasInputError = false

        togglePasswordInput.forEach((item, index) => {
            item.addEventListener('click', () => {
                if (passwordInput[index].type === 'password') {
                    passwordInput[index].type = 'text';
                    togglePasswordInput[index].innerHTML = '<i class="fa-solid fa-eye "></i>';
                } else {
                    passwordInput[index].type = 'password';
                    togglePasswordInput[index].innerHTML =
                        '<i class="fa-solid fa-eye-slash "></i>';
                }
            })
        })

        pwdField.addEventListener('keyup', () => {
            if (!passwordValidation(pwdField.value.trim())) {
                pwdField.parentNode.classList.add('input-danger')
                pwdErrorText.innerText =
                    'Password must have minimum of 6 digits containing letters and numbers'
                pwdErrorText.style.display = 'block'
                hasInputError = true
            } else {
                pwdField.parentNode.classList.remove('input-danger')
                pwdErrorText.innerText = ''
                pwdErrorText.style.display = 'none'
                hasInputError = false
            }
        })

        pwdConfirmField.addEventListener('keyup', () => {
            if (pwdConfirmField.value.trim() !== pwdField.value
                .trim()) {
                pwdConfirmField.parentNode.classList.add('input-danger')
                pwdConfirmErrorText.innerText =
                    'Re-entered password did not match'
                pwdConfirmErrorText.style.display = 'block'
                hasInputError = true
            } else {
                pwdConfirmField.parentNode.classList.remove('input-danger')
                pwdConfirmErrorText.innerText = ''
                pwdConfirmErrorText.style.display = 'none'
                hasInputError = false
            }
        })

        usernameField.addEventListener('keyup', () => {
            if (!usernameValidation(usernameField.value.trim())) {
                usernameField.parentNode.classList.add('input-danger')
                usernameErrorText.innerText =
                    'Username should contain letters or letters with numbers having length of 6-30 characters'
                usernameErrorText.style.display = 'block'
                hasInputError = true
            } else {
                usernameField.parentNode.classList.remove('input-danger')
                usernameErrorText.innerText = ''
                usernameErrorText.style.display = 'none'
                hasInputError = false
            }
        })

        emailField.addEventListener('keyup', () => {
            if (emailField.value.trim().length && !emailValidation(emailField.value.trim())) {
                emailField.parentNode.classList.add('input-danger')
                emailErrorText.innerText =
                    'Invalid Email address'
                emailErrorText.style.display = 'block'
                hasInputError = true
            } else {
                emailField.parentNode.classList.remove('input-danger')
                emailErrorText.innerText = ''
                emailErrorText.style.display = 'none'
                hasInputError = false
            }
        })

        whatsappField.addEventListener('keyup', () => {
            if (!onlyIntegersValidation(whatsappField.value.trim())) {
                whatsappField.parentNode.classList.add('input-danger')
                whatsappErrorText.innerText =
                    'Invalid Number'
                whatsappErrorText.style.display = 'block'
                hasInputError = true
            } else {
                whatsappField.parentNode.classList.remove('input-danger')
                whatsappErrorText.innerText = ''
                whatsappErrorText.style.display = 'none'
                hasInputError = false
            }
        })

        registerForm.addEventListener('submit', ($event) => {
            $event.preventDefault()
            if (!hasInputError) {
                registerForm.submit()
            }
        })
    </script>
@endsection
