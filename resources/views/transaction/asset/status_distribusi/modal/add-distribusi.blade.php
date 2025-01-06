
<div class="modal fade" id="addStatusDistribusiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Distribusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" id="form_serialize" enctype="multipart/form-data">
                <div class="modal-body p-0">
                    <div class="container mt-2">
                        <fieldset class="mb-2">
                            <legend>General Asset</legend>
                            <div class="row">
                                <div class="col-5 col-sm-5 col-md-2 mt-2">
                                    <label for="edit_select_asset">Asset Product</label>
                                </div>
                                  <div class="col-7 col-sm-7 col-md-4">
                                    <select name="edit_select_asset" class="select2" id="edit_select_asset"></select>
                                    <input type="hidden" class="form-control" id="edit_asset">
                                    <span class="message_error edit_asset_error text-red d-block"></span>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2 mt-2">
                                    <label for="edit_select_tujuan">Satgas Tujuan</label>
                                </div>
                                  <div class="col-7 col-sm-7 col-md-4">
                                    <select name="edit_select_tujuan" class="select2" id="edit_select_tujuan"></select>
                                    <input type="hidden" class="form-control" id="edit_tujuan">
                                    <span class="message_error edit_tujuan_error text-red d-block"></span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-5 col-md-2 mt-2">
                                    <label for="edit_select_reporter">Reporter</label>
                                </div>
                                  <div class="col-7 col-sm-7 col-md-4">
                                    <select name="edit_select_reporter" class="select2" id="edit_select_reporter"></select>
                                    <input type="hidden" class="form-control" id="edit_reporter">
                                    <span class="message_error edit_reporter_error text-red d-block"></span>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-5 col-md-2 mt-2">
                                    <label for="remark">Catatan</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-10">
                                    <textarea class="form-control" id="edit_catatan" rows="3"></textarea>
                                    <span class="message_error edit_catatan_error text-red d-block"></span>
                                </div>
                            </div>
                        </fieldset>
    
                        <fieldset class="mt-4 container_label">
                            <legend>Detail Asset</legend>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_asset_code">Asset Code</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_asset_code"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_no_un">No UN</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_no_un"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_satgas">Satgas</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_satgas"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_no_rangka">No Rangka</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_no_rangka"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_no_mesin">No Mesin</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_no_mesin"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_kategori">Kategori</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_kategori"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_sub_kategori">Sub Kategori</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_sub_kategori"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_jenis">Jenis</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_jenis"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="edit_label_merk">Merk</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label id="edit_label_merk"></label>
                                </div>
                                <div class="col-5 col-sm-5 col-md-2">
                                    <label for="">Kondisi</label>
                                </div>
                                <div class="col-7 col-sm-7 col-md-4">
                                    <label for="" id="edit_label_kondisi"></label>
                                </div>
                            </div>
                        </fieldset>
    
                    </div>
                </div>
                {{-- <div class="modal-footer container_label">
                    <button class="btn btn-sm btn-success" type="submit" id="btn_save_distribusi">
                        <i class="fas fa-check"></i>
                    </button>
                </div> --}}
            </form>
        </div>
    </div>
</div>
<script>

</script>