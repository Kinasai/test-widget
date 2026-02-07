@props(['options', 'name', 'empty' => '-- Выберите --', 'selected' => null])

<select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'your-default-classes']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $label }}
        </option>
    @endforeach
</select>
