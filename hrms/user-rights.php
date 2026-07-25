<?php
$pageTitle = "User Rights - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 900px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-shield-lock me-2" style="font-size: 16px;"></i>USER AUTHENTICATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [F5] For List</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="userRightsForm">
        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            User's Authentication / Permission</legend>

          <!-- Nav Tabs styled classically -->
          <ul class="nav nav-tabs mb-0 border-bottom-0" id="rightsTabs" role="tablist"
            style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold py-1 px-3" id="rights-tab" data-bs-toggle="tab"
                data-bs-target="#rights-content" type="button" role="tab" aria-controls="rights-content"
                aria-selected="true" style="font-size: 11px;">User's Authentication / Permission</button>
            </li>
          </ul>

          <!-- Tab Content Container with light blue background and border -->
          <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="rightsTabsContent">
            <div class="tab-pane fade show active" id="rights-content" role="tabpanel" aria-labelledby="rights-tab">
              <!-- Top Form Row -->
              <div class="row g-2 mb-3 align-items-center">
                <div class="col-md-3 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 50px;">User ID.</label>
                  <input type="text" class="form-control form-control-sm" name="user_id" id="user_id" value="VRUTI"
                    style="font-size: 11px; background-color: #fdf2cc !important;" />
                </div>
                <div class="col-md-5 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">User Name</label>
                  <input type="text" class="form-control form-control-sm bg-light" name="user_name" id="user_name"
                    value="VRUTIKA KANANI" readonly style="font-size: 11px;" />
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Menu Head</label>
                  <select class="form-select form-select-sm bg-white" name="menu_head" id="menu_head" style="font-size: 11px;">
                    <option value="Master" selected>Master</option>
                    <option value="Admin">Admin</option>
                    <option value="Payroll">Payroll</option>
                    <option value="Reports">Reports</option>
                    <option value="Utility">Utility</option>
                    <option value="Exit">Exit</option>
                  </select>
                </div>
              </div>

              <!-- Table Grid for Rights -->
              <div class="table-responsive rounded border bg-white" style="max-height: 350px; overflow-y: auto; border-color: #a3b8cc !important;">
                <table class="table table-sm table-bordered table-striped table-hover mb-0 text-center" style="font-size: 11px; vertical-align: middle;">
                  <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                      <th style="width: 50px;">Sr.</th>
                      <th class="text-start">Screen Name</th>
                      <th>Menu</th>
                      <th style="width: 70px;">Add</th>
                      <th style="width: 70px;">Edit</th>
                      <th style="width: 70px;">Delete</th>
                      <th style="width: 70px;">Search</th>
                      <th style="width: 70px;">Print</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td class="text-start fw-semibold">Company Master</td>
                      <td>Master</td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="text-start fw-semibold">User Details</td>
                      <td>Master</td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" /></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="text-start fw-semibold">Department Master</td>
                      <td>Master</td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td class="text-start fw-semibold">Designation Master</td>
                      <td>Master</td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td class="text-start fw-semibold">Holiday Entry</td>
                      <td>Master</td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                      <td><input type="checkbox" class="form-check-input" checked /></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- Bottom Action Toolbar / Footer Buttons -->
    <div class="card-footer bg-light border-top p-2 px-3">
      <div class="d-flex justify-content-end gap-2">
        <button type="button" id="btnSave" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
            class="ti ti-device-floppy me-1 text-success"></i>Save</button>
        <button type="button" id="btnCancel" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
            class="ti ti-refresh me-1 text-danger"></i>Cancel</button>
        <button type="button" id="btnExit" class="btn btn-xs btn-outline-secondary px-3 py-1"
          style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;"><i
            class="ti ti-logout me-1 text-dark"></i>Exit</button>
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
  #rightsTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #rightsTabs .nav-item .nav-link {
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

  #rightsTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #rightsTabs .nav-item .nav-link.active {
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
