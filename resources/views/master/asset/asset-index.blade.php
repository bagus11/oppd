@extends('garage._dashboard')
@section('content')
<style>
    #asset_table tbody tr {
    cursor: pointer;
    background-color: #B1F0F7 !important; 
    color: white !important;
}
    #tablist .nav-link.active {
        background-color: #179BAE !important;
        color: white !important;
        border-color: #179BAE !important;
    }
    #tablist .nav-link {
        color: white !important; 
        background-color: #BCCCDC !important;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <strong>Asset List</strong>
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success" id="btn_add_asset" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-header p-0 mx-1">
                    <div class="table-responsive" style="overflow-y: hidden">
                        <table id="asset_table" class="table table-striped table-bordered text-nowrap">
                            <thead class="text-dark fs-1">
                                <tr>
                                  <th>Asset Code</th>
                                  <th>No UN</th>
                                  <th>Kategori</th>
                                  <th>Sub Kategori</th>
                                  <th>Jenis</th>
                                  <th>Merk</th>
                                  <th>No Mesin</th>
                                  <th>No Rangka</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('master.asset.modal.add-asset')
    @include('master.asset.modal.edit-asset')
@endsection

@push('js')
    <script src="{{ asset('oppd/master/asset.js') }}"></script>
@endpush
