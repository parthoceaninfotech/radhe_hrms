<?php
$pageTitle = "Employee Hour Rate - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 700px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

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
        <fieldset class="border p-3 rounded mb-2"
          style="border-color: #9ca3af !important; background-color: #e5e7eb !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            Employee Rate</legend>

          <!-- Id & Employee Fields -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-4 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Id.</label>
              <input type="text" class="form-control form-control-sm border-secondary text-center"
                style="font-size: 11px; width: 80px;" />
            </div>
          </div>

          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-3 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Employee</label>
              <input type="text" class="form-control form-control-sm border-secondary text-center"
                style="font-size: 11px; width: 80px;" />
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control form-control-sm bg-white border-secondary fw-semibold text-dark"
                readonly style="font-size: 11px;" />
            </div>
          </div>

          <!-- Dept Field -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-12 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Dept.</label>
              <input type="text" class="form-control form-control-sm border-secondary"
                style="font-size: 11px; max-width: 320px;" />
            </div>
          </div>

          <!-- Effective From & Month -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end"
                style="font-size: 11px; min-width: 60px;">Effective From</label>
              <select class="form-select form-select-sm border-secondary" style="font-size: 11px; max-width: 120px;">
                <option>2026</option>
                <option>2027</option>
              </select>
              <label class="fw-semibold text-dark-blue mx-2" style="font-size: 11px;">Month</label>
              <select class="form-select form-select-sm border-secondary" style="font-size: 11px; max-width: 100px;">
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
          </div>

          <!-- Day Rate & Night Rate -->
          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 60px;">Day
                Rate</label>
              <input type="text" class="form-control form-control-sm border-secondary text-end" value="0.00"
                style="font-size: 11px; max-width: 120px;" />
            </div>
          </div>

          <div class="row g-2 mb-2 align-items-center">
            <div class="col-md-6 d-flex align-items-center">
              <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 60px;">Night
                Rate</label>
              <input type="text" class="form-control form-control-sm border-secondary text-end" value="0.00"
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
          <span class="px-2 fw-bold me-2 text-dark">NEW</span>
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

<style>
  /* Light blue background for the tab content window */
  .bg-legacy-blue {
    background-color: #e5e7eb !important;
    border-color: #9ca3af !important;
  }

  .text-dark-blue {
    color: #111827 !important;
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