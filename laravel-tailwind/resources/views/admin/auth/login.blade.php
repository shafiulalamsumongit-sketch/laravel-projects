<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VueMart Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-blue-400">Vue<span class="text-white">Mart</span></h1>
            <p class="text-gray-400 mt-2">Admin Panel</p>
        </div>
        <div class="bg-gray-800 rounded-2xl p-8 shadow-2xl">
            @if($errors->any())
                <div class="mb-4 bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg text-sm">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="admin@vuemart.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition-colors">
                    Sign In to Admin
                </button>
            </form>
        </div>
        <p class="text-center text-gray-600 text-sm mt-6">Default: admin@vuemart.com / password</p>
    </div>
</body>
</html>
