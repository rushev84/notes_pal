<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заметки</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1 class="editable-header">Заметки</h1>
        </div>
        <div>
            <button class="btn btn-primary" id="newNoteBtn">Новая заметка</button>
        </div>
    </div>

    <ul class="list-group mt-2">
        @foreach($notes as $note)
            @component('components.note-component', ['note' => $note])
            @endcomponent
        @endforeach
    </ul>
</div>

<div class="modal" id="newNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая заметка</h5>
            </div>

            <form id="form_create_note">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noteTitle">Заголовок</label>
                        <input type="text" class="form-control" id="noteTitle" placeholder="Введите заголовок">
                    </div>
                    <div class="form-group">
                        <label for="noteContent">Содержимое</label>
                        <textarea class="form-control" id="noteContent" rows="3" placeholder="Введите содержимое"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                    <button type="button" class="btn btn-secondary" id="cancelBtn" data-dismiss="modal">Отмена</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
    document.getElementById('newNoteBtn').addEventListener('click', function() {
        $('#newNoteModal').modal('show');
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        $('#newNoteModal').modal('hide');
    });


    $('#form_create_note').submit(function(event) {
        event.preventDefault();

        let title = document.getElementById('noteTitle').value;
        let content = document.getElementById('noteContent').value;

        $.ajax({
            url: '/notes/create',
            type: 'POST',
            data: {
                title: title,
                content: content,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                // Обработка успешного ответа от сервера
                $('.list-group').append(response.html)
            },
            error: function (xhr, status, error) {
                // Обработка ошибки
                // ...
            }
        });

        $('#newNoteModal').modal('hide');
    });




</script>


</body>
</html>
