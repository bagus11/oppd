@extends('garage._dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
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
                    <h6 class="fw-normal fs-3 mb-1">Total Orders</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                      16,689</h4>
                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                      Details</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card warning-gradient">
                  <div class="card-body text-center px-9 pb-4">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                      <iconify-icon icon="solar:recive-twice-square-linear" class="fs-7 text-white"></iconify-icon>
                    </div>
                    <h6 class="fw-normal fs-3 mb-1">Return Item</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                      148</h4>
                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
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
                    <h6 class="fw-normal fs-3 mb-1">Annual Budget</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                      $156K</h4>
                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
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
                    <h6 class="fw-normal fs-3 mb-1">Cancel Orders</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                      64</h4>
                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
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
                    <h6 class="fw-normal fs-3 mb-1">Total Income</h6>
                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                      $36,715</h4>
                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
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
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex align-items-center justify-content-between mb-3">
              <div>
                <h5 class="card-title">Revenue Forecast</h5>
                <p class="card-subtitle mb-0">Overview of Profit</p>
              </div>

              <div class="hstack gap-9 mt-4 mt-md-0">
                <div class="d-flex align-items-center gap-2">
                  <span class="d-block flex-shrink-0 round-10 bg-primary rounded-circle"></span>
                  <span class="text-nowrap text-muted">2024</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <span class="d-block flex-shrink-0 round-10 bg-danger rounded-circle"></span>
                  <span class="text-nowrap text-muted">2023</span>
                </div>
              </div>
            </div>
            <div style="height: 305px;" class="me-n2 rounded-bars">
              <div id="revenue-forecast"></div>
            </div>
            <div class="row mt-4 mb-2">
              <div class="col-md-4">
                <div class="hstack gap-6 mb-3 mb-md-0">
                  <span class="d-flex align-items-center justify-content-center round-48 bg-light rounded">
                    <iconify-icon icon="solar:pie-chart-2-linear" class="fs-7 text-dark"></iconify-icon>
                  </span>
                  <div>
                    <span>Total</span>
                    <h5 class="mt-1 fw-medium mb-0">$96,640</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="hstack gap-6 mb-3 mb-md-0">
                  <span class="d-flex align-items-center justify-content-center round-48 bg-primary-subtle rounded">
                    <iconify-icon icon="solar:dollar-minimalistic-linear" class="fs-7 text-primary"></iconify-icon>
                  </span>
                  <div>
                    <span>Profit</span>
                    <h5 class="mt-1 fw-medium mb-0">$48,820</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="hstack gap-6">
                  <span class="d-flex align-items-center justify-content-center round-48 bg-danger-subtle rounded">
                    <iconify-icon icon="solar:database-linear" class="fs-7 text-danger"></iconify-icon>
                  </span>
                  <div>
                    <span>Earnings</span>
                    <h5 class="mt-1 fw-medium mb-0">$48,820</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ----------------------------------------- -->
      <!-- Annual Profit -->
      <!-- ----------------------------------------- -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Annual Profit</h5>
            <div class="bg-primary bg-opacity-10 rounded-1 overflow-hidden mb-4">
              <div class="p-4 mb-9">
                <div class="d-flex align-items-center justify-content-between">
                  <span class="text-dark-light">Conversion Rate</span>
                  <h3 class="mb-0">18.4%</h3>
                </div>
              </div>
              <div id="annual-profit"></div>
            </div>
            <div class="d-flex align-items-center justify-content-between pb-6 border-bottom">
              <div>
                <span class="text-muted fw-medium">Added to Cart</span>
                <span class="fs-11 fw-medium d-block mt-1">5 clicks</span>
              </div>
              <div class="text-end">
                <h6 class="fw-bolder mb-1 lh-base">$21,120.70</h6>
                <span class="fs-11 fw-medium text-success">+13.2%</span>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between py-6 border-bottom">
              <div>
                <span class="text-muted fw-medium">Reached to Checkout</span>
                <span class="fs-11 fw-medium d-block mt-1">12 clicks</span>
              </div>
              <div class="text-end">
                <h6 class="fw-bolder mb-1 lh-base">$16,100.00</h6>
                <span class="fs-11 fw-medium text-danger">-7.4%</span>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between pt-6">
              <div>
                <span class="text-muted fw-medium">Added to Cart</span>
                <span class="fs-11 fw-medium d-block mt-1">24 views</span>
              </div>
              <div class="text-end">
                <h6 class="fw-bolder mb-1 lh-base">$6,400.50</h6>
                <span class="fs-11 fw-medium text-success">+9.3%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <!-- -------------------------------------------- -->
        <!-- Your Performance -->
        <!-- -------------------------------------------- -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold">Your Performance</h5>
            <p class="card-subtitle mb-0 lh-base">Last check on 25 february</p>

            <div class="row mt-4">
              <div class="col-md-6">
                <div class="vstack gap-9 mt-2">
                  <div class="hstack align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded bg-primary-subtle flex-shrink-0">
                      <iconify-icon icon="solar:shop-2-linear" class="fs-7 text-primary"></iconify-icon>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">64 new orders</h6>
                      <span>Processing</span>
                    </div>

                  </div>
                  <div class="hstack align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded bg-danger-subtle">
                      <iconify-icon icon="solar:filters-outline" class="fs-7 text-danger"></iconify-icon>
                    </div>
                    <div>
                      <h6 class="mb-0">4 orders</h6>
                      <span>On hold</span>
                    </div>

                  </div>
                  <div class="hstack align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center round-48 rounded bg-secondary-subtle">
                      <iconify-icon icon="solar:pills-3-linear" class="fs-7 text-secondary"></iconify-icon>
                    </div>
                    <div>
                      <h6 class="mb-0">12 orders</h6>
                      <span>Delivered</span>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="text-center mt-sm-n7">
                  <div id="your-preformance"></div>
                  <h2 class="fs-8">275</h2>
                  <p class="mb-0">
                    Learn insigs how to manage all aspects of your
                    startup.
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-6">
            <!-- -------------------------------------------- -->
            <!-- Customers -->
            <!-- -------------------------------------------- -->
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                  <div>
                    <h5 class="card-title fw-semibold">Customers</h5>
                    <p class="card-subtitle mb-0">Last 7 days</p>
                  </div>
                  <span class="fs-11 text-success fw-semibold lh-lg">+26.5%</span>
                </div>
                <div class="py-4 my-1">
                  <div id="customers-area"></div>
                </div>
                <div class="d-flex flex-column align-items-center gap-2 w-100 mt-3">
                  <div class="d-flex align-items-center gap-2 w-100">
                    <span class="d-block flex-shrink-0 round-8 bg-primary rounded-circle"></span>
                    <h6 class="fs-3 fw-normal text-muted mb-0">April 07 - April 14</h6>
                    <h6 class="fs-3 fw-normal mb-0 ms-auto text-muted">6,380</h6>
                  </div>
                  <div class="d-flex align-items-center gap-2 w-100">
                    <span class="d-block flex-shrink-0 round-8 bg-light rounded-circle"></span>
                    <h6 class="fs-3 fw-normal text-muted mb-0">Last Week</h6>
                    <h6 class="fs-3 fw-normal mb-0 ms-auto text-muted">4,298</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <!-- -------------------------------------------- -->
            <!-- Sales Overview -->
            <!-- -------------------------------------------- -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title fw-semibold">Sales Overview</h5>
                <p class="card-subtitle mb-1">Last 7 days</p>

                <div class="position-relative labels-chart">
                  <span class="fs-11 label-1">0%</span>
                  <span class="fs-11 label-2">25%</span>
                  <span class="fs-11 label-3">50%</span>
                  <span class="fs-11 label-4">75%</span>
                  <div id="sales-overview"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-12">
        <!-- -------------------------------------------- -->
        <!-- Revenue by Product -->
        <!-- -------------------------------------------- -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap gap-3 mb-9 justify-content-between align-items-center">
              <h5 class="card-title fw-semibold mb-0">Revenue by Product</h5>
              <select class="form-select w-auto fw-semibold">
                <option value="1">Sep 2024</option>
                <option value="2">Oct 2024</option>
                <option value="3">Nov 2024</option>
              </select>
            </div>

            <div class="table-responsive">
              <ul class="nav nav-tabs theme-tab gap-3 flex-nowrap" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#app" role="tab">
                    <div class="hstack gap-2">
                      <iconify-icon icon="solar:widget-linear" class="fs-4"></iconify-icon>
                      <span>App</span>
                    </div>

                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#mobile" role="tab">
                    <div class="hstack gap-2">
                      <iconify-icon icon="solar:smartphone-line-duotone" class="fs-4"></iconify-icon>
                      <span>Mobile</span>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#saas" role="tab">
                    <div class="hstack gap-2">
                      <iconify-icon icon="solar:calculator-linear" class="fs-4"></iconify-icon>
                      <span>SaaS</span>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#other" role="tab">
                    <div class="hstack gap-2">
                      <iconify-icon icon="solar:folder-open-outline" class="fs-4"></iconify-icon>
                      <span>Others</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-content mb-n3">
              <div class="tab-pane active" id="app" role="tabpanel">
                <div class="table-responsive" data-simplebar>
                  <table class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="fw-normal ps-0">Assigned
                        </th>
                        <th scope="col" class="fw-normal">Progress</th>
                        <th scope="col" class="fw-normal">Priority</th>
                        <th scope="col" class="fw-normal">Budget</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-1.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Minecraf App</h6>
                              <span>Jason Roy</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-success-subtle text-success">Low</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-2.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Web App Project</h6>
                              <span>Mathew Flintoff</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-warning-subtle text-warning">Medium</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-3.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Modernize Dashboard</h6>
                              <span>Anil Kumar</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-secondary-subtle text-secondary">Very
                            High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-4.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Dashboard Co</h6>
                              <span>George Cruize</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-danger-subtle text-danger">High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="mobile" role="tabpanel">
                <div class="table-responsive" data-simplebar>
                  <table class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="fw-normal ps-0">Assigned
                        </th>
                        <th scope="col" class="fw-normal">Progress</th>
                        <th scope="col" class="fw-normal">Priority</th>
                        <th scope="col" class="fw-normal">Budget</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-2.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Web App Project</h6>
                              <span>Mathew Flintoff</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-warning-subtle text-warning">Medium</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-3.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Modernize Dashboard</h6>
                              <span>Anil Kumar</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-secondary-subtle text-secondary">Very
                            High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-1.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Minecraf App</h6>
                              <span>Jason Roy</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-success-subtle text-success">Low</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-4.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Dashboard Co</h6>
                              <span>George Cruize</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-danger-subtle text-danger">High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="saas" role="tabpanel">
                <div class="table-responsive" data-simplebar>
                  <table class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="fw-normal ps-0">Assigned
                        </th>
                        <th scope="col" class="fw-normal">Progress</th>
                        <th scope="col" class="fw-normal">Priority</th>
                        <th scope="col" class="fw-normal">Budget</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-2.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Web App Project</h6>
                              <span>Mathew Flintoff</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-warning-subtle text-warning">Medium</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-1.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Minecraf App</h6>
                              <span>Jason Roy</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-success-subtle text-success">Low</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>

                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-3.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Modernize Dashboard</h6>
                              <span>Anil Kumar</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-secondary-subtle text-secondary">Very
                            High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-4.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Dashboard Co</h6>
                              <span>George Cruize</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-danger-subtle text-danger">High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="other" role="tabpanel">
                <div class="table-responsive" data-simplebar>
                  <table class="table text-nowrap align-middle table-custom mb-0 last-items-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="fw-normal ps-0">Assigned
                        </th>
                        <th scope="col" class="fw-normal">Progress</th>
                        <th scope="col" class="fw-normal">Priority</th>
                        <th scope="col" class="fw-normal">Budget</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-1.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Minecraf App</h6>
                              <span>Jason Roy</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-success-subtle text-success">Low</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-3.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Modernize Dashboard</h6>
                              <span>Anil Kumar</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-secondary-subtle text-secondary">Very
                            High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-2.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Web App Project</h6>
                              <span>Mathew Flintoff</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-warning-subtle text-warning">Medium</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>

                      <tr>
                        <td class="ps-0">
                          <div class="d-flex align-items-center gap-6">
                            <img src="../assets/images/products/dash-prd-4.jpg" alt="prd1" width="48" class="rounded" />
                            <div>
                              <h6 class="mb-0">Dashboard Co</h6>
                              <span>George Cruize</span>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span>73.2%</span>
                        </td>
                        <td>
                          <span class="badge bg-danger-subtle text-danger">High</span>
                        </td>
                        <td>
                          <span class="text-dark-light">$3.5k</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
@endsection
