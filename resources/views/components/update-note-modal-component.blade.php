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
