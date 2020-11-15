$(document).ready(function() {
    //alert("hi");
    $("#selectAllPosts").click(function(event) {
        if (this.checked) {
            $(".selectPost").each(function() {
                    this.checked = true;
            });
        } else {
            $(".selectPost").each(function() {
                    this.checked = false;
            });
        }
    });
});
