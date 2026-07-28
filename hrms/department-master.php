<?php
$pageTitle = "Department Master - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 750px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-briefcase me-2" style="font-size: 16px;"></i>DEPARTMENT MASTER INFORMATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [F5] For List, [Esc]
        For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="departmentMasterForm">
        <input type="hidden" name="id" id="dept_db_id" value="0">
        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Department Details</legend>

          <!-- Nav Tabs styled classically -->
          <ul class="nav nav-tabs mb-0 border-bottom-0" id="deptTabs" role="tablist"
            style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold py-1 px-3" id="dept-tab" data-bs-toggle="tab"
                data-bs-target="#dept-info" type="button" role="tab" aria-controls="dept-info" aria-selected="true"
                style="font-size: 11px;">Department Information</button>
            </li>
          </ul>

          <!-- Tab Content Container with light blue background and border -->
          <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="deptTabsContent"
            style="min-height: 150px;">
            <div class="tab-pane fade show active" id="dept-info" role="tabpanel" aria-labelledby="dept-tab">
              <div class="row g-3 py-2">
                <div class="col-12">
                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-2 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">Dept. Id.</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control form-control-sm bg-white" name="dept_id" id="dept_id"
                        value="554" style="font-size: 11px;" />
                    </div>
                  </div>

                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-2 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">Dept. Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm bg-white" name="dept_name" id="dept_name"
                        value="ASSISTANT ADMINISTRATIVE OFFICER" style="font-size: 11px;" />
                    </div>
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

        <!-- Right Side: Record Navigation Slider (Legacy style) -->
        <div class="d-flex align-items-center bg-white p-1 rounded border shadow-xs"
          style="border-color: #c9c8cc !important; font-size: 11px; height: 26px;">
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
  #deptTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #deptTabs .nav-item .nav-link {
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

  #deptTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #deptTabs .nav-item .nav-link.active {
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
    card.style.top = "100px";
    card.style.opacity = "1";

    dragElement(card);

    // Esc key press handling
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        if (currentMode !== 'view') {
          cancelAction();
        } else {
          window.location.href = 'index?change_company=1';
        }
      }
    });

    // CRUD AJAX LOGIC
    let deptRecords = [];
    let currentIndex = -1;
    let currentMode = 'view'; // 'view', 'add', 'edit'
    let deptSelectModalInstance = null;

    const form = document.getElementById("departmentMasterForm");
    const formElements = form.querySelectorAll("input, select");

    // Load records initially
    fetchRecords();

    function fetchRecords(showModal = false) {
      fetch('actions/department-master-action.php?action=view')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            deptRecords = response.data;
            if (deptRecords.length > 0) {
              if (currentIndex === -1 || currentIndex >= deptRecords.length) {
                currentIndex = 0;
              }
              displayRecord(currentIndex);

              if (showModal) {
                populateModalAndShow();
              }
            } else {
              currentIndex = -1;
              clearForm();

              // Reset navigation UI for 0 records
              document.getElementById("navLabel").innerText = "0 / 0";
              const slider = document.getElementById("rangeSlider");
              slider.max = 0;
              slider.value = 0;
              slider.disabled = true;

              setMode('add');
            }
          }
        })
        .catch(err => console.error("Error fetching records: ", err));
    }

    function populateModalAndShow() {
      const selectBody = document.getElementById("deptSelectBody");
      selectBody.innerHTML = "";
      deptRecords.forEach((rec, idx) => {
        const tr = document.createElement("tr");
        tr.style.cursor = "pointer";
        tr.innerHTML = `<td><strong>${rec.dept_code || ''}</strong></td><td>${rec.dept_name || ''}</td>`;
        tr.addEventListener('click', () => {
          currentIndex = idx;
          displayRecord(currentIndex);
          if (deptSelectModalInstance) {
            deptSelectModalInstance.hide();
          }
        });
        selectBody.appendChild(tr);
      });

      if (!deptSelectModalInstance) {
        const modalEl = document.getElementById("deptSelectModal");
        document.body.appendChild(modalEl);
        deptSelectModalInstance = new bootstrap.Modal(modalEl);
      }
      deptSelectModalInstance.show();
    }

    function displayRecord(index) {
      if (index < 0 || index >= deptRecords.length) return;
      const record = deptRecords[index];
      document.getElementById("dept_db_id").value = record.id;
      document.getElementById("dept_id").value = record.dept_code || '';
      document.getElementById("dept_name").value = record.dept_name || '';

      document.getElementById("navLabel").innerText = (index + 1) + " / " + deptRecords.length;

      const slider = document.getElementById("rangeSlider");
      slider.max = deptRecords.length - 1;
      slider.value = index;
      slider.disabled = deptRecords.length <= 1;

      setMode('view');
    }

    function clearForm() {
      document.getElementById("dept_db_id").value = "0";
      document.getElementById("dept_id").value = "";
      document.getElementById("dept_name").value = "";
    }

    function setMode(mode) {
      currentMode = mode;
      if (mode === 'view') {
        formElements.forEach(el => el.disabled = true);
        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = deptRecords.length === 0;
        document.getElementById("btnDelete").disabled = deptRecords.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = true;
        document.getElementById("btnSearch").disabled = false;
        document.getElementById("rangeSlider").disabled = deptRecords.length <= 1;
        document.getElementById("btnPrev").disabled = deptRecords.length <= 1 || currentIndex <= 0;
        document.getElementById("btnNext").disabled = deptRecords.length <= 1 || currentIndex >= deptRecords.length - 1;
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

        if (mode === 'add') {
          clearForm();
          fetch('actions/department-master-action.php?action=next_code')
            .then(res => res.json())
            .then(data => {
              if (data.status === 'success') {
                document.getElementById("dept_id").value = data.next_code;
              }
            });
        }
      }
    }

    function cancelAction() {
      if (deptRecords.length > 0) {
        if (currentIndex === -1) currentIndex = 0;
        displayRecord(currentIndex);
      } else {
        clearForm();
        setMode('add');
      }
    }

    // Button Listeners
    document.getElementById("btnAdd").addEventListener('click', () => setMode('add'));
    document.getElementById("btnEdit").addEventListener('click', () => setMode('edit'));
    document.getElementById("btnCancel").addEventListener('click', cancelAction);
    document.getElementById("btnSearch").addEventListener('click', () => {
      fetchRecords(true);
    });

    document.getElementById("btnDelete").addEventListener('click', () => {
      const id = document.getElementById("dept_db_id").value;
      if (id > 0 && confirm("Are you sure you want to delete this department?")) {
        fetch(`actions/department-master-action.php?action=delete&id=${id}`)
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success') {
              currentIndex = 0;
              fetchRecords();
            } else {
              alert(data.message);
            }
          });
      }
    });

    document.getElementById("btnSave").addEventListener('click', () => {
      const formData = new FormData(form);
      fetch('actions/department-master-action.php?action=save', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            if (currentMode === 'add' && data.insert_id) {
              fetch('actions/department-master-action.php?action=view')
                .then(res => res.json())
                .then(response => {
                  if (response.status === 'success') {
                    deptRecords = response.data;
                    currentIndex = deptRecords.findIndex(r => r.id == data.insert_id);
                    displayRecord(currentIndex);
                  }
                });
            } else {
              fetchRecords();
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
      if (currentIndex < deptRecords.length - 1) {
        currentIndex++;
        displayRecord(currentIndex);
      }
    });

    // Slider
    document.getElementById("rangeSlider").addEventListener('input', (e) => {
      currentIndex = parseInt(e.target.value);
      displayRecord(currentIndex);
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
      if (['INPUT', 'BUTTON', 'A', 'SPAN'].includes(e.target.tagName)) return;
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

<!-- Department Selection Modal -->
<div class="modal fade" id="deptSelectModal" tabindex="-1" data-bs-backdrop="static"
  aria-labelledby="deptSelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content border shadow-lg"
      style="border-radius: 6px !important; border-color: #a3b8cc !important;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom: 1px solid #104f9b;">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="deptSelectModalLabel"
          style="font-size: 13px; margin: 0;">
          <i class="ti ti-building me-2" style="font-size: 15px;"></i>Select Department
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
                <th style="width: 80px;">Code</th>
                <th>Department Name</th>
              </tr>
            </thead>
            <tbody id="deptSelectBody">
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