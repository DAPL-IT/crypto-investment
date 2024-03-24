@extends('template.layouts.auth-layout')
@section('page_title')
    Login
@endsection

@section('main_content')
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="auth-form">
                <div class="text-center mb-3">
                    <img src="{{ asset('images/site/icon/icon.png') }}" alt="logo">
                </div>
                <h4 class="text-center mb-4 heading">Send Forgot Password Request</h4>
                <form method="POST" action="{{ route('custom.forgot.password.mail') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="mb-1 label"><strong>Username/Email</strong></label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                autocomplete="off">
                        </div>
                        <div class="form-group col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p><small>Want to login? </small><a class="text-primary"
                            href="{{ route('login') }}"><small><u>Login</u></small></a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        const passwordInput = document.querySelectorAll('.passwordInput');
        const togglePasswordInput = document.querySelectorAll('.togglePasswordInput');


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
    </script>
@endsection
