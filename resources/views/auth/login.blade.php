@extends('layout.app')

@section('content')

<!-- Account Section -->
<section class="auth-wrapper">
    <div class="auth-container">
        <div class="auth-tab-group">
            <button class="auth-tab-btn {{ session('show_login') || !$errors->any() ? 'active' : '' }}" data-tab="login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <button class="auth-tab-btn {{ $errors->any() ? 'active' : '' }}" data-tab="register">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </div>

        <div class="auth-forms-wrapper">
            <!-- Login Form -->
            <div id="login" class="auth-form-item {{ session('show_login') || !$errors->any() ? 'active' : '' }}">
                {{-- LOGIN ERROR --}}
                @if ($errors->has('login_error'))
                <div class="auth-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first('login_error') }}
                </div>
                @endif

                {{-- REGISTER SUCCESS MESSAGE --}}
                @if (session('success'))
                <div class="auth-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                @error('password')
                <div class="auth-error">{{ $message }}</div>
                @enderror

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="auth-input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="auth-input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="auth-form-options">
                        <label class="auth-remember-label">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="auth-forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="auth-submit-btn">Login</button>

                </form>
            </div>


            <!-------- Registration Form --------->
            <div id="register" class="auth-form-item {{ $errors->any() ? 'active' : '' }}">
                @if ($errors->any())
                <div class="auth-error">
                    <i class="fas fa-exclamation-circle"></i>

                    @if ($errors->has('email'))
                    {{ $errors->first('email') }}

                    @elseif ($errors->has('password'))
                    {{ $errors->first('password') }}

                    @elseif ($errors->has('password_confirmation'))
                    {{ $errors->first('password_confirmation') }}

                    @else
                    Please check the form for errors.

                    @endif
                </div>
                @endif
                <div id="registerError" class="auth-error" style="display: none;"></div>
                <form id="registerForm" method="POST" action="{{route('register.submit')}}">
                    @csrf
                    <div class="auth-input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                        <div class="invalid-feedback" id="nameError"></div>
                    </div>
                    <div class="auth-input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Enter your email address" required>
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>
                    <div class="auth-input-group">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone" placeholder="Enter your phone number" required>
                        <div class="invalid-feedback" id="phoneError"></div>
                    </div>
                    <div class="auth-input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Create a password" required>
                        <div class="invalid-feedback" id="passwordError"></div>
                    </div>
                    <div class="auth-input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                        <div class="invalid-feedback" id="passwordConfirmationError"></div>
                    </div>
                    <button type="submit" class="auth-submit-btn" id="registerButton">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection