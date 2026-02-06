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
    <form id="ticket">
        <x-input :id="'name'" :placeholder="'Введите имя'" :type="'text'"></x-input>
        <x-input :id="'email'" :placeholder="'Введите email'" :type="'text'"></x-input>
        <x-input :id="'phone_number'" :placeholder="'Введите телефон +7...'" :type="'text'"></x-input>
        <x-input :id="'title'" :placeholder="'Введите тему'" :type="'text'"></x-input>
        <x-textarea :id="'text'" :placeholder="'Введите сообщение'" :type="'text'"></x-textarea>
        <div class="form-group">
            <button class="btn btn-success" id="submit">Отправить</button>
        </div>
        <div id="message_success" class="text-success-emphasis"></div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>

    $('#ticket').on('submit',function(event){
        event.preventDefault();

        let name = $('#name').val();
        let email = $('#email').val();
        let phone_number = $('#phone_number').val();
        let title = $('#title').val();
        let text = $('#text').val();

        $.ajax({
            url: "/api/tickets",
            type:"POST",
            data:{
                "_token": `{{ csrf_token() }}`,
                name:name,
                email:email,
                phone_number:phone_number,
                title:title,
                text:text,
            },
            credentials: 'include',
            success:function(response){
                document.querySelector('#message_success').innerHTML = 'Успешно отправлено'
                document.querySelector('#message_success').className = 'alert alert-success'
                document.querySelector('#message_name').innerHTML = ''
                document.querySelector('#message_email').innerHTML = ''
                document.querySelector('#message_phone_number').innerHTML = ''
                document.querySelector('#message_title').innerHTML = ''
                document.querySelector('#message_text').innerHTML = ''
                const form = $('#ticket');

                // 1. Стандартный сброс
                form[0].reset();
            },
            error:function(response){
                if (response.responseJSON.errors) {
                    const list = response.responseJSON.errors
                    document.querySelector('#message_success').innerHTML = ''
                    document.querySelector('#message_success').className = ''

                    if(list.name){
                        document.querySelector('#message_name').innerHTML = list.name
                    }else {
                        document.querySelector('#message_name').innerHTML = ''
                    }
                    if(list.email){
                        document.querySelector('#message_email').innerHTML = list.email
                    }else {
                        document.querySelector('#message_email').innerHTML = ''
                    }
                    if(list.phone_number){
                        document.querySelector('#message_phone_number').innerHTML = list.phone_number
                    }else {
                        document.querySelector('#message_phone_number').innerHTML = ''
                    }
                    if(list.title){
                        document.querySelector('#message_title').innerHTML = list.title
                    }else {
                        document.querySelector('#message_title').innerHTML = ''
                    }
                    if(list.text){
                        document.querySelector('#message_text').innerHTML = list.text
                    }else {
                        document.querySelector('#message_text').innerHTML = ''
                    }
                }

            }
        });
    });
</script>
</body>
</html>
