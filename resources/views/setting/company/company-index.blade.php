@extends('garage._dashboard')
@section('content')
    <div class="row">
     
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-9">
                            <strong>Company</strong>
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            <button class="btn btn-sm btn-success" id="btn_add_company" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 mx-1">
                        <div class="table-responsive" style="overflow-y: hidden">
                            <table id="company_table" class="table table-striped table-bordered text-nowrap">
                                <thead class="text-dark fs-1">
                                    <tr>
                                      <th>Name</th>
                                      <th>Company Code</th>
                                      <th>Company Type</th>
                                      <th>Company Level</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
 @include('setting.company.modal.add-company')
@endsection

@push('js')
    <script src="{{ asset('hris/setting/company/company.js') }}"></script>
@endpush
