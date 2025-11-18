@extends('layouts.admin')

@section('title', 'Paramètres du site')
@section('header', 'Paramètres généraux')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-semibold mb-6">Paramètres généraux</h1>
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="text-sm text-slate-600">Nom du site</label>
            <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" required class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-slate-600">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="text-sm text-slate-600">Email</label>
                <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="text-sm text-slate-600">Adresse</label>
            <input type="text" name="address" value="{{ old('address', $setting->address) }}" class="mt-1 w-full rounded border border-slate-200 px-3 py-2">
        </div>
        <div>
            <label class="text-sm text-slate-600">Logo</label>
            <input type="file" name="logo" class="mt-1 w-full text-sm">
            @if ($setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" class="mt-2 h-16" alt="Logo">
            @endif
        </div>
        <div>
            <label class="text-sm text-slate-600">Liens sociaux</label>
            <div class="mt-1 space-y-2">
                <div class="flex items-center gap-2">
                    <label class="w-24 text-sm text-slate-500">Facebook:</label>
                    <input type="url" name="social_links[facebook]" value="{{ old('social_links.facebook', $setting->social_links['facebook'] ?? '') }}" placeholder="https://facebook.com/yourpage" class="flex-1 rounded border border-slate-200 px-3 py-2">
                </div>
                <div class="flex items-center gap-2">
                    <label class="w-24 text-sm text-slate-500">Twitter:</label>
                    <input type="url" name="social_links[twitter]" value="{{ old('social_links.twitter', $setting->social_links['twitter'] ?? '') }}" placeholder="https://twitter.com/yourhandle" class="flex-1 rounded border border-slate-200 px-3 py-2">
                </div>
                <div class="flex items-center gap-2">
                    <label class="w-24 text-sm text-slate-500">Instagram:</label>
                    <input type="url" name="social_links[instagram]" value="{{ old('social_links.instagram', $setting->social_links['instagram'] ?? '') }}" placeholder="https://instagram.com/yourprofile" class="flex-1 rounded border border-slate-200 px-3 py-2">
                </div>
                <div class="flex items-center gap-2">
                    <label class="w-24 text-sm text-slate-500">LinkedIn:</label>
                    <input type="url" name="social_links[linkedin]" value="{{ old('social_links.linkedin', $setting->social_links['linkedin'] ?? '') }}" placeholder="https://linkedin.com/company/yourcompany" class="flex-1 rounded border border-slate-200 px-3 py-2">
                </div>
                @error('social_links.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-semibold">Enregistrer</button>
    </form>
</div>
@endsection
