@props(['options', 'name', 'selected' => null])

<select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'your-default-classes']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">
            {{ $label }}
        </option>
    @endforeach
</select>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('{{ $name }}').value = "{{$selected}}";
    })
</script>
