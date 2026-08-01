<div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->
</div>

<!--/ Layout container -->
</div>
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>

<!-- Fixed Status Bar at the bottom -->
<div class="fixed-bottom bg-white border-top d-flex align-items-center justify-content-between px-3 py-1 shadow-sm"
  style="z-index: 1050; min-height: 35px; font-size: 13px; border-color: #d9dee3 !important;">
  <div class="d-flex align-items-center gap-3">
    <span class="text-muted"><i class="ti ti-server me-1" style="font-size: 15px;"></i>Server:
      <?php echo $_SERVER['SERVER_ADDR'] ?? '127.0.0.1'; ?></span>
    <span class="text-muted">|</span>
    <span class="text-muted"><i class="ti ti-database me-1" style="font-size: 15px;"></i>Database:
      <?php echo defined('DB_DATABASE') ? DB_DATABASE : 'radhe_hrms'; ?></span>
  </div>

  <div class="text-center text-muted" style="font-size: 13px;">
    © <?php echo date('Y'); ?> , made with ❤️ by <a href="https://www.oceaninfotech.co.in/" target="_blank"
      class="text-primary fw-semibold" style="text-decoration: none;">Ocean Infotech</a>
  </div>

  <div class="d-flex align-items-center gap-3">
    <span class="fw-semibold text-primary"><i class="ti ti-user me-1" style="font-size: 15px;"></i>Logged In:
      <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></span>
    <span class="text-muted">|</span>
    <span class="fw-semibold text-success"><i class="ti ti-building me-1" style="font-size: 15px;"></i>Company:
      <?php echo htmlspecialchars($_SESSION['selected_company_name'] ?? 'None'); ?></span>
    <span class="text-muted">|</span>
    <span class="text-muted"><i class="ti ti-calendar me-1" style="font-size: 15px;"></i>Date:
      <?php echo date('d/m/Y'); ?></span>
  </div>
</div>

<style>
  body {
    padding-bottom: 42px !important;
  }
</style>



<!-- Calculator Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true"
  data-bs-backdrop="false" style="pointer-events: none; z-index: 9999;">
  <div class="modal-dialog modal-sm"
    style="pointer-events: auto; width: 320px; max-width: 320px; position: absolute; top: 100px; left: 100px; margin: 0;">
    <div class="modal-content border shadow-lg win11-calc"
      style="border-radius: 8px; border: 1px solid #d9d9d9 !important; background-color: #f3f3f3;">

      <!-- Windows 11 Titlebar -->
      <div class="modal-header text-dark p-2 px-3 drag-handle win11-titlebar"
        style="cursor: move; user-select: none; border-bottom: none; display: flex; justify-content: space-between; align-items: center;">
        <div class="d-flex align-items-center" style="font-size: 12px; color: #1a1a1a;">
          <i class="ti ti-calculator me-2 text-primary" style="font-size: 14px;"></i>
          <span>Calculator</span>
        </div>
        <div class="win11-title-controls d-flex gap-1">
          <button type="button" style="background: transparent; border: none; font-size: 12px; color: #333;"
            disabled>−</button>
          <button type="button" style="background: transparent; border: none; font-size: 11px; color: #333;"
            disabled>▢</button>
          <button type="button" class="win11-btn-close" data-bs-dismiss="modal" aria-label="Close"
            style="background: transparent; border: none; font-size: 14px; color: #333; cursor: pointer; border-radius: 4px; padding: 0 6px;">✕</button>
        </div>
      </div>

      <!-- Win11 Menu & Standard Title -->
      <div class="win11-menu-row d-flex align-items-center justify-content-between px-3 py-1">
        <div class="d-flex align-items-center gap-2">
          <i class="ti ti-menu-2" style="font-size: 16px; cursor: pointer; color: #333;"></i>
          <span style="font-size: 18px; font-weight: 600; color: #1a1a1a;">Standard</span>
          <i class="ti ti-app-window" style="font-size: 12px; cursor: pointer; color: #666; margin-left: 2px;"></i>
        </div>
        <i class="ti ti-history" style="font-size: 16px; cursor: pointer; color: #333;"></i>
      </div>

      <!-- Display container -->
      <div class="win11-display-container text-end px-3 py-1 mt-2">
        <div id="calcDisplay" class="win11-display-val"
          style="font-size: 40px; font-weight: 600; color: #1a1a1a; min-height: 55px; line-height: 55px; font-family: 'Segoe UI', -apple-system, sans-serif;">
          0</div>
      </div>

      <!-- Memory Row -->
      <div class="win11-memory-row d-flex justify-content-between px-3 py-1 text-muted"
        style="font-size: 11px; user-select: none;">
        <span>MC</span>
        <span>MR</span>
        <span>M+</span>
        <span>M-</span>
        <span>MS</span>
        <span>M▾</span>
      </div>

      <!-- Win11 Keypad Grid -->
      <div class="modal-body p-2 pt-1">
        <div class="row g-1">
          <!-- Row 1 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="%">%</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="CE">CE</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="C">C</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="Backspace">⌫</button></div>

          <!-- Row 2 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="1/x">¹/x</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="x2">x²</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="sqrt">²√x</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="/">÷</button></div>

          <!-- Row 3 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="7">7</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="8">8</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="9">9</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="*">✕</button></div>

          <!-- Row 4 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="4">4</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="5">5</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="6">6</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="-">−</button></div>

          <!-- Row 5 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="1">1</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="2">2</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="3">3</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-op calc-btn"
              data-val="+">+</button></div>

          <!-- Row 6 -->
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="+-">+/-</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val="0">0</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn calc-btn" data-val=".">.</button></div>
          <div class="col-3"><button type="button" class="btn w-100 win11-btn win11-btn-eq calc-btn"
              data-val="=">=</button></div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  /* Win11 custom style overwrites */
  .win11-calc {
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
  }

  .win11-btn-close:hover {
    background-color: #e81123 !important;
    color: #fff !important;
  }

  .win11-btn {
    border: 1px solid #e5e5e5 !important;
    border-radius: 4px !important;
    background-color: #ffffff !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    height: 42px !important;
    color: #1a1a1a !important;
    padding: 0 !important;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .win11-btn:hover {
    background-color: #f6f6f6 !important;
    border-color: #cccccc !important;
  }

  .win11-btn:active {
    background-color: #ececec !important;
  }

  .win11-btn-op {
    background-color: #f9f9f9 !important;
    font-weight: 400 !important;
  }

  .win11-btn-op:hover {
    background-color: #f3f3f3 !important;
  }

  .win11-btn-eq {
    background-color: #555730 !important;
    color: #ffffff !important;
    border: none !important;
    font-size: 18px !important;
  }

  .win11-btn-eq:hover {
    background-color: #4a4c2a !important;
  }

  .win11-memory-row span {
    padding: 4px 6px;
    cursor: default;
    border-radius: 3px;
  }
</style>

<?php include 'js.php'; ?>
</body>

</html>