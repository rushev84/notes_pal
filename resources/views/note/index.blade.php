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

@include('includes.head')

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

{{-- modal window for create --}}
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

{{-- modal window for update --}}

<div class="modal" id="updateNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая заметка</h5>
            </div>

            <form id="form_update_note">
                <div class="modal-body">
                    <div class="form-group d-none">
                        <label for="idTitle">ID</label>
                        <input type="text" class="form-control" id="updateIdTitle">
                    </div>
                    <div class="form-group">
                        <label for="noteTitle">Заголовок</label>
                        <input type="text" class="form-control" id="updateNoteTitle" placeholder="Введите заголовок">
                    </div>
                    <div class="form-group">
                        <label for="noteContent">Содержимое</label>
                        <textarea class="form-control" id="updateNoteContent" rows="3" placeholder="Введите содержимое"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                    <button type="button" class="btn btn-secondary" id="cancelUpdBtn" data-dismiss="modal">Отмена</button>
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

    document.getElementById('cancelUpdBtn').addEventListener('click', function() {
        $('#updateNoteModal').modal('hide');
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
                $('.list-group').append(response.html)
            },
            error: function (xhr, status, error) {
                //
            }
        });

        $('#newNoteModal').modal('hide');
    });


    function update(id) {
        let note = document.getElementById('note_' + id)

        let title = note.querySelector('#title').textContent;
        let content = note.querySelector('#content').textContent;

        $('#updateIdTitle').val(id);
        $('#updateNoteTitle').val(title);
        $('#updateNoteContent').val(content);

        $('#updateNoteModal').modal('show');
    }



    $('#form_update_note').submit(function(event) {
        event.preventDefault();

        var id = $('#updateIdTitle').val();
        var title = $('#updateNoteTitle').val();
        var content = $('#updateNoteContent').val();

        $.ajax({
            url: '/notes/update',
            type: 'POST',
            data: {
                id: id,
                title: title,
                content: content,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                let note = document.getElementById('note_' + id)

                note.querySelector('#title').textContent = title;
                note.querySelector('#content').textContent = content;
            },
            error: function (xhr, status, error) {
                //
            }
        });

        $('#updateNoteModal').modal('hide');
    });


    function delete_note(id) {

        $.ajax({
            url: '/notes/delete',
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                let note = document.getElementById('note_' + id)
                note.remove()
            },
            error: function (xhr, status, error) {
                //
            }
        });
    }


</script>


</body>
</html>
