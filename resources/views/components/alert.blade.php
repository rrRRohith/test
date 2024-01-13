<div class="alert alert-{{ $type }} {{ $class }}">
    {{ __($message) }}
    @if($dismiss)
    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>