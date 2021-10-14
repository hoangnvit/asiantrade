@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-center text-danger']) }}>
        {{ $status }}
    </div>
@endif
