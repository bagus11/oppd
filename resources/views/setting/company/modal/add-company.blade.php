<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true" style="overflow-y: hidden;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" id="form_serialize" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-2 mt-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="name">
                            <span class="message_error name_error text-red d-block"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 mt-2">
                            <label for="select_type">Type</label>
                        </div>
                        <div class="col-4">
                            <select class="select2" id="select_type" name="select_type">
                            </select>
                            <input type="hidden" class="form-control" id="type">
                            <span class="message_error type_error text-red d-block"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <label for="">Level</label>
                        </div>
                        <div class="col-4">
                            <select name="select_company_level" class="select2" id="select_company_level"></select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 mt-2">
                            <label for="">Taxt File Number</label>
                        </div>
                        <div class="col-4">
                            <input type="number" id="taxt_file_number" class="form-control">
                        </div>
                        <div class="col-2 mt-2">
                            <label for="">Taxt Country</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="taxt_country">
                        </div>
                    </div>
                    <fieldset>
                      <legend>Coordinate </legend>
                    <div class="row mt-2">
                        <div class="col-2 mt-2">
                            <label for="x">X</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="x">
                            <span class="message_error x_error text-red d-block"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <label for="y">Y</label>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="y">
                            <span class="message_error y_error text-red d-block"></span>
                        </div>
                    </div>
                </fieldset>
                    <div class="row mt-2">
                        <div class="col-2 mt-2">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" id="address" rows="3"></textarea>
                            <span class="message_error address_error text-red d-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success" type="submit" id="btn_save_location">
                        <i class="fas fa-check"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
