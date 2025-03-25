
<?php
$page_name_footer = isset($page_name_footer) ? $page_name_footer : ''; 
?>
<div class="back-to-top" id="backToTop" onclick="scrollToTop()">
    <i class="fas fa-arrow-up"></i>
</div>
<script src="https://js.stripe.com/v3/"></script>
    <script src="../script/java.js"></script>
    <script src="../script/script.js"></script>

<footer class="footer">
    <div class="footer-links">
        <a href="about.php" class="footer-link <?php echo ($page_name_footer == 'about') ? 'active' : ''; ?>">About Us</a>
        <a href="privacy.php" class="footer-link <?php echo ($page_name_footer == 'privacy') ? 'active' : ''; ?>">Terms & Privacy</a>
        <a href="fao.php" class="footer-link <?php echo ($page_name_footer == 'fao') ? 'active' : ''; ?>">FAQs</a>
        <a href="contact.php" class="footer-link <?php echo ($page_name_footer == 'contact') ? 'active' : ''; ?>">Contact</a>
    </div>
    <div class="copyright">
        © 2025 Post Bus Malawi. All rights reserved.
    </div>
</footer>

<script>
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
