@props(['model', 'type'])

<x-panel class="flex flex-col">
    {{-- logo when employer --}}
    @if($type === 'employer')
        <div class="mb-4">
            <x-Employer-logo :Employer="$model" width="64" />
        </div>
    @endif

    <div class="flex-1">
        <h3 class="text-xl font-bold">
            {{ $model->name }}
        </h3>

        @if($type === 'employer')
            @if($model->website)
                <p class="text-sm mt-2">
                    <a href="{{ $model->website }}" target="_blank"
                        class="text-blue-800 hover:underline">{{ $model->website }}</a>
                </p>
            @endif
            @if($model->description)
                <p class="text-sm mt-1 text-gray-400">{{ $model->description }}</p>
            @endif
        @else
            <p class="text-sm mt-2 text-gray-400">{{ $model->email }}</p>
        @endif
    </div>
</x-panel>