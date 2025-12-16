<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Metropolis Grid</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
</head>
<body class="bg-stone-50 p-4 font-sans select-none text-stone-800">
    
    <header class="flex flex-col items-center mb-8 mt-4">
        <div class="flex items-center gap-3 mb-2">
            <div class="grid grid-cols-2 gap-1 rotate-45">
                <div class="w-3 h-3 bg-red-900"></div>
                <div class="w-3 h-3 border-2 border-red-900"></div>
                <div class="w-3 h-3 border-2 border-red-900"></div>
                <div class="w-3 h-3 bg-orange-600"></div>
            </div>
            <h1 class="text-4xl font-bold text-red-900 tracking-wide">METROPOLIS</h1>
        </div>
        <div class="w-full max-w-4xl border-t-2 border-dashed border-red-900 opacity-30 mt-2"></div>
        <script src="{{ asset('js/grid.js') }}" defer></script>
    </header>

    @php
        $components = [
            'c-housing'    => ['label' => 'Housing',    'image' => 'https://placehold.co/150x150/7f1d1d/ffffff?text=Home'],
            'c-park'       => ['label' => 'Park',       'image' => 'https://placehold.co/150x150/15803d/ffffff?text=Park'],
            'c-office'     => ['label' => 'Office',     'image' => 'https://placehold.co/150x150/1e3a8a/ffffff?text=Office'],
            'c-commercial' => ['label' => 'Commercial', 'image' => 'https://placehold.co/150x150/d97706/ffffff?text=Shop'],
            'c-school'     => ['label' => 'School',     'image' => 'https://placehold.co/150x150/0891b2/ffffff?text=School'],
            'c-hospital'   => ['label' => 'Hospital',   'image' => 'https://placehold.co/150x150/a21caf/ffffff?text=Care'],
        ];
    @endphp

    <script>
        window.gridComponents = @json($components);
    </script>

    <main class="flex flex-col lg:flex-row gap-6 justify-center max-w-7xl mx-auto items-start">
        
        <div class="w-full max-w-md lg:w-64 p-4 bg-white shadow rounded border border-stone-200 lg:sticky lg:top-5">
            <h2 class="font-bold mb-4 text-red-900">Bibliotheek</h2>
            <div class="grid grid-cols-2 gap-3" id="component-library" ondragover="allowDrop(event)" ondrop="handleDrop(event)">
                @foreach($components as $id => $data)
                    <div 
                        class="component-button group relative aspect-square rounded overflow-hidden cursor-grab border border-stone-200 shadow-sm hover:shadow-md hover:border-red-300 transition"
                        draggable="true" 
                        id="{{ $id }}"
                    >
                        <img src="{{ $data['image'] }}" class="w-full h-full object-cover" alt="{{ $data['label'] }}">
                        <div class="absolute bottom-0 w-full bg-red-900/80 text-white text-xs text-center py-1">
                            {{ $data['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-full lg:flex-1 p-4 bg-white shadow rounded border border-stone-200 flex flex-col items-center">
            <h2 class="font-bold mb-4 text-red-900">Grid</h2>
            <div class="grid grid-cols-6 grid-rows-4 gap-1 w-full max-w-[720px] aspect-[3/2] bg-stone-200 p-1 rounded">
                @for ($i = 0; $i < 24; $i++)
                    @php
                        $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
                        $col = $i % 6;
                        $row = floor($i / 6) + 1;
                        $coord = $letters[$col] . $row;
                    @endphp
                    <div data-coordinate="{{ $coord }}"
                         class="bg-white border border-stone-300 flex items-center justify-center relative grid-cell overflow-hidden rounded-sm hover:border-red-500 transition"
                         ondragover="allowDrop(event)" 
                         ondrop="handleDrop(event)">
                    </div>
                @endfor
            </div>
        </div>

        <div class="w-full max-w-md lg:w-64 p-4 bg-white shadow rounded border border-stone-200 lg:sticky lg:top-5">
            <h2 class="font-bold mb-4 text-red-900">Simulatie Effecten</h2>

            <div class="flex flex-col gap-4 mb-6">
                <div>
                    <div class="flex justify-between text-sm mb-1 text-stone-700 font-medium">
                        <span>Leefbaarheid</span>
                        <span>-</span>
                    </div>
                    <div class="w-full h-3 bg-stone-200 rounded-full overflow-hidden">
                        <div class="h-full bg-green-600 w-0"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1 text-stone-700 font-medium">
                        <span>Welzijn</span>
                        <span>-</span>
                    </div>
                    <div class="w-full h-3 bg-stone-200 rounded-full overflow-hidden">
                        <div class="h-full bg-sky-600 w-0"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1 text-stone-700 font-medium">
                        <span>Duurzaamheid</span>
                        <span>-</span>
                    </div>
                    <div class="w-full h-3 bg-stone-200 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-600 w-0"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1 text-stone-700 font-medium">
                        <span>Economie</span>
                        <span>-</span>
                    </div>
                    <div class="w-full h-3 bg-stone-200 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-500 w-0"></div>
                    </div>
                </div>
            </div>

            <button onclick="console.log(getCoordinates())" class="w-full bg-red-900 text-white py-3 px-4 rounded font-bold hover:bg-red-800 transition shadow active:scale-95">
                Start Simulatie
            </button>
        </div>
    </main>
</body>
</html>