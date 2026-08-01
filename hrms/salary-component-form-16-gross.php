<?php
$pageTitle = "Salary Component For Form - 16 Gross - Payroll System";
include 'header.php';
?>

<style>
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
</style>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 600px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-settings me-2" style="font-size: 16px;"></i>FORM-16 GROSS COMPONENTS MAPPING
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;">
        # Press [Esc] For Cancel
      </span>
    </div>

    <div class="card-body p-3 bg-white">
      
      <!-- Global Branch Selection Dropdown -->
      <fieldset class="border p-3 rounded mb-3" style="border-color: #135ca3 !important;">
        <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
          Select Branch
        </legend>
        <div class="row align-items-center">
          <label class="col-sm-3 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue" style="font-size: 11px;">Branch Selection</label>
          <div class="col-sm-7">
            <select class="form-select form-select-sm" id="global_branch_id" style="font-size: 11px; border: 1px solid #135ca3 !important;">
              <option value="">-- Choose Branch --</option>
            </select>
          </div>
        </div>
      </fieldset>

      <!-- Placeholder when branch is not selected -->
      <div id="selectBranchPlaceholder" class="text-center py-4 border rounded" style="background-color: #f8f9fa; border-style: dashed !important; border-color: #cbd5e1 !important;">
        <i class="ti ti-info-circle text-secondary mb-2" style="font-size: 28px;"></i>
        <p class="text-muted mb-0" style="font-size: 12px;">Please select a Branch to configure Form-16 Gross components.</p>
      </div>

      <!-- Main UI (Hidden or disabled until branch is selected) -->
      <div id="componentsContainer" style="display: none;">
        <form id="form16ComponentsForm">
          <input type="hidden" name="branch_id" class="hidden-branch-id" value="0">
          <fieldset class="border p-3 rounded bg-legacy-blue" style="min-height: 250px;">
            <legend class="float-none w-auto px-2 fw-bold text-primary" style="font-size: 12px; margin-bottom: 0;">
              Salary Component Mapping Details
            </legend>
            <div class="table-responsive bg-white rounded border" style="max-height: 300px; overflow-y: auto; border-color: #a3b8cc !important;">
              <table class="table table-sm table-bordered table-striped table-hover mb-0" style="font-size: 11px;">
                <thead class="table-light">
                  <tr>
                    <th class="text-center" style="width: 50px;">Select</th>
                    <th>Salary Component Name</th>
                  </tr>
                </thead>
                <tbody id="componentsTableBody">
                  <!-- Loaded dynamically -->
                </tbody>
              </table>
            </div>

            <!-- Bottom Action Toolbar -->
            <div class="d-flex flex-wrap gap-2 justify-content-end align-items-center mt-3 pt-2 border-top">
              <button type="submit" id="btnSaveComponents" class="btn btn-xs btn-outline-secondary px-3 py-1" style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
                <i class="ti ti-device-floppy me-1 text-primary"></i>Save Mapping
              </button>
              <button type="button" id="btnExitComponents" class="btn btn-xs btn-outline-secondary px-3 py-1" style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
                <i class="ti ti-logout me-1 text-danger"></i>Exit
              </button>
            </div>
          </fieldset>
        </form>
      </div>

    </div>
  </div>
</div>

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
        window.location.href = 'index';
      }
    });

    const globalBranchSelect = document.getElementById("global_branch_id");
    const componentsContainer = document.getElementById("componentsContainer");
    const selectBranchPlaceholder = document.getElementById("selectBranchPlaceholder");
    const componentsTableBody = document.getElementById("componentsTableBody");

    // Load branches
    fetch('actions/form-16-gross-action.php?action=get_branches')
      .then(res => res.json())
      .then(response => {
        if (response.status === 'success') {
          response.data.forEach(branch => {
            const opt = document.createElement("option");
            opt.value = branch.id;
            opt.textContent = `${branch.branch_name} (${branch.branch_code})`;
            globalBranchSelect.appendChild(opt);
          });
        }
      })
      .catch(err => console.error("Error loading branches: ", err));

    // Handle Branch Selection Change
    globalBranchSelect.addEventListener('change', () => {
      const selectedBranchId = globalBranchSelect.value;
      
      // Update hidden branch_id field
      const hiddenBranchFields = document.querySelectorAll(".hidden-branch-id");
      hiddenBranchFields.forEach(el => el.value = selectedBranchId || 0);

      if (!selectedBranchId) {
        componentsContainer.style.display = "none";
        selectBranchPlaceholder.style.display = "block";
        return;
      }

      // Show container, hide placeholder
      componentsContainer.style.display = "block";
      selectBranchPlaceholder.style.display = "none";

      // Load Components for the selected Branch
      fetchComponents(selectedBranchId);
    });

    function fetchComponents(branchId) {
      componentsTableBody.innerHTML = `<tr><td colspan="2" class="text-center"><span class="spinner-border spinner-border-sm text-primary" role="status"></span> Loading...</td></tr>`;

      fetch(`actions/form-16-gross-action.php?action=get_components&branch_id=${branchId}`)
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            componentsTableBody.innerHTML = "";
            response.data.forEach(comp => {
              const row = document.createElement("tr");
              row.innerHTML = `
                <td class="text-center">
                  <input type="checkbox" class="form-check-input component-checkbox" 
                    name="components[]" value="${comp.code}" ${comp.is_applicable ? 'checked' : ''} />
                </td>
                <td class="fw-bold">${comp.description}</td>
              `;
              componentsTableBody.appendChild(row);
            });
          } else {
            componentsTableBody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">${response.message}</td></tr>`;
          }
        })
        .catch(err => {
          console.error(err);
          componentsTableBody.innerHTML = `<tr><td colspan="2" class="text-center text-danger">Failed to load components.</td></tr>`;
        });
    }

    // Handle Components Form Submit
    document.getElementById("form16ComponentsForm").addEventListener('submit', (e) => {
      e.preventDefault();
      const branchId = globalBranchSelect.value;
      if (!branchId) return;

      const formData = new FormData();
      formData.append('branch_id', branchId);

      const checkboxes = componentsTableBody.querySelectorAll('.component-checkbox:checked');
      checkboxes.forEach(cb => {
        formData.append('components[]', cb.value);
      });

      fetch('actions/form-16-gross-action.php?action=save_components', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(response => {
        if (response.status === 'success') {
          alert(response.message);
        } else {
          alert("Error: " + response.message);
        }
      })
      .catch(err => {
        console.error(err);
        alert("Failed to update components mapping.");
      });
    });

    document.getElementById("btnExitComponents").addEventListener('click', () => {
      window.location.href = 'index';
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
