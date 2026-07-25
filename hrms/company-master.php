<?php
$pageTitle = "Company Master - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1150px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-building me-2" style="font-size: 16px;"></i>COMPANY MASTER INFORMATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <div class="row">
        <!-- Main Form Area (Left & Middle Columns) -->
        <div class="col-xl-9 col-lg-8 col-md-12">
          <form id="companyMasterForm" enctype="multipart/form-data">
            <!-- Hidden Fields for Database CRUD -->
            <input type="hidden" name="id" id="company_db_id" value="0">
            <input type="hidden" name="old_logo" id="old_logo" value="">
            <input type="hidden" name="old_sig" id="old_sig" value="">

            <!-- Classic Group Box using Fieldset/Legend -->
            <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
              <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
                Company Information</legend>

              <!-- Nav Tabs styled classically -->
              <ul class="nav nav-tabs mb-0 border-bottom-0" id="companyTabs" role="tablist"
                style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active fw-bold py-1 px-3" id="office-tab" data-bs-toggle="tab"
                    data-bs-target="#office-info" type="button" role="tab" aria-controls="office-info"
                    aria-selected="true" style="font-size: 11px;">1. Office Information</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-bold py-1 px-3" id="registration-tab" data-bs-toggle="tab"
                    data-bs-target="#registration-info" type="button" role="tab" aria-controls="registration-info"
                    aria-selected="false" style="font-size: 11px;">2. Registration Information</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-bold py-1 px-3" id="mailing-tab" data-bs-toggle="tab"
                    data-bs-target="#mailing-info" type="button" role="tab" aria-controls="mailing-info"
                    aria-selected="false" style="font-size: 11px;">3. Mailing Information</button>
                </li>
              </ul>

              <!-- Tab Content Container with light blue background and border -->
              <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="companyTabsContent">

                <!-- Tab 1: Office Information -->
                <div class="tab-pane fade show active" id="office-info" role="tabpanel" aria-labelledby="office-tab">
                  <div class="row g-2">
                    <!-- Left Form Group -->
                    <div class="col-md-6 pe-md-3 border-end border-light-blue">
                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Company Id.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="company_id"
                            id="company_id" value="001" readonly style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Company Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="company_name"
                            id="company_name" required style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Address</label>
                        <div class="col-sm-9">
                          <textarea class="form-control form-control-sm bg-white" name="address" id="address" rows="3"
                            style="font-size: 11px; line-height: 1.4;"></textarea>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Nature Of Bus.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="nature_of_bus"
                            id="nature_of_bus" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Contact No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="contact_no"
                            id="contact_no" style="font-size: 11px;" />
                        </div>
                      </div>
                    </div>

                    <!-- Right Form Group -->
                    <div class="col-md-6 ps-md-3">
                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Owner Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="owner_name"
                            id="owner_name" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Owner Desig.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="owner_desig"
                            id="owner_desig" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Owner Address</label>
                        <div class="col-sm-9">
                          <textarea class="form-control form-control-sm bg-white" name="owner_address"
                            id="owner_address" rows="3" style="font-size: 11px; line-height: 1.4;"></textarea>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control form-control-sm bg-white" name="email" id="email"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">WebSite</label>
                        <div class="col-sm-9">
                          <input type="url" class="form-control form-control-sm bg-white" name="website" id="website"
                            style="font-size: 11px;" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Tab 2: Registration Information -->
                <div class="tab-pane fade" id="registration-info" role="tabpanel" aria-labelledby="registration-tab">
                  <div class="row g-2">
                    <!-- Left Form Group -->
                    <div class="col-md-6 pe-md-3 border-end border-light-blue">
                      <div class="row mb-1">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">CIT (TDS) Addr</label>
                        <div class="col-sm-9">
                          <textarea class="form-control form-control-sm bg-white" name="cit_tds_address"
                            id="cit_tds_address" rows="2" style="font-size: 11px;"></textarea>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">PAN No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="pan_no" id="pan_no"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">TAN No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="tan_no" id="tan_no"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Place / City</label>
                        <div class="col-sm-9">
                          <div class="row g-1">
                            <div class="col-6">
                              <input type="text" class="form-control form-control-sm bg-white" name="place" id="place"
                                placeholder="Place" style="font-size: 11px;" />
                            </div>
                            <div class="col-6">
                              <input type="text" class="form-control form-control-sm bg-white" name="city" id="city"
                                placeholder="City" style="font-size: 11px;" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">District</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="district" id="district"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">State</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="state" id="state"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">ER 1 Code</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="er1_code" id="er1_code"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <!-- Checkboxes and inline values -->
                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="row g-1 align-items-center">
                            <div class="col-7">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="machine_code_excel"
                                  id="machine_code_excel">
                                <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                                  for="machine_code_excel" style="font-size: 11px;">Machine Code in Excel</label>
                              </div>
                            </div>
                            <label class="col-2 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                              style="font-size: 11px;">%</label>
                            <div class="col-3">
                              <input type="text" class="form-control form-control-sm px-1 bg-white"
                                name="machine_code_percentage" id="machine_code_percentage" style="font-size: 11px;" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="row g-1 align-items-center">
                            <div class="col-7">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="leave_in_salary"
                                  id="leave_in_salary">
                                <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                                  for="leave_in_salary" style="font-size: 11px;">Leave in Salary</label>
                              </div>
                            </div>
                            <div class="col-5">
                              <input type="text" class="form-control form-control-sm bg-white" name="leave_salary_val"
                                id="leave_salary_val" value="5.00" style="font-size: 11px;" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="gratuity_in_salary"
                              id="gratuity_in_salary">
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="gratuity_in_salary" style="font-size: 11px;">Gratuity in Salary</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="leave_in_muster" id="leave_in_muster">
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="leave_in_muster" style="font-size: 11px;">Leave in Muster</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="maintain_leave" id="maintain_leave">
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="maintain_leave" style="font-size: 11px;">Maintain Leave</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bonus_in_salary" id="bonus_in_salary">
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="bonus_in_salary" style="font-size: 11px;">Bonus in Salary</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="maintain_loan_record"
                              id="maintain_loan_record" checked>
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="maintain_loan_record" style="font-size: 11px;">Maintain Loan Record</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Right Form Group -->
                    <div class="col-md-6 ps-md-3">
                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">PF No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="pf_no" id="pf_no"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">ESIC No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="esic_no" id="esic_no"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">PT PRC No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="pt_prc_no"
                            id="pt_prc_no" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">PT PEC No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="pt_pec_no"
                            id="pt_pec_no" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Regis. No. (CIN)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="cin_no" id="cin_no"
                            style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Regis. Date</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control form-control-sm bg-white" name="regis_date"
                            id="regis_date" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <div class="col-sm-9 offset-sm-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="lwf_applicable" id="lwf_applicable">
                            <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                              for="lwf_applicable" style="font-size: 11px;">LWF Applicable</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Labour ID No.</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="labour_id_no"
                            id="labour_id_no" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">LWF EST Code</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="lwf_est_code"
                            id="lwf_est_code" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">License Reg No</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-sm bg-white" name="license_reg_no"
                            id="license_reg_no" style="font-size: 11px;" />
                        </div>
                      </div>

                      <div class="row mb-1 align-items-center">
                        <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">W. Off</label>
                        <div class="col-sm-9">
                          <select class="form-select form-select-sm bg-white" name="w_off" id="w_off"
                            style="font-size: 11px;">
                            <option value="NONE">NONE</option>
                            <option value="SUNDAY">SUNDAY</option>
                            <option value="MONDAY">MONDAY</option>
                            <option value="TUESDAY">TUESDAY</option>
                            <option value="WEDNESDAY">WEDNESDAY</option>
                            <option value="THURSDAY">THURSDAY</option>
                            <option value="FRIDAY">FRIDAY</option>
                            <option value="SATURDAY">SATURDAY</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Registration Tab Footer Elements -->
                  <div class="row mt-3 border-top border-light-blue pt-2 g-2">
                    <div class="col-md-3">
                      <div class="row align-items-center">
                        <label class="col-5 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Regis. Format</label>
                        <div class="col-7">
                          <select class="form-select form-select-sm bg-white" name="register_format"
                            id="register_format" style="font-size: 11px;">
                            <option value=""></option>
                            <option value="Format One">Format One</option>
                            <option value="Format Two">Format Two</option>
                            <option value="Format Three">Format Three</option>
                            <option value="Format Four">Format Four</option>
                            <option value="Format Morbi">Format Morbi</option>
                            <option value="Branch Name In Register">Branch Name In Register</option>
                            <option value="Production Inc. Add in Spe. Allow.">Production Inc. Add in Spe. Allow.
                            </option>
                            <option value="Salary Register Holiday">Salary Register Holiday</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row align-items-center">
                        <label class="col-5 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Leave Code Muster</label>
                        <div class="col-7">
                          <select class="form-select form-select-sm bg-white" name="leave_code_muster"
                            id="leave_code_muster" style="font-size: 11px;">
                            <option value="PL" selected>PL</option>
                            <option value="CL">CL</option>
                            <option value="SL">SL</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row align-items-center">
                        <label class="col-5 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Month Start From</label>
                        <div class="col-7">
                          <select class="form-select form-select-sm bg-white" name="leave_month_start"
                            id="leave_month_start" style="font-size: 11px;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row align-items-center">
                        <label class="col-5 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px; white-space: nowrap;">State For P.T.</label>
                        <div class="col-7">
                          <select class="form-select form-select-sm bg-white" name="pt_state" id="pt_state"
                            style="font-size: 11px;">
                            <option value=""></option>
                            <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                            <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                            <option value="ASSAM">ASSAM</option>
                            <option value="BIHAR">BIHAR</option>
                            <option value="CHHATTISGARH">CHHATTISGARH</option>
                            <option value="GOA">GOA</option>
                            <option value="GUJARAT">GUJARAT</option>
                            <option value="HARYANA">HARYANA</option>
                            <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                            <option value="JHARKHAND">JHARKHAND</option>
                            <option value="KARNATAKA">KARNATAKA</option>
                            <option value="KERALA">KERALA</option>
                            <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                            <option value="MAHARASHTRA">MAHARASHTRA</option>
                            <option value="MANIPUR">MANIPUR</option>
                            <option value="MEGHALAYA">MEGHALAYA</option>
                            <option value="MIZORAM">MIZORAM</option>
                            <option value="NAGALAND">NAGALAND</option>
                            <option value="ODISHA">ODISHA</option>
                            <option value="PUNJAB">PUNJAB</option>
                            <option value="RAJASTHAN">RAJASTHAN</option>
                            <option value="SIKKIM">SIKKIM</option>
                            <option value="TAMIL NADU">TAMIL NADU</option>
                            <option value="TELANGANA">TELANGANA</option>
                            <option value="TRIPURA">TRIPURA</option>
                            <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                            <option value="UTTARAKHAND">UTTARAKHAND</option>
                            <option value="WEST BENGAL">WEST BENGAL</option>
                            <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                            <option value="CHANDIGARH">CHANDIGARH</option>
                            <option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU">DADRA AND NAGAR HAVELI AND DAMAN
                              AND DIU</option>
                            <option value="DELHI">DELHI</option>
                            <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                            <option value="LADAKH">LADAKH</option>
                            <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                            <option value="PUDUCHERRY">PUDUCHERRY</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2 g-2">
                    <div class="col-md-6">
                      <div class="row align-items-center">
                        <label class="col-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                          style="font-size: 11px;">Salary Process on</label>
                        <div class="col-9">
                          <select class="form-select form-select-sm bg-white" name="salary_process_on"
                            id="salary_process_on" style="font-size: 11px;">
                            <option value=""></option>
                            <option value="PAY DAYS - CALCULATE BASIC AND OTHER COMPONENTS">PAY DAYS - CALCULATE BASIC
                              AND OTHER COMPONENTS</option>
                            <option value="PAY DAYS GROSS - CALCULATE BASIC - OT - HRA - EXTRA">PAY DAYS GROSS -
                              CALCULATE BASIC - OT - HRA - EXTRA</option>
                            <option value="PAY DAY GROSS - CALCULATE BASIC - HRA">PAY DAY GROSS - CALCULATE BASIC - HRA
                            </option>
                            <option value="GROSS - CALCULATE BASIC - HRA - LEAVE - Ext OT">GROSS - CALCULATE BASIC - HRA
                              - LEAVE - Ext OT</option>
                            <option value="GROSS - CALCULATE BASIC OT - DIFF IN HRA">GROSS - CALCULATE BASIC OT - DIFF
                              IN HRA</option>
                            <option value="PAY DAY GROSS - BASIC SAME AS GROSS">PAY DAY GROSS - BASIC SAME AS GROSS
                            </option>
                            <option value="PAY DAY GROSS - CALCULATE PAY COMPONENT - DIFF IN SPE. A">PAY DAY GROSS -
                              CALCULATE PAY COMPONENT - DIFF IN SPE. A</option>
                            <option value="PAY DAY GROSS - CALCULATE PAY COMPONENT - DIFF IN CONVEYANCE">PAY DAY GROSS -
                              CALCULATE PAY COMPONENT - DIFF IN CONVEYANCE</option>
                            <option value="NET SALARY - CALCULATE PAY DAY - BASIC - DIFF IN HRA">NET SALARY - CALCULATE
                              PAY DAY - BASIC - DIFF IN HRA</option>
                            <option value="PAY DAY EARN COMPONENT - CALCULATE PF AND DEDUCTIONS">PAY DAY EARN COMPONENT
                              - CALCULATE PF AND DEDUCTIONS</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Tab 3: Mailing Information -->
                <div class="tab-pane fade" id="mailing-info" role="tabpanel" aria-labelledby="mailing-tab">
                  <div class="row g-2">
                    <div class="col-md-6 offset-md-3 py-3">
                      <fieldset class="border p-3 rounded bg-white" style="border-color: #a3b8cc !important;">
                        <legend class="float-none w-auto px-2 fs-6 fw-bold text-primary"
                          style="font-size: 12px; margin-bottom: 0;">Sender Mail Configuration</legend>

                        <div class="mb-2 row align-items-center">
                          <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                            style="font-size: 11px;">Sender Mail</label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control form-control-sm bg-white" name="sender_mail"
                              id="sender_mail" style="font-size: 11px;" />
                          </div>
                        </div>

                        <div class="mb-2 row align-items-center">
                          <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                            style="font-size: 11px;">Mail Server</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm bg-white" name="mail_server"
                              id="mail_server" style="font-size: 11px;" />
                          </div>
                        </div>

                        <div class="mb-2 row align-items-center">
                          <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                            style="font-size: 11px;">Port</label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm bg-white" name="mail_port"
                              id="mail_port" style="font-size: 11px;" />
                          </div>
                        </div>

                        <div class="mb-2 row align-items-center">
                          <div class="col-sm-8 offset-sm-4">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="mail_ssl" id="mail_ssl">
                              <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue"
                                for="mail_ssl" style="font-size: 11px;">SSL</label>
                            </div>
                          </div>
                        </div>

                        <div class="mb-2 row align-items-center">
                          <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                            style="font-size: 11px;">User Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm bg-white" name="mail_username"
                              id="mail_username" style="font-size: 11px;" />
                          </div>
                        </div>

                        <div class="mb-2 row align-items-center">
                          <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                            style="font-size: 11px;">Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control form-control-sm bg-white" name="mail_password"
                              id="mail_password" style="font-size: 11px;" />
                          </div>
                        </div>

                        <div class="row align-items-center mt-3">
                          <div class="col-sm-8 offset-sm-4">
                            <button type="button" id="btnTestMail" class="btn btn-xs btn-outline-primary px-3 py-1"
                              style="font-size: 11px;">
                              <i class="ti ti-mail-forward me-1"></i>Test Mail Connection
                            </button>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>

              </div>
            </fieldset>
          </form>
        </div>

        <!-- Right Side Logo/Upload Area -->
        <div class="col-xl-3 col-lg-4 col-md-12 ps-xl-3 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
          style="gap: 12px;">

          <!-- Hidden inputs for File uploads -->
          <input type="file" id="logoFileInput" accept="image/*" style="display: none;">
          <input type="file" id="sigFileInput" accept="image/*" style="display: none;">
          <input type="file" id="extraFileInput" accept="image/*" style="display: none;">

          <!-- Company Logo Upload Box -->
          <div class="card w-100 border p-2 text-center bg-legacy-blue"
            style="border-color: #a3b8cc !important; border-radius: 4px;">
            <span class="col-form-label-sm fw-bold d-block mb-1 text-dark-blue" style="font-size: 11px;">Company
              Logo</span>
            <div id="logoPreviewBox"
              class="border rounded bg-white d-flex align-items-center justify-content-center mx-auto mb-2"
              style="width: 140px; height: 80px; border-style: dashed !important; border-color: #135ca3 !important; overflow: hidden;">
              <i class="ti ti-photo fs-2 text-muted"></i>
            </div>
            <div class="d-flex justify-content-center gap-1">
              <button type="button" id="btnBrowseLogo" class="btn btn-xs btn-outline-secondary py-0 px-2"
                style="font-size: 10px; height: 22px;">Browse</button>
              <button type="button" id="btnUploadLogo" class="btn btn-xs btn-primary py-0 px-2"
                style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Upload</button>
            </div>
          </div>

          <!-- Owner Signature Upload Box -->
          <div class="card w-100 border p-2 text-center bg-legacy-blue"
            style="border-color: #a3b8cc !important; border-radius: 4px;">
            <span class="col-form-label-sm fw-bold d-block mb-1 text-dark-blue" style="font-size: 11px;">Owner
              Signature</span>
            <div id="sigPreviewBox"
              class="border rounded bg-white d-flex align-items-center justify-content-center mx-auto mb-2"
              style="width: 140px; height: 50px; border-style: dashed !important; border-color: #135ca3 !important; overflow: hidden;">
              <i class="ti ti-signature fs-2 text-muted"></i>
            </div>
            <div class="d-flex justify-content-center gap-1">
              <button type="button" id="btnBrowseSig" class="btn btn-xs btn-outline-secondary py-0 px-2"
                style="font-size: 10px; height: 22px;">Browse</button>
              <button type="button" id="btnUploadSig" class="btn btn-xs btn-primary py-0 px-2"
                style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Upload</button>
            </div>
          </div>

          <!-- Extra Specimen Upload Box -->
          <div class="card w-100 border p-2 text-center bg-legacy-blue"
            style="border-color: #a3b8cc !important; border-radius: 4px;">
            <div id="extraPreviewBox"
              class="border rounded bg-white d-flex align-items-center justify-content-center mx-auto mb-2"
              style="width: 140px; height: 50px; border-style: dashed !important; border-color: #135ca3 !important; overflow: hidden;">
              <i class="ti ti-file-text fs-2 text-muted"></i>
            </div>
            <div class="d-flex justify-content-center gap-1">
              <button type="button" id="btnBrowseExtra" class="btn btn-xs btn-outline-secondary py-0 px-2"
                style="font-size: 10px; height: 22px;">Browse</button>
              <button type="button" id="btnUploadExtra" class="btn btn-xs btn-primary py-0 px-2"
                style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Upload</button>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Bottom Action Toolbar / Footer Buttons -->
    <div class="card-footer bg-light border-top p-2 px-3">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <!-- Left Side: Buttons + Slider Navigation -->
        <div class="d-flex flex-column gap-1">
          <!-- DB Operations Buttons Group -->
          <div class="d-flex flex-wrap gap-1 align-items-center bg-white p-1 rounded border shadow-xs"
            style="border-color: #c9c8cc !important;">
            <button type="button" id="btnAdd" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-plus me-1 text-success"></i>Add</button>
            <button type="button" id="btnEdit" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-edit me-1 text-warning"></i>Edit</button>
            <button type="button" id="btnDelete" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-trash me-1 text-danger"></i>Delete</button>
            <button type="button" id="btnSave" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-device-floppy me-1 text-primary"></i>Save</button>
            <button type="button" id="btnCancel" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-refresh me-1 text-secondary"></i>Cancel</button>
            <button type="button" id="btnExit" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-logout me-1 text-danger"></i>Exit</button>
            <button type="button" id="btnSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-search me-1 text-info"></i>Search</button>
            <button type="button" id="btnPrint" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
                class="ti ti-printer me-1 text-dark"></i>Print</button>
          </div>
          <!-- Record Navigation Slider (Legacy style) -->
          <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
            style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
            <span id="navLabel" class="px-2 fw-bold border-end me-2"
              style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
            <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
              style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
            <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="0" value="0"
              style="height: 4px; flex-grow: 1; min-width: 200px;" disabled />
            <button type="button" id="btnNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
              style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
          </div>
        </div>

        <!-- Additional Information Buttons -->
        <div class="d-flex flex-wrap gap-2">
          <button type="button" id="btnBranchInfo" class="btn btn-sm btn-info text-white px-2 py-1"
            style="font-size: 11px; height: 26px; background-color: #02a9f4; border-color: #02a9f4;"><i
              class="ti ti-git-branch me-1"></i>Branch Info.</button>
          <button type="button" id="btnPrincipalEmployer" class="btn btn-sm btn-primary text-white px-2 py-1"
            style="font-size: 11px; height: 26px; background-color: #135ca3; border-color: #135ca3;"><i
              class="ti ti-user-check me-1"></i>Principal Employer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Branch Master Floating Dialog Card -->
  <div id="branchCard" class="card shadow-lg border-1"
    style="max-width: 900px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; display: none; z-index: 20;">
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-git-branch me-2" style="font-size: 16px;"></i>BRANCH MASTER INFORMATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="branchMasterForm">
        <input type="hidden" name="id" id="branch_db_id" value="0">
        <input type="hidden" name="company_id" id="branch_company_id" value="0">

        <fieldset class="border p-3 rounded mb-2 bg-legacy-blue" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">Branch
            Information</legend>

          <div class="row g-2">
            <!-- Left Column -->
            <div class="col-md-6 pe-md-3 border-end border-light-blue">
              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Branch Id.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="branch_code" id="branch_code"
                    required style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Company Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-light" id="branch_company_name_val" readonly
                    style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Branch Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="branch_name" id="branch_name"
                    required style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Address</label>
                <div class="col-sm-8">
                  <textarea class="form-control form-control-sm bg-white" name="address" id="branch_address" rows="3"
                    style="font-size: 11px; line-height: 1.4;"></textarea>
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Place</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="place" id="branch_place"
                    style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">City</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="city" id="branch_city"
                    style="font-size: 11px;" />
                </div>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6 ps-md-3">
              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">District</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="district" id="branch_district"
                    style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">State</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="state" id="branch_state"
                    style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Salary Month Start From</label>
                <div class="col-sm-8">
                  <select class="form-select form-select-sm bg-white" name="salary_month_start_from"
                    id="branch_salary_month_start_from" style="font-size: 11px;">
                    <?php for ($m = 1; $m <= 31; $m++) {
                      echo "<option value='$m'>$m</option>";
                    } ?>
                  </select>
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">State For Calculation of P.T.</label>
                <div class="col-sm-8">
                  <select class="form-select form-select-sm bg-white" name="pt_state" id="branch_pt_state"
                    style="font-size: 11px;">
                    <option value=""></option>
                    <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                    <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                    <option value="ASSAM">ASSAM</option>
                    <option value="BIHAR">BIHAR</option>
                    <option value="CHHATTISGARH">CHHATTISGARH</option>
                    <option value="GOA">GOA</option>
                    <option value="GUJARAT">GUJARAT</option>
                    <option value="HARYANA">HARYANA</option>
                    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                    <option value="JHARKHAND">JHARKHAND</option>
                    <option value="KARNATAKA">KARNATAKA</option>
                    <option value="KERALA">KERALA</option>
                    <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                    <option value="MAHARASHTRA">MAHARASHTRA</option>
                    <option value="MANIPUR">MANIPUR</option>
                    <option value="MEGHALAYA">MEGHALAYA</option>
                    <option value="MIZORAM">MIZORAM</option>
                    <option value="NAGALAND">NAGALAND</option>
                    <option value="ODISHA">ODISHA</option>
                    <option value="PUNJAB">PUNJAB</option>
                    <option value="RAJASTHAN">RAJASTHAN</option>
                    <option value="SIKKIM">SIKKIM</option>
                    <option value="TAMIL NADU">TAMIL NADU</option>
                    <option value="TELANGANA">TELANGANA</option>
                    <option value="TRIPURA">TRIPURA</option>
                    <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                    <option value="UTTARAKHAND">UTTARAKHAND</option>
                    <option value="WEST BENGAL">WEST BENGAL</option>
                    <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                    <option value="CHANDIGARH">CHANDIGARH</option>
                    <option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU">DADRA AND NAGAR HAVELI AND DAMAN AND DIU
                    </option>
                    <option value="DELHI">DELHI</option>
                    <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                    <option value="LADAKH">LADAKH</option>
                    <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                    <option value="PUDUCHERRY">PUDUCHERRY</option>
                  </select>
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">PT PRC No.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="pt_prc_no"
                    id="branch_pt_prc_no" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">PT PEC No.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="pt_pec_no"
                    id="branch_pt_pec_no" style="font-size: 11px;" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </form>

      <!-- Branch Search Pane -->
      <fieldset id="branchSearchPane" class="border p-2 rounded bg-white mb-2"
        style="border-color: #a3b8cc !important; display: none;">
        <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 11px; margin-bottom: 0;">Search
          Branches</legend>
        <div class="row g-2 align-items-center mb-2">
          <div class="col-sm-8">
            <input type="text" id="branchSearchCriteria" class="form-control form-control-sm"
              placeholder="Search by branch code or name..."
              style="font-size: 11px; border: 1px solid #135ca3 !important;">
          </div>
          <div class="col-sm-4 d-flex gap-1">
            <button type="button" id="btnDoBranchSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px;"><i class="ti ti-search text-info"></i> Search</button>
            <button type="button" id="btnHideBranchSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px;"><i class="ti ti-x text-danger"></i> Close</button>
          </div>
        </div>
        <div class="table-responsive" style="max-height: 150px; overflow-y: auto;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light">
              <tr>
                <th>Branch Id</th>
                <th>Branch Name</th>
                <th>City</th>
              </tr>
            </thead>
            <tbody id="branchSearchResultsBody"></tbody>
          </table>
        </div>
      </fieldset>
    </div>

    <div class="card-footer bg-light border-top p-2 px-3">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <div class="d-flex flex-wrap gap-1 align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important;">
          <button type="button" id="btnBranchAdd" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-plus me-1 text-success"></i>Add</button>
          <button type="button" id="btnBranchEdit" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-edit me-1 text-warning"></i>Edit</button>
          <button type="button" id="btnBranchDelete" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-trash me-1 text-danger"></i>Delete</button>
          <button type="button" id="btnBranchSave" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-device-floppy me-1 text-primary"></i>Save</button>
          <button type="button" id="btnBranchCancel" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-refresh me-1 text-secondary"></i>Cancel</button>
          <button type="button" id="btnBranchExit" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-logout me-1 text-danger"></i>Exit</button>
          <button type="button" id="btnBranchSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-search me-1 text-info"></i>Search</button>
        </div>

        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
          <span id="branchNavLabel" class="px-2 fw-bold border-end me-2"
            style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
          <button type="button" id="btnBranchPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="branchRangeSlider" class="form-range mx-2" min="0" max="0" value="0"
            style="height: 4px; flex-grow: 1; min-width: 120px;" disabled />
          <button type="button" id="btnBranchNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Principal Employer Floating Dialog Card -->
  <div id="employerCard" class="card shadow-lg border-1"
    style="max-width: 950px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; display: none; z-index: 20;">
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-user-check me-2" style="font-size: 16px;"></i>PRINCIPLE EMPLOYER MASTER
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="employerMasterForm">
        <input type="hidden" name="id" id="employer_db_id" value="0">
        <input type="hidden" name="company_id" id="employer_company_id" value="0">

        <fieldset class="border p-3 rounded mb-2 bg-legacy-blue" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Employer Information</legend>

          <div class="row g-2">
            <!-- Left Column -->
            <div class="col-md-6 pe-md-3 border-end border-light-blue">
              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Employer Id.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="employer_code"
                    id="employer_code" required style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Company Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-light" id="employer_company_name_val"
                    readonly style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Principle Employer Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="employer_name"
                    id="employer_name" required style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Address</label>
                <div class="col-sm-8">
                  <textarea class="form-control form-control-sm bg-white" name="employer_address" id="employer_address"
                    rows="3" style="font-size: 11px; line-height: 1.4;"></textarea>
                </div>
              </div>

              <div class="row mb-1">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Establishment in which Contract is Carried on</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="establishment_name"
                    id="establishment_name" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Address</label>
                <div class="col-sm-8">
                  <textarea class="form-control form-control-sm bg-white" name="establishment_address"
                    id="establishment_address" rows="3" style="font-size: 11px; line-height: 1.4;"></textarea>
                </div>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6 ps-md-3">
              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Nature Of Work</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="nature_of_work"
                    id="employer_nature_of_work" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Location Of Work</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="location_of_work"
                    id="employer_location_of_work" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Labour No</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="labour_no"
                    id="employer_labour_no" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">PAN No.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="pan_no" id="employer_pan_no"
                    style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Mobile No.</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm bg-white" name="mobile_no"
                    id="employer_mobile_no" style="font-size: 11px;" />
                </div>
              </div>

              <div class="row mb-1 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control form-control-sm bg-white" name="email" id="employer_email"
                    style="font-size: 11px;" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </form>

      <!-- Employer Search Pane -->
      <fieldset id="employerSearchPane" class="border p-2 rounded bg-white mb-2"
        style="border-color: #a3b8cc !important; display: none;">
        <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 11px; margin-bottom: 0;">Search
          Employers</legend>
        <div class="row g-2 align-items-center mb-2">
          <div class="col-sm-8">
            <input type="text" id="employerSearchCriteria" class="form-control form-control-sm"
              placeholder="Search by code or name..." style="font-size: 11px; border: 1px solid #135ca3 !important;">
          </div>
          <div class="col-sm-4 d-flex gap-1">
            <button type="button" id="btnDoEmployerSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px;"><i class="ti ti-search text-info"></i> Search</button>
            <button type="button" id="btnHideEmployerSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px;"><i class="ti ti-x text-danger"></i> Close</button>
          </div>
        </div>
        <div class="table-responsive" style="max-height: 150px; overflow-y: auto;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light">
              <tr>
                <th>Employer Id</th>
                <th>Employer Name</th>
                <th>Mobile No.</th>
              </tr>
            </thead>
            <tbody id="employerSearchResultsBody"></tbody>
          </table>
        </div>
      </fieldset>
    </div>

    <div class="card-footer bg-light border-top p-2 px-3">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <div class="d-flex flex-wrap gap-1 align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important;">
          <button type="button" id="btnEmployerAdd" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-plus me-1 text-success"></i>Add</button>
          <button type="button" id="btnEmployerEdit" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-edit me-1 text-warning"></i>Edit</button>
          <button type="button" id="btnEmployerDelete" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-trash me-1 text-danger"></i>Delete</button>
          <button type="button" id="btnEmployerSave" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-device-floppy me-1 text-primary"></i>Save</button>
          <button type="button" id="btnEmployerCancel" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-refresh me-1 text-secondary"></i>Cancel</button>
          <button type="button" id="btnEmployerExit" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-logout me-1 text-danger"></i>Exit</button>
          <button type="button" id="btnEmployerSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
              class="ti ti-search me-1 text-info"></i>Search</button>
        </div>

        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
          <span id="employerNavLabel" class="px-2 fw-bold border-end me-2"
            style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
          <button type="button" id="btnEmployerPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="employerRangeSlider" class="form-range mx-2" min="0" max="0" value="0"
            style="height: 4px; flex-grow: 1; min-width: 120px;" disabled />
          <button type="button" id="btnEmployerNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!--/ Content -->

<!-- Custom Style block to override tabs design in company-master -->
<style>
  /* Light blue background for the tab content window */
  .bg-legacy-blue {
    background-color: #e8f0fe !important;
    border-color: #a3b8cc !important;
  }

  .border-light-blue {
    border-color: #c4d6ec !important;
  }

  .text-dark-blue {
    color: #135ca3 !important;
  }

  /* Make inputs have classical blue borders */
  .bg-legacy-blue .form-control,
  .bg-legacy-blue .form-select {
    border: 1px solid #135ca3 !important;
    border-radius: 2px !important;
    background-color: #ffffff !important;
  }

  .bg-legacy-blue .form-control:focus,
  .bg-legacy-blue .form-select:focus {
    border-color: #00a2e8 !important;
    box-shadow: 0 0 4px rgba(0, 162, 232, 0.4) !important;
  }

  /* Classical Tab styles */
  #companyTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #companyTabs .nav-item .nav-link {
    border: 1px solid #a3b8cc !important;
    border-bottom: none !important;
    background-color: #f0f4f8 !important;
    color: #4b465c !important;
    margin-right: 4px !important;
    border-top-left-radius: 4px !important;
    border-top-right-radius: 4px !important;
    padding: 6px 12px !important;
    transition: all 0.15s ease-in-out;
  }

  #companyTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #companyTabs .nav-item .nav-link.active {
    background-color: #e8f0fe !important;
    /* matches content bg */
    border-color: #a3b8cc !important;
    border-bottom-color: #e8f0fe !important;
    /* hide bottom border on active tab */
    color: #135ca3 !important;
    position: relative;
    z-index: 2;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById("draggableCard");

    // Center card initially on load
    const initialLeft = (window.innerWidth - card.offsetWidth) / 2;
    card.style.left = Math.max(0, initialLeft) + "px";
    card.style.top = "100px";
    card.style.opacity = "1"; // Show the card once centered

    dragElement(card);

    // Esc key press redirects to index or closes active modals
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        const branchCard = document.getElementById("branchCard");
        const employerCard = document.getElementById("employerCard");
        const searchCard = document.getElementById("searchCard");

        if (searchCard.style.display === 'block') {
          searchCard.style.display = 'none';
        } else if (branchCard.style.display === 'block') {
          if (branchMode !== 'view') {
            if (branchRecords.length > 0) {
              displayBranch(branchIndex);
            } else {
              branchCard.style.display = 'none';
              card.style.display = 'block';
            }
          } else {
            branchCard.style.display = 'none';
            card.style.display = 'block';
          }
        } else if (employerCard.style.display === 'block') {
          if (employerMode !== 'view') {
            if (employerRecords.length > 0) {
              displayEmployer(employerIndex);
            } else {
              employerCard.style.display = 'none';
              card.style.display = 'block';
            }
          } else {
            employerCard.style.display = 'none';
            card.style.display = 'block';
          }
        } else {
          // If we are in add/edit mode, cancel it. Otherwise exit.
          if (currentMode !== 'view') {
            cancelAction();
          } else {
            window.location.href = 'index';
          }
        }
      }
    });

    // Exit button click redirects to index
    const btnExit = document.getElementById("btnExit");
    if (btnExit) {
      btnExit.addEventListener('click', () => {
        window.location.href = 'index';
      });
    }

    // --- CRUD AJAX LOGIC ---
    let companyRecords = [];
    let currentIndex = -1;
    let currentMode = 'view'; // 'view', 'add', 'edit'
    let companySelectModalInstance = null;

    const form = document.getElementById("companyMasterForm");
    const formElements = form.querySelectorAll("input, textarea, select");

    // Load records initially
    fetchRecords();

    function fetchRecords() {
      fetch('actions/company-master-action.php?action=view')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            companyRecords = response.data;
            if (companyRecords.length === 1) {
              currentIndex = 0;
              displayRecord(currentIndex);
            } else if (companyRecords.length > 1) {

              const selectBody = document.getElementById("companySelectBody");
              selectBody.innerHTML = "";
              companyRecords.forEach((rec, idx) => {
                const tr = document.createElement("tr");
                tr.style.cursor = "pointer";
                tr.innerHTML = `<td><strong>${rec.company_code || ''}</strong></td><td>${rec.company_name || ''}</td>`;
                tr.addEventListener('click', () => {
                  currentIndex = idx;
                  displayRecord(currentIndex);
                  if (companySelectModalInstance) {
                    companySelectModalInstance.hide();
                  }
                });
                selectBody.appendChild(tr);
              });

              companySelectModalInstance = new bootstrap.Modal(document.getElementById("companySelectModal"));
              companySelectModalInstance.show();
            } else {
              currentIndex = -1;
              clearForm();
              setMode('add'); // Force add mode if no records exist
            }
          }
        })
        .catch(err => console.error("Error fetching records: ", err));
    }

    function displayRecord(index) {
      if (index < 0 || index >= companyRecords.length) return;

      const record = companyRecords[index];

      // Fill text inputs, selects, textareas
      document.getElementById("company_db_id").value = record.id;
      document.getElementById("company_id").value = record.company_code || '';
      document.getElementById("company_name").value = record.company_name || '';
      document.getElementById("address").value = record.address || '';
      document.getElementById("nature_of_bus").value = record.nature_of_bus || '';
      document.getElementById("owner_name").value = record.owner_name || '';
      document.getElementById("owner_desig").value = record.owner_desig || '';
      document.getElementById("owner_address").value = record.owner_address || '';
      document.getElementById("contact_no").value = record.contact_no || '';

      if (document.getElementById("official_name")) document.getElementById("official_name").value = record.official_name || '';
      if (document.getElementById("official_address")) document.getElementById("official_address").value = record.official_address || '';
      if (document.getElementById("auth_name")) document.getElementById("auth_name").value = record.auth_name || '';
      if (document.getElementById("auth_desig")) document.getElementById("auth_desig").value = record.auth_desig || '';
      if (document.getElementById("auth_address")) document.getElementById("auth_address").value = record.auth_address || '';
      document.getElementById("email").value = record.email || '';
      document.getElementById("website").value = record.website || '';

      document.getElementById("pan_no").value = record.pan_no || '';
      document.getElementById("tan_no").value = record.tan_no || '';
      document.getElementById("pf_no").value = record.pf_code || '';
      document.getElementById("esic_no").value = record.esic_code || '';
      document.getElementById("cin_no").value = record.reg_no || '';
      document.getElementById("regis_date").value = record.reg_date || '';

      document.getElementById("sender_mail").value = record.mailing_email || '';
      document.getElementById("mail_server").value = record.mailing_address || '';
      document.getElementById("mail_port").value = record.mailing_phone || '';

      // Newly added fields
      document.getElementById("cit_tds_address").value = record.cit_tds_address || '';
      document.getElementById("place").value = record.place || '';
      document.getElementById("city").value = record.city || '';
      document.getElementById("district").value = record.district || '';
      document.getElementById("state").value = record.state || '';
      document.getElementById("er1_code").value = record.er1_code || '';

      document.getElementById("machine_code_percentage").value = record.machine_code_percentage || '';
      document.getElementById("leave_salary_val").value = record.leave_salary_val || '5.00';

      document.getElementById("pt_prc_no").value = record.pt_prc_no || '';
      document.getElementById("pt_pec_no").value = record.pt_pec_no || '';
      document.getElementById("labour_id_no").value = record.labour_id_no || '';
      document.getElementById("lwf_est_code").value = record.lwf_est_code || '';
      document.getElementById("license_reg_no").value = record.license_reg_no || '';
      document.getElementById("w_off").value = record.w_off || 'NONE';

      document.getElementById("register_format").value = record.register_format || '';
      document.getElementById("leave_code_muster").value = record.leave_code_muster || 'PL';
      document.getElementById("leave_month_start").value = record.leave_month_start || '1';
      document.getElementById("salary_process_on").value = record.salary_process_on || '';
      document.getElementById("pt_state").value = record.pt_state || '';

      document.getElementById("mail_username").value = record.mail_username || '';
      document.getElementById("mail_password").value = record.mail_password || '';

      // Old file names
      document.getElementById("old_logo").value = record.logo || '';
      document.getElementById("old_sig").value = record.owner_signature || '';

      // Checkboxes
      document.getElementById("machine_code_excel").checked = record.machine_code_excel === '1';
      document.getElementById("leave_in_salary").checked = record.leave_in_salary === '1';
      document.getElementById("gratuity_in_salary").checked = record.gratuity_in_salary === '1';
      document.getElementById("leave_in_muster").checked = record.leave_in_muster === '1';
      document.getElementById("maintain_leave").checked = record.maintain_leave === '1';
      document.getElementById("bonus_in_salary").checked = record.bonus_in_salary === '1';
      document.getElementById("maintain_loan_record").checked = record.maintain_loan_record === '1';
      document.getElementById("lwf_applicable").checked = record.lwf_applicable === '1';
      document.getElementById("mail_ssl").checked = record.mail_ssl === '1';

      // File Preview updates
      updatePreview("logoPreviewBox", record.logo ? 'uploads/logos/' + record.logo : null, "ti-photo");
      updatePreview("sigPreviewBox", record.owner_signature ? 'uploads/signatures/' + record.owner_signature : null, "ti-signature");

      // Update Slider UI
      document.getElementById("navLabel").innerText = (index + 1) + " / " + companyRecords.length;

      const slider = document.getElementById("rangeSlider");
      slider.max = companyRecords.length - 1;
      slider.value = index;
      slider.disabled = companyRecords.length <= 1;

      setMode('view');
    }

    function updatePreview(boxId, filePath, defaultIconClass) {
      const box = document.getElementById(boxId);
      if (filePath) {
        box.innerHTML = `<img src="${filePath}" style="max-width:100%; max-height:100%; object-fit:contain;" />`;
      } else {
        box.innerHTML = `<i class="ti ${defaultIconClass} fs-2 text-muted"></i>`;
      }
    }

    function clearForm() {
      form.reset();
      document.getElementById("company_db_id").value = "0";
      document.getElementById("old_logo").value = "";
      document.getElementById("old_sig").value = "";

      // Fetch next Company ID from database
      fetch('actions/company-master-action.php?action=next_code')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            document.getElementById("company_id").value = response.next_code;
          }
        })
        .catch(err => console.error("Error fetching next company code: ", err));

      updatePreview("logoPreviewBox", null, "ti-photo");
      updatePreview("sigPreviewBox", null, "ti-signature");
      updatePreview("extraPreviewBox", null, "ti-file-text");
    }

    function setMode(mode) {
      currentMode = mode;
      if (mode === 'view') {
        formElements.forEach(el => {
          if (el.id !== 'rangeSlider') el.disabled = true;
        });
        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = companyRecords.length === 0;
        document.getElementById("btnDelete").disabled = companyRecords.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = false;

        document.getElementById("btnBrowseLogo").disabled = true;
        document.getElementById("btnBrowseSig").disabled = true;
        document.getElementById("btnBrowseExtra").disabled = true;
        document.getElementById("btnUploadLogo").disabled = true;
        document.getElementById("btnUploadSig").disabled = true;
        document.getElementById("btnUploadExtra").disabled = true;
      } else {
        // add or edit mode
        formElements.forEach(el => {
          if (el.id !== 'rangeSlider') el.disabled = false;
        });
        document.getElementById("company_id").readOnly = true; // Ensure it remains read-only
        document.getElementById("btnAdd").disabled = true;
        document.getElementById("btnEdit").disabled = true;
        document.getElementById("btnDelete").disabled = true;
        document.getElementById("btnSave").disabled = false;
        document.getElementById("btnCancel").disabled = false;

        document.getElementById("btnBrowseLogo").disabled = false;
        document.getElementById("btnBrowseSig").disabled = false;
        document.getElementById("btnBrowseExtra").disabled = false;
        document.getElementById("btnUploadLogo").disabled = false;
        document.getElementById("btnUploadSig").disabled = false;
        document.getElementById("btnUploadExtra").disabled = false;
      }
    }

    // --- Button Actions ---

    document.getElementById("btnAdd").addEventListener('click', () => {
      clearForm();
      setMode('add');
    });

    document.getElementById("btnEdit").addEventListener('click', () => {
      if (currentIndex >= 0) {
        setMode('edit');
      }
    });

    document.getElementById("btnCancel").addEventListener('click', () => {
      cancelAction();
    });

    function cancelAction() {
      if (currentMode !== 'view' && companyRecords.length > 0) {
        displayRecord(currentIndex);
      } else {
        window.location.href = 'index';
      }
    }

    document.getElementById("btnDelete").addEventListener('click', () => {
      if (currentIndex >= 0) {
        const record = companyRecords[currentIndex];
        if (confirm("Are you sure you want to delete this company record?")) {
          fetch(`actions/company-master-action.php?action=delete&id=${record.id}`)
            .then(res => res.json())
            .then(response => {
              alert(response.message);
              if (response.status === 'success') {
                fetchRecords();
              }
            })
            .catch(err => console.error("Error deleting record: ", err));
        }
      }
    });

    document.getElementById("btnSave").addEventListener('click', () => {
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      const formData = new FormData(form);

      // Add file inputs
      const logoFile = document.getElementById("logoFileInput").files[0];
      if (logoFile) formData.append('logo', logoFile);

      const sigFile = document.getElementById("sigFileInput").files[0];
      if (sigFile) formData.append('owner_signature', sigFile);

      fetch('actions/company-master-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            fetchRecords();
          }
        })
        .catch(err => console.error("Error saving record: ", err));
    });

    // --- Slider Navigation ---

    document.getElementById("btnPrev").addEventListener('click', () => {
      if (currentMode === 'view' && currentIndex > 0) {
        currentIndex--;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("btnNext").addEventListener('click', () => {
      if (currentMode === 'view' && currentIndex < companyRecords.length - 1) {
        currentIndex++;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("rangeSlider").addEventListener('input', (e) => {
      if (currentMode === 'view') {
        currentIndex = parseInt(e.target.value);
        displayRecord(currentIndex);
      }
    });

    // --- File Browsing triggers ---

    document.getElementById("btnBrowseLogo").addEventListener('click', () => {
      document.getElementById("logoFileInput").click();
    });

    document.getElementById("logoFileInput").addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          document.getElementById("logoPreviewBox").innerHTML = `<img src="${event.target.result}" style="max-width:100%; max-height:100%; object-fit:contain;" />`;
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById("btnUploadLogo").addEventListener('click', () => {
      const file = document.getElementById("logoFileInput").files[0];
      if (!file) {
        alert("Please select a logo file first.");
        return;
      }
      const formData = new FormData();
      formData.append('file', file);
      formData.append('old_file', document.getElementById("old_logo").value);

      fetch('actions/company-master-action.php?action=upload&type=logo', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            document.getElementById("old_logo").value = response.filename;
            updatePreview("logoPreviewBox", 'uploads/logos/' + response.filename, "ti-photo");
            alert("Logo uploaded and converted to WebP successfully!");
          } else {
            alert("Upload failed: " + response.message);
          }
        })
        .catch(err => console.error("Error uploading logo: ", err));
    });

    document.getElementById("btnBrowseSig").addEventListener('click', () => {
      document.getElementById("sigFileInput").click();
    });

    document.getElementById("sigFileInput").addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          document.getElementById("sigPreviewBox").innerHTML = `<img src="${event.target.result}" style="max-width:100%; max-height:100%; object-fit:contain;" />`;
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById("btnUploadSig").addEventListener('click', () => {
      const file = document.getElementById("sigFileInput").files[0];
      if (!file) {
        alert("Please select a signature file first.");
        return;
      }
      const formData = new FormData();
      formData.append('file', file);
      formData.append('old_file', document.getElementById("old_sig").value);

      fetch('actions/company-master-action.php?action=upload&type=signature', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            document.getElementById("old_sig").value = response.filename;
            updatePreview("sigPreviewBox", 'uploads/signatures/' + response.filename, "ti-signature");
            alert("Signature uploaded and converted to WebP successfully!");
          } else {
            alert("Upload failed: " + response.message);
          }
        })
        .catch(err => console.error("Error uploading signature: ", err));
    });

    document.getElementById("btnBrowseExtra").addEventListener('click', () => {
      document.getElementById("extraFileInput").click();
    });

    document.getElementById("extraFileInput").addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          document.getElementById("extraPreviewBox").innerHTML = `<img src="${event.target.result}" style="max-width:100%; max-height:100%; object-fit:contain;" />`;
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById("btnUploadExtra").addEventListener('click', () => {
      const file = document.getElementById("extraFileInput").files[0];
      if (!file) {
        alert("Please select an extra specimen file first.");
        return;
      }
      const formData = new FormData();
      formData.append('file', file);

      fetch('actions/company-master-action.php?action=upload&type=extra', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            updatePreview("extraPreviewBox", 'uploads/specimens/' + response.filename, "ti-file-text");
            alert("Extra specimen uploaded and converted to WebP successfully!");
          } else {
            alert("Upload failed: " + response.message);
          }
        })
        .catch(err => console.error("Error uploading extra specimen: ", err));
    });

    document.getElementById("btnTestMail").addEventListener('click', () => {
      const senderMail = document.getElementById("sender_mail").value.trim();
      const mailServer = document.getElementById("mail_server").value.trim();
      const mailPort = document.getElementById("mail_port").value.trim();

      if (!senderMail || !mailServer || !mailPort) {
        alert("Please fill in Sender Mail, Mail Server, and Port first.");
        return;
      }

      const recipient = prompt("Enter recipient email address to send test email to:");
      if (!recipient) return;

      const formData = new FormData(form);

      // Send to test mail endpoint
      fetch(`actions/mail-action.php?action=test_mail&to=${encodeURIComponent(recipient)}`, {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
        })
        .catch(err => {
          console.error("Test email error: ", err);
          alert("Failed to send test email. Check console logs.");
        });
    });

    // --- SEARCH CARD LOGIC ---
    const searchCard = document.getElementById("searchCard");
    let allCompaniesList = [];
    dragElement(searchCard);

    document.getElementById("btnSearch").addEventListener('click', () => {
      document.getElementById("searchCriteria").value = "";

      // Fetch all companies unfiltered for the search results
      fetch('actions/company-master-action.php?action=list')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            allCompaniesList = response.data;
            renderSearchResults(allCompaniesList);

            // Center the searchCard and show it
            searchCard.style.display = "block";
            const left = (window.innerWidth - searchCard.offsetWidth) / 2;
            searchCard.style.left = Math.max(0, left) + "px";
            searchCard.style.top = "120px";
          }
        })
        .catch(err => console.error("Error fetching all companies for search: ", err));
    });

    document.getElementById("btnExitSearch").addEventListener('click', () => {
      searchCard.style.display = 'none';
    });

    document.getElementById("btnCancelSearch").addEventListener('click', () => {
      searchCard.style.display = 'none';
    });

    document.getElementById("btnRefreshSearch").addEventListener('click', () => {
      document.getElementById("searchCriteria").value = "";
      renderSearchResults(allCompaniesList);
    });

    document.getElementById("btnShowAllSearch").addEventListener('click', () => {
      renderSearchResults(allCompaniesList);
    });

    document.getElementById("btnDoSearch").addEventListener('click', () => {
      const field = document.getElementById("searchField").value;
      const operator = document.getElementById("searchOperator").value;
      const criteria = document.getElementById("searchCriteria").value.toLowerCase().trim();

      if (criteria === "") {
        renderSearchResults(allCompaniesList);
        return;
      }

      const filtered = allCompaniesList.filter(rec => {
        let val = (rec[field] || '').toLowerCase();
        if (operator === 'equals') {
          return val === criteria;
        } else if (operator === 'starts') {
          return val.startsWith(criteria);
        } else {
          return val.includes(criteria);
        }
      });

      renderSearchResults(filtered);
    });

    function renderSearchResults(records) {
      const tbody = document.getElementById("searchResultsBody");
      document.getElementById("searchResultsLegend").innerText = `Search Result (${records.length}) Record(s) Found`;

      if (records.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-2">No records match your criteria.</td></tr>`;
        return;
      }

      tbody.innerHTML = "";
      records.forEach(rec => {
        const tr = document.createElement("tr");
        tr.style.cursor = "pointer";
        tr.innerHTML = `
          <td><strong>${rec.company_code || ''}</strong></td>
          <td>${rec.company_name || ''}</td>
          <td>${rec.owner_name || ''}</td>
          <td>${rec.contact_no || ''}</td>
        `;
        tr.addEventListener('click', () => {
          // Select company in session and reload/fetch record
          fetch(`actions/company-master-action.php?action=select&id=${rec.id}`)
            .then(res => res.json())
            .then(selResponse => {
              if (selResponse.status === 'success') {
                searchCard.style.display = 'none';
                fetchRecords(); // This will load only the selected company record
              } else {
                alert("Error selecting company: " + selResponse.message);
              }
            })
            .catch(err => console.error("Error setting active company session from search: ", err));
        });
        tbody.appendChild(tr);
      });
    }

    // ==========================================
    // --- BRANCH MASTER JS CRUD LOGIC ---
    // ==========================================
    const branchCard = document.getElementById("branchCard");
    dragElement(branchCard);

    let branchRecords = [];
    let branchIndex = -1;
    let branchMode = 'view';

    const branchForm = document.getElementById("branchMasterForm");
    const branchFormElements = branchForm.querySelectorAll("input, textarea, select");

    document.getElementById("btnBranchInfo").addEventListener('click', () => {
      const activeCompany = companyRecords[currentIndex];
      if (!activeCompany) {
        alert("Please select a company first.");
        return;
      }

      // Hide main card
      card.style.display = 'none';

      // Position and show card
      branchCard.style.display = "block";
      const left = (window.innerWidth - branchCard.offsetWidth) / 2;
      branchCard.style.left = Math.max(0, left) + "px";
      branchCard.style.top = "120px";

      document.getElementById("branch_company_id").value = activeCompany.id;
      document.getElementById("branch_company_name_val").value = activeCompany.company_name;

      fetchBranches(activeCompany.id);
    });

    function fetchBranches(companyId) {
      fetch(`actions/branch-action.php?action=view&company_id=${companyId}`)
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            branchRecords = response.data;
            if (branchRecords.length > 0) {
              branchIndex = 0;
              displayBranch(branchIndex);
            } else {
              branchIndex = -1;
              clearBranchForm();
              setBranchMode('add');
            }
          }
        })
        .catch(err => console.error("Error fetching branches: ", err));
    }

    function displayBranch(index) {
      if (index < 0 || index >= branchRecords.length) return;
      const record = branchRecords[index];

      document.getElementById("branch_db_id").value = record.id;
      document.getElementById("branch_code").value = record.branch_code || '';
      document.getElementById("branch_name").value = record.branch_name || '';
      document.getElementById("branch_address").value = record.address || '';
      document.getElementById("branch_place").value = record.place || '';
      document.getElementById("branch_city").value = record.city || '';
      document.getElementById("branch_district").value = record.district || '';
      document.getElementById("branch_state").value = record.state || '';
      document.getElementById("branch_salary_month_start_from").value = record.salary_month_start_from || '1';
      document.getElementById("branch_pt_state").value = record.pt_state || 'GUJARAT';
      document.getElementById("branch_pt_prc_no").value = record.pt_prc_no || '';
      document.getElementById("branch_pt_pec_no").value = record.pt_pec_no || '';

      document.getElementById("branchNavLabel").innerText = (index + 1) + " / " + branchRecords.length;

      const slider = document.getElementById("branchRangeSlider");
      slider.max = branchRecords.length - 1;
      slider.value = index;
      slider.disabled = branchRecords.length <= 1;

      setBranchMode('view');
    }

    function clearBranchForm() {
      branchForm.reset();
      document.getElementById("branch_db_id").value = "0";

      const activeCompany = companyRecords[currentIndex];
      if (activeCompany) {
        document.getElementById("branch_company_id").value = activeCompany.id;
        document.getElementById("branch_company_name_val").value = activeCompany.company_name;
      }
    }

    function setBranchMode(mode) {
      branchMode = mode;
      const isView = (mode === 'view');

      branchFormElements.forEach(el => {
        if (el.id !== 'branchRangeSlider' && el.id !== 'branch_company_name_val') {
          el.disabled = isView;
        }
      });

      document.getElementById("btnBranchAdd").disabled = !isView;
      document.getElementById("btnBranchEdit").disabled = !isView || branchRecords.length === 0;
      document.getElementById("btnBranchDelete").disabled = !isView || branchRecords.length === 0;
      document.getElementById("btnBranchSave").disabled = isView;
      document.getElementById("btnBranchCancel").disabled = false;
    }

    document.getElementById("btnBranchAdd").addEventListener('click', () => {
      clearBranchForm();
      setBranchMode('add');
    });

    document.getElementById("btnBranchEdit").addEventListener('click', () => {
      if (branchIndex >= 0) {
        setBranchMode('edit');
      }
    });

    document.getElementById("btnBranchCancel").addEventListener('click', () => {
      if (branchMode !== 'view' && branchRecords.length > 0) {
        displayBranch(branchIndex);
      } else {
        branchCard.style.display = 'none';
        card.style.display = 'block';
      }
    });

    document.getElementById("btnBranchExit").addEventListener('click', () => {
      branchCard.style.display = 'none';
      card.style.display = 'block';
    });

    document.getElementById("btnBranchDelete").addEventListener('click', () => {
      if (branchIndex >= 0) {
        const record = branchRecords[branchIndex];
        if (confirm("Are you sure you want to delete this branch?")) {
          fetch(`actions/branch-action.php?action=delete&id=${record.id}`)
            .then(res => res.json())
            .then(response => {
              alert(response.message);
              if (response.status === 'success') {
                fetchBranches(document.getElementById("branch_company_id").value);
              }
            })
            .catch(err => console.error("Error deleting branch: ", err));
        }
      }
    });

    document.getElementById("btnBranchSave").addEventListener('click', () => {
      if (!branchForm.checkValidity()) {
        branchForm.reportValidity();
        return;
      }
      const formData = new FormData(branchForm);
      fetch('actions/branch-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            fetchBranches(document.getElementById("branch_company_id").value);
            branchCard.style.display = 'none';
            card.style.display = 'block';
          }
        })
        .catch(err => console.error("Error saving branch: ", err));
    });

    document.getElementById("btnBranchPrev").addEventListener('click', () => {
      if (branchMode === 'view' && branchIndex > 0) {
        branchIndex--;
        displayBranch(branchIndex);
      }
    });

    document.getElementById("btnBranchNext").addEventListener('click', () => {
      if (branchMode === 'view' && branchIndex < branchRecords.length - 1) {
        branchIndex++;
        displayBranch(branchIndex);
      }
    });

    document.getElementById("branchRangeSlider").addEventListener('input', (e) => {
      if (branchMode === 'view') {
        branchIndex = parseInt(e.target.value);
        displayBranch(branchIndex);
      }
    });

    // Branch Search
    document.getElementById("btnBranchSearch").addEventListener('click', () => {
      document.getElementById("branchSearchPane").style.display = 'block';
      renderBranchSearchResults(branchRecords);
    });

    document.getElementById("btnHideBranchSearch").addEventListener('click', () => {
      document.getElementById("branchSearchPane").style.display = 'none';
    });

    document.getElementById("btnDoBranchSearch").addEventListener('click', () => {
      const criteria = document.getElementById("branchSearchCriteria").value.toLowerCase().trim();
      const filtered = branchRecords.filter(b =>
        (b.branch_code || '').toLowerCase().includes(criteria) ||
        (b.branch_name || '').toLowerCase().includes(criteria)
      );
      renderBranchSearchResults(filtered);
    });

    function renderBranchSearchResults(records) {
      const tbody = document.getElementById("branchSearchResultsBody");
      tbody.innerHTML = "";
      if (records.length === 0) {
        tbody.innerHTML = "<tr><td colspan='3' class='text-center text-muted'>No branches found</td></tr>";
        return;
      }
      records.forEach(b => {
        const tr = document.createElement("tr");
        tr.style.cursor = 'pointer';
        tr.innerHTML = `<td><strong>${b.branch_code || ''}</strong></td><td>${b.branch_name || ''}</td><td>${b.city || ''}</td>`;
        tr.addEventListener('click', () => {
          const idx = branchRecords.findIndex(r => r.id === b.id);
          if (idx >= 0) {
            branchIndex = idx;
            displayBranch(branchIndex);
            document.getElementById("branchSearchPane").style.display = 'none';
          }
        });
        tbody.appendChild(tr);
      });
    }


    // ==========================================
    // --- PRINCIPAL EMPLOYER JS CRUD LOGIC ---
    // ==========================================
    const employerCard = document.getElementById("employerCard");
    dragElement(employerCard);

    let employerRecords = [];
    let employerIndex = -1;
    let employerMode = 'view';

    const employerForm = document.getElementById("employerMasterForm");
    const employerFormElements = employerForm.querySelectorAll("input, textarea, select");

    document.getElementById("btnPrincipalEmployer").addEventListener('click', () => {
      const activeCompany = companyRecords[currentIndex];
      if (!activeCompany) {
        alert("Please select a company first.");
        return;
      }

      // Hide main card
      card.style.display = 'none';

      // Position and show card
      employerCard.style.display = "block";
      const left = (window.innerWidth - employerCard.offsetWidth) / 2;
      employerCard.style.left = Math.max(0, left) + "px";
      employerCard.style.top = "120px";

      document.getElementById("employer_company_id").value = activeCompany.id;
      document.getElementById("employer_company_name_val").value = activeCompany.company_name;

      fetchEmployers(activeCompany.id);
    });

    function fetchEmployers(companyId) {
      fetch(`actions/principal-employer-action.php?action=view&company_id=${companyId}`)
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            employerRecords = response.data;
            if (employerRecords.length > 0) {
              employerIndex = 0;
              displayEmployer(employerIndex);
            } else {
              employerIndex = -1;
              clearEmployerForm();
              setEmployerMode('add');
            }
          }
        })
        .catch(err => console.error("Error fetching employers: ", err));
    }

    function displayEmployer(index) {
      if (index < 0 || index >= employerRecords.length) return;
      const record = employerRecords[index];

      document.getElementById("employer_db_id").value = record.id;
      document.getElementById("employer_code").value = record.employer_code || '';
      document.getElementById("employer_name").value = record.employer_name || '';
      document.getElementById("employer_address").value = record.employer_address || '';
      document.getElementById("establishment_name").value = record.establishment_name || '';
      document.getElementById("establishment_address").value = record.establishment_address || '';
      document.getElementById("employer_nature_of_work").value = record.nature_of_work || '';
      document.getElementById("employer_location_of_work").value = record.location_of_work || '';
      document.getElementById("employer_labour_no").value = record.labour_no || '';
      document.getElementById("employer_pan_no").value = record.pan_no || '';
      document.getElementById("employer_mobile_no").value = record.mobile_no || '';
      document.getElementById("employer_email").value = record.email || '';

      document.getElementById("employerNavLabel").innerText = (index + 1) + " / " + employerRecords.length;

      const slider = document.getElementById("employerRangeSlider");
      slider.max = employerRecords.length - 1;
      slider.value = index;
      slider.disabled = employerRecords.length <= 1;

      setEmployerMode('view');
    }

    function clearEmployerForm() {
      employerForm.reset();
      document.getElementById("employer_db_id").value = "0";

      const activeCompany = companyRecords[currentIndex];
      if (activeCompany) {
        document.getElementById("employer_company_id").value = activeCompany.id;
        document.getElementById("employer_company_name_val").value = activeCompany.company_name;
      }
    }

    function setEmployerMode(mode) {
      employerMode = mode;
      const isView = (mode === 'view');

      employerFormElements.forEach(el => {
        if (el.id !== 'employerRangeSlider' && el.id !== 'employer_company_name_val') {
          el.disabled = isView;
        }
      });

      document.getElementById("btnEmployerAdd").disabled = !isView;
      document.getElementById("btnEmployerEdit").disabled = !isView || employerRecords.length === 0;
      document.getElementById("btnEmployerDelete").disabled = !isView || employerRecords.length === 0;
      document.getElementById("btnEmployerSave").disabled = isView;
      document.getElementById("btnEmployerCancel").disabled = false;
    }

    document.getElementById("btnEmployerAdd").addEventListener('click', () => {
      clearEmployerForm();
      setEmployerMode('add');
    });

    document.getElementById("btnEmployerEdit").addEventListener('click', () => {
      if (employerIndex >= 0) {
        setEmployerMode('edit');
      }
    });

    document.getElementById("btnEmployerCancel").addEventListener('click', () => {
      if (employerMode !== 'view' && employerRecords.length > 0) {
        displayEmployer(employerIndex);
      } else {
        employerCard.style.display = 'none';
        card.style.display = 'block';
      }
    });

    document.getElementById("btnEmployerExit").addEventListener('click', () => {
      employerCard.style.display = 'none';
      card.style.display = 'block';
    });

    document.getElementById("btnEmployerDelete").addEventListener('click', () => {
      if (employerIndex >= 0) {
        const record = employerRecords[employerIndex];
        if (confirm("Are you sure you want to delete this employer?")) {
          fetch(`actions/principal-employer-action.php?action=delete&id=${record.id}`)
            .then(res => res.json())
            .then(response => {
              alert(response.message);
              if (response.status === 'success') {
                fetchEmployers(document.getElementById("employer_company_id").value);
              }
            })
            .catch(err => console.error("Error deleting employer: ", err));
        }
      }
    });

    document.getElementById("btnEmployerSave").addEventListener('click', () => {
      if (!employerForm.checkValidity()) {
        employerForm.reportValidity();
        return;
      }
      const formData = new FormData(employerForm);
      fetch('actions/principal-employer-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            fetchEmployers(document.getElementById("employer_company_id").value);
            employerCard.style.display = 'none';
            card.style.display = 'block';
          }
        })
        .catch(err => console.error("Error saving employer: ", err));
    });

    document.getElementById("btnEmployerPrev").addEventListener('click', () => {
      if (employerMode === 'view' && employerIndex > 0) {
        employerIndex--;
        displayEmployer(employerIndex);
      }
    });

    document.getElementById("btnEmployerNext").addEventListener('click', () => {
      if (employerMode === 'view' && employerIndex < employerRecords.length - 1) {
        employerIndex++;
        displayEmployer(employerIndex);
      }
    });

    document.getElementById("employerRangeSlider").addEventListener('input', (e) => {
      if (employerMode === 'view') {
        employerIndex = parseInt(e.target.value);
        displayEmployer(employerIndex);
      }
    });

    // Employer Search
    document.getElementById("btnEmployerSearch").addEventListener('click', () => {
      document.getElementById("employerSearchPane").style.display = 'block';
      renderEmployerSearchResults(employerRecords);
    });

    document.getElementById("btnHideEmployerSearch").addEventListener('click', () => {
      document.getElementById("employerSearchPane").style.display = 'none';
    });

    document.getElementById("btnDoEmployerSearch").addEventListener('click', () => {
      const criteria = document.getElementById("employerSearchCriteria").value.toLowerCase().trim();
      const filtered = employerRecords.filter(e =>
        (e.employer_code || '').toLowerCase().includes(criteria) ||
        (e.employer_name || '').toLowerCase().includes(criteria)
      );
      renderEmployerSearchResults(filtered);
    });

    function renderEmployerSearchResults(records) {
      const tbody = document.getElementById("employerSearchResultsBody");
      tbody.innerHTML = "";
      if (records.length === 0) {
        tbody.innerHTML = "<tr><td colspan='3' class='text-center text-muted'>No employers found</td></tr>";
        return;
      }
      records.forEach(e => {
        const tr = document.createElement("tr");
        tr.style.cursor = 'pointer';
        tr.innerHTML = `<td><strong>${e.employer_code || ''}</strong></td><td>${e.employer_name || ''}</td><td>${e.mobile_no || ''}</td>`;
        tr.addEventListener('click', () => {
          const idx = employerRecords.findIndex(r => r.id === e.id);
          if (idx >= 0) {
            employerIndex = idx;
            displayEmployer(employerIndex);
            document.getElementById("employerSearchPane").style.display = 'none';
          }
        });
        tbody.appendChild(tr);
      });
    }

  });

  function dragElement(elmnt) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    const header = elmnt.querySelector('.card-header');

    if (header) {
      header.style.cursor = "move";
      header.onmousedown = dragMouseDown;
    } else {
      elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
      e = e || window.event;

      // Stop dragging if clicking on form inputs, buttons, badges or active tabs
      if (
        e.target.tagName === 'BUTTON' ||
        e.target.tagName === 'A' ||
        e.target.tagName === 'INPUT' ||
        e.target.tagName === 'TEXTAREA' ||
        e.target.tagName === 'SELECT' ||
        e.target.classList.contains('badge')
      ) {
        return;
      }

      e.preventDefault();
      // Get mouse cursor position at start
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
      e = e || window.event;
      e.preventDefault();
      // Calculate new cursor position
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;

      // Apply new positions
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
      // Release event listeners
      document.onmouseup = null;
      document.onmousemove = null;
    }
  }
</script>

<!-- Search Options Dialog Modal -->
<!-- Search Options Dialog Card -->
<div id="searchCard" class="card shadow-lg border-1"
  style="max-width: 800px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; z-index: 30; display: none;">
  <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
    style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
    <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
      <i class="ti ti-search me-2" style="font-size: 16px;"></i>Search Options
    </h6>
    <button type="button" class="btn-close btn-close-white" id="btnExitSearch" style="font-size: 10px;"></button>
  </div>
  <div class="card-body p-3 bg-white">
    <!-- Inner box container -->
    <fieldset class="border p-3 rounded mb-2 bg-white" style="border-color: #a3b8cc !important;">
      <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 11px; margin-bottom: 0;">AutoPay
        - Search Option Dialog</legend>

      <div class="row g-2 mt-1">
        <!-- Search Condition radio buttons -->
        <div class="col-md-4 border-end border-light-blue pe-2">
          <span class="d-block fw-bold text-dark-blue mb-2" style="font-size: 11px;">Search Condition</span>
          <div class="form-check mb-1">
            <input class="form-check-input" type="radio" name="searchCond" id="condSingle" value="single" checked>
            <label class="form-check-label fw-semibold text-dark" for="condSingle" style="font-size: 11px;">Single
              Condition</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="searchCond" id="condMultiple" value="multiple">
            <label class="form-check-label fw-semibold text-dark" for="condMultiple" style="font-size: 11px;">Multiple
              Condition</label>
          </div>
        </div>

        <!-- Search Criteria -->
        <div class="col-md-8 ps-2">
          <span class="d-block fw-bold text-dark-blue mb-2" style="font-size: 11px;">Search Criteria 1</span>

          <div class="row g-2 align-items-center mb-1">
            <label class="col-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
              style="font-size: 11px;">Field By</label>
            <div class="col-9">
              <select class="form-select form-select-sm" id="searchField"
                style="font-size: 11px; border: 1px solid #135ca3 !important;">
                <option value="company_code">Company Code</option>
                <option value="company_name" selected>Company Name</option>
                <option value="owner_name">Owner Name</option>
                <option value="pan_no">PAN No.</option>
                <option value="pf_code">PF No.</option>
                <option value="esic_code">ESIC No.</option>
              </select>
            </div>
          </div>

          <div class="row g-2 align-items-center mb-1">
            <label class="col-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
              style="font-size: 11px;">With</label>
            <div class="col-9">
              <select class="form-select form-select-sm" id="searchOperator"
                style="font-size: 11px; border: 1px solid #135ca3 !important;">
                <option value="contains" selected>Contains</option>
                <option value="equals">Equals</option>
                <option value="starts">Starts With</option>
              </select>
            </div>
          </div>

          <div class="row g-2 align-items-center mb-1">
            <label class="col-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
              style="font-size: 11px;">Criteria</label>
            <div class="col-9">
              <input type="text" class="form-control form-control-sm" id="searchCriteria"
                placeholder="Enter search text..." style="font-size: 11px; border: 1px solid #135ca3 !important;">
            </div>
          </div>
        </div>
      </div>

      <!-- Dialog buttons -->
      <div class="d-flex justify-content-center gap-2 mt-3 border-top pt-2">
        <button type="button" id="btnDoSearch" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; border-color: #a3b8cc !important; height: 26px;"><i
            class="ti ti-search me-1 text-info"></i>Search</button>
        <button type="button" id="btnRefreshSearch" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; border-color: #a3b8cc !important; height: 26px;"><i
            class="ti ti-refresh me-1 text-warning"></i>Refresh</button>
        <button type="button" id="btnShowAllSearch" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; border-color: #a3b8cc !important; height: 26px;"><i
            class="ti ti-list me-1 text-primary"></i>Show All</button>
        <button type="button" id="btnCancelSearch" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; border-color: #a3b8cc !important; height: 26px;"><i
            class="ti ti-logout me-1 text-danger"></i>Exit</button>
      </div>
    </fieldset>

    <!-- Results Grid Box -->
    <fieldset class="border p-2 rounded bg-white" style="border-color: #a3b8cc !important;">
      <legend class="float-none w-auto px-2 fw-bold text-primary" id="searchResultsLegend"
        style="font-size: 11px; margin-bottom: 0;">Search Result (0) Record(s) Found</legend>

      <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
        <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
          <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
            <tr>
              <th style="width: 80px;">Code</th>
              <th>Company Name</th>
              <th>Owner Name</th>
              <th>Contact No.</th>
            </tr>
          </thead>
          <tbody id="searchResultsBody">
            <tr>
              <td colspan="4" class="text-center text-muted py-2">No records found. Click Search or Show All.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </fieldset>
  </div>
</div>
<!-- Company Selection Modal -->
<div class="modal fade" id="companySelectModal" tabindex="-1" data-bs-backdrop="static"
  aria-labelledby="companySelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content border shadow-lg"
      style="border-radius: 6px !important; border-color: #a3b8cc !important;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom: 1px solid #104f9b;">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="companySelectModalLabel"
          style="font-size: 13px; margin: 0;">
          <i class="ti ti-building me-2" style="font-size: 15px;"></i>Select Company
        </h6>
      </div>
      <div class="modal-body p-3" style="background-color: #e8f0fe !important;">
        <div class="table-responsive bg-white rounded p-2 border"
          style="max-height: 300px; overflow-y: auto; border-color: #a3b8cc !important;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light">
              <tr>
                <th style="width: 80px;">Code</th>
                <th>Company Name</th>
              </tr>
            </thead>
            <tbody id="companySelectBody">
              <!-- Dynamically populated -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>