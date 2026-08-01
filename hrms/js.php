<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="assets/vendor/libs/hammer/hammer.js"></script>

<script src="assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="assets/js/main.js"></script>

<!-- Page JS -->

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btnExit = document.getElementById("btnExit");
    if (btnExit) {
      btnExit.addEventListener('click', () => {
        window.location.href = 'index.php';
      });
    }

    // Form button shortcuts and dynamic underlines
    const btnShortcuts = [
      { id: 'btnAdd', key: 'a', underlineHtml: '<u>A</u>dd' },
      { id: 'btnEdit', key: 'e', underlineHtml: '<u>E</u>dit' },
      { id: 'btnDelete', key: 'd', underlineHtml: '<u>D</u>elete' },
      { id: 'btnSave', key: 's', underlineHtml: '<u>S</u>ave' },
      { id: 'btnCancel', key: 'c', underlineHtml: '<u>C</u>ancel' },
      { id: 'btnExit', key: 'x', underlineHtml: 'E<u>x</u>it' },
      { id: 'btnSearch', key: 'h', underlineHtml: 'Searc<u>h</u>' },
      { id: 'btnPrint', key: 'p', underlineHtml: '<u>P</u>rint' }
    ];

    btnShortcuts.forEach(item => {
      const btn = document.getElementById(item.id);
      if (btn) {
        const icon = btn.querySelector('i');
        if (icon) {
          btn.innerHTML = icon.outerHTML + item.underlineHtml;
        } else {
          btn.innerHTML = item.underlineHtml;
        }
      }
    });

    // Keyboard shortcuts and arrow navigation for top-level menu items
    document.addEventListener('keydown', (e) => {
      // Ignore shortcuts if the user is typing in an input, textarea, select, or editable element
      const activeEl = document.activeElement;
      const isEditable = activeEl && (
        activeEl.tagName === 'INPUT' ||
        activeEl.tagName === 'TEXTAREA' ||
        activeEl.tagName === 'SELECT' ||
        activeEl.isContentEditable
      );

      // 1. Form Action Shortcuts (Alt + Key) - Allow even inside inputs!
      if (e.altKey && !e.ctrlKey && !e.shiftKey) {
        const key = e.key.toLowerCase();
        const shortcut = btnShortcuts.find(item => item.key === key);
        if (shortcut) {
          const btn = document.getElementById(shortcut.id);
          if (btn && !btn.disabled && btn.offsetWidth > 0 && btn.offsetHeight > 0) {
            e.preventDefault();
            btn.click();
            return;
          }
        }
      }

      // If user is editing text, don't trigger navigation / global menu shortcuts
      if (isEditable) {
        return;
      }

      // 2. Keyboard shortcuts (Ctrl + Key) for top-level menu
      if (e.ctrlKey && !e.altKey && !e.shiftKey) {
        const key = e.key.toLowerCase();
        let handled = false;

        if (key === 'm') {
          triggerMenuToggle('Master');
          handled = true;
        } else if (key === 'a') {
          triggerMenuToggle('Admin');
          handled = true;
        } else if (key === 'p') {
          triggerMenuToggle('Payroll');
          handled = true;
        } else if (key === 'r') {
          triggerMenuToggle('Reports');
          handled = true;
        } else if (key === 'u') {
          triggerMenuToggle('Utility');
          handled = true;
        } else if (key === 'e') {
          triggerMenuToggle('Exit');
          handled = true;
        }

        if (handled) {
          e.preventDefault();
          return;
        }
      }

      // 3. Arrow Key Navigation
      const openTopMenu = document.querySelector('#layout-menu .menu-inner > .menu-item.open');

      // Helper to get visible focusable links inside the currently open top menu
      const getVisibleLinks = () => {
        if (!openTopMenu) return [];
        const links = Array.from(openTopMenu.querySelectorAll('.menu-sub .menu-link'));
        return links.filter(link => link.offsetWidth > 0 && link.offsetHeight > 0);
      };

      if (openTopMenu) {
        const key = e.key;
        const visibleLinks = getVisibleLinks();
        const activeLinkIndex = visibleLinks.indexOf(activeEl);

        if (key === 'ArrowDown') {
          e.preventDefault();
          if (activeLinkIndex === -1) {
            if (visibleLinks.length > 0) visibleLinks[0].focus();
          } else {
            const nextIndex = (activeLinkIndex + 1) % visibleLinks.length;
            visibleLinks[nextIndex].focus();
          }
        } else if (key === 'ArrowUp') {
          e.preventDefault();
          if (activeLinkIndex === -1) {
            if (visibleLinks.length > 0) visibleLinks[visibleLinks.length - 1].focus();
          } else {
            const prevIndex = (activeLinkIndex - 1 + visibleLinks.length) % visibleLinks.length;
            visibleLinks[prevIndex].focus();
          }
        } else if (key === 'ArrowRight') {
          if (activeLinkIndex !== -1) {
            const activeLink = visibleLinks[activeLinkIndex];
            if (activeLink.classList.contains('menu-toggle')) {
              e.preventDefault();
              const parentItem = activeLink.closest('.menu-item');
              if (parentItem && !parentItem.classList.contains('open')) {
                activeLink.click();
                setTimeout(() => {
                  const updatedVisibleLinks = getVisibleLinks();
                  const index = updatedVisibleLinks.indexOf(activeLink);
                  if (index !== -1 && index + 1 < updatedVisibleLinks.length) {
                    updatedVisibleLinks[index + 1].focus();
                  }
                }, 100);
              }
            }
          }
        } else if (key === 'ArrowLeft') {
          if (activeLinkIndex !== -1) {
            const activeLink = visibleLinks[activeLinkIndex];
            const parentSub = activeLink.closest('.menu-sub');
            if (parentSub && parentSub.parentElement.closest('.menu-sub')) {
              e.preventDefault();
              const parentItem = parentSub.closest('.menu-item');
              if (parentItem) {
                const parentToggle = parentItem.querySelector('.menu-link.menu-toggle');
                if (parentToggle) {
                  parentToggle.click();
                  parentToggle.focus();
                }
              }
            }
          }
        }
      } else {
        // If no menu is open, but a top-level menu link has focus
        const isTopLevelLink = activeEl && activeEl.closest('.menu-inner') && !activeEl.closest('.menu-sub');
        if (isTopLevelLink && e.key === 'ArrowDown') {
          e.preventDefault();
          activeEl.click();
          setTimeout(() => {
            const newlyOpenedMenu = document.querySelector('#layout-menu .menu-inner > .menu-item.open');
            if (newlyOpenedMenu) {
              const links = Array.from(newlyOpenedMenu.querySelectorAll('.menu-sub .menu-link'));
              const visible = links.filter(link => link.offsetWidth > 0 && link.offsetHeight > 0);
              if (visible.length > 0) {
                visible[0].focus();
              }
            }
          }, 100);
        }
      }
    });

    function triggerMenuToggle(menuName) {
      const links = document.querySelectorAll('#layout-menu .menu-inner > .menu-item > .menu-link');
      links.forEach(link => {
        const div = link.querySelector('div[data-i18n]');
        if (div && div.getAttribute('data-i18n').trim().toLowerCase() === menuName.toLowerCase()) {
          link.click();
          // Focus the toggle link
          link.focus();
        }
      });
    }
  });
</script>