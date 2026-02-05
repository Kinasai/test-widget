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
    <h2 class="panel-heading">Форма обратной связи</h2>
    <form id="ticket">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Введите имя" id="name">
        </div>

        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Введите email" id="email">
        </div>

        <div class="form-group">
            <input type="text" name="phone_number" class="form-control" placeholder="Введите номер телефона +7..." id="phone_number">
        </div>

        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Введите тему" id="title">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="text" placeholder="Введите сообщение" id="text"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" id="submit">Отправить</button>
        </div>
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
                name:name,
                email:email,
                phone_number:phone_number,
                title:title,
                text:text,
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
                console.log(response);
            },
            error:function(response){
                alert(response.responseJSON.message);
            }
        });
    });
</script>
</body>
</html>
