<?php
$pageTitle = "Employee Payroll Details - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 950px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-receipt me-2" style="font-size: 16px;"></i>PAYROLL DETAILS
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="payrollDetailsForm">
        
        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Employee Payroll Configuration</legend>

          <!-- Nav Tabs styled classically -->
          <ul class="nav nav-tabs mb-0 border-bottom-0" id="payrollTabs" role="tablist"
            style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold py-1 px-3" id="payroll-tab" data-bs-toggle="tab"
                data-bs-target="#payroll-content" type="button" role="tab" aria-controls="payroll-content" aria-selected="true"
                style="font-size: 11px;">Payroll Details</button>
            </li>
          </ul>

          <!-- Tab Content Container with light blue background and border -->
          <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="payrollTabsContent">
            <div class="tab-pane fade show active" id="payroll-content" role="tabpanel" aria-labelledby="payroll-tab">
              
              <!-- Upper Config Box -->
              <div class="row g-2 mb-3 bg-white p-2 rounded border" style="border-color: #c4d6ec !important;">
                
                <!-- Line 1: Emp Id, Name, Payl Type -->
                <div class="col-md-3 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 60px;">Emp. Id.</label>
                  <input type="text" class="form-control form-control-sm" value="10029" style="font-size: 11px; width: 80px;" />
                </div>
                <div class="col-md-5 d-flex align-items-center">
                  <input type="text" class="form-control form-control-sm bg-light" value="ASHA TANKA VISHWAKARMA" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Payl Type</label>
                  <select class="form-select form-select-sm" style="font-size: 11px;">
                    <option selected>Monthly</option>
                  </select>
                </div>

                <!-- Line 2: PF, P.Tax, Value -->
                <div class="col-md-4 d-flex align-items-center gap-1">
                  <div class="form-check me-1">
                    <input class="form-check-input" type="checkbox" id="chkPF" checked>
                    <label class="form-check-label fw-semibold text-dark-blue" for="chkPF" style="font-size: 11px;">PF Applicable</label>
                  </div>
                  <input type="text" class="form-control form-control-sm text-center" value="12.00" style="font-size: 11px; width: 60px;" />
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="550.00" readonly style="font-size: 11px; width: 80px;" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chkPTax">
                    <label class="form-check-label fw-semibold text-dark-blue" for="chkPTax" style="font-size: 11px;">P.Tax Applicable</label>
                  </div>
                </div>
                <div class="col-md-4 text-end d-flex align-items-center justify-content-end">
                  <input type="text" class="form-control form-control-sm bg-light text-center" value="57255" readonly style="font-size: 11px; width: 80px;" />
                </div>

                <!-- Line 3: Gratuity, Bonus -->
                <div class="col-md-6 d-flex align-items-center gap-1">
                  <div class="form-check me-1">
                    <input class="form-check-input" type="checkbox" id="chkGratuity">
                    <label class="form-check-label fw-semibold text-dark-blue" for="chkGratuity" style="font-size: 11px;">Gratuity</label>
                  </div>
                  <input type="text" class="form-control form-control-sm text-center" value="4.81" style="font-size: 11px; width: 50px;" />
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="264.55" readonly style="font-size: 11px; width: 70px;" />

                  <div class="form-check ms-3 me-1">
                    <input class="form-check-input" type="checkbox" id="chkBonus">
                    <label class="form-check-label fw-semibold text-dark-blue" for="chkBonus" style="font-size: 11px;">Bonus (%)</label>
                  </div>
                  <input type="text" class="form-control form-control-sm text-center" value="8.33" style="font-size: 11px; width: 50px;" />
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="458.15" readonly style="font-size: 11px; width: 70px;" />
                </div>
              </div>

              <!-- Earnings and Deductions Side-by-Side Tables -->
              <div class="row g-2">
                
                <!-- Earnings Block -->
                <div class="col-md-6">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-1 text-primary" style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Earning</span>
                    
                    <div class="table-responsive rounded border bg-white" style="max-height: 180px; overflow-y: auto; border-color: #cbd5e1 !important;">
                      <table class="table table-sm table-bordered mb-0 text-center" style="font-size: 10px; vertical-align: middle;">
                        <thead class="table-light text-primary fw-bold" style="position: sticky; top: 0; z-index: 1;">
                          <tr>
                            <th class="text-start">Description</th>
                            <th style="width: 40px;">Row</th>
                            <th style="width: 70px;">Val/Per(%)</th>
                            <th style="width: 70px;">Rate</th>
                            <th style="width: 70px;">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-start fw-semibold text-danger">BASIC</td>
                            <td>1</td>
                            <td class="fw-semibold text-danger">V</td>
                            <td>5500.00</td>
                            <td>5500.00</td>
                          </tr>
                          <tr>
                            <td class="text-start fw-semibold">HOUSE RENT ALLOWANCE</td>
                            <td>2</td>
                            <td class="fw-semibold text-danger">V</td>
                            <td>1500.00</td>
                            <td>1500.00</td>
                          </tr>
                          <tr>
                            <td class="text-start fw-semibold">MEDICAL ALLOWANCE</td>
                            <td>3</td>
                            <td class="fw-semibold text-danger">V</td>
                            <td>1000.00</td>
                            <td>1000.00</td>
                          </tr>
                          <tr>
                            <td class="text-start fw-semibold">WASHING ALLOWANCE</td>
                            <td>6</td>
                            <td class="fw-semibold text-danger">V</td>
                            <td>500.00</td>
                            <td>500.00</td>
                          </tr>
                          <tr>
                            <td class="text-start fw-semibold">PAPER ALLOW</td>
                            <td>7</td>
                            <td class="fw-semibold text-danger">V</td>
                            <td>1000.00</td>
                            <td>1000.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Deductions Block -->
                <div class="col-md-6">
                  <div class="card p-2 bg-white border h-100" style="border-color: #c4d6ec !important;">
                    <span class="col-form-label-sm fw-bold d-block mb-1 text-primary" style="font-size: 11px; border-bottom: 1px solid #e2e8f0; padding-bottom: 2px;">Deduction</span>
                    
                    <div class="table-responsive rounded border bg-white" style="max-height: 180px; overflow-y: auto; border-color: #cbd5e1 !important;">
                      <table class="table table-sm table-bordered mb-0 text-center" style="font-size: 10px; vertical-align: middle;">
                        <thead class="table-light text-primary fw-bold" style="position: sticky; top: 0; z-index: 1;">
                          <tr>
                            <th class="text-start">Description</th>
                            <th style="width: 40px;">Row</th>
                            <th style="width: 70px;">Val/Per(%)</th>
                            <th style="width: 70px;">Rate</th>
                            <th style="width: 70px;">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="5" class="text-muted text-center py-4">No deduction rules defined.</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Lower Row Parameters (Totals) -->
              <div class="row g-2 mt-2 bg-white p-2 rounded border" style="border-color: #c4d6ec !important;">
                <div class="col-md-2 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-1 text-end" style="font-size: 10px; min-width: 50px;">Total Earn</label>
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="21100.00" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-2 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-1 text-end" style="font-size: 10px; min-width: 50px;">Total Ded</label>
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="660.00" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-2 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-1 text-end" style="font-size: 10px; min-width: 55px;">Net Amount</label>
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="20440.00" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-3 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-1 text-end" style="font-size: 10px; min-width: 60px;">Employer PF</label>
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="12.00" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-3 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-1 text-end" style="font-size: 10px; min-width: 60px;">Act Wage</label>
                  <input type="text" class="form-control form-control-sm text-center bg-light" value="21822.70" readonly style="font-size: 11px;" />
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

        <!-- Right Side: Record Navigation Slider (Legacy style) -->
        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
          <span id="navLabel" class="px-2 fw-bold border-end me-2"
            style="min-width: 50px; text-align: center; white-space: nowrap;">26 / 26</span>
          <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="25" value="25"
            style="height: 4px; flex-grow: 1; min-width: 120px;" />
          <button type="button" id="btnNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
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

  /* Table styling */
  .table th {
    background-color: #f1f5f9 !important;
    color: #135ca3 !important;
    font-weight: bold !important;
    border-color: #cbd5e1 !important;
  }

  .table td {
    border-color: #e2e8f0 !important;
  }

  /* Classical Tab styles */
  #payrollTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #payrollTabs .nav-item .nav-link {
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

  #payrollTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #payrollTabs .nav-item .nav-link.active {
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
