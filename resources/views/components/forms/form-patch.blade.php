<form method="POST" {{ $attributes }}>
    @method("PATCH")
    @csrf
    {{ $slot }}
</form>
