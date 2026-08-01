<?php
$pageTitle = "Employee Master - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1200px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

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
        <input type="hidden" name="id" id="emp_db_id" value="0">
        <input type="hidden" name="photo_path" id="photo_path" value="">
        <input type="hidden" name="signature_path" id="signature_path" value="">
        <input type="hidden" name="status" id="emp_status" value="active">

        <!-- Header row of general employee info -->
        <div class="row g-2 mb-2 align-items-center bg-legacy-blue p-2 rounded border"
          style="border-color: #a3b8cc !important;">
          <div class="col-md-3 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Emp.
              Code</label>
            <input type="text" class="form-control form-control-sm" name="emp_code" id="emp_code" value=""
              style="font-size: 11px;" required />
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Emp.
              Name</label>
            <input type="text" class="form-control form-control-sm" name="emp_name" id="emp_name" value=""
              style="font-size: 11px;" required />
          </div>
          <div class="col-md-5 d-flex align-items-center">
            <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 80px;">Father
              Name</label>
            <input type="text" class="form-control form-control-sm" name="father_name" id="father_name" value=""
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
                      <input type="text" class="form-control form-control-sm mb-1" name="address_1" id="address_1"
                        style="font-size: 11px;" />
                      <input type="text" class="form-control form-control-sm mb-1" name="address_2" id="address_2"
                        style="font-size: 11px;" />
                      <input type="text" class="form-control form-control-sm" name="address_3" id="address_3"
                        style="font-size: 11px;" />
                    </div>

                    <div class="row g-1 mb-1">
                      <div class="col-7">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">City</label>
                        <input type="text" class="form-control form-control-sm" name="city" id="city"
                          style="font-size: 11px;" />
                      </div>
                      <div class="col-5">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Pin Code</label>
                        <input type="text" class="form-control form-control-sm" name="pincode" id="pincode"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1">
                      <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                        style="font-size: 10px;">Mobile</label>
                      <input type="text" class="form-control form-control-sm" name="mobile" id="mobile"
                        style="font-size: 11px;" />
                    </div>

                    <div class="row g-1 mb-1">
                      <div class="col-6">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Emer. Per.</label>
                        <input type="text" class="form-control form-control-sm" name="emergency_person"
                          id="emergency_person" style="font-size: 11px;" />
                      </div>
                      <div class="col-6">
                        <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                          style="font-size: 10px;">Contact</label>
                        <input type="text" class="form-control form-control-sm" name="emergency_contact"
                          id="emergency_contact" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1">
                      <label class="col-form-label col-form-label-sm fw-semibold text-dark-blue p-0"
                        style="font-size: 10px;">E-Mail Id.</label>
                      <input type="email" class="form-control form-control-sm" name="email" id="email"
                        style="font-size: 11px;" />
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
                        <select class="form-select form-select-sm" name="branch_id" id="branch_id"
                          style="font-size: 11px;" required>
                          <option value="">-- Select Branch --</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Department</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" name="dept_id" id="dept_id" style="font-size: 11px;">
                          <option value="0">-- Select Dept --</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Sub Dept.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="sub_dept" id="sub_dept"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Designation</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" name="desig_id" id="desig_id"
                          style="font-size: 11px;">
                          <option value="0">-- Select Designation --</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Marital Stat.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="marital_status"
                          id="marital_status" style="font-size: 11px;" required />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Gender</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="gender" id="gender"
                          style="font-size: 11px;" required />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Blood Group</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="blood_group" id="blood_group"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Category</label>
                      <div class="col-sm-8">
                        <select class="form-select form-select-sm" name="category" id="category"
                          style="font-size: 11px;">
                          <option value="">-- Select --</option>
                          <option value="UN SKILLED">UN SKILLED</option>
                          <option value="SEMI SKILLED">SEMI SKILLED</option>
                          <option value="SKILLED">SKILLED</option>
                          <option value="HIGHLY SKILLED">HIGHLY SKILLED</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Punch Machine Code</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="punch_code" id="punch_code"
                          style="font-size: 11px;" />
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
                        <input type="text" class="form-control form-control-sm" name="joining_date" id="joining_date"
                          placeholder="DD/MM/YYYY" style="font-size: 11px;" required />
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Birth Date</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" name="birth_date" id="birth_date"
                          placeholder="DD/MM/YYYY" style="font-size: 11px;" required />
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="pension" id="chkPension" value="1">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPension"
                            style="font-size: 10px;">Pension</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="pf_applicable" id="chkPFAux" value="1">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPFAux"
                            style="font-size: 10px;">PF Applicable</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="esic_applicable" id="chkESICAux"
                            value="1">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkESICAux"
                            style="font-size: 10px;">ESIC Applicable</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="pt_applicable" id="chkPTAux" value="1">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkPTAux"
                            style="font-size: 10px;">PT Applicable</label>
                        </div>
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Ceiling Amt.</label>
                      <div class="col-sm-7">
                        <input type="number" class="form-control form-control-sm" name="ceiling_amount"
                          id="ceiling_amount" value="0" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-2 row align-items-center">
                      <label class="col-sm-5 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">PF Start Dt.</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" name="pf_start_date" id="pf_start_date"
                          placeholder="DD/MM/YYYY" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="ot_applicable" id="chkOT" value="1">
                          <label class="form-check-label col-form-label-sm fw-semibold text-dark-blue" for="chkOT"
                            style="font-size: 10px;">OT Calc.</label>
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
                      <div id="photoPreviewContainer" class="text-danger fw-bold mb-2" style="font-size: 11px;">Image
                        Not Available</div>
                      <div class="d-flex justify-content-center gap-1">
                        <input type="file" id="photoFile" style="display: none;" accept="image/*">
                        <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2" id="btnBrowsePhoto"
                          style="font-size: 10px; height: 22px;">Browse</button>
                        <button type="button" class="btn btn-xs btn-primary py-0 px-2" id="btnUploadPhoto"
                          style="font-size: 10px; height: 22px; background-color: #135ca3; border-color: #135ca3;">Import
                          Image</button>
                      </div>
                    </div>

                    <!-- Signature preview box -->
                    <div class="text-center p-2 rounded border"
                      style="border-style: dashed !important; border-color: #135ca3 !important; background-color: #f8fafc;">
                      <span class="col-form-label-sm fw-bold d-block mb-1 text-dark-blue"
                        style="font-size: 11px;">Signature</span>
                      <div id="sigPreviewContainer" class="text-muted mb-2" style="font-size: 10px;">No Signature</div>
                      <div class="d-flex justify-content-center gap-1">
                        <input type="file" id="sigFile" style="display: none;" accept="image/*">
                        <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2" id="btnBrowseSig"
                          style="font-size: 10px; height: 22px;">Browse</button>
                        <button type="button" class="btn btn-xs btn-primary py-0 px-2" id="btnUploadSig"
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
                        <select class="form-select form-select-sm" name="salary_mode" id="salary_mode"
                          style="font-size: 11px;">
                          <option value="BANK" selected>BANK</option>
                          <option value="CASH">CASH</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Bank</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm bank-fields" name="bank_name"
                          id="bank_name" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Branch Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm bank-fields" name="branch_name"
                          id="branch_name_input" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Bank Account No.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm bank-fields" name="bank_account_no"
                          id="bank_account_no" style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-4 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">IFSC Code</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm bank-fields" name="ifsc_code"
                          id="ifsc_code" style="font-size: 11px;" />
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
                        <input type="text" class="form-control form-control-sm" name="aadhar_no" id="aadhar_no"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">Pan No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="pan_no" id="pan_no"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">P.F. No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="pf_no" id="pf_no"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">UAN No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="uan_no" id="uan_no"
                          style="font-size: 11px;" />
                      </div>
                    </div>

                    <div class="mb-1 row align-items-center">
                      <label class="col-sm-3 col-form-label col-form-label-sm fw-semibold text-dark-blue"
                        style="font-size: 10px;">ESIC No.</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="esic_no" id="esic_no"
                          style="font-size: 11px;" />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Resign checkbox & date -->
                <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="resign" id="chkResign" value="1">
                    <label class="form-check-label fw-bold text-danger" style="font-size: 12px;"
                      for="chkResign">Resign</label>
                  </div>
                  <div id="resignDateWrapper" class="mt-2 w-100" style="display: none;">
                    <label class="col-form-label col-form-label-sm fw-semibold text-danger p-0"
                      style="font-size: 10px;">Resign Date</label>
                    <input type="text" class="form-control form-control-sm mb-1" name="resign_date" id="resign_date"
                      placeholder="DD/MM/YYYY" style="font-size: 11px;" />
                    <label class="col-form-label col-form-label-sm fw-semibold text-danger p-0"
                      style="font-size: 10px;">Reason / Remark</label>
                    <textarea class="form-control form-control-sm" name="resign_remark" id="resign_remark" rows="2"
                      style="font-size: 11px; resize: none;"></textarea>
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
            style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
          <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="0" value="0"
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

  /* Override global card z-index during modal overlays */
  .modal-backdrop {
    z-index: 1150 !important;
  }

  .modal {
    z-index: 1200 !important;
  }
</style>

<!-- Employee Search modal -->
<div class="modal fade" id="empSelectModal" tabindex="-1" data-bs-backdrop="static"
  aria-labelledby="empSelectModalLabel" aria-hidden="true" style="z-index: 1200 !important;">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border shadow-lg"
      style="border-radius: 6px !important; border-color: #a3b8cc !important;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom: 1px solid #104f9b;">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="empSelectModalLabel"
          style="font-size: 13px; margin: 0;">
          <i class="ti ti-users me-2" style="font-size: 15px;"></i>Select Employee
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
          style="font-size: 10px;"></button>
      </div>
      <div class="modal-body p-3" style="background-color: #e8f0fe !important;">
        <div class="table-responsive bg-white rounded p-2 border"
          style="max-height: 350px; overflow-y: auto; border-color: #a3b8cc !important;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light text-primary fw-bold">
              <tr>
                <th style="width: 80px;">Code</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Department</th>
              </tr>
            </thead>
            <tbody id="empSelectBody">
              <!-- Dynamically populated -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById("draggableCard");
    const form = document.getElementById("employeeMasterForm");
    const formElements = form.querySelectorAll('input, select, textarea, button:not(#btnBrowsePhoto):not(#btnUploadPhoto):not(#btnBrowseSig):not(#btnUploadSig)');

    let employeesList = [];
    let currentIndex = -1;
    let currentMode = 'view'; // view, add, edit

    // Center card initially on load
    const initialLeft = (window.innerWidth - card.offsetWidth) / 2;
    card.style.left = Math.max(0, initialLeft) + "px";
    card.style.top = "60px";
    card.style.opacity = "1";

    dragElement(card);

    // ESC key press redirects to index
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'index';
      }
    });

    // Exit button redirects to index
    const btnExit = document.getElementById("btnExit");
    if (btnExit) {
      btnExit.addEventListener('click', () => {
        window.location.href = 'index';
      });
    }

    // Auto format date inputs as DD/MM/YYYY
    const dateInputs = ['joining_date', 'birth_date', 'pf_start_date', 'resign_date'];
    dateInputs.forEach(id => {
      const input = document.getElementById(id);
      if (input) {
        input.addEventListener('input', function (e) {
          let value = e.target.value.replace(/\D/g, '');
          if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2);
          }
          if (value.length > 5) {
            value = value.slice(0, 5) + '/' + value.slice(5, 9);
          }
          e.target.value = value;
        });
      }
    });

    // Toggle Resign date field
    const chkResign = document.getElementById("chkResign");
    const resignDateWrapper = document.getElementById("resignDateWrapper");
    chkResign.addEventListener('change', function () {
      if (this.checked) {
        resignDateWrapper.style.display = "block";
      } else {
        resignDateWrapper.style.display = "none";
        document.getElementById("resign_date").value = "";
        document.getElementById("resign_remark").value = "";
      }
      updateRequiredFields();
    });

    // Dynamic field validation on checkbox select
    function updateRequiredFields() {
      const pfNo = document.getElementById("pf_no");
      const uanNo = document.getElementById("uan_no");
      const esicNo = document.getElementById("esic_no");
      const resignDate = document.getElementById("resign_date");

      const pfApplicable = document.getElementById("chkPFAux").checked;
      const esicApplicable = document.getElementById("chkESICAux").checked;
      const resignChecked = document.getElementById("chkResign").checked;

      // PF Fields
      if (pfApplicable) {
        pfNo.required = true;
        uanNo.required = true;
        pfNo.placeholder = "PF Number (Required)";
        uanNo.placeholder = "UAN Number (Required)";
      } else {
        pfNo.required = false;
        uanNo.required = false;
        pfNo.placeholder = "";
        uanNo.placeholder = "";
      }

      // ESIC Field
      if (esicApplicable) {
        esicNo.required = true;
        esicNo.placeholder = "ESIC Number (Required)";
      } else {
        esicNo.required = false;
        esicNo.placeholder = "";
      }

      // Resign Date Field
      if (resignChecked) {
        resignDate.required = true;
      } else {
        resignDate.required = false;
      }
    }

    document.getElementById("chkPFAux").addEventListener('change', updateRequiredFields);
    document.getElementById("chkESICAux").addEventListener('change', updateRequiredFields);

    // Toggle Salary Mode - CASH disables bank inputs
    const salaryModeSelect = document.getElementById("salary_mode");
    const bankFields = document.querySelectorAll(".bank-fields");
    salaryModeSelect.addEventListener('change', function () {
      if (this.value === 'CASH') {
        bankFields.forEach(field => {
          field.value = "";
          field.disabled = true;
        });
      } else {
        if (currentMode !== 'view') {
          bankFields.forEach(field => field.disabled = false);
        }
      }
    });

    // Sub-master Info buttons listeners
    document.getElementById("btnPayrollInfo").addEventListener('click', () => {
      const code = document.getElementById("emp_code").value;
      if (code) {
        window.location.href = `employee-payroll-details.php?emp_code=${code}`;
      } else {
        window.location.href = 'employee-payroll-details.php';
      }
    });

    document.getElementById("btnHourRateInfo").addEventListener('click', () => {
      const code = document.getElementById("emp_code").value;
      if (code) {
        window.location.href = `employee-hour-rate-details.php?emp_code=${code}`;
      } else {
        window.location.href = 'employee-hour-rate-details.php';
      }
    });

    document.getElementById("btnNomineeInfo").addEventListener('click', () => {
      const code = document.getElementById("emp_code").value;
      if (code) {
        window.location.href = `employee-nominee-details.php?emp_code=${code}`;
      } else {
        window.location.href = 'employee-nominee-details.php';
      }
    });

    // File inputs triggers
    const btnBrowsePhoto = document.getElementById("btnBrowsePhoto");
    const photoFile = document.getElementById("photoFile");
    btnBrowsePhoto.addEventListener('click', () => photoFile.click());

    photoFile.addEventListener('change', function () {
      const container = document.getElementById("photoPreviewContainer");
      if (this.files && this.files[0]) {
        container.innerHTML = `<span class="text-success">${this.files[0].name} (Selected)</span>`;
      }
    });

    const btnUploadPhoto = document.getElementById("btnUploadPhoto");
    btnUploadPhoto.addEventListener('click', () => {
      if (!photoFile.files || !photoFile.files[0]) {
        alert("Please browse an image file first.");
        return;
      }
      const formData = new FormData();
      formData.append('file', photoFile.files[0]);
      formData.append('old_file', document.getElementById("photo_path").value);

      fetch('actions/employee-master-action.php?action=upload&type=photo', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            document.getElementById("photo_path").value = data.filename;
            document.getElementById("photoPreviewContainer").innerHTML = `<img src="../uploads/photos/${data.filename}" style="max-height:80px; max-width:100%; border-radius:4px;"/>`;
            alert("Photo uploaded successfully.");
          } else {
            alert(data.message);
          }
        });
    });

    const btnBrowseSig = document.getElementById("btnBrowseSig");
    const sigFile = document.getElementById("sigFile");
    btnBrowseSig.addEventListener('click', () => sigFile.click());

    sigFile.addEventListener('change', function () {
      const container = document.getElementById("sigPreviewContainer");
      if (this.files && this.files[0]) {
        container.innerHTML = `<span class="text-success">${this.files[0].name}</span>`;
      }
    });

    const btnUploadSig = document.getElementById("btnUploadSig");
    btnUploadSig.addEventListener('click', () => {
      if (!sigFile.files || !sigFile.files[0]) {
        alert("Please browse a signature file first.");
        return;
      }
      const formData = new FormData();
      formData.append('file', sigFile.files[0]);
      formData.append('old_file', document.getElementById("signature_path").value);

      fetch('actions/employee-master-action.php?action=upload&type=signature', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            document.getElementById("signature_path").value = data.filename;
            document.getElementById("sigPreviewContainer").innerHTML = `<img src="../uploads/signatures/${data.filename}" style="max-height:50px; max-width:100%; border-radius:4px;"/>`;
            alert("Signature uploaded successfully.");
          } else {
            alert(data.message);
          }
        });
    });

    // Populate dynamic lists (Branch, Dept, Desig)
    let branchMap = {};
    let deptMap = {};
    let desigMap = {};

    function loadRelatedData() {
      return fetch('actions/employee-master-action.php?action=get_related_data')
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            const branchSelect = document.getElementById("branch_id");
            const deptSelect = document.getElementById("dept_id");
            const desigSelect = document.getElementById("desig_id");

            // Reset
            branchSelect.innerHTML = '<option value="0">-- Select Branch --</option>';
            deptSelect.innerHTML = '<option value="0">-- Select Dept --</option>';
            desigSelect.innerHTML = '<option value="0">-- Select Designation --</option>';

            data.branches.forEach(b => {
              branchMap[b.id] = b.branch_name;
              branchSelect.innerHTML += `<option value="${b.id}">${b.branch_name}</option>`;
            });

            data.departments.forEach(d => {
              deptMap[d.id] = d.dept_name;
              deptSelect.innerHTML += `<option value="${d.id}">${d.dept_name}</option>`;
            });

            data.designations.forEach(dg => {
              desigMap[dg.id] = dg.desig_name;
              desigSelect.innerHTML += `<option value="${dg.id}">${dg.desig_name}</option>`;
            });
          }
        });
    }

    // Load employees list
    function fetchEmployees(openSearch = false) {
      fetch('actions/employee-master-action.php?action=view')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            employeesList = response.data;
            if (employeesList.length > 0) {
              if (currentIndex === -1) currentIndex = employeesList.length - 1;
              displayRecord(currentIndex);
            } else {
              clearForm();
              setMode('add');
            }
            if (openSearch) {
              populateSearchModal();
              const modalEl = document.getElementById('empSelectModal');
              document.body.appendChild(modalEl);
              const myModal = new bootstrap.Modal(modalEl);
              myModal.show();
            }
          }
        });
    }

    // Populate search modal list
    function populateSearchModal() {
      const body = document.getElementById("empSelectBody");
      body.innerHTML = '';
      if (employeesList.length === 0) {
        body.innerHTML = '<tr><td colspan="4" class="text-center">No employees found</td></tr>';
        return;
      }
      employeesList.forEach((emp, index) => {
        const branchName = branchMap[emp.branch_id] || '-';
        const deptName = deptMap[emp.dept_id] || '-';
        const desigName = desigMap[emp.desig_id] || '-';

        const tr = document.createElement('tr');
        tr.style.cursor = 'pointer';
        tr.innerHTML = `
          <td><strong>${emp.emp_code}</strong></td>
          <td>${emp.emp_name}</td>
          <td>${desigName}</td>
          <td>${deptName}</td>
        `;
        tr.addEventListener('click', () => {
          currentIndex = index;
          displayRecord(currentIndex);
          bootstrap.Modal.getInstance(document.getElementById('empSelectModal')).hide();
        });
        body.appendChild(tr);
      });
    }

    function clearForm() {
      form.reset();
      document.getElementById("emp_db_id").value = "0";
      document.getElementById("photo_path").value = "";
      document.getElementById("signature_path").value = "";
      document.getElementById("emp_status").value = "active";
      document.getElementById("photoPreviewContainer").innerHTML = "Image Not Available";
      document.getElementById("sigPreviewContainer").innerHTML = "No Signature";
      resignDateWrapper.style.display = "none";
      document.getElementById("resign_remark").value = "";
      bankFields.forEach(field => field.disabled = false);
      updateRequiredFields();
    }

    function displayRecord(index) {
      if (index < 0 || index >= employeesList.length) return;
      const emp = employeesList[index];

      document.getElementById("emp_db_id").value = emp.id;
      document.getElementById("emp_code").value = emp.emp_code;
      document.getElementById("emp_name").value = emp.emp_name;
      document.getElementById("father_name").value = emp.father_name;

      document.getElementById("address_1").value = emp.address_1;
      document.getElementById("address_2").value = emp.address_2;
      document.getElementById("address_3").value = emp.address_3;

      document.getElementById("city").value = emp.city;
      document.getElementById("pincode").value = emp.pincode;
      document.getElementById("mobile").value = emp.mobile;
      document.getElementById("emergency_person").value = emp.emergency_person;
      document.getElementById("emergency_contact").value = emp.emergency_contact;
      document.getElementById("email").value = emp.email;

      document.getElementById("branch_id").value = emp.branch_id;
      document.getElementById("dept_id").value = emp.dept_id;
      document.getElementById("sub_dept").value = emp.sub_dept;
      document.getElementById("desig_id").value = emp.desig_id;

      document.getElementById("marital_status").value = emp.marital_status;
      document.getElementById("gender").value = emp.gender;
      document.getElementById("blood_group").value = emp.blood_group;
      document.getElementById("category").value = emp.category;
      document.getElementById("punch_code").value = emp.punch_code;

      document.getElementById("joining_date").value = emp.joining_date;
      document.getElementById("birth_date").value = emp.birth_date;

      document.getElementById("chkPension").checked = emp.pension == 1;
      document.getElementById("chkPFAux").checked = emp.pf_applicable == 1;
      document.getElementById("chkESICAux").checked = emp.esic_applicable == 1;
      document.getElementById("chkPTAux").checked = emp.pt_applicable == 1;

      document.getElementById("ceiling_amount").value = emp.ceiling_amount;
      document.getElementById("pf_start_date").value = emp.pf_start_date;
      document.getElementById("chkOT").checked = emp.ot_applicable == 1;

      document.getElementById("salary_mode").value = emp.salary_mode;
      document.getElementById("bank_name").value = emp.bank_name;
      document.getElementById("branch_name_input").value = emp.branch_name;
      document.getElementById("bank_account_no").value = emp.bank_account_no;
      document.getElementById("ifsc_code").value = emp.ifsc_code;

      document.getElementById("aadhar_no").value = emp.aadhar_no;
      document.getElementById("pan_no").value = emp.pan_no;
      document.getElementById("pf_no").value = emp.pf_no;
      document.getElementById("uan_no").value = emp.uan_no;
      document.getElementById("esic_no").value = emp.esic_no;

      document.getElementById("chkResign").checked = emp.resign == 1;
      document.getElementById("resign_date").value = emp.resign_date;
      document.getElementById("resign_remark").value = emp.resign_remark || "";

      if (emp.resign == 1) {
        resignDateWrapper.style.display = "block";
      } else {
        resignDateWrapper.style.display = "none";
      }

      document.getElementById("photo_path").value = emp.photo_path;
      document.getElementById("signature_path").value = emp.signature_path;
      document.getElementById("emp_status").value = emp.status;

      if (emp.photo_path) {
        document.getElementById("photoPreviewContainer").innerHTML = `<img src="../uploads/photos/${emp.photo_path}" style="max-height:80px; max-width:100%; border-radius:4px;"/>`;
      } else {
        document.getElementById("photoPreviewContainer").innerHTML = "Image Not Available";
      }

      if (emp.signature_path) {
        document.getElementById("sigPreviewContainer").innerHTML = `<img src="../uploads/signatures/${emp.signature_path}" style="max-height:50px; max-width:100%; border-radius:4px;"/>`;
      } else {
        document.getElementById("sigPreviewContainer").innerHTML = "No Signature";
      }

      // Handle Cash Mode Bank Fields Disable
      if (emp.salary_mode === 'CASH') {
        bankFields.forEach(field => field.disabled = true);
      } else {
        bankFields.forEach(field => field.disabled = currentMode === 'view');
      }

      // Update Slider Navigation label
      document.getElementById("navLabel").textContent = `${index + 1} / ${employeesList.length}`;
      document.getElementById("rangeSlider").value = index;

      updateRequiredFields();
      setMode('view');
    }

    function setMode(mode) {
      currentMode = mode;
      if (mode === 'view') {
        formElements.forEach(el => el.disabled = true);

        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = employeesList.length === 0;
        document.getElementById("btnDelete").disabled = employeesList.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = true;
        document.getElementById("btnSearch").disabled = false;

        document.getElementById("rangeSlider").disabled = employeesList.length <= 1;
        document.getElementById("btnPrev").disabled = employeesList.length <= 1 || currentIndex <= 0;
        document.getElementById("btnNext").disabled = employeesList.length <= 1 || currentIndex >= employeesList.length - 1;

        // Keep photo browse buttons disabled in view mode
        btnBrowsePhoto.disabled = true;
        btnUploadPhoto.disabled = true;
        btnBrowseSig.disabled = true;
        btnUploadSig.disabled = true;

      } else if (mode === 'add' || mode === 'edit') {
        formElements.forEach(el => el.disabled = false);

        document.getElementById("btnAdd").disabled = true;
        document.getElementById("btnEdit").disabled = true;
        document.getElementById("btnDelete").disabled = true;
        document.getElementById("btnSave").disabled = false;
        document.getElementById("btnCancel").disabled = false;
        document.getElementById("btnSearch").disabled = true;

        document.getElementById("rangeSlider").disabled = true;
        document.getElementById("btnPrev").disabled = true;
        document.getElementById("btnNext").disabled = true;

        btnBrowsePhoto.disabled = false;
        btnUploadPhoto.disabled = false;
        btnBrowseSig.disabled = false;
        btnUploadSig.disabled = false;

        // Make sure bank fields are disabled if salary mode is CASH even in edit/add mode
        if (document.getElementById("salary_mode").value === 'CASH') {
          bankFields.forEach(field => field.disabled = true);
        }

        if (mode === 'add') {
          clearForm();
          fetch('actions/employee-master-action.php?action=next_code')
            .then(res => res.json())
            .then(data => {
              if (data.status === 'success') {
                document.getElementById("emp_code").value = data.next_code;
              }
            });
        }
      }
    }

    function cancelAction() {
      if (employeesList.length > 0) {
        if (currentIndex === -1) currentIndex = 0;
        displayRecord(currentIndex);
      } else {
        clearForm();
        setMode('add');
      }
    }

    // Button Listeners
    document.getElementById("btnAdd").addEventListener('click', () => setMode('add'));

    document.getElementById("btnEdit").addEventListener('click', () => {
      if (employeesList.length > 0) {
        setMode('edit');
      }
    });

    document.getElementById("btnCancel").addEventListener('click', cancelAction);

    document.getElementById("btnSearch").addEventListener('click', () => {
      fetchEmployees(true);
    });

    document.getElementById("btnDelete").addEventListener('click', () => {
      const id = document.getElementById("emp_db_id").value;
      if (id > 0 && confirm("Are you sure you want to delete this employee record?")) {
        fetch(`actions/employee-master-action.php?action=delete&id=${id}`)
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success') {
              currentIndex = 0;
              fetchEmployees();
            } else {
              alert(data.message);
            }
          });
      }
    });

    document.getElementById("btnSave").addEventListener('click', () => {
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      const joiningDateVal = document.getElementById("joining_date").value.trim();
      const pfStartDateVal = document.getElementById("pf_start_date").value.trim();

      if (joiningDateVal && pfStartDateVal) {
        // Parse DD/MM/YYYY date format
        function parseDateString(dateStr) {
          const parts = dateStr.split('/');
          if (parts.length === 3) {
            return new Date(parts[2], parts[1] - 1, parts[0]);
          }
          return new Date(dateStr);
        }

        const joinDate = parseDateString(joiningDateVal);
        const pfDate = parseDateString(pfStartDateVal);

        if (pfDate < joinDate) {
          alert("PF Start Date cannot be earlier than Joining Date!");
          document.getElementById("pf_start_date").focus();
          return;
        }
      }

      const formData = new FormData(form);
      fetch('actions/employee-master-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            alert(data.message);
            if (currentMode === 'add' && data.insert_id) {
              fetch('actions/employee-master-action.php?action=view')
                .then(res => res.json())
                .then(response => {
                  if (response.status === 'success') {
                    employeesList = response.data;
                    currentIndex = employeesList.findIndex(r => r.id == data.insert_id);
                    displayRecord(currentIndex);
                  }
                });
            } else {
              fetchEmployees();
            }
          } else {
            alert(data.message);
          }
        });
    });

    // Navigation Buttons
    document.getElementById("btnPrev").addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("btnNext").addEventListener('click', () => {
      if (currentIndex < employeesList.length - 1) {
        currentIndex++;
        displayRecord(currentIndex);
      }
    });

    // Slider
    document.getElementById("rangeSlider").addEventListener('input', (e) => {
      currentIndex = parseInt(e.target.value);
      displayRecord(currentIndex);
    });

    // Initialize Page
    loadRelatedData().then(() => {
      fetchEmployees();
    });
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