<?php
$pageTitle = "Employee Master - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1200px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-user me-2" style="font-size: 16px;"></i>EMPLOYEE MASTER INFORMATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [F5] For List, [Esc]
        For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="employeeMasterForm">

        <!-- Header row of general employee info -->
        <div class="row g-2 mb-2 align-items-center bg-legacy-blue p-2 rounded border"
          style="border-color: #a3b8cc !important;">
          <div class="col-md-3 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Emp.
              Code</label>
            <input type="text" class="form-control form-control-sm" name="emp_code" id="emp_code" value="10029"
              style="font-size: 11px;" />
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Emp.
              Name</label>
            <input type="text" class="form-control form-control-sm" name="emp_name" id="emp_name"
              value="ASHA TANKA VISHWAKARMA" style="font-size: 11px;" />
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 80px;">Father
              Name</label>
            <input type="text" class="form-control form-control-sm" name="father_name" id="father_name"
              value="TANKA VISHWAKARMA" style="font-size: 11px;" />
          </div>
          <div class="col-md-1">
            <input type="text" class="form-control form-control-sm bg-light" value="57255" readonly
              style="font-size: 11px;" />
          </div>
        </div>

        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Employee Details</legend>

          <!-- Nav Tabs styled classically -->
          <ul class="nav nav-tabs mb-0 border-bottom-0" id="empTabs" role="tablist"
            style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold py-1 px-3" id="emp-info-tab" data-bs-toggle="tab"
                data-bs-target="#emp-info-content" type="button" role="tab" aria-controls="emp-info-content"
                aria-selected="true" style="font-size: 11px;">1. Employee Information</button>
            </li>
          </ul>

          <!-- Tab Content Container with light blue background and border -->
          <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="empTabsContent">
            <div class="tab-pane fade show active" id="emp-info-content" role="tabpanel" aria-labelledby="emp-info-tab">

              <!-- Upper Blocks Row (Permanent, Classification, Join/Dates, Uploads) -->
              <div class="row g-2">

                <!-- Block 1: Permanent Details -->
                <div class="col-xl-3 col-lg-6 col-md-12 pe-md-2 border-end border-light-blue">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-2 text-primary"
                      style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Permanent
                      Details</span>

                    <div class="mb-1">
                      <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                        style="font-size: 10px;">Address</label>
                      <input type="text" class="form-control form-control-sm mb-1" style="font-size: 11px;" />
                      <input type="text" class="form-control form-control-sm mb-1" style="font-size: 11px;" />
                      <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                    </div>

                    <div class="row g-1 mb-1">
                      <div class="col-7">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">City</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                      <div class="col-5">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Pin Code</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1">
                      <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                        style="font-size: 10px;">Mobile</label>
                      <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                    </div>

                    <div class="row g-1 mb-1">
                      <div class="col-6">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Emer. Per.</label>
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                      <div class="col-6">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Contact</label>
                        <input type="text" class="form-control form-control-sm" value="9925629704"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1">
                      <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                        style="font-size: 10px;">E-Mail Id.</label>
                      <input type="email" class="form-control form-control-sm" style="font-size: 11px;" />
                    </div>
                  </div>
                </div>

                <!-- Block 2: Classification Details -->
                <div class="col-xl-3 col-lg-6 col-md-12 pe-md-2 border-end border-light-blue">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-2 text-primary"
                      style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Classification
                      Details</span>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Branch</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option selected>RAJKOT</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Department</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Sub Dept.</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Designation</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option selected>CARE TAKER</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Marital Stat.</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option selected>MARRIED</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Gender</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option selected>FEMALE</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Blood Group</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Category</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Punch Machine Code</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Block 3: Dates & Settings -->
                <div class="col-xl-3 col-lg-6 col-md-12 pe-md-2 border-end border-light-blue">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-2 text-primary"
                      style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Dates &
                      Flags</span>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Joining Date</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" value="01/04/2026"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Birth Date</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" value="20/07/1986"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkPension" checked>
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPension"
                            style="font-size: 10px;">Pension</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkPFAux" checked>
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPFAux"
                            style="font-size: 10px;">PF Applicable</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkESICAux">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkESICAux"
                            style="font-size: 10px;">ESIC Applicable</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkPTAux">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPTAux"
                            style="font-size: 10px;">PT Applicable</label>
                        </div>
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Ceiling Amt.</label>
                      <div class="col-sm-7">
                        <input type="number" class="form-control form-control-sm" value="0" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">PF Start Dt.</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" value="01/04/2026"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkOT" checked>
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkOT"
                            style="font-size: 10px;">OT Calc.</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chkABRY">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkABRY"
                            style="font-size: 10px;">ABRY Scheme</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Block 4: Photos / Signature Uploads -->
                <div class="col-xl-3 col-lg-6 col-md-12">
                  <div class="card p-2 bg-white border h-100 justify-content-center"
                    style="border-color: #c4d6ec !important; gap: 8px;">
                    <!-- Photo preview box -->
                    <div class="text-center p-2 rounded border"
                      style="border-style: dashed !important; border-color: #135ca3 !important; background-color: #f8fafc;">
                      <div class="text-danger fw-bold mb-2" style="font-size: 11px;">Image Not Available</div>
                      <div class="d-flex justify-content-center gap-1">
                        <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2"
                          style="font-size: 10px; height: 22px;">Browse</button>
                        <button type="button" class="btn btn-xs btn-primary py-0 px-2"
                          style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Import
                          Image</button>
                      </div>
                      <button type="button" class="btn btn-xs btn-secondary mt-1 w-100 py-0"
                        style="font-size: 10px; height: 22px;">Export Image</button>
                    </div>

                    <!-- Signature preview box -->
                    <div class="text-center p-2 rounded border"
                      style="border-style: dashed !important; border-color: #135ca3 !important; background-color: #f8fafc;">
                      <span class="col-form-label-sm fw-bold d-block mb-1 text-dark-blue"
                        style="font-size: 11px;">Signature</span>
                      <div class="d-flex justify-content-center gap-1">
                        <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2"
                          style="font-size: 10px; height: 22px;">Browse</button>
                        <button type="button" class="btn btn-xs btn-primary py-0 px-2"
                          style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Upload</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Lower Row (Bank Details, Document Details, Resign flag) -->
              <div class="row g-2 mt-2">

                <!-- Bank Details -->
                <div class="col-md-5">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-2 text-primary"
                      style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Bank
                      Details</span>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Salary Mode</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" style="font-size: 11px;">
                          <option selected>BANK</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Bank</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" value="KOTAK BANK"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Branch Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Bank Account No.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" value="3646577394"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">ISFC Code</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" value="KKBK0002708"
                          style="font-size: 11px;" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Document Details -->
                <div class="col-md-5">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-2 text-primary"
                      style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Document
                      Details</span>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Aadhar</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Pan No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">P.F. No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" value="10029"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">UAN No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" value="102325481263"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">ESIC No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" style="font-size: 11px;" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Resign checkbox -->
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chkResign">
                    <label class="form-check-label fw-bold text-danger" style="font-size: 12px;"
                      for="chkResign">Resign</label>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- Bottom Action Toolbar / Footer Buttons -->
    <div class="card-footer bg-light border-top p-2 px-3">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <!-- Left Side: Buttons + Slider Navigation -->
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

        <!-- Middle: Record Navigation Slider -->
        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
          <span id="navLabel" class="px-2 fw-bold border-end me-2"
            style="min-width: 50px; text-align: center; white-space: nowrap;">29 / 29</span>
          <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="28" value="28"
            style="height: 4px; flex-grow: 1; min-width: 120px;" />
          <button type="button" id="btnNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
        </div>

        <!-- Right Side: Info buttons -->
        <div class="d-flex gap-2">
          <button type="button" id="btnPayrollInfo" class="btn btn-sm btn-info text-white px-2 py-1"
            style="font-size: 11px; height: 26px; background-color: #02a9f4; border-color: #02a9f4;">
            Payroll Info.
          </button>
          <button type="button" id="btnHourRateInfo" class="btn btn-sm btn-primary text-white px-2 py-1"
            style="font-size: 11px; height: 26px; background-color: #135ca3; border-color: #135ca3;">
            Hour Rate Info.
          </button>
          <button type="button" id="btnNomineeInfo" class="btn btn-sm btn-warning text-white px-2 py-1"
            style="font-size: 11px; height: 26px; background-color: #ff9800; border-color: #ff9800;">
            Nominee Info.
          </button>
        </div>
      </div>
    </div>
  </div>

</div>
<!--/ Content -->

<style>
  /* Light blue background for the tab content window */
  .bg-legacy-blue {
    background-color: #e8f0fe !important;
    border-color: #a3b8cc !important;
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
  #empTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #empTabs .nav-item .nav-link {
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

  #empTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #empTabs .nav-item .nav-link.active {
    background-color: #e8f0fe !important;
    border-color: #a3b8cc !important;
    border-bottom-color: #e8f0fe !important;
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
    card.style.top = "60px";
    card.style.opacity = "1";

    dragElement(card);

    // Esc key press redirects to index
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'index';
      }
    });

    // Exit button click redirects to index
    const btnExit = document.getElementById("btnExit");
    if (btnExit) {
      btnExit.addEventListener('click', () => {
        window.location.href = 'index';
      });
    }

    // Payroll Info button click redirects to employee-payroll-details
    const btnPayrollInfo = document.getElementById("btnPayrollInfo");
    if (btnPayrollInfo) {
      btnPayrollInfo.addEventListener('click', () => {
        window.location.href = 'employee-payroll-details.php';
      });
    }

    // Hour Rate Info button click redirects to employee-hour-rate-details
    const btnHourRateInfo = document.getElementById("btnHourRateInfo");
    if (btnHourRateInfo) {
      btnHourRateInfo.addEventListener('click', () => {
        window.location.href = 'employee-hour-rate-details.php';
      });
    }

    // Nominee Info button click redirects to employee-nominee-details
    const btnNomineeInfo = document.getElementById("btnNomineeInfo");
    if (btnNomineeInfo) {
      btnNomineeInfo.addEventListener('click', () => {
        window.location.href = 'employee-nominee-details.php';
      });
    }
  });

  // Simple Draggable Functionality
  function dragElement(elmnt) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    const header = elmnt.querySelector('.card-header');
    if (header) {
      header.onmousedown = dragMouseDown;
    } else {
      elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
      e = e || window.event;
      if (['INPUT', 'BUTTON', 'A', 'SPAN', 'SELECT'].includes(e.target.tagName)) return;
      e.preventDefault();
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
      e = e || window.event;
      e.preventDefault();
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
      document.onmouseup = null;
      document.onmousemove = null;
    }
  }
</script>

<?php
include 'footer.php';
?>