<footer class="w3-container w3-dark-grey" style="padding:32px">
    <a href="#" class="w3-button w3-black w3-padding-large w3-margin-bottom"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
    // Toggle between hiding and showing blog replies/comments
    document.getElementById("myBtn").click();
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function likeFunction(x) {
        x.style.fontWeight = "bold";
        x.innerHTML = "✓ Liked";
    }
</script>

</body>
</html>