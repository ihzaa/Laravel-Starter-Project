<form method="POST" {{ $attributes }}>
    @method("PUT")
    @csrf
    {{ $slot }}
</form>
