<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$pageTitle = "Home - Payroll System";
include 'header.php';

$showModal = (!isset($_SESSION['selected_company_id']) || intval($_SESSION['selected_company_id']) <= 0 || isset($_GET['change_company'])) ? 'true' : 'false';
?>

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <!-- Place holder or home screen dashboard elements if any -->
</div>
<!--/ Content -->

<!-- Company Selection Modal -->
<div class="modal fade" id="companySelectModal" tabindex="-1" data-bs-backdrop="static"
  aria-labelledby="companySelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content border shadow-lg"
      style="border-radius: 6px !important; border-color: #a3b8cc !important;">
      <div class="modal-header text-white p-2 px-3"
        style="background: linear-gradient(90deg, #135ca3 0%, #00a2e8 100%); border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom: 1px solid #104f9b;">
        <h6 class="modal-title fw-bold text-white d-flex align-items-center" id="companySelectModalLabel"
          style="font-size: 13px; margin: 0;">
          <i class="ti ti-building me-2" style="font-size: 15px;"></i>Select Company
        </h6>
      </div>
      <div class="modal-body p-3" style="background-color: #e8f0fe !important;">
        <div class="table-responsive bg-white rounded p-2 border"
          style="max-height: 300px; overflow-y: auto; border-color: #a3b8cc !important;">
          <table class="table table-sm table-striped table-bordered table-hover mb-0" style="font-size: 11px;">
            <thead class="table-light">
              <tr>
                <th style="width: 80px;">Code</th>
                <th>Company Name</th>
              </tr>
            </thead>
            <tbody id="companySelectBody">
              <tr>
                <td colspan="2" class="text-center text-muted py-2">Loading companies...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const showModal = <?php echo $showModal; ?>;

    // Redirect if Escape key is pressed
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.location.href = '../dashboard.php';
      }
    });

    // Listen for modal hide event
    const modalEl = document.getElementById("companySelectModal");
    modalEl.addEventListener('hide.bs.modal', () => {
      window.location.href = '../dashboard.php';
    });

    if (showModal) {
      fetch('actions/company-master-action.php?action=list')
        .then(res => res.json())
        .then(response => {
          if (response.status === 'success') {
            const companyRecords = response.data;
            if (companyRecords.length > 0) {
              const selectBody = document.getElementById("companySelectBody");
              selectBody.innerHTML = "";
              companyRecords.forEach((rec) => {
                const tr = document.createElement("tr");
                tr.style.cursor = "pointer";
                tr.innerHTML = `<td><strong>${rec.company_code || ''}</strong></td><td>${rec.company_name || ''}</td>`;
                tr.addEventListener('click', () => {
                  fetch(`actions/company-master-action.php?action=select&id=${rec.id}`)
                    .then(r => r.json())
                    .then(selResponse => {
                      if (selResponse.status === 'success') {
                        window.location.href = 'index.php';
                      } else {
                        alert("Error selecting company: " + selResponse.message);
                      }
                    })
                    .catch(err => console.error("Error setting active company session: ", err));
                });
                selectBody.appendChild(tr);
              });

              const selectModal = new bootstrap.Modal(modalEl);
              selectModal.show();
            } else {
              // If no company exists, redirect to company master to create one
              window.location.href = 'company-master.php';
            }
          }
        })
        .catch(err => console.error("Error fetching companies: ", err));
    }
  });
</script>

<?php
include 'footer.php';
?>