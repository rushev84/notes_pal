<div class="modal" id="newNoteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Новая заметка') }}</h5>
            </div>
            <form id="form_create_note">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noteTitle">{{ __('Заголовок') }}</label>
                        <input type="text" class="form-control" id="noteTitle" placeholder="{{ __('Введите заголовок') }}">
                        <div class="invalid-feedback" id="titleError" style="color: red; display: block;"></div>

                    </div>
                    <div class="form-group">
                        <label for="noteContent">{{ __('Содержимое') }}</label>
                        <textarea class="form-control" id="noteContent" rows="3" placeholder="{{ __('Введите содержимое') }}"></textarea>
                        <div class="invalid-feedback" id="contentError" style="color: red; display: block;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Создать') }}</button>
                    <button type="button" class="btn btn-secondary" id="cancelBtn" data-dismiss="modal">{{ __('Отмена') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
