
<div class="modal fade" id="addAssetModal" tabindex="-1" aria-hidden="true" style="overflow-y: hidden">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Role User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container">
                    <div class="row mx-2 mb-2">
                        <div class="col-4 mt-2">
                            <label for="">Satgas</label>
                        </div>
                        <div class="col-8">
                            <select name="select_satgas" class="select2" id="select_satgas"></select>
                        </div>
                        <div class="col-4 mt-2">
                            <label for="">Kondisi</label>
                        </div>
                        <div class="col-8">
                            <select name="select_kondisi" class="select2" id="select_kondisi">
                                <option value="BAIK">BAIK</option>
                                <option value="RR OPS">RR OPS</option>
                                <option value="RB">RB</option>
                                <option value="RR TDK OPS">RR TDK OPS</option>
                                <option value="M">M</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" id="btnAddAsset">
                    <i class="fas fa-check"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>