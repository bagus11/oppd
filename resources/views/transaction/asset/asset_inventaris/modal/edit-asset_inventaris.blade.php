<div class="modal fade" id="editAssetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0 mx-2 pt-2">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills flex-column flex-sm-row mt-4" id="tablist" role="tablist" style="margin-top: 1px !important">
                            <li class="nav-item flex-sm-fill text-sm-center">
                              <a class="nav-link active" data-bs-toggle="tab" href="#navpill-11" role="tab">
                                 <i class="fa-solid fa-circle-info fa-xs"></i> <span style="font-size: 12px !important">General Information</span>
                              </a>
                            </li>
                            <li class="nav-item flex-sm-fill text-sm-center" style="margin-left: 10px !important">
                              <a class="nav-link" data-bs-toggle="tab" href="#navpill-22" role="tab">
                                 <i class="fa-solid fa-clock-rotate-left fa-xs"></i> <span style="font-size: 12px !important"> Log Transaksi</span>
                              </a>
                            </li>
                          </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" style="margin-right: 5px" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="tab-content">
                    <div class="tab-pane active p-3" id="navpill-11" role="tabpanel">
                        <div class="row d-flex justify-content-end">
                            <div class="col-12">
                                <button style="float:right;margin-left:5px" title="Print PDF" class="btn btn-sm btn-danger" id="btn_print_pdf">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                                <button style="float:right" title="Edit" class="btn btn-sm btn-warning" id="btn_edit_inventaris">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="float:right" title="Cancel Edit" class="btn btn-sm btn-info" id="btn_cancel_edit_inventaris">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <form class="form" id="form_serialize" enctype="multipart/form-data">
                            <div class="container mt-2">
                                <fieldset class="mb-2">
                                    <legend>General Asset</legend>
                                    <div class="row">
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for="edit_bulan">Kode Transaksi</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <input type="text" class="form-control" id="inventaris_code" readonly disabled value="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for="edit_bulan">Bulan</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <input type="date" class="form-control" id="edit_bulan" value="">
                                            <span class="message_error edit_bulan_error text-red d-block"></span>
                                        </div>
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for="edit_select_satgas">Satgas</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <select name="edit_select_satgas" class="select2" id="edit_select_satgas"></select>
                                            <input type="hidden" class="form-control" id="edit_satgas">
                                            <span class="message_error edit_satgas_error text-red d-block"></span>
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
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for="edit_select_asset">Asset Product</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <select name="edit_select_asset" class="select2" id="edit_select_asset"></select>
                                            <input type="hidden" class="form-control" id="edit_asset">
                                            <span class="message_error edit_asset_error text-red d-block"></span>
                                        </div>
                                    </div>
                                </fieldset>
            
                                <fieldset class="mt-4" >
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
                                        <div class="col-5 col-sm-5 col-md-2">
                                            <label for="">Attachment</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <label for="" id="edit_label_attachment"></label>
                                        </div>
                                    </div>
                                </fieldset>
            
                                <fieldset class="mt-4">
                                    <legend>Kondisi Aset</legend>
                                    <div class="row">
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for=""> Kondisi</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <select name="edit_select_kondisi" class="select2" id="edit_select_kondisi">
                                                <option value="">Pilih Kondisi</option>
                                                <option value="1">BAIK</option>
                                                <option value="2">RR OPS</option>
                                                <option value="3">RB</option>
                                                <option value="4">RR TDK OPS</option>
                                                <option value="5">M</option>
                                                <option value="6">D</option>
                                            </select>
                                            <input type="hidden" id="edit_kondisi">
                                            <span class="message_error edit_kondisi_name_error text-red d-block"></span>
                                        </div>
                                        <div class="col-5 col-sm-5 col-md-2 mt-2">
                                            <label for="">Attachment</label>
                                        </div>
                                        <div class="col-7 col-sm-7 col-md-4">
                                            <input type="file" class="form-control" id="edit_attachment">
                                            <span class="message_error edit_attachment_name_error text-red d-block"></span>
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
                                <div class="row d-flex justify-content-end py-2">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-success" style="float: right" type="submit" id="btn_update_inventaris">
                                            <i class="fas fa-check"></i>
                                        </button>
        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane p-3" id="navpill-22" role="tabpanel">
                        <div class="row">
                              <div class="col-12">
                                   <div class="table-responsive" style="overflow-y: hidden">
                                      <table id="inventaris_table_log" class="table table-striped table-bordered text-nowrap">
                                          <thead class="text-dark fs-1">
                                            <tr>
                                                <th>Created At</th>
                                                <th>User Name</th>
                                                <th>Satgas</th>
                                                <th>Bulan</th>
                                                <th>Asset Code</th>
                                                <th>Catatan</th>
                                                <th>Attachment</th>
                                                <th>Kondisi</th>
                                            </tr>
                                          </thead>
                                          <tbody></tbody>
                                      </table>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>
<script>

</script>