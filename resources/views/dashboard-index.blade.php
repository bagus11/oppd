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
    ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
            }

            ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px hsla(0, 1%, 60%, 0.3);; ; 
            border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
            background:hsla(0, 1%, 60%, 0.3);; 
            border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
            background:#b2b1b0;
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
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-9">
                <div id="asset_map_track"></div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header p-2 bg-danger bg-opacity-10" style="border-radius-top-left:10px; border-radius-top-right:10px">
                          <div class="row">
                            <div class="col-2">
                              <strong style="font-size:17px; color:black"><i class="fa-solid fa-bullhorn pr-4"></i> </strong>
                            </div>
                            <div class="col-8">
                              <strong style="font-size:17px;margin-left:5px;color:black; font-weight:bold">Hot News</strong>
                            </div>
                          </div>
                        </div>
                        <div class="card-body rounded-2 p-0 bg-opacity-10" style="overflow-y: auto; height:250px" >
                            <a href="javascript:void(0)"
                                class="py-6 d-flex align-items-center dropdown-item gap-3">
                                <span
                                    class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                    <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                </span>
                                <div class="w-75">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-1 fw-semibold">Siap Tugas Misi Perdamaian</h6>
                                    </div>
                                    <span class="d-block text-truncate text-truncate fs-11"> 
                                      <i class="fa-solid fa-calendar-days"></i> <strong style="margin-left: 5px; font-weight:200"> 1 Jan 2025 </strong>
                                    </span>
                                </div>
                            </a>
                              <a href="javascript:void(0)"
                                  class="py-6 d-flex align-items-center dropdown-item gap-3">
                                  <span
                                      class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                      <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                  </span>
                                  <div class="w-75">
                                      <div class="d-flex align-items-center justify-content-between">
                                          <h6 class="mb-1 fw-semibold">DANKORMAR Hadiri Pelepasan Satgas</h6>
                                      </div>
                                      <span class="d-block text-truncate text-truncate fs-11"> 
                                        <i class="fa-solid fa-calendar-days"></i> <strong style="margin-left: 5px; font-weight:200"> 1 Jan 2025 </strong>
                                      </span>
                                  </div>
                              </a>
                            <a href="javascript:void(0)"
                                class="py-6 d-flex align-items-center dropdown-item gap-3">
                                <span
                                    class="flex-shrink-0 bg-info-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                    <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                </span>
                                <div class="w-75">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-1 fw-semibold">Panglima TNI Tinjau Persiapan Satgas</h6>
                                    </div>
                                    <span class="d-block text-truncate text-truncate fs-11"> 
                                      <i class="fa-solid fa-calendar-days"></i> <strong style="margin-left: 5px; font-weight:200"> 1 Jan 2025 </strong>
                                    </span>
                                </div>
                            </a>
                                <a href="javascript:void(0)"
                                    class="py-6 d-flex align-items-center dropdown-item gap-3">
                                    <span
                                        class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                    </span>
                                    <div class="w-75">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-1 fw-semibold">Tuntaskan Misi di Lebanon</h6>
                                          
                                        </div>
                                        <span class="d-block text-truncate text-truncate fs-11"> 
                                          <i class="fa-solid fa-calendar-days"></i> <strong style="margin-left: 5px; font-weight:200"> 2 Jan 2025 </strong>
                                        </span>
                                    </div>
                                </a>
                            <a href="javascript:void(0)"
                                class="py-6 d-flex align-items-center dropdown-item gap-3">
                                <span
                                    class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                    <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                </span>
                                <div class="w-75">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                        <span class="d-block fs-2">9:30 AM</span>
                                    </div>
                                    <span class="d-block text-truncate text-truncate fs-11">Just
                                        see the my new admin!</span>
                                </div>
                            </a>
                        
                                <a href="javascript:void(0)"
                                    class="py-6 d-flex align-items-center dropdown-item gap-3">
                                    <span
                                        class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-dark">
                                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                    </span>
                                    <div class="w-75">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                            <span class="d-block fs-2">9:30 AM</span>
                                        </div>
                                        <span class="d-block text-truncate text-truncate fs-11">Just
                                            see the my new admin!</span>
                                    </div>
                                </a>
                          
                          
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="card  p-0" id="total_oppd_card">
                        <div class="card-body rounded-2 p-0 bg-info bg-opacity-10">
                          <div class="mx-4 mt-2">
                            <h5 class="ml-4 card-title">Summary OPPD</h5>
                            {{-- <p class="ml-4 card-subtitle mb-0">Berdasarkan kondisi</p> --}}
                          </div>
                          <div class="p-0" style="padding:0 !important" id="radialChart"></div>
                        </div>
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
