<?php
$pageTitle = "User Master - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 800px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-user me-2" style="font-size: 16px;"></i>USER MASTER INFORMATION
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="userMasterForm">
        <input type="hidden" name="id" id="user_db_id" value="0">
        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
          <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
            User Authentication Settings</legend>

          <!-- Nav Tabs styled classically -->
          <ul class="nav nav-tabs mb-0 border-bottom-0" id="userTabs" role="tablist"
            style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active fw-bold py-1 px-3" id="user-tab" data-bs-toggle="tab"
                data-bs-target="#user-info" type="button" role="tab" aria-controls="user-info" aria-selected="true"
                style="font-size: 11px;">User Master</button>
            </li>
          </ul>

          <!-- Tab Content Container with light blue background and border -->
          <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="userTabsContent">
            <div class="tab-pane fade show active" id="user-info" role="tabpanel" aria-labelledby="user-tab">
              <div class="row g-2">
                <!-- Left Form Group -->
                <div class="col-md-6 pe-md-3 border-end border-light-blue">
                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">User ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm bg-white" name="user_id" id="user_id"
                        value="VRUTI" style="font-size: 11px;" />
                    </div>
                  </div>

                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">User Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm bg-white" name="user_name" id="user_name"
                        value="VRUTIKA KANANI" style="font-size: 11px;" />
                    </div>
                  </div>

                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control form-control-sm bg-white" name="password" id="password"
                        value="******" style="font-size: 11px;" />
                    </div>
                  </div>

                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">Verify Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control form-control-sm bg-white" name="verify_password"
                        id="verify_password" value="******" style="font-size: 11px;" />
                    </div>
                  </div>

                  <div class="row mb-2 align-items-center">
                    <div class="col-sm-8 offset-sm-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="deactivate_user" id="deactivate_user">
                        <label class="form-check-label col-form-label-sm fw-semibold text-danger" for="deactivate_user"
                          style="font-size: 11px;">Deactivate User</label>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Right Form Group -->
                <div class="col-md-6 ps-md-3">
                  <div class="row mb-2 align-items-center">
                    <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                      style="font-size: 11px;">File Path</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control form-control-sm bg-white" name="file_path" id="file_path"
                        value="C:\TEMP" style="font-size: 11px;" />
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
            style="min-width: 50px; text-align: center; white-space: nowrap;">10 / 10</span>
          <button type="button" id="btnPrev" class="btn btn-xs btn-outline-secondary px-2 py-0"
            style="font-size: 11px; line-height: 1.2; border-color: #a3b8cc !important; height: 20px; font-weight: bold; background-color: #f8f9fa;">&lt;</button>
          <input type="range" id="rangeSlider" class="form-range mx-2" min="0" max="9" value="9"
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
  #userTabs {
    border-bottom: 1px solid #a3b8cc !important;
  }

  #userTabs .nav-item .nav-link {
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

  #userTabs .nav-item .nav-link:hover {
    background-color: #e3ebf6 !important;
    color: #135ca3 !important;
  }

  #userTabs .nav-item .nav-link.active {
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

    // --- Dynamic CRUD Logic ---
    const form = document.getElementById("userMasterForm");
    const formElements = form.querySelectorAll("input, select, textarea");

    let userRecords = [];
    let currentIndex = -1;
    let currentMode = 'view'; // 'view', 'add', 'edit'

    function fetchRecords() {
      fetch('actions/user-master-action.php?action=list')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            userRecords = response.data;
            if (userRecords.length > 0) {
              // Default display first record
              displayRecord(0);
            } else {
              clearForm();
              setMode('view');
              document.getElementById("navLabel").innerText = "0 / 0";
            }
          } else {
            console.error("Failed to load users: ", response.message);
          }
        })
        .catch(err => console.error("Error loading user records: ", err));
    }

    function displayRecord(index) {
      if (index < 0 || index >= userRecords.length) return;
      currentIndex = index;
      const record = userRecords[index];

      document.getElementById("user_db_id").value = record.id;
      document.getElementById("user_id").value = record.username || '';
      document.getElementById("user_name").value = record.name || '';
      document.getElementById("password").value = '';
      document.getElementById("verify_password").value = '';
      document.getElementById("file_path").value = record.file_path || '';
      document.getElementById("deactivate_user").checked = record.status === 'inactive';

      // Update Slider UI
      document.getElementById("navLabel").innerText = (index + 1) + " / " + userRecords.length;

      const slider = document.getElementById("rangeSlider");
      slider.max = userRecords.length - 1;
      slider.value = index;
      slider.disabled = userRecords.length <= 1;

      setMode('view');
    }

    function clearForm() {
      form.reset();
      document.getElementById("user_db_id").value = "0";
      document.getElementById("user_id").value = "";
      document.getElementById("user_name").value = "";
      document.getElementById("password").value = "";
      document.getElementById("verify_password").value = "";
      document.getElementById("file_path").value = "C:\\TEMP";
      document.getElementById("deactivate_user").checked = false;
    }

    function setMode(mode) {
      currentMode = mode;
      if (mode === 'view') {
        formElements.forEach(el => {
          if (el.id !== 'rangeSlider') el.disabled = true;
        });
        document.getElementById("btnAdd").disabled = false;
        document.getElementById("btnEdit").disabled = userRecords.length === 0;
        document.getElementById("btnDelete").disabled = userRecords.length === 0;
        document.getElementById("btnSave").disabled = true;
        document.getElementById("btnCancel").disabled = false;
      } else {
        // add or edit mode
        formElements.forEach(el => {
          if (el.id !== 'rangeSlider') el.disabled = false;
        });
        // Allow editing user_id in edit mode as well
        document.getElementById("btnAdd").disabled = true;
        document.getElementById("btnEdit").disabled = true;
        document.getElementById("btnDelete").disabled = true;
        document.getElementById("btnSave").disabled = false;
        document.getElementById("btnCancel").disabled = false;
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
      if (currentMode !== 'view' && userRecords.length > 0) {
        displayRecord(currentIndex);
      } else {
        window.location.href = 'index';
      }
    }

    document.getElementById("btnDelete").addEventListener('click', () => {
      if (currentIndex >= 0) {
        const record = userRecords[currentIndex];
        if (confirm("Are you sure you want to delete this user record?")) {
          fetch(`actions/user-master-action.php?action=delete&id=${record.id}`)
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
      // Validate passwords
      const password = document.getElementById("password").value;
      const verify = document.getElementById("verify_password").value;

      if (currentMode === 'add' || password !== '') {
        if (password === '') {
          alert("Password is required!");
          return;
        }
        if (password !== verify) {
          alert("Passwords do not match!");
          return;
        }
      }

      const formData = new FormData(form);
      const deactivateCheckbox = document.getElementById("deactivate_user");
      formData.set("deactivate_user", deactivateCheckbox.checked ? "1" : "0");




      fetch('actions/user-master-action.php?action=save', {
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

    // --- Navigation Controls ---

    document.getElementById("btnPrev").addEventListener('click', () => {
      if (currentIndex > 0) {
        displayRecord(currentIndex - 1);
      }
    });

    document.getElementById("btnNext").addEventListener('click', () => {
      if (currentIndex < userRecords.length - 1) {
        displayRecord(currentIndex + 1);
      }
    });

    document.getElementById("rangeSlider").addEventListener('input', (e) => {
      displayRecord(parseInt(e.target.value));
    });

    // --- Search Modal Logic ---
    let userSearchModalInstance = null;
    const btnSearch = document.getElementById("btnSearch");
    if (btnSearch) {
      btnSearch.addEventListener('click', () => {
        if (!userSearchModalInstance) {
          userSearchModalInstance = new bootstrap.Modal(document.getElementById("userSearchModal"));
        }
        renderSearchTable();
        document.getElementById("userSearchInput").value = "";
        userSearchModalInstance.show();
      });
    }

    function renderSearchTable(filterText = "") {
      const tableBody = document.getElementById("userSearchTableBody");
      tableBody.innerHTML = "";

      const filtered = userRecords.filter(rec => {
        const username = (rec.username || '').toLowerCase();
        const name = (rec.name || '').toLowerCase();
        const query = filterText.toLowerCase();
        return username.includes(query) || name.includes(query);
      });

      if (filtered.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="2" class="text-center text-muted py-3">No matching records found</td></tr>`;
        return;
      }

      filtered.forEach(rec => {
        const originalIndex = userRecords.findIndex(r => r.id === rec.id);
        const tr = document.createElement("tr");
        tr.innerHTML = `<td><strong>${rec.username || ''}</strong></td><td>${rec.name || ''}</td>`;
        tr.addEventListener('click', () => {
          displayRecord(originalIndex);
          userSearchModalInstance.hide();
        });
        tableBody.appendChild(tr);
      });
    }

    document.getElementById("userSearchInput").addEventListener('input', (e) => {
      renderSearchTable(e.target.value);
    });

    // Initialize
    fetchRecords();
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

<!-- Search Modal -->
<div class="modal fade" id="userSearchModal" tabindex="-1" aria-labelledby="userSearchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content shadow-lg" style="border-radius: 8px;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%);">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="userSearchModalLabel"
          style="font-size: 13px;">
          <i class="ti ti-search me-2"></i>Search User
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-3">
        <div class="mb-3">
          <input type="text" id="userSearchInput" class="form-control form-control-sm"
            placeholder="Type to search by User ID or Name..." style="font-size: 11px; border: 1px solid #135ca3;">
        </div>
        <div style="max-height: 300px; overflow-y: auto;">
          <table class="table table-sm table-hover table-bordered mb-0" style="font-size: 11px;">
            <thead class="table-light sticky-top">
              <tr>
                <th class="fw-bold text-dark-blue">User ID</th>
                <th class="fw-bold text-dark-blue">User Name</th>
              </tr>
            </thead>
            <tbody id="userSearchTableBody" style="cursor: pointer;">
              <!-- Rows will be dynamically generated -->
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