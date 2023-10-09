<li class="list-group-item d-flex align-items-center">
    <div class="flex-grow-1">
        <div><b>{{ $note->title }}</b></div>
        <div class="w-100">{{ $note->content }}</div>
    </div>
    <div>
        <button class="btn btn-success edit-btn">Редактировать</button>
        <button class="btn btn-danger save-btn">Удалить</button>
    </div>
</li>
