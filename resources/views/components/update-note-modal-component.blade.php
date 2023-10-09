<div class="modal" id="updateNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Новая заметка') }}</h5>
            </div>

            <form id="form_update_note">
                <div class="modal-body">
                    <div class="form-group d-none">
                        <label for="idTitle">ID</label>
                        <input type="text" class="form-control" id="updateIdTitle">
                    </div>
                    <div class="form-group">
                        <label for="noteTitle">{{ __('Заголовок') }}</label>
                        <input type="text" class="form-control" id="updateNoteTitle" placeholder="{{ __('Введите заголовок') }}">
                    </div>
                    <div class="form-group">
                        <label for="noteContent">{{ __('Содержимое') }}</label>
                        <textarea class="form-control" id="updateNoteContent" rows="3" placeholder="{{ __('Введите содержимое') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Редактировать') }}</button>
                    <button type="button" class="btn btn-secondary" id="cancelUpdBtn" data-dismiss="modal">{{ __('Отмена') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
