@if (session('success'))
    <div class="mb-6 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="mb-6 rounded border border-sky-200 bg-sky-50 px-4 py-3 text-sky-700">
        {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 rounded border border-amber-200 bg-amber-50 px-4 py-3 text-amber-700">
        <p class="font-semibold">Merci de corriger les erreurs suivantes :</p>
        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
