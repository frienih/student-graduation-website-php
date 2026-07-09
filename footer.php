<!-- bagian footer -->
<footer class="footer-user">
    <div class="footer-container">
		 <p> Copyright &copy; 2024 - <?= htmlspecialchars($d->nama) ?></p>
    </div>
</footer>

<script type="text/javascript">
    var mobileMenu = document.getElementById("mobileMenu");

    function showMobileMenu() {
        if (mobileMenu) {
            mobileMenu.style.display = "block";
        }
    }

    function hideMobileMenu() {
        if (mobileMenu) {
            mobileMenu.style.display = "none";
        }
    }

    document.addEventListener('click', function(event) {
        var isClickInside = mobileMenu && mobileMenu.contains(event.target);
        if (!isClickInside && mobileMenu) {
            hideMobileMenu();
        }
    });
</script>
</body>
</html>
