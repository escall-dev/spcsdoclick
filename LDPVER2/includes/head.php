<?php
// Use constants if defined (MVC context), otherwise calculate relative paths (Legacy context)
if (defined('PUBLIC_ROOT')) {
    $path_to_public = PUBLIC_ROOT;
} else {
    $current_page_dir = basename(dirname($_SERVER['PHP_SELF']));
    // Default path logic
    if ($current_page_dir === 'public') {
        $path_to_public = '';
    } elseif ($current_page_dir === 'user' || $current_page_dir === 'hr' || $current_page_dir === 'pages') {
        $path_to_public = '../public/';
    } else {
        $path_to_public = 'public/';
    }
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<meta name="theme-color" content="#0f4c75">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Base Styles fallback -->
<link rel="stylesheet" href="<?php echo $path_to_public; ?>css/base/variables.css?v=<?php echo time(); ?>">

<!-- Notification Styles -->
<link rel="stylesheet" href="<?php echo $path_to_public; ?>css/layout/notifications.css?v=<?php echo time(); ?>">

<!-- Centralized User Design System -->
<link rel="stylesheet" href="<?php echo $path_to_public; ?>css/layout/sidebar.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="<?php echo $path_to_public; ?>css/user.css?v=<?php echo time(); ?>">

<!-- Global Notification JS -->
<script src="<?php echo $path_to_public; ?>js/notifications.js"></script>
<!-- Global UI Core JS -->
<script src="<?php echo $path_to_public; ?>js/ui-core.js"></script>

<?php if (isset($_SESSION['toast'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast(
                "<?php echo htmlspecialchars($_SESSION['toast']['title']); ?>",
                "<?php echo htmlspecialchars($_SESSION['toast']['message']); ?>",
                "<?php echo htmlspecialchars($_SESSION['toast']['type']); ?>"
            );
        });
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>

<!-- Prevent Sidebar Flash/Animation (Must be in head) -->
<script>
    (function () {
        const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (collapsed && window.innerWidth > 992) {
            document.documentElement.classList.add('sidebar-initial-collapsed');
        }
    })();
</script>

<!-- Global Capslock Input Listener -->
<script>
    document.addEventListener('input', function (e) {
        const target = e.target;
        if (target.tagName === 'INPUT' || target.tagName === 'TEXTAREA') {
            const type = target.getAttribute('type');
            const name = target.getAttribute('name') || '';
            const id = target.getAttribute('id') || '';
            
            if (type === 'password' || type === 'email') {
                return;
            }
            if (
                name.toLowerCase().includes('email') || 
                id.toLowerCase().includes('email') || 
                name.toLowerCase().includes('password') || 
                id.toLowerCase().includes('password') || 
                name.toLowerCase().includes('gmail') ||
                id.toLowerCase().includes('gmail')
            ) {
                return;
            }
            
            const start = target.selectionStart;
            const end = target.selectionEnd;
            target.value = target.value.toUpperCase();
            if (start !== null && end !== null) {
                target.setSelectionRange(start, end);
            }
        }
    });
</script>