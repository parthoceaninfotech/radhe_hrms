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
            style="min-width: 50px; text-align: center; white-space: nowrap;">1 / 1</span>
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

<?php
include 'footer.php';
?>