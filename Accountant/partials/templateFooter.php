</div>

<script type="text/javaScript">

    let error = document.querySelector(".formWrapper .errorMsg");
    let notification = document.getElementById("updateNofication");
    error.style.display = "block";  
    function hideErrorMsg(){
            error.style.display = "none";
            notification.style.display = "none";
    }



    function showBox(){
        var contentBox = document.querySelector(".wrapper .content");
        contentBox.style.display = "block";
        
    }
  
</script>
</body>

</html>