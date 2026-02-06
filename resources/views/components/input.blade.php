@props(['type' => 'text', 'id', 'placeholder', 'error' => false])

<div class="form-group">
    <input type="{{ $type }}" name="{{ $id }}" class="form-control" placeholder="{{ $placeholder }}" id="{{ $id }}">
    <div id="message_{{$id}}" class="text-danger"></div>
</div>
