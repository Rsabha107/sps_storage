<div class="offcanvas offcanvas-end offcanvas-global-modal in" id="offcanvas-add-stored-item-modal" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <a class="close-task-detail in" id="close-task-detail" style="display: block;" data-bs-dismiss="offcanvas">
        <span>
            <i class="fa fa-times"></i>
        </span>
    </a>
    <x-admin-stored-item-drawer id="" formAction="{{ route('spss.admin.visitor.store') }}"
        formId="add_stored_item_form" />
</div>

<div class="modal fade" id="add_stored_item_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Add Item Description</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event"
                action="{{ route('spss.admin.item.store') }}" method="POST">
                @csrf
                <input type="hidden" name="profile_id" id="add_profile_id" value="">
                <input type="hidden" name="table" id="add_table" value="storage_table">

                <div class="modal-body">
                    <div class="row">
                        <x-formy.form_select class="mb-3 text-start" floating="1" selectedValue=""
                            name="prohibited_item_id" elementId="add_prohibited_item" label="Item Category"
                            required="required" :forLoopCollection="$prohibitedItems" itemIdForeach="id" itemTitleForeach="item_name"
                            style="" addDynamicButton="0" />
                        <x-formy.form_textarea class="col-sm-6 col-md-12 mb-3" floating="1" inputValue=""
                            name="item_description" elementId="add_item_description" inputType="text" inputAttributes=""
                            label="Item Description" required="required" disabled="0" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary"
                        id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="stored_item_detail_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Item Description</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="global-stored-item-content"></div>
        </div>
    </div>
</div>
{{-- <div class="offcanvas offcanvas-end offcanvas-filter-modal in" id="scheduleFilterOffcanvas" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <x-setting.admin-schedule-filter-drawer id="" formAction="" formId="filter_schedule_form"
        :events="$events" :venues="$venues" :rsps="$rsps" :schedules="$schedules" :globalYn="$global_yn" />
</div> --}}