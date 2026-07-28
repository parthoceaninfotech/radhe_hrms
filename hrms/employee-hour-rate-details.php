<?php
$pageTitle = "Employee Hour Rate - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 700px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-clock me-2" style="font-size: 16px;"></i>EMPLOYEE HOUR RATE
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3" style="background-color: #cbd2f6 !important;">
      <form id="hourRateForm">

        <!-- EMPLOYEE HOUR RATE Inner Title Bar -->
        <div class="p-2 mb-2 fw-bold text-dark border"
          style="background-color: #d1d5db !important; border-color: #9ca3af !important; font-size: 13px; letter-spacing: 0.5px;">
          EMPLOYEE HOUR RATE
        </div>

        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2 bg-legacy-blue"
          style="border-color: #9ca3af !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Employee Rate</legend>

          <!-- Id & Employee Fields -->
          <input type="hidden" name="id" id="rate_db_id" value="0">
          
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-3 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Employee</label>
              <input type="text" name="emp_code" id="emp_code" class="form-control form-control-sm border-secondary text-center"
                style="font-size: 11px; width: 80px;" required />
            </div>
            <div class="col-md-9">
              <input type="text" name="emp_name" id="emp_name" class="form-control form-control-sm bg-white border-secondary fw-semibold text-dark"
                readonly style="font-size: 11px;" />
            </div>
          </div>

          <!-- Dept Field -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-12 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Dept.</label>
              <input type="text" name="dept_name" id="dept_name" class="form-control form-control-sm bg-white border-secondary"
                readonly style="font-size: 11px; max-width: 320px;" />
            </div>
          </div>

          <!-- Effective From & Month -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-8 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Effective From</label>
              <select name="effective_year" id="effective_year" class="form-select form-select-sm border-secondary" style="font-size: 11px; max-width: 120px;">
                <option value="2026" selected>2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
              </select>
              <label class="fw-semibold text-dark-blue mx-2" style="font-size: 11px;">Month</label>
              <select name="effective_month" id="effective_month" class="form-select form-select-sm border-secondary" style="font-size: 11px; max-width: 100px;">
                <?php
                for ($m = 1; $m <= 12; $m++) {
                    $selected = ($m == intval(date('m'))) ? 'selected' : '';
                    echo "<option value='{$m}' {$selected}>{$m}</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <!-- Day Rate & Night Rate -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 60px;">Day Rate</label>
              <input type="number" step="0.01" name="day_rate" id="day_rate" class="form-control form-control-sm border-secondary text-end" value="0.00"
                style="font-size: 11px; max-width: 120px;" />
            </div>
          </div>

          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 60px;">Night Rate</label>
              <input type="number" step="0.01" name="night_rate" id="night_rate" class="form-control form-control-sm border-secondary text-end" value="0.00"
                style="font-size: 11px; max-width: 120px;" />
            </div>
          </div>

        </fieldset>
      </form>
    </div>

    <!-- Bottom Action Toolbar / Footer Buttons styled in classic desktop layout -->
    <div class="card-footer p-2 px-3 border-top"
      style="background-color: #cbd2f6 !important; border-color: #9ca3af !important;">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <!-- Left Side: Buttons (Stack Style) -->
        <div class="d-flex flex-wrap gap-1 align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #9ca3af !important;">

          <button type="button" id="btnAdd"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-plus text-success mb-1" style="font-size: 18px;"></i>Add
          </button>

          <button type="button" id="btnEdit"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-edit text-warning mb-1" style="font-size: 18px;"></i>Edit
          </button>

          <button type="button" id="btnDelete"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-trash text-danger mb-1" style="font-size: 18px;"></i>Delete
          </button>

          <button type="button" id="btnSave"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-device-floppy text-primary mb-1" style="font-size: 18px;"></i>Save
          </button>

          <button type="button" id="btnCancel"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-refresh text-secondary mb-1" style="font-size: 18px;"></i>Cancel
          </button>

          <button type="button" id="btnExit"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-square-x text-danger mb-1" style="font-size: 18px;"></i>Exit
          </button>

          <button type="button" id="btnSearch"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-search text-info mb-1" style="font-size: 18px;"></i>Search
          </button>

          <button type="button" id="btnPrint"
            class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center p-1"
            style="font-size: 11px; font-weight: bold; width: 62px; height: 50px; border-color: #9ca3af !important; color: #000 !important; background-color: #f3f4f6;">
            <i class="ti ti-printer text-dark mb-1" style="font-size: 18px;"></i>Print
          </button>

        </div>

        <!-- Right Side: Record Navigation Slider (Legacy style) -->
        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #9ca3af !important; font-size: 11px; height: 50px;">
          <span class="px-2 fw-bold me-2 text-dark" id="sliderModeLabel">NEW</span>
          <span id="navLabel" class="px-2 fw-bold border-end border-start me-2"
            style="min-width: 50px; text-align: center; white-space: nowrap;">0 / 0</span>
          <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #9ca3af !important; height: 26px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="0" value="0"
            style="height: 4px; flex-grow: 1; min-width: 120px;" />
          <button type="button" id="btnNext" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #9ca3af !important; height: 26px; font-weight: bold; background-color: #f8f9fa;">&gt;</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!--/ Content -->

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
          <i class="ti ti-users me-2" style="font-size: 15px;"></i>Select Hour Rate Record
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
                <th>Period</th>
                <th>Day Rate</th>
                <th>Night Rate</th>
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

<style>
  /* Light blue background for the tab content window */
  .bg-legacy-blue {
    background-color: #e5e7eb !important;
    border-color: #9ca3af !important;
  }

  .text-dark-blue {
    color: #111827 !important;
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

  /* Override global card z-index during modal overlays */
  .modal-backdrop {
    z-index: 1150 !important;
  }
  .modal {
    z-index: 1200 !important;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById("draggableCard");
    const form = document.getElementById("hourRateForm");
    const formElements = form.querySelectorAll('input, select, button');

    let hourRateList = [];
    let currentIndex = -1;
    let currentMode = 'view'; // view, add, edit

    // Center card initially on load
    const initialLeft = (window.innerWidth - card.offsetWidth) / 2;
    card.style.left = Math.max(0, initialLeft) + "px";
    card.style.top = "60px";
    card.style.opacity = "1";

    dragElement(card);

    // Esc key press redirects to employee-master
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'employee-master.php';
      }
    });

    // Exit button click redirects to employee-master
    const btnExit = document.getElementById("btnExit");
    if (btnExit) {
      btnExit.addEventListener('click', () => {
        window.location.href = 'employee-master.php';
      });
    }

    // Dynamic employee code lookup
    document.getElementById("emp_code").addEventListener('change', function () {
      const code = this.value.trim();
      if (!code) return;

      fetch(`actions/employee-hour-rate-action.php?action=get_employee&emp_code=${code}`)
        .then(res => res.json())
        .then(res => {
          if (res.status === 'success') {
            document.getElementById("emp_name").value = res.data.emp_name;
            document.getElementById("dept_name").value = res.data.dept_name || '';

            // check if they already have details in list
            const existingIndex = hourRateList.findIndex(p => p.emp_code === code);
            if (existingIndex !== -1) {
              currentIndex = existingIndex;
              displayRecord(currentIndex);
            } else {
              document.getElementById("day_rate").value = "0.00";
              document.getElementById("night_rate").value = "0.00";
            }
          } else {
            alert(res.message);
            document.getElementById("emp_code").value = "";
            document.getElementById("emp_name").value = "";
            document.getElementById("dept_name").value = "";
          }
        });
    });

    // CRUD action triggers
    function fetchHourRates(openSearch = false) {
      fetch('actions/employee-hour-rate-action.php?action=view')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            hourRateList = response.data;
            
            // Check URL query parameters for emp_code
            const urlParams = new URLSearchParams(window.location.search);
            const queryEmpCode = urlParams.get('emp_code');

            if (queryEmpCode) {
              const matchIdx = hourRateList.findIndex(p => p.emp_code === queryEmpCode);
              if (matchIdx !== -1) {
                currentIndex = matchIdx;
                displayRecord(currentIndex);
              } else {
                document.getElementById("emp_code").value = queryEmpCode;
                document.getElementById("emp_code").dispatchEvent(new Event('change'));
                setMode('add');
              }
            } else if (hourRateList.length > 0) {
              if (currentIndex === -1) currentIndex = hourRateList.length - 1;
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

    function displayRecord(index) {
      if (index < 0 || index >= hourRateList.length) return;
      const rate = hourRateList[index];

      document.getElementById("rate_db_id").value = rate.id;
      document.getElementById("emp_code").value = rate.emp_code;
      document.getElementById("emp_name").value = rate.emp_name;
      document.getElementById("dept_name").value = rate.dept_name || '';
      document.getElementById("effective_year").value = rate.effective_year;
      document.getElementById("effective_month").value = rate.effective_month;
      document.getElementById("day_rate").value = rate.day_rate;
      document.getElementById("night_rate").value = rate.night_rate;

      // Update Navigation
      document.getElementById("navLabel").textContent = `${index + 1} / ${hourRateList.length}`;
      document.getElementById("rangeSlider").value = index;
      document.getElementById("rangeSlider").max = hourRateList.length - 1;

      setMode('view');
    }

    function clearForm() {
      form.reset();
      document.getElementById("rate_db_id").value = "0";
      document.getElementById("emp_code").value = "";
      document.getElementById("emp_name").value = "";
      document.getElementById("dept_name").value = "";
      document.getElementById("day_rate").value = "0.00";
      document.getElementById("night_rate").value = "0.00";
    }

    function setMode(mode) {
      currentMode = mode;
      document.getElementById("sliderModeLabel").textContent = mode.toUpperCase();

      if (mode === 'view') {
        formElements.forEach(el => el.disabled = true);
        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = hourRateList.length === 0;
        document.getElementById("btnDelete").disabled = hourRateList.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = true;
      } else {
        formElements.forEach(el => el.disabled = false);
        document.getElementById("emp_name").disabled = true;
        document.getElementById("dept_name").disabled = true;
        if (mode === 'edit') {
          document.getElementById("emp_code").disabled = true;
        }
        document.getElementById("btnAdd").disabled = true;
        document.getElementById("btnEdit").disabled = true;
        document.getElementById("btnDelete").disabled = true;
        document.getElementById("btnSave").disabled = false;
        document.getElementById("btnCancel").disabled = false;
      }
    }

    // Button event bindings
    document.getElementById("btnAdd").addEventListener('click', () => {
      clearForm();
      setMode('add');
    });

    document.getElementById("btnEdit").addEventListener('click', () => {
      setMode('edit');
    });

    document.getElementById("btnCancel").addEventListener('click', () => {
      if (hourRateList.length > 0) {
        displayRecord(currentIndex);
      } else {
        clearForm();
        setMode('add');
      }
    });

    document.getElementById("btnDelete").addEventListener('click', () => {
      if (currentIndex < 0 || currentIndex >= hourRateList.length) return;
      if (!confirm("Are you sure you want to delete this hour rate record?")) return;

      const record = hourRateList[currentIndex];
      fetch(`actions/employee-hour-rate-action.php?action=delete&id=${record.id}`)
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            alert(data.message);
            currentIndex = Math.max(0, currentIndex - 1);
            fetchHourRates();
          } else {
            alert(data.message);
          }
        });
    });

    document.getElementById("btnSave").addEventListener('click', () => {
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      const formData = new FormData(form);
      fetch('actions/employee-hour-rate-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            alert(data.message);
            fetchHourRates();
          } else {
            alert(data.message);
          }
        });
    });

    // Slider and Navigation
    document.getElementById("btnPrev").addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("btnNext").addEventListener('click', () => {
      if (currentIndex < hourRateList.length - 1) {
        currentIndex++;
        displayRecord(currentIndex);
      }
    });

    document.getElementById("rangeSlider").addEventListener('input', function () {
      currentIndex = parseInt(this.value);
      displayRecord(currentIndex);
    });

    // Search action
    document.getElementById("btnSearch").addEventListener('click', () => {
      fetchHourRates(true);
    });

    function populateSearchModal() {
      const body = document.getElementById("empSelectBody");
      body.innerHTML = '';
      hourRateList.forEach((r, idx) => {
        const tr = document.createElement('tr');
        tr.style.cursor = 'pointer';
        tr.innerHTML = `
          <td>${r.emp_code}</td>
          <td>${r.emp_name}</td>
          <td>Year: ${r.effective_year}, Month: ${r.effective_month}</td>
          <td>${r.day_rate}</td>
          <td>${r.night_rate}</td>
        `;
        tr.addEventListener('click', () => {
          currentIndex = idx;
          displayRecord(currentIndex);
          bootstrap.Modal.getInstance(document.getElementById('empSelectModal')).hide();
        });
        body.appendChild(tr);
      });
    }

    fetchHourRates();
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