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
                url: '/api/notes/update',
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
                url: '/api/notes/delete',
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
@endsection
