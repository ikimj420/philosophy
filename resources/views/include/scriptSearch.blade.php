<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#search").keyup(function() {
            var output = $('#search').val();
            if (output == "") {
                $("#display").html("");
            }
            else {
                $.ajax({
                    type: "GET",
                    url: "/search",
                    data: {
                        search: output
                    },
                    success: function(html) {
                        $("#display").html(html).show();
                    }
                });
            }
        });
    });
</script>
