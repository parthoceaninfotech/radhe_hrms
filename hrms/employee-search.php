<?php
$pageTitle = "Employee Search - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 1000px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 10;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-users me-2" style="font-size: 16px;"></i>EMPLOYEE MASTER SEARCH / DISPLAY
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Cancel</span>
    </div>

    <!-- Top Toolbar Actions inside Body -->
    <div class="card-body p-3 bg-white">
      <div
        class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 pb-2 border-bottom border-light">
        <div>
          <!-- Blank left side or search input can go here if needed -->
        </div>
        <div class="d-flex align-items-center gap-3">
          <span class="fw-bold text-danger" style="font-size: 11px;">[ Filtered Employee : 29/29 ]</span>
          <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" id="allEmployeeCheckbox" checked>
            <label class="form-check-label fw-semibold text-dark" style="font-size: 11px;" for="allEmployeeCheckbox">All
              Employee</label>
          </div>
          <button type="button" class="btn btn-xs btn-outline-secondary px-2 py-1 d-flex align-items-center gap-1"
            style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
            <i class="ti ti-filter-off text-warning" style="font-size: 13px;"></i>Clear Filter
          </button>
        </div>
      </div>

      <!-- Employee Grid -->
      <div class="table-responsive rounded border bg-white"
        style="max-height: 450px; overflow-y: auto; border-color: #a3b8cc !important;">
        <table class="table table-sm table-bordered table-hover mb-0 text-center"
          style="font-size: 11px; vertical-align: middle;">
          <thead class="table-light text-primary fw-bold" style="position: sticky; top: 0; z-index: 1;">
            <tr>
              <th style="width: 80px;">EMP.ID.</th>
              <th style="width: 80px;">CODE</th>
              <th class="text-start">NAME</th>
              <th class="text-start">FATHER</th>
              <th>SEX</th>
              <th>BIRTH DATE</th>
              <th>MARITAL STAT.</th>
              <th class="text-start">ADDRESS</th>
            </tr>
          </thead>
          <tbody id="employeeTableBody">
            <tr>
              <td>1859</td>
              <td>10001</td>
              <td class="text-start fw-semibold">RATHOD SAJANBA NARENDRASINH</td>
              <td class="text-start">NARENDRASINH</td>
              <td>FEMALE</td>
              <td>14.12.1969</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1840</td>
              <td>10002</td>
              <td class="text-start fw-semibold">AVANI DHARMESHBHAI</td>
              <td class="text-start">DHARMESHBHAI</td>
              <td>FEMALE</td>
              <td>08.11.1984</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1854</td>
              <td>10003</td>
              <td class="text-start fw-semibold">GADHIYA MITALBEN DHAVALBHAI</td>
              <td class="text-start">DHAVALBHAI</td>
              <td>FEMALE</td>
              <td>09.05.1994</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr class="table-danger" style="background-color: #ffb3b3 !important;">
              <td>1848</td>
              <td class="fw-bold">10004</td>
              <td class="text-start fw-semibold">ADITYA NILESHBHAI PARMAR</td>
              <td class="text-start">NILESHBHAI</td>
              <td>MALE</td>
              <td>16.11.1994</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr class="table-danger" style="background-color: #ffb3b3 !important;">
              <td>1855</td>
              <td class="fw-bold">10005</td>
              <td class="text-start fw-semibold">PARMAR URVASHI ABHISHEK</td>
              <td class="text-start">ABHISHEK</td>
              <td>FEMALE</td>
              <td>08.08.1995</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr class="table-danger" style="background-color: #ffb3b3 !important;">
              <td>1860</td>
              <td class="fw-bold">10006</td>
              <td class="text-start fw-semibold">SOLANKI ALKABEN ASHISHBHAI</td>
              <td class="text-start">ASHISHBHAI</td>
              <td>FEMALE</td>
              <td>23.04.1983</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1855</td>
              <td>10007</td>
              <td class="text-start fw-semibold">JADEJA HARPALSINH RANJITSINH</td>
              <td class="text-start">RANJITSINH</td>
              <td>MALE</td>
              <td>09.03.1998</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1851</td>
              <td>10008</td>
              <td class="text-start fw-semibold">CHAVDA PURVESH KAMLESHBHAI</td>
              <td class="text-start">KAMLESHBHAI</td>
              <td>MALE</td>
              <td>14.10.1993</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1853</td>
              <td>10009</td>
              <td class="text-start fw-semibold">DERASARI MEERA MANISH</td>
              <td class="text-start">MANISH</td>
              <td>FEMALE</td>
              <td>19.09.1979</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr class="table-danger" style="background-color: #ffb3b3 !important;">
              <td>1850</td>
              <td class="fw-bold">10010</td>
              <td class="text-start fw-semibold">CHAUHAN SRUSHTI MAYURBHAI</td>
              <td class="text-start">MAYURBHAI</td>
              <td>FEMALE</td>
              <td>16.11.1999</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1861</td>
              <td>10011</td>
              <td class="text-start fw-semibold">SUTARIA NIDHI KARAMSHIBHAI</td>
              <td class="text-start">KARAMSHIBHAI</td>
              <td>FEMALE</td>
              <td>27.06.1988</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1852</td>
              <td>10012</td>
              <td class="text-start fw-semibold">DALVANI RUKSHANABEN MAHMADBHAI</td>
              <td class="text-start">MAHMADBHAI</td>
              <td>FEMALE</td>
              <td>02.12.1982</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1857</td>
              <td>10013</td>
              <td class="text-start fw-semibold">RATHOD DRASHTI NARENDRASINH</td>
              <td class="text-start">NARENDRASINH</td>
              <td>FEMALE</td>
              <td>20.08.1999</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>1858</td>
              <td>10014</td>
              <td class="text-start fw-semibold">RATHOD MANISHABEN BHAVESHBHAI</td>
              <td class="text-start">BHAVESHBHAI RATHOD</td>
              <td>FEMALE</td>
              <td>08.08.1986</td>
              <td>-</td>
              <td class="text-start">RAJKOT</td>
            </tr>
            <tr>
              <td>14655</td>
              <td>10015</td>
              <td class="text-start fw-semibold">CHAVDA VILASBEN VIPULBHAI</td>
              <td class="text-start">VIPULBHAI</td>
              <td>FEMALE</td>
              <td>22.03.1977</td>
              <td>MARRIED</td>
              <td class="text-start">-</td>
            </tr>
            <tr>
              <td>14657</td>
              <td>10016</td>
              <td class="text-start fw-semibold">VIPUL MEPABHAI CHAVDA</td>
              <td class="text-start">MEPABHAI</td>
              <td>MALE</td>
              <td>01.01.1978</td>
              <td>MARRIED</td>
              <td class="text-start">-</td>
            </tr>
            <tr>
              <td>19695</td>
              <td>10017</td>
              <td class="text-start fw-semibold">SHIVRAJSINH ANIRUDDHSINH JADEJA</td>
              <td class="text-start">ANIRUDDHSINH</td>
              <td>MALE</td>
              <td>26.05.2000</td>
              <td>MARRIED</td>
              <td class="text-start">-</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Bottom Footer -->
    <div class="card-footer bg-light border-top p-2 px-3 text-end">
      <button type="button" id="btnExit" class="btn btn-xs btn-outline-secondary px-3 py-1"
        style="font-size: 11px; height: 26px; border-color: #a3b8cc !important;">
        <i class="ti ti-logout text-danger me-1"></i>Exit
      </button>
    </div>
  </div>

</div>
<!--/ Content -->

<style>
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

  /* Make row highlighting pop out */
  .table-danger td {
    background-color: #ffd8d8 !important;
    color: #bf2626 !important;
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

    // Toggle showing deactivated employees based on checkbox
    const allEmployeeCheckbox = document.getElementById('allEmployeeCheckbox');
    if (allEmployeeCheckbox) {
      allEmployeeCheckbox.addEventListener('change', function () {
        const rows = document.querySelectorAll('#employeeTableBody tr');
        let count = 0;
        rows.forEach(row => {
          if (row.classList.contains('table-danger')) {
            if (this.checked) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
          }
          if (row.style.display !== 'none') {
            count++;
          }
        });
        document.querySelector('.text-danger').innerText = `[ Filtered Employee : ${count}/${rows.length} ]`;
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