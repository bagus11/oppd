@extends('garage._dashboard')
@section('content')
<style>
  .navbar {
    z-index: 90px !important;
  }
  #asset_map_track {
    height: 100%; /* Match parent height */
    border-radius: 10px !important;
    z-index: 0 !important;
  }

  .row {
    display: flex; /* Ensure both child elements adjust to each other's height */
    align-items: stretch; /* Ensure children align to the tallest */
  }
    #radialChart{
      width: 100% !important;
    }

    .select2-container{
        z-index:0 !important;
    }
</style>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex align-items-center justify-content-between mb-3">
              <div>
                <h5 class="card-title">Summary Asset</h5>
                <p class="card-subtitle mb-0">Summary Asset OPPD</p>
              </div>

              {{-- <div class="hstack gap-9 mt-4 mt-md-0">
                <div class="d-flex align-items-center gap-2">
                  <span class="d-block flex-shrink-0 round-10 bg-primary rounded-circle"></span>
                  <span class="text-nowrap text-muted">2024</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <span class="d-block flex-shrink-0 round-10 bg-danger rounded-circle"></span>
                  <span class="text-nowrap text-muted">2023</span>
                </div>
              </div> --}}
            </div>
            <div class="row">
              <div class="col-9">
                <div id="asset_map_track"></div>
              </div>
              <div class="col-3">
                <div class="card" id="total_oppd_card">
                  <div class="card-body rounded-2 p-0 bg-info bg-opacity-10">
                    <div class="mx-4 mt-2">
                      <h5 class="ml-4 card-title">Total OPPD</h5>
                      <p class="ml-4 card-subtitle mb-0">Berdasarkan kondisi</p>
                    </div>
                    <div id="radialChart"></div>
                    <div class="row mx-2 mb-2" id="country_list">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body p-4 pb-0" data-simplebar="">
            <div class="row flex-nowrap">
              <div class="col">
                <div class="card primary-gradient">
                  <div class="card-body text-center px-9 pb-4">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                      <iconify-icon icon="solar:dollar-minimalistic-linear" class="fs-7 text-white"></iconify-icon>
                    </div>
                    <h6 class="fw-normal fs-3 mb-1">UNIFIL</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" id="counting_unifil"></h4>
                    <a href="javascript:void(0)"  data-val="UNIFIL" class="btn btn-white fs-2 asset_modal fw-semibold text-nowrap">View
                      Details</a>
                  </div>
                </div>
              </div>
             
              <div class="col">
                <div class="card secondary-gradient">
                  <div class="card-body text-center px-9 pb-4">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                      <iconify-icon icon="ic:outline-backpack" class="fs-7 text-white"></iconify-icon>
                    </div>
                    <h6 class="fw-normal fs-3 mb-1">KIZI MINUSCA
                    </h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" id="counting_kizi_minusca"></h4>
                    <a href="javascript:void(0)" data-val="KIZI MINUSCA"  class="btn btn-white fs-2 asset_modal fw-semibold text-nowrap">View
                      Details</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card danger-gradient">
                  <div class="card-body text-center px-9 pb-4">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                      <iconify-icon icon="ic:baseline-sync-problem" class="fs-7 text-white"></iconify-icon>
                    </div>
                    <h6 class="fw-normal fs-3 mb-1">KIZI MONUSCO
                    </h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" id="counting_kizi_monusco"></h4>
                    <a href="javascript:void(0)" data-val="KIZI MONUSCO"  class="btn btn-white fs-2 asset_modal fw-semibold text-nowrap">View
                      Details</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card success-gradient">
                  <div class="card-body text-center px-9 pb-4">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                      <iconify-icon icon="ic:outline-forest" class="fs-7 text-white"></iconify-icon>
                    </div>
                    <h6 class="fw-normal fs-3 mb-1">BGC MONUSCO</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1" id="counting_bgc_monusco"></h4>
                    <a href="javascript:void(0)" data-val="BGC MONUSCO" class="btn btn-white fs-2 asset_modal fw-semibold text-nowrap">View
                      Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 
      <!-- ----------------------------------------- -->
      <!-- Revenue Forecast -->
      <!-- ----------------------------------------- -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="row mb-4">
              <div class="col-8">
                <h5 class="card-title">Kondisi Aset</h5>
              </div>
              <div class="col-4">
                <select name="select_asset_type" class="select2" id="select_asset_type"></select>
              </div>
            </div>
            <div style="height: 405px;" class="me-n2 rounded-bars mb-4">
              <div id="asset_chart"></div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- ----------------------------------------- -->
      <!-- Annual Profit -->
      <!-- ----------------------------------------- -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Pengajuan Aset</h5>
            <ul class="nav nav-tabs theme-tab gap-3 flex-nowrap" role="tablist">
              <li class="nav-item">
                <a class="nav-link pengajuan_filter active" data-pengajuan="1" data-bs-toggle="tab" href="#app" role="tab">
                  <div class="hstack gap-2">
                    <iconify-icon icon="solar:widget-linear" class="fs-4"></iconify-icon>
                    <span>Pengajuan Perbaikan</span>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pengajuan_filter" data-pengajuan="2" data-bs-toggle="tab" href="#mobile" role="tab">
                  <div class="hstack gap-2">
                    <iconify-icon icon="solar:smartphone-line-duotone" class="fs-4"></iconify-icon>
                    <span>Pengajuan Penggantian</span>
                  </div>
                </a>
              </li>
            </ul>
           <div class="row mt-2">
            <div class="col-12">
              <div class="table-responsive" style="overflow-y: hidden">
              
                <table id="pengajuan_asset_table" class="table table-striped table-bordered text-nowrap">
                    <thead class="text-dark fs-1">
                        <tr>
                            <th>Satgas</th>
                            <th>No UN</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            {{-- <th>Jenis</th> --}}
                            {{-- <th>Merk</th> --}}
                            <th>No Mesin</th>
                            <th>No Rangka</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
              
          </div>
            </div>
           </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">

    </div>
  </div>
</div>
@include('modal.detail-asset')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@push('js')
    <script src="{{ asset('oppd/dashboard.js') }}"></script>
@endpush
