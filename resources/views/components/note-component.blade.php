<li class="list-group-item d-flex align-items-center" id="note_{{ $note->id }}">
    <div class="flex-grow-1">
        <div id="title"><b>{{ $note->title }}</b></div>
        <div id="content" class="w-100">{{ $note->content }}</div>
    </div>
    <div>
        <button class="btn btn-success" id="updateBtn" onclick="update({{ $note->id }})">Редактировать</button>
        <button class="btn btn-danger" id="deleteBtn">Удалить</button>
    </div>
</li>
