<?php
$pageTitle = "Change User Password - Payroll System";
include 'header.php';
?>

<!-- Content wrapper -->
<div class="container-fluid flex-grow-1 container-p-y position-relative" style="min-height: calc(100vh - 120px);">

  <!-- Draggable Floating Dialog Card -->
  <div id="draggableCard" class="card shadow-lg border-1"
    style="max-width: 450px; width: 100%; border-radius: 8px !important; border: 1px solid #c9c8cc !important; background-color: #ffffff; position: absolute; opacity: 0; transition: opacity 0.15s ease-in-out; z-index: 1;">

    <!-- Dialog Header (Acts as Drag Handle) -->
    <div class="card-header p-2 px-3 text-white d-flex align-items-center justify-content-between"
      style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 7px !important; border-top-right-radius: 7px !important; border-bottom: 1px solid #104f9b; user-select: none;">
      <h6 class="m-0 text-white fw-bold d-flex align-items-center" style="font-size: 14px;">
        <i class="ti ti-lock me-2" style="font-size: 16px;"></i>Change User Password
      </h6>
      <span class="badge bg-danger px-2 py-1" style="font-size: 10px; font-weight: 600;"># Press [Esc] For Exit</span>
    </div>

    <div class="card-body p-3 bg-white">
      <form id="changePasswordForm">
        <!-- Classic Group Box using Fieldset/Legend -->
        <fieldset class="border p-3 rounded mb-3"
          style="border-color: #a3b8cc !important; background-color: #e8f0fe !important;">
          <legend class="float-none w-auto px-2 fw-bold text-white bg-danger rounded"
            style="font-size: 12px; margin-bottom: 5px; padding: 2px 10px;">
            User Authentication [Change User Password]
          </legend>

          <div class="row g-2 py-1">
            <div class="col-12">
              <div class="row mb-2 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Old Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control form-control-sm bg-white" name="old_password"
                    id="old_password"
                    style="font-size: 11px; border: 1px solid #135ca3 !important; border-radius: 2px !important;"
                    required />
                </div>
              </div>

              <div class="row mb-2 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">New Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control form-control-sm bg-white" name="new_password"
                    id="new_password"
                    style="font-size: 11px; border: 1px solid #135ca3 !important; border-radius: 2px !important;"
                    required />
                </div>
              </div>

              <div class="row mb-2 align-items-center">
                <label class="col-sm-4 col-form-label col-form-label-sm text-end fw-semibold text-dark-blue"
                  style="font-size: 11px;">Retype Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control form-control-sm bg-white" name="retype_password"
                    id="retype_password"
                    style="font-size: 11px; border: 1px solid #135ca3 !important; border-radius: 2px !important;"
                    required />
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center gap-2 mt-2">
            <button type="submit" id="btnChangePassword" class="btn btn-xs btn-outline-secondary px-3 py-1 bg-white"
              style="font-size: 11px; height: 28px; border-color: #a3b8cc !important;">
              <i class="ti ti-lock-open me-1 text-success"></i>Change Password
            </button>
            <button type="button" id="btnExit" class="btn btn-xs btn-outline-secondary px-3 py-1 bg-white"
              style="font-size: 11px; height: 28px; border-color: #a3b8cc !important;">
              <i class="ti ti-logout me-1 text-danger"></i>Exit
            </button>
          </div>
        </fieldset>

        <!-- Backup widget block matching the screenshot layout -->
        <div class="d-flex align-items-center justify-content-center gap-2 p-2 border rounded"
          style="border-color: #a3b8cc !important; background-color: #f8f9fa;">
          <input type="text" class="form-control form-control-sm bg-white" id="backup_path" placeholder="" readonly
            style="font-size: 11px; max-width: 200px; border: 1px solid #135ca3 !important; border-radius: 2px !important;" />
          <button type="button" id="btnBackup" class="btn btn-xs btn-outline-secondary px-3 py-1 bg-white"
            style="font-size: 11px; height: 28px; border-color: #a3b8cc !important;">
            <i class="ti ti-database me-1 text-primary"></i>Backup
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
<!--/ Content -->

<style>
  .text-dark-blue {
    color: #135ca3 !important;
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

    // Esc key press handling to exit
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = 'index.php';
      }
    });

    document.getElementById("btnExit").addEventListener('click', () => {
      window.location.href = 'index.php';
    });

    // Handle Form Submit
    const form = document.getElementById("changePasswordForm");
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const oldPass = document.getElementById("old_password").value;
      const newPass = document.getElementById("new_password").value;
      const retypePass = document.getElementById("retype_password").value;

      if (newPass !== retypePass) {
        alert("New Password and Retype Password do not match!");
        return;
      }

      const formData = new FormData();
      formData.append('old_password', oldPass);
      formData.append('new_password', newPass);

      fetch('actions/change-password-action.php', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(response => {
          alert(response.message);
          if (response.status === 'success') {
            form.reset();
          }
        })
        .catch(err => {
          console.error("Error changing password: ", err);
          alert("An error occurred. Please try again.");
        });
    });

    // Simple placeholder action for Backup
    document.getElementById("btnBackup").addEventListener('click', () => {
      alert("Database backup functionality has been initiated!");
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

<?php
include 'footer.php';
?>