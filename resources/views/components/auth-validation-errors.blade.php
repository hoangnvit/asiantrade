@props(['errors'])
<div class="col-md-12">
@if ($errors->any())
    <div {{ $attributes }} >
        <div class="font-medium  text-center text-danger">
            {{ __('Some Errors.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-center text-red-600 text-warning">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>