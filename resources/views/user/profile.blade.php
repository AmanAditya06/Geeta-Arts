@extends('layout.app')

@section('content')
<div class="gtaprof-main">
    <div class="gtaprof-header">
        <h1 class="gtaprof-title">My Profile</h1>
        <p class="gtaprof-subtitle">Edit Your Account Details</p>
    </div>

    <div class="gtaprof-body">
        <!-- ========== PERSONAL INFORMATION ========== -->
        <div class="gtaprof-section">
            <div class="gtaprof-section-header">
                <h3 class="gtaprof-section-title">
                    <i class="fas fa-user"></i> Personal Information
                </h3>
                <!-- <a href="#" class="gtaprof-edit-link">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a> -->
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <div class="gtaprof-form-grid">
                    <div class="gtaprof-form-group">
                        <label class="gtaprof-label">Name</label>
                        <input type="text" name="name" class="gtaprof-input" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your name">
                    </div>
                    <div class="gtaprof-form-group">
                        <label class="gtaprof-label">Email Address</label>
                        <input type="email" class="gtaprof-input" value="{{ Auth::user()->email }}" placeholder="Enter email address" readonly>
                    </div>
                    <div class="gtaprof-form-group">
                        <label class="gtaprof-label">Mobile Number</label>
                        <input type="tel" name="phone" class="gtaprof-input" value="{{ old('phone', auth()->user()->phone) }}" placeholder="Enter mobile number" required>
                    </div>
                </div>
                <button type="submit" class="gtaprof-btn gtaprof-btn-primary">
                    <i class="fas fa-save"></i> UPDATE
                </button>
            </form>
        </div>

        <!-- ========== PASSWORD ========== -->
        <div class="gtaprof-section">
            <div class="gtaprof-section-header">
                <h3 class="gtaprof-section-title">
                    <i class="fas fa-lock"></i> Password
                </h3>
                <!-- <a href="#" class="gtaprof-edit-link">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a> -->
            </div>

            <form action="{{ route('user.profile.password') }}" method="POST">
                @csrf
                <div class="gtaprof-form-grid">
                    <div class="gtaprof-form-group">
                        <label class="gtaprof-label">New Password</label>
                        <input type="password" name="password" class="gtaprof-input @error('password') is-invalid @enderror" placeholder="Enter new password" required>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="gtaprof-form-group">
                        <label class="gtaprof-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="gtaprof-input" placeholder="Confirm new password" required>
                    </div>
                </div>
                
                <button type="submit" class="gtaprof-btn gtaprof-btn-primary">
                    <i class="fas fa-refresh"></i> UPDATE PASSWORD
                </button>
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection