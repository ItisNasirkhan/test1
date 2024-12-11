<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akhi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('home/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @include('home.header')
     
       @yield('content')
    
    @include('home.footer')

  
    <script src="{{ asset('home/script.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        var searchTerm = $(this).val();

        // If the search term is not empty, make the Ajax request
        if (searchTerm.length > 0) {
            $.ajax({
                url: '{{ route("search") }}',
                type: 'GET',
                data: {
                    searchTerm: searchTerm
                },
                success: function(data) {
                    var resultHTML = '';
                    $('#search-results').empty();  // Clear previous results

                    // Loop through the results and create list items
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            resultHTML += '<li>' + item.product_name + ' (' + item.category_name + ')</li>';
                        });
                        $('#search-results').html(resultHTML);
                        $('#search-results').show();  // Show the dropdown
                    } else {
                        $('#search-results').hide();  // Hide the dropdown if no results
                    }
                }
            });
        } else {
            $('#search-results').hide();  // Hide the dropdown if the search term is empty
        }
    });

    // Hide results when clicking outside the search bar
    $(document).click(function(event) {
        if (!$(event.target).closest('#search').length) {
            $('#search-results').hide();
        }
    });
});
</script>
</body>
</html>