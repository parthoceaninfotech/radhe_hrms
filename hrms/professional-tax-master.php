<?php
$pageTitle = "Professional Tax Master - Payroll System";
include 'header.php';
?>

<style>
  #slabsTable input[type=number]::-webkit-outer-spin-button,
  #slabsTable input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  #slabsTable input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1150px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-settings me-2" style="font-size: 16px;"></i>PROFESSIONAL TAX MASTER
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;">
        # Press [F5] For List, [Esc] For Cancel
      </span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="ptaxForm">
        <input type="hidden" name="id" id="ptax_rule_id" value="0">

        <!-- Top Fields: State, Date, Tax Type, Gender Checkboxes -->
        <fieldset class="border p-3 rounded mb-3" style="border-color: #135ca3 !important; background-color: #ffffff;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Payroll Details
          </legend>
          <div class="row g-2 align-items-center">

            <!-- State Select -->
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 90px;">State</label>
              <select class="form-select form-select-sm bg-white" name="state_name" id="state_name" required
                style="font-size: 11px; border: 1px solid #c9c8cc !important;">
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

            <!-- Record ID display indicator -->
            <div class="col-md-6 text-end">
              <span id="recordIndicator" class="badge bg-light text-dark border py-1"
                style="font-size: 11px; min-width: 40px;">0</span>
            </div>

            <!-- Effect From Date -->
            <div class="col-md-4 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 90px;">Effect
                From</label>
              <input type="text" class="form-control form-control-sm text-center" name="effective_date"
                id="effective_date" placeholder="DD/MM/YYYY" required
                style="font-size: 11px; border: 1px solid #c9c8cc !important;" />
            </div>

            <!-- Tax Type Select -->
            <div class="col-md-4 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 80px;">Tax
                Type</label>
              <select class="form-select form-select-sm" name="tax_type" id="tax_type"
                style="font-size: 11px; border: 1px solid #c9c8cc !important;">
                <option value="MONTHLY">MONTHLY</option>
                <option value="YEARLY">YEARLY</option>
              </select>
            </div>

            <!-- Gender Checkboxes -->
            <div class="col-md-4 d-flex align-items-center justify-content-start ps-3 gap-3">
              <div class="form-check">
                <input class="form-check-input border-secondary" type="checkbox" name="applicable_male"
                  id="applicable_male" value="1" checked />
                <label class="form-check-label fw-semibold text-dark" for="applicable_male"
                  style="font-size: 11px;">Male</label>
              </div>
              <div class="form-check">
                <input class="form-check-input border-secondary" type="checkbox" name="applicable_female"
                  id="applicable_female" value="1" checked />
                <label class="form-check-label fw-semibold text-dark" for="applicable_female"
                  style="font-size: 11px;">Female</label>
              </div>
            </div>

          </div>
        </fieldset>

        <!-- Slabs Earning Table Grid -->
        <fieldset class="border p-3 rounded mb-2"
          style="border-color: #a3b8cc !important; background-color: #cbd2f6 !important;">
          <div class="d-flex justify-content-between align-items-center mb-1 pb-1 border-bottom"
            style="border-color: #9ca3af !important;">
            <span class="fw-bold text-dark" style="font-size: 11px;">Earning Slabs & month-wise tax rate</span>
            <div class="d-flex gap-1">
              <button type="button" id="btnAddRow" class="btn btn-xs btn-primary px-2 py-0"
                style="font-size: 10px; height: 20px;"><i class="ti ti-plus me-1"></i>Add Slab</button>
              <button type="button" id="btnDeleteRow" class="btn btn-xs btn-danger px-2 py-0"
                style="font-size: 10px; height: 20px;"><i class="ti ti-trash me-1"></i>Remove Selected</button>
            </div>
          </div>

          <div class="table-responsive rounded border bg-secondary"
            style="max-height: 250px; overflow-y: auto; border-color: #9ca3af !important;">
            <table class="table table-sm table-bordered mb-0 text-center text-dark font-monospace" id="slabsTable"
              style="font-size: 11px; vertical-align: middle; background-color: #a0a0a0 !important; table-layout: fixed; width: 100%;">
              <thead class="table-light fw-bold"
                style="position: sticky; top: 0; z-index: 1; background-color: #d1d5db !important;">
                <tr class="border-secondary text-dark">
                  <th style="width: 40px;" class="border-secondary">Sel</th>
                  <th style="width: 145px;" class="border-secondary">FROM</th>
                  <th style="width: 145px;" class="border-secondary">TO</th>
                  <th style="width: 100px;" class="border-secondary">RATE</th>
                  <th style="width: 75px;" class="border-secondary">APR</th>
                  <th style="width: 75px;" class="border-secondary">MAY</th>
                  <th style="width: 75px;" class="border-secondary">JUN</th>
                  <th style="width: 75px;" class="border-secondary">JUL</th>
                  <th style="width: 75px;" class="border-secondary">AUG</th>
                  <th style="width: 75px;" class="border-secondary">SEP</th>
                  <th style="width: 75px;" class="border-secondary">OCT</th>
                  <th style="width: 75px;" class="border-secondary">NOV</th>
                  <th style="width: 75px;" class="border-secondary">DEC</th>
                  <th style="width: 75px;" class="border-secondary">JAN</th>
                  <th style="width: 75px;" class="border-secondary">FEB</th>
                  <th style="width: 75px;" class="border-secondary">MAR</th>
                </tr>
              </thead>
              <tbody id="slabsTableBody">
                <!-- Slabs populated dynamically -->
              </tbody>
            </table>
          </div>
        </fieldset>

        <!-- Bottom Action Toolbar -->
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-3 pt-2 border-top">
          <div class="d-flex flex-wrap gap-1 align-items-center bg-white p-1 rounded border shadow-xs"
            style="border-color: #c9c8cc !important;">
            <button type="button" id="btnAdd" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-plus me-1 text-success"></i>Add
            </button>
            <button type="button" id="btnEdit" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-edit me-1 text-warning"></i>Edit
            </button>
            <button type="button" id="btnDelete" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-trash me-1 text-danger"></i>Delete
            </button>
            <button type="button" id="btnSave" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-device-floppy me-1 text-primary"></i>Save
            </button>
            <button type="button" id="btnCancel" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-refresh me-1 text-secondary"></i>Cancel
            </button>
            <button type="button" id="btnExit" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-logout me-1 text-danger"></i>Exit
            </button>
            <button type="button" id="btnSearch" class="btn btn-xs btn-outline-secondary px-2 py-1"
              style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
              <i class="ti ti-search me-1 text-info"></i>Search
            </button>
          </div>

          <!-- Slider / Record Navigation -->
          <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
            style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
            <span id="sliderModeLabel" class="badge bg-secondary me-2" style="font-size: 9px;">VIEW</span>
            <span id="navLabel" class="px-2 fw-bold border-end me-2"
              style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
            <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
              style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
            <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="0" value="0"
              style="height: 4px; flex-grow: 1; min-width: 120px;" disabled />
            <button type="button" id="btnNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
              style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>

<!-- Search Selection Modal -->
<div class="modal fade" id="ruleSelectModal" tabindex="-1" data-bs-backdrop="static"
  aria-labelledby="ruleSelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border shadow-lg"
      style="border-radius: 6px !important; border-color: #a3b8cc !important;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom: 1px solid #104f9b;">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="ruleSelectModalLabel"
          style="font-size: 13px; margin: 0;">
          <i class="ti ti-search me-2" style="font-size: 15px;"></i>Select Professional Tax Rule
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
          style="font-size: 10px;"></button>
      </div>
      <div class="modal-body p-3" style="background-color: #e8f0fe !important;">
        <div class="table-responsive bg-white rounded p-2 border"
          style="max-height: 300px; overflow-y: auto; border-color: #a3b8cc !important;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light">
              <tr>
                <th>State Name</th>
                <th>Effective Date</th>
                <th>Tax Type</th>
                <th>Male App.</th>
                <th>Female App.</th>
              </tr>
            </thead>
            <tbody id="ruleSelectBody">
              <!-- Dynamically populated -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Controller Logic -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const card = document.getElementById("draggableCard");
    const form = document.getElementById("ptaxForm");
    const slabsTableBody = document.getElementById("slabsTableBody");
    const formElements = form.querySelectorAll("input, select, button[type='submit']");

    let rulesList = [];
    let currentIndex = -1;
    let currentMode = 'view'; // view, add, edit
    let ruleSelectModalInstance = null;

    // Center card initially
    const initialLeft = (window.innerWidth - card.offsetWidth) / 2;
    card.style.left = Math.max(0, initialLeft) + "px";
    card.style.top = "60px";
    card.style.opacity = "1";

    dragElement(card);

    // Esc key press redirects to index
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'index.php';
      }
    });

    document.getElementById("btnExit").addEventListener('click', () => {
      window.location.href = 'index.php';
    });

    // Helper functions for date formats
    function formatDateForDisplay(dateStr) {
      if (!dateStr) return "";
      const parts = dateStr.split('-');
      if (parts.length === 3) {
        return `${parts[2]}/${parts[1]}/${parts[0]}`;
      }
      return dateStr;
    }

    // Dynamic grid functions
    function addSlabRow(data = {}) {
      const fromVal = parseFloat(data.salary_from !== undefined ? data.salary_from : 0).toFixed(2);
      const toVal = parseFloat(data.salary_to !== undefined ? data.salary_to : 99999999).toFixed(2);
      const rateVal = parseFloat(data.rate !== undefined ? data.rate : 0).toFixed(2);

      const aprVal = parseFloat(data.apr !== undefined ? data.apr : 0).toFixed(2);
      const mayVal = parseFloat(data.may !== undefined ? data.may : 0).toFixed(2);
      const junVal = parseFloat(data.jun !== undefined ? data.jun : 0).toFixed(2);
      const julVal = parseFloat(data.jul !== undefined ? data.jul : 0).toFixed(2);
      const augVal = parseFloat(data.aug !== undefined ? data.aug : 0).toFixed(2);
      const sepVal = parseFloat(data.sep !== undefined ? data.sep : 0).toFixed(2);
      const octVal = parseFloat(data.oct !== undefined ? data.oct : 0).toFixed(2);
      const novVal = parseFloat(data.nov !== undefined ? data.nov : 0).toFixed(2);
      const decVal = parseFloat(data.dec !== undefined ? data.dec : 0).toFixed(2);
      const janVal = parseFloat(data.jan !== undefined ? data.jan : 0).toFixed(2);
      const febVal = parseFloat(data.feb !== undefined ? data.feb : 0).toFixed(2);
      const marVal = parseFloat(data.mar !== undefined ? data.mar : 0).toFixed(2);

      const tr = document.createElement("tr");
      tr.className = "border-secondary";
      tr.innerHTML = `
        <td class="border-secondary bg-white text-center">
          <input type="checkbox" class="form-check-input select-row-chk" />
        </td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 slab-salary-from" value="${fromVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 slab-salary-to" value="${toVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 slab-rate" value="${rateVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="apr" value="${aprVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="may" value="${mayVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="jun" value="${junVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="jul" value="${julVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="aug" value="${augVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="sep" value="${sepVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="oct" value="${octVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="nov" value="${novVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="dec" value="${decVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="jan" value="${janVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="feb" value="${febVal}" style="font-size: 11px; padding: 4px;" /></td>
        <td class="border-secondary bg-white p-0"><input type="number" step="0.01" class="form-control form-control-sm text-end border-0 month-rate" data-month="mar" value="${marVal}" style="font-size: 11px; padding: 4px;" /></td>
      `;

      // Auto update monthly rates if master rate is edited
      const rateInput = tr.querySelector('.slab-rate');
      rateInput.addEventListener('input', function () {
        const rateVal = parseFloat(this.value) || 0;
        tr.querySelectorAll('.month-rate').forEach(mInput => {
          mInput.value = rateVal.toFixed(2);
        });
      });

      // Format to 2 decimal places on blur/change
      tr.querySelectorAll("input[type='number']").forEach(input => {
        input.addEventListener('change', function () {
          const val = parseFloat(this.value) || 0;
          this.value = val.toFixed(2);
        });
      });

      slabsTableBody.appendChild(tr);

      // Disable inputs if we are in view mode
      if (currentMode === 'view') {
        tr.querySelectorAll("input").forEach(inp => inp.disabled = true);
      }
    }

    document.getElementById("btnAddRow").addEventListener('click', () => {
      if (currentMode === 'view') return;
      addSlabRow();
    });

    document.getElementById("btnDeleteRow").addEventListener('click', () => {
      if (currentMode === 'view') return;
      const checked = slabsTableBody.querySelectorAll(".select-row-chk:checked");
      checked.forEach(chk => {
        chk.closest("tr").remove();
      });
    });

    function clearForm() {
      form.reset();
      document.getElementById("ptax_rule_id").value = "0";
      document.getElementById("recordIndicator").textContent = "0";
      slabsTableBody.innerHTML = "";
      
      const today = new Date();
      const dd = String(today.getDate()).padStart(2, '0');
      const mm = String(today.getMonth() + 1).padStart(2, '0');
      const yyyy = today.getFullYear();
      document.getElementById("effective_date").value = `${dd}/${mm}/${yyyy}`;
    }

    function setMode(mode) {
      currentMode = mode;
      document.getElementById("sliderModeLabel").textContent = mode.toUpperCase();

      const inputs = form.querySelectorAll("input, select");
      const gridButtons = document.querySelectorAll("#btnAddRow, #btnDeleteRow");

      if (mode === 'view') {
        inputs.forEach(el => el.disabled = true);
        gridButtons.forEach(btn => btn.disabled = true);
        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = rulesList.length === 0;
        document.getElementById("btnDelete").disabled = rulesList.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = true;
      } else {
        inputs.forEach(el => el.disabled = false);
        gridButtons.forEach(btn => btn.disabled = false);
        document.getElementById("btnAdd").disabled = true;
        document.getElementById("btnEdit").disabled = true;
        document.getElementById("btnDelete").disabled = true;
        document.getElementById("btnSave").disabled = false;
        document.getElementById("btnCancel").disabled = false;
      }
    }

    // Display loaded rule and slabs
    function displayRecord(index) {
      if (index < 0 || index >= rulesList.length) return;
      clearForm();
      const rule = rulesList[index];

      document.getElementById("ptax_rule_id").value = rule.id;
      document.getElementById("recordIndicator").textContent = rule.id;
      document.getElementById("state_name").value = rule.state_name;
      document.getElementById("effective_date").value = formatDateForDisplay(rule.effective_date);
      document.getElementById("tax_type").value = rule.tax_type;
      document.getElementById("applicable_male").checked = rule.applicable_male == 1;
      document.getElementById("applicable_female").checked = rule.applicable_female == 1;

      // Fetch slabs for this rule
      fetch(`actions/professional-tax-master-action.php?action=get_slabs&rule_id=${rule.id}`)
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            response.data.forEach(slab => addSlabRow(slab));
          }
        });

      document.getElementById("navLabel").textContent = `${index + 1} / ${rulesList.length}`;
      document.getElementById("rangeSlider").value = index;
      document.getElementById("rangeSlider").max = rulesList.length - 1;

      setMode('view');
    }

    function fetchRules(openSearch = false) {
      fetch('actions/professional-tax-master-action.php?action=view_rules')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            rulesList = response.data;
            if (rulesList.length > 0) {
              if (currentIndex === -1) currentIndex = 0;
              displayRecord(currentIndex);
            } else {
              clearForm();
              setMode('add');
              addSlabRow();
            }

            if (openSearch) {
              populateSearchModal();
              if (!ruleSelectModalInstance) {
                ruleSelectModalInstance = new bootstrap.Modal(document.getElementById('ruleSelectModal'));
              }
              ruleSelectModalInstance.show();
            }
          }
        });
    }

    // Modal populate helper
    function populateSearchModal() {
      const selectBody = document.getElementById("ruleSelectBody");
      selectBody.innerHTML = "";

      rulesList.forEach((rule, index) => {
        const row = document.createElement("tr");
        row.style.cursor = "pointer";
        row.innerHTML = `
          <td>${rule.state_name}</td>
          <td>${formatDateForDisplay(rule.effective_date)}</td>
          <td>${rule.tax_type}</td>
          <td>${rule.applicable_male == 1 ? 'Yes' : 'No'}</td>
          <td>${rule.applicable_female == 1 ? 'Yes' : 'No'}</td>
        `;
        row.addEventListener('click', () => {
          currentIndex = index;
          displayRecord(currentIndex);
          ruleSelectModalInstance.hide();
        });
        selectBody.appendChild(row);
      });
    }

    // Navigation and Action Triggers
    document.getElementById("btnPrev").addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("btnNext").addEventListener('click', () => {
      if (currentIndex < rulesList.length - 1) {
        currentIndex++;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("rangeSlider").addEventListener('input', (e) => {
      currentIndex = parseInt(e.target.value);
      displayRecord(currentIndex);
    });

    document.getElementById("btnAdd").addEventListener('click', () => {
      clearForm();
      setMode('add');
      addSlabRow();
    });

    document.getElementById("btnEdit").addEventListener('click', () => {
      if (rulesList.length === 0) return;
      setMode('edit');
    });

    document.getElementById("btnCancel").addEventListener('click', () => {
      if (rulesList.length > 0) {
        displayRecord(currentIndex);
      } else {
        clearForm();
        setMode('add');
        addSlabRow();
      }
    });

    document.getElementById("btnSearch").addEventListener('click', () => {
      fetchRules(true);
    });

    document.getElementById("btnDelete").addEventListener('click', () => {
      const ruleId = document.getElementById("ptax_rule_id").value;
      if (ruleId <= 0) return;
      if (!confirm("Are you sure you want to delete this Professional Tax configuration?")) return;

      fetch(`actions/professional-tax-master-action.php?action=delete_rule&id=${ruleId}`)
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            currentIndex = 0;
            fetchRules();
          }
        });
    });

    // Save logic
    document.getElementById("btnSave").addEventListener('click', () => {
      const stateName = document.getElementById("state_name").value;
      const effectiveDate = document.getElementById("effective_date").value;
      if (!stateName || !effectiveDate) {
        alert("State Name and Effective Date are required.");
        return;
      }

      // Collect slab data from grid
      const slabs = [];
      const rows = slabsTableBody.querySelectorAll("tr");
      rows.forEach(tr => {
        const salary_from = tr.querySelector(".slab-salary-from").value;
        const salary_to = tr.querySelector(".slab-salary-to").value;
        const rate = tr.querySelector(".slab-rate").value;

        const apr = tr.querySelector("[data-month='apr']").value;
        const may = tr.querySelector("[data-month='may']").value;
        const jun = tr.querySelector("[data-month='jun']").value;
        const jul = tr.querySelector("[data-month='jul']").value;
        const aug = tr.querySelector("[data-month='aug']").value;
        const sep = tr.querySelector("[data-month='sep']").value;
        const oct = tr.querySelector("[data-month='oct']").value;
        const nov = tr.querySelector("[data-month='nov']").value;
        const dec = tr.querySelector("[data-month='dec']").value;
        const jan = tr.querySelector("[data-month='jan']").value;
        const feb = tr.querySelector("[data-month='feb']").value;
        const mar = tr.querySelector("[data-month='mar']").value;

        slabs.push({
          salary_from, salary_to, rate,
          apr, may, jun, jul, aug, sep, oct, nov, dec, jan, feb, mar
        });
      });

      const formData = new FormData();
      formData.append('id', document.getElementById("ptax_rule_id").value);
      formData.append('state_name', stateName);
      formData.append('effective_date', effectiveDate);
      formData.append('tax_type', document.getElementById("tax_type").value);
      formData.append('applicable_male', document.getElementById("applicable_male").checked ? 1 : 0);
      formData.append('applicable_female', document.getElementById("applicable_female").checked ? 1 : 0);
      formData.append('slabs', JSON.stringify(slabs));

      fetch('actions/professional-tax-master-action.php?action=save_rule', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            fetchRules();
          }
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

    // Initial load
    fetchRules();
  });
</script>

<?php
include 'footer.php';
?>