<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCore | Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3">
                <div class="p-3 bg-blue-600 rounded-xl text-white">
                    <i data-feather="activity" class="w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold text-slate-800">MediCore</span>
            </div>
            <p class="text-slate-500 mt-2 text-sm">Hospital Management System</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">

            <h2 class="text-xl font-bold text-slate-800 mb-1">Forgot Password?</h2>
            <p class="text-slate-500 text-sm mb-6">
                No problem. Just enter your email address and we will send you a password reset link.
            </p>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
                    <i data-feather="check-circle" class="w-4 h-4"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                            <i data-feather="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border border-slate-200 rounded-xl pl-11 pr-4 py-3 outline-none focus:ring-4 focus:ring-blue-50 focus:border-blue-500 transition-all @error('email') border-rose-500 @enderror"
                            placeholder="john@example.com">
                    </div>
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition-all flex items-center justify-center gap-2">
                    <i data-feather="send" class="w-4 h-4"></i>
                    Send Reset Link
                </button>

            </form>

            {{-- Back to login --}}
            <p class="text-center text-sm text-slate-500 mt-6">
                Remember your password?
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                    Sign in here
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            © 2026 MediCore. All rights reserved.
        </p>

    </div>

    <script>feather.replace();</script>
</body>
</html>