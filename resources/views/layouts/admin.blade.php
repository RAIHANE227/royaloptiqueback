<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - {{ app('settings')->get('site_name', 'Optique Royale') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen">
            <div class="px-6 py-5 border-b border-slate-200">
                <p class="text-xs uppercase tracking-widest text-slate-400">Administration</p>
                @if(app('settings')->get('logo'))
                    <img src="{{ asset('storage/' . app('settings')->get('logo')) }}" alt="{{ app('settings')->get('site_name', 'Optique Royale') }}" class="h-6 w-auto mt-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <p class="text-xl font-semibold text-slate-900" style="display:none;">{{ app('settings')->get('site_name', 'Optique Royale') }}</p>
                @else
                    <p class="text-xl font-semibold text-slate-900">{{ app('settings')->get('site_name', 'Optique Royale') }}</p>
                @endif
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Dashboard
                </a>
    
                    <a href="{{ route('admin.produits.index') }}" class="flex items-center px-3 py-2 rounded-lg font-medium hover:bg-slate-100 {{ request()->routeIs('admin.produits.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-600' }}">
                        Produits
                    </a>
                  
                
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.categories.*') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Catégories
                </a>
                <a href="{{ route('admin.commandes.index') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.commandes.*') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Commandes
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.users.*') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Utilisateurs
                </a>
                <a href="{{ route('admin.livraison.index') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.livraison.*') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Livraison
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center px-3 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-100 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-100 text-slate-900' : '' }}">
                    Paramètres
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0">
                <div>
                    <p class="text-sm text-slate-500">Espace administrateur</p>
                    <h1 class="text-lg font-semibold text-slate-900">@yield('header', 'Tableau de bord')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right text-sm">
                        <p class="font-semibold text-slate-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-slate-500">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-slate-500 hover:text-slate-700">Déconnexion</button>
                    </form>
                </div>
            </header>
            <main class="flex-1 p-8">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-800">{{ session('error') }}</p>
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-blue-800">{{ session('info') }}</p>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-800">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
