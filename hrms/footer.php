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

<?php include 'js.php'; ?>
</body>

</html>