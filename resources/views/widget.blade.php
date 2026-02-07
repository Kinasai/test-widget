<html lang="en">
<head>
    <title>Форма обратной связи</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container panel panel-default ">
    <h2 class="">Форма обратной связи</h2>
    <form id="ticket" enctype="multipart/form-data">
        <div class="form-group">
            <x-input class="form-control" name="name" id="name" placeholder="Введите имя" type="text"></x-input>
            <div id="message_name" class="text-danger"></div>
        </div>
        <div class="form-group">
            <x-input class="form-control" name="id" id="email" placeholder="Введите email" type="text"></x-input>
            <div id="message_email" class="text-danger"></div>
        </div>
        <div class="form-group">
            <x-input class="form-control" name="phone_number" id="phone_number" placeholder="Введите телефон +7..." type="text"></x-input>
            <div id="message_phone_number" class="text-danger"></div>
        </div>
        <div class="form-group">
            <x-input class="form-control" name="title" id="title" placeholder="Введите тему" type="text"></x-input>
            <div id="message_title" class="text-danger"></div>
        </div>
        <div class="form-group">
            <x-textarea class="form-control" name="text" id="text" placeholder="Введите сообщение" type="text"></x-textarea>
            <div id="message_text" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="file">Прикрепить файл</label>
            <input id="file" name="file" type="file" accept="image/*" />
        </div>
        <div id="message_file" class="text-danger"></div>
        <div class="form-group">
            <button class="btn btn-success" id="submit">Отправить</button>
        </div>
        <div id="message_success" class="text-success-emphasis"></div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
    const form = $('#ticket');
    form.on('submit',function(event){
        event.preventDefault();

        const formData = new FormData();
        /*formData.append('_token', '{{ csrf_token() }}');*/

        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('phone_number', $('#phone_number').val());
        formData.append('title', $('#title').val());
        formData.append('text', $('#text').val());

        const fileInput = document.getElementById('file');
        if (fileInput.files.length > 0) {
            formData.append('file', fileInput.files[0]);
        }

        clearErrorMessages();

        $.ajax({
            url: "/api/tickets",
            type:"POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            credentials: 'include',
            success:function(response){
                document.querySelector('#message_success').innerHTML = 'Успешно отправлено';
                document.querySelector('#message_success').className = 'alert alert-success';

                form[0].reset();
            },
            error:function(response){
                document.querySelector('#message_success').innerHTML = '';
                document.querySelector('#message_success').className = '';

                if (response.responseJSON && response.responseJSON.errors) {
                    const errors = response.responseJSON.errors;

                    displayError('name', errors.name);
                    displayError('email', errors.email);
                    displayError('phone_number', errors.phone_number);
                    displayError('title', errors.title);
                    displayError('text', errors.text);
                    displayError('file', errors.file);
                } else {
                    document.querySelector('#message_success').innerHTML = 'Произошла ошибка при отправке';
                    document.querySelector('#message_success').className = 'alert alert-danger';
                }
            }
        });
    });

    function displayError(fieldName, errorMessage) {
        const element = document.querySelector(`#message_${fieldName}`);
        if (element && errorMessage) {
            element.innerHTML = errorMessage;
        }
    }

    function clearErrorMessages() {
        const errorFields = ['name', 'email', 'phone_number', 'title', 'text', 'file'];
        errorFields.forEach(field => {
            const element = document.querySelector(`#message_${field}`);
            if (element) {
                element.innerHTML = '';
            }
        });
    }

    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const maxSize = 5 * 1024 * 1024;

        if (file && file.size > maxSize) {
            document.querySelector('#message_file').innerHTML = 'Файл слишком большой. Максимальный размер: 5MB';
            e.target.value = '';
        } else {
            document.querySelector('#message_file').innerHTML = '';
        }
    });
</script>
</body>
</html>
