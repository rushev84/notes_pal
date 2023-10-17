@extends('layouts.base')

@section('content')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h1 class="editable-header">{{ __('Заметки') }}</h1>
            </div>
            <div>
                <button class="btn btn-primary" id="newNoteBtn">{{ __('Новая заметка') }}</button>
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
    @component('components.new-note-modal-component')
    @endcomponent

    {{-- modal window for update --}}
    @component('components.update-note-modal-component')
    @endcomponent

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

        // Создаём заметку
        $('#createNoteForm').submit((event) => {
            event.preventDefault();

            let title = document.querySelector('#noteTitle').value;
            let content = document.querySelector('#noteContent').value;

            $.ajax({
                url: '/notes/create',
                type: 'POST',
                data: {
                    title: title,
                    content: content,
                    _token: '{{ csrf_token() }}',
                },
                success: (response) => {
                    $('.list-group').append(response.html)
                    $('#newNoteModal').modal('hide')

                    // Очищаем значения полей
                    $('#newNoteModal #noteTitle').val('');
                    $('#newNoteModal #noteContent').val('');

                    // Очищаем текстовые ошибки
                    $('#newNoteModal #titleError').html('');
                    $('#newNoteModal #contentError').html('');
                },
                error: (response) => {

                    // Очищаем текстовые ошибки
                    $('#titleError').html('');
                    $('#contentError').html('');

                    // Ошибки валидации
                    let errors = response.responseJSON.errors;
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            let errorMessages = errors[key];
                            for (let i = 0; i < errorMessages.length; i++) {
                                console.log(errorMessages[i]);
                                // Вывод ошибки в нужное место в форме
                                if (key === 'title') {
                                    $('#newNoteModal #titleError').text(errorMessages[i]);
                                } else if (key === 'content') {
                                    $('#newNoteModal #contentError').text(errorMessages[i]);
                                }
                            }
                        }
                    }
                }

            });


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

            let id = $('#updateIdTitle').val();
            let title = $('#updateNoteTitle').val();
            let content = $('#updateNoteContent').val();

            $.ajax({
                url: '/api/notes/update',
                type: 'PATCH',
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

                    $('#updateNoteModal').modal('hide');

                    // Очищаем значения полей
                    $('#updateNoteModal #updateNoteTitle').val('');
                    $('#updateNoteModal #updateNoteContent').val('');

                    // Очищаем текстовые ошибки
                    $('#updateNoteModal #titleError').html('');
                    $('#updateNoteModal #contentError').html('');
                },
                error: function(response) {
                    // Очищаем текстовые ошибки
                    $('#updateNoteModal #titleError').html('');
                    $('#updateNoteModal #contentError').html('');

                    // Ошибки валидации
                    let errors = response.responseJSON.errors;
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            let errorMessages = errors[key];
                            for (let i = 0; i < errorMessages.length; i++) {
                                console.log(errorMessages[i]);
                                // Вывод ошибки в нужное место в форме
                                if (key === 'title') {
                                    $('#updateNoteModal #titleError').text(errorMessages[i]);
                                } else if (key === 'content') {
                                    $('#updateNoteModal #contentError').text(errorMessages[i]);
                                }
                            }
                        }
                    }
                }
            });


        });

        function delete_note(id) {
            $.ajax({
                url: '/api/notes/delete',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
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
@endsection
