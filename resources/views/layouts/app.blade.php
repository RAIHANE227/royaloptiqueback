<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Boutique de lunettes')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            @if(app('settings')->get('logo'))
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('storage/' . app('settings')->get('logo')) }}" alt="{{ app('settings')->get('site_name', 'Optique Royale') }}" class="h-8 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="text-2xl font-semibold text-indigo-600" style="display:none;">{{ app('settings')->get('site_name', 'Optique Royale') }}</div>
                </a>
            @else
                <a href="{{ route('home') }}" class="text-2xl font-semibold text-indigo-600">{{ app('settings')->get('site_name', 'Optique Royale') }}</a>
            @endif
            <nav class="hidden md:flex items-center gap-4 text-sm font-medium">
                <a href="{{ route('selection') }}" class="hover:text-indigo-600">Sélection</a>
                <a href="{{ route('lunettes') }}" class="hover:text-indigo-600">Lunettes</a>
                <a href="{{ route('lentilles') }}" class="hover:text-indigo-600">Lentilles</a>
                <a href="{{ route('verres-medicaux') }}" class="hover:text-indigo-600">Verres Médicaux</a>
                <a href="{{ route('accessoires') }}" class="hover:text-indigo-600">Accessoires</a>
                <a href="{{ route('faq') }}" class="hover:text-indigo-600">FAQ</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-600">Contact</a>
            </nav>
            <div class="hidden md:flex items-center gap-3 text-sm font-medium">
                @auth
                    <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">Panier</a>
                    <a href="{{ route('profile.index') }}" class="hover:text-indigo-600">Mon profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:text-red-600">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Inscription</a>
                @endauth
            </div>
            <button class="md:hidden" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
        </div>
        <div id="mobile-menu" class="md:hidden hidden border-t border-slate-200">
            <div class="px-4 py-3 space-y-2 text-sm">
                <a href="{{ route('selection') }}" class="block">Sélection</a>
                <a href="{{ route('lunettes') }}" class="block">Lunettes</a>
                <a href="{{ route('lentilles') }}" class="block">Lentilles</a>
                <a href="{{ route('verres-medicaux') }}" class="block">Verres Médicaux</a>
                <a href="{{ route('accessoires') }}" class="block">Accessoires</a>
                <a href="{{ route('faq') }}" class="block">FAQ</a>
                <a href="{{ route('contact') }}" class="block">Contact</a>
                @auth
                    <a href="{{ route('cart.index') }}" class="block">Panier</a>
                    <a href="{{ route('profile.index') }}" class="block">Mon profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-2">
                        @csrf
                        <button class="text-red-500">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block">Connexion</a>
                    <a href="{{ route('register') }}" class="block">Inscription</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-16">
        <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-slate-500 flex flex-wrap justify-between gap-4">
            <p>© {{ date('Y') }} {{ app('settings')->get('site_name', 'Optique Royale') }}. Tous droits réservés.</p>
            <div class="space-x-4">
                <a href="{{ route('mentions') }}" class="hover:text-indigo-600">Mentions légales</a>
                <a href="{{ route('privacy') }}" class="hover:text-indigo-600">Politique de confidentialité</a>
            </div>
        </div>
    </footer>
</body>
</html>
