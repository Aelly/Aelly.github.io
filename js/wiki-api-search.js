$(document).ready(function() {
    //When search button is clicked
    $('#search-button').click(function() {
        //Get search input
        var searchTerm = $('#search-input').val();
        
        var url = "https://en.wikipedia.org/w/api.php?action=opensearch&format=json&search=" + searchTerm + "&origin=*";

        $.ajax({
            type: "GET",
            url: url,
            async: true,
            dataType: "json",
            success: function(data) {
                $('#output').empty();
                for (var i = 0; i < data[1].length; i++) {
                    $('#output').append("<li><a href=" + data[3][i] + " target=" + '"' + "_blank" + '">' + data[1][i] + "</a> <p>" + data[2][i] + "</p></li>");
                }

            },
            error: function(error) {
                alert("Error");
                console.log(error);
            }
        });
    });
});
