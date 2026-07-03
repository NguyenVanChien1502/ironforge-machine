<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — IronForge Machinery</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-charcoal px-6">
    <div class="w-full max-w-md rounded-2xl bg-white p-10 shadow-premium">
        <div class="mb-8 text-center">
            <span class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-gold font-black text-charcoal">IF</span>
            <h1 class="text-2xl font-extrabold text-charcoal">Admin Login</h1>
            <p class="mt-1 text-sm text-gray-500">Sign in to manage IronForge Machinery</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-md bg-red-50 px-4 py-3 text-sm text-red-600 ring-1 ring-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" required autofocus value="{{ old('email') }}" class="input">
            </div>
            <div>
                <label class="label">Password</label>
                <input type="password" name="password" required class="input">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-gold focus:ring-gold">
                Remember me
            </label>
            <button type="submit" class="btn-primary w-full">Sign In</button>
        </form>
    </div>
</body>
</html>
