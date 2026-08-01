<?php
$pageTitle = "View or Delete Employee - Payroll System";
require_once 'root/config.php';
include 'header.php';
global $ai_db;

$company_id = isset($_SESSION['selected_company_id']) ? intval($_SESSION['selected_company_id']) : 0;

// Fetch branches and departments for filters
$branches = $ai_db->aiGetQuery("SELECT id, branch_name FROM hrms_branches WHERE company_id = $company_id ORDER BY branch_name ASC");
$departments = $ai_db->aiGetQuery("SELECT id, dept_name FROM hrms_departments WHERE company_id = $company_id ORDER BY dept_name ASC");
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1100px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-trash me-2" style="font-size: 16px;"></i>EMPLOYEE MASTER DELETE
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Exit</span>
    </div>

    <div class="card-body p-3 bg-white">
      <!-- Title banner inside form -->
      <div class="bg-secondary text-white p-2 mb-3 rounded" style="background-color: #d1d1d1 !important; border: 1px solid #b8b8b8;">
        <h6 class="m-0 fw-bold text-dark" style="font-size: 13px; letter-spacing: 0.5px;">VIEW OR DELETE EMPLOYEE</h6>
      </div>

      <!-- Classic Group Box using Fieldset/Legend -->
      <fieldset class="border p-3 rounded mb-2" style="border-color: #a3b8cc !important;">
        <!-- Nav Tabs styled classically -->
        <ul class="nav nav-tabs mb-0 border-bottom-0" id="employeeTabs" role="tablist"
          style="margin-left: 0 !important; margin-right: 0 !important; padding-left: 4px !important;">
          <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold py-1 px-3" id="view-delete-tab" data-bs-toggle="tab"
              data-bs-target="#view-delete-content" type="button" role="tab" aria-controls="view-delete-content"
              aria-selected="true" style="font-size: 11px; border-bottom-color: #e2e8f0;">View or Delete Employee</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold py-1 px-3 text-danger" id="status-tab" data-bs-toggle="tab"
              data-bs-target="#status-content" type="button" role="tab" aria-controls="status-content"
              aria-selected="false" style="font-size: 11px;">Status</button>
          </li>
        </ul>

        <!-- Tab Content Container with light blue background and border -->
        <div class="tab-content border p-3 rounded-bottom bg-legacy-blue" id="employeeTabsContent" style="background-color: #f4f7fa;">
          
          <div class="tab-pane fade show active" id="view-delete-content" role="tabpanel" aria-labelledby="view-delete-tab">
            <!-- Filter Section -->
            <div class="row g-2 mb-3 align-items-center">
              <div class="col-md-3 d-flex align-items-center">
                <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 70px;">Filter Emp.</label>
                <input type="text" class="form-control form-control-sm bg-white" id="filter_emp" placeholder="Search by name/code..." style="font-size: 11px; height: 26px;" />
              </div>
              <div class="col-md-3 d-flex align-items-center">
                <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 50px;">Branch</label>
                <select class="form-select form-select-sm bg-white" id="filter_branch" style="font-size: 11px; height: 26px;">
                  <option value="">---SELECT ALL---</option>
                  <?php foreach ($branches as $branch): ?>
                    <option value="<?php echo htmlspecialchars($branch['id']); ?>"><?php echo htmlspecialchars($branch['branch_name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3 d-flex align-items-center">
                <label class="fw-semibold text-dark-blue me-2 text-end" style="font-size: 11px; min-width: 40px;">Dept.</label>
                <select class="form-select form-select-sm bg-white" id="filter_dept" style="font-size: 11px; height: 26px;">
                  <option value="">---SELECT ALL---</option>
                  <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo htmlspecialchars($dept['id']); ?>"><?php echo htmlspecialchars($dept['dept_name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3 d-flex justify-content-end gap-2">
                <button type="button" id="btnDisplay" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 11px; height: 26px; border-color: #a3b8cc !important; background-color: #ffffff;">
                  <i class="ti ti-search text-info me-1" style="font-size: 13px;"></i>Display
                </button>
                <button type="button" id="btnDeleteRecord" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 11px; height: 26px; border-color: #a3b8cc !important; background-color: #ffffff;">
                  <i class="ti ti-trash text-danger me-1" style="font-size: 13px;"></i>Delete Record
                </button>
              </div>
            </div>

            <!-- Select All Checkbox -->
            <div class="mb-2 d-flex align-items-center">
              <input class="form-check-input me-2" type="checkbox" id="selectAllCheckbox">
              <label class="form-check-label fw-bold text-dark" style="font-size: 11px; user-select: none;" for="selectAllCheckbox">Select All</label>
            </div>

            <!-- Grid Container -->
            <div class="table-responsive rounded border bg-white" style="max-height: 400px; overflow-y: auto; border-color: #a3b8cc !important;">
              <table class="table table-sm table-bordered table-hover mb-0" style="font-size: 11px; vertical-align: middle;">
                <thead class="table-light text-primary fw-bold" style="position: sticky; top: 0; z-index: 1;">
                  <tr>
                    <th style="width: 40px;" class="text-center">Select</th>
                    <th style="width: 80px;" class="text-center">CODE</th>
                    <th class="text-start">NAME</th>
                    <th class="text-start">DEPARTMENT</th>
                    <th class="text-start">DESIGNATION</th>
                    <th class="text-start">BRANCH</th>
                    <th style="width: 100px;" class="text-center">JOIN DATE</th>
                  </tr>
                </thead>
                <tbody id="employeeTableBody">
                  <tr>
                    <td colspan="7" class="text-center text-muted py-3">Click Display to load employees.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="tab-pane fade" id="status-content" role="tabpanel" aria-labelledby="status-tab">
            <div class="p-3 bg-white border rounded">
              <h6 class="fw-bold text-dark mb-2">Module Information</h6>
              <p class="mb-1" style="font-size: 11px;">This module allows administrators to search and delete employees in batch mode.</p>
              <p class="mb-0 text-danger fw-semibold" style="font-size: 11px;">Caution: Deleting employee records is permanent and cannot be undone.</p>
            </div>
          </div>

        </div>
      </fieldset>
    </div>
  </div>

</div>

<style>
  .table th {
    background-color: #f1f5f9 !important;
    color: #135ca3 !important;
    font-weight: bold !important;
    border-color: #cbd5e1 !important;
  }
  .table td {
    border-color: #e2e8f0 !important;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById("draggableCard");

    // Center card initially
    const initialLeft = (window.innerWidth - card.offsetWidth) / 2;
    card.style.left = Math.max(0, initialLeft) + "px";
    card.style.top = "60px";
    card.style.opacity = "1";

    dragElement(card);

    // Esc key redirect to index
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'index';
      }
    });

    let employeesList = [];

    // Load related data (branches, departments, etc)
    function fetchEmployees() {
      const filterEmp = document.getElementById("filter_emp").value.toLowerCase();
      const filterBranch = document.getElementById("filter_branch").value;
      const filterDept = document.getElementById("filter_dept").value;

      const tbody = document.getElementById("employeeTableBody");
      tbody.innerHTML = `<tr><td colspan="7" class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading...</td></tr>`;

      fetch('actions/employee-master-action.php?action=view')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            employeesList = response.data;
            renderTable(filterEmp, filterBranch, filterDept);
          } else {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger py-3">${response.message}</td></tr>`;
          }
        })
        .catch(err => {
          tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger py-3">Error fetching records.</td></tr>`;
        });
    }

    function renderTable(nameSearch, branchId, deptId) {
      const tbody = document.getElementById("employeeTableBody");
      tbody.innerHTML = "";

      const branchMap = {};
      const branchOptions = document.querySelectorAll("#filter_branch option");
      branchOptions.forEach(opt => {
        if (opt.value) branchMap[opt.value] = opt.textContent;
      });

      const deptMap = {};
      const deptOptions = document.querySelectorAll("#filter_dept option");
      deptOptions.forEach(opt => {
        if (opt.value) deptMap[opt.value] = opt.textContent;
      });

      const filtered = employeesList.filter(emp => {
        const matchesName = !nameSearch || 
                            (emp.emp_name && emp.emp_name.toLowerCase().includes(nameSearch)) || 
                            (emp.emp_code && emp.emp_code.toLowerCase().includes(nameSearch));
        const matchesBranch = !branchId || String(emp.branch_id) === String(branchId);
        const matchesDept = !deptId || String(emp.dept_id) === String(deptId);
        return matchesName && matchesBranch && matchesDept;
      });

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-3">No matching employees found.</td></tr>`;
        document.getElementById("selectAllCheckbox").checked = false;
        return;
      }

      fetch('actions/employee-master-action.php?action=get_related_data')
        .then(res => res.json())
        .then(relatedData => {
          const desigMap = {};
          if (relatedData.status === 'success' && relatedData.designations) {
            relatedData.designations.forEach(d => {
              desigMap[d.id] = d.desig_name;
            });
          }

          filtered.forEach(emp => {
            const tr = document.createElement("tr");
            
            const deptName = deptMap[emp.dept_id] || "-";
            const branchName = branchMap[emp.branch_id] || "-";
            const desigName = desigMap[emp.desig_id] || "-";
            
            tr.innerHTML = `
              <td class="text-center"><input type="checkbox" class="emp-row-checkbox form-check-input" data-id="${emp.id}"></td>
              <td class="text-center fw-bold">${emp.emp_code || '-'}</td>
              <td class="text-start fw-semibold">${emp.emp_name || '-'}</td>
              <td class="text-start">${deptName}</td>
              <td class="text-start">${desigName}</td>
              <td class="text-start">${branchName}</td>
              <td class="text-center">${emp.joining_date || '-'}</td>
            `;
            tbody.appendChild(tr);
          });

          syncSelectAllCheckbox();
        });
    }

    function syncSelectAllCheckbox() {
      const checkboxes = document.querySelectorAll(".emp-row-checkbox");
      const selectAll = document.getElementById("selectAllCheckbox");
      if (checkboxes.length === 0) {
        selectAll.checked = false;
        return;
      }
      const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
      selectAll.checked = (checkedCount === checkboxes.length);
    }

    document.getElementById("selectAllCheckbox").addEventListener('change', function() {
      const checkboxes = document.querySelectorAll(".emp-row-checkbox");
      checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.getElementById("employeeTableBody").addEventListener('change', (e) => {
      if (e.target.classList.contains("emp-row-checkbox")) {
        syncSelectAllCheckbox();
      }
    });

    document.getElementById("btnDisplay").addEventListener('click', () => {
      fetchEmployees();
    });

    document.getElementById("btnDeleteRecord").addEventListener('click', () => {
      const checkedBoxes = document.querySelectorAll(".emp-row-checkbox:checked");
      if (checkedBoxes.length === 0) {
        alert("Please select at least one employee to delete.");
        return;
      }

      const idsToDelete = Array.from(checkedBoxes).map(cb => cb.getAttribute("data-id")).join(",");
      if (confirm(`Are you sure you want to delete the selected ${checkedBoxes.length} employee record(s)? This action is permanent.`)) {
        fetch(`actions/employee-master-action.php?action=delete&id=${idsToDelete}`)
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success') {
              alert(data.message);
              fetchEmployees();
            } else {
              alert(data.message);
            }
          })
          .catch(err => {
            alert("Error trying to delete records.");
          });
      }
    });

    fetchEmployees();
  });

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
