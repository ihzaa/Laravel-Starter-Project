<form method="POST" {{ $attributes }}>
    @method("DELETE")
    @csrf
    {{ $slot }}
</form>
