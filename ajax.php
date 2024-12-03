<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocomplete Search Bar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- Google Font (Poppins) -->
    <style>
        /* Global styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container for the title and search bar */
        .container {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Title */
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Styling for the search bar input */
        .search-container {
            width: 100%;
            position: relative;
        }

        #search-bar {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        /* Focus effect for the search bar */
        #search-bar:focus {
            border-color: #007bff;
        }

        /* Styling for the suggestions dropdown */
        #suggestions {
            width: 100%;
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: white;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        /* Styling for each suggestion item */
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }

        /* Hover effect for the suggestions */
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }

        /* No results found styling */
        .no-results {
            padding: 10px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Autocomplete Search Bar</h2>
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Search..." autocomplete="off">
            <div id="suggestions"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#search-bar').on('input', function() {
                var query = $(this).val();

                // Send an AJAX request if the query is not empty
                if(query.length > 0) {
                    $.ajax({
                        url: 'search.php',  // Server-side script
                        type: 'GET',
                        data: { query: query },
                        success: function(data) {
                            console.log(data);  // Output the plain text result to the console

                            // Show suggestions
                            var suggestions = $('#suggestions');
                            suggestions.empty().show();  // Clear previous suggestions

                            // Check if there are suggestions
                            if(data.length > 0) {
                                // Create suggestion items
                                var items = data.split(',');
                                items.forEach(function(item) {
                                    var suggestionItem = $('<div class="suggestion-item"></div>')
                                        .text(item)
                                        .on('click', function() {
                                            $('#search-bar').val(item);  // Set the clicked suggestion in the search bar
                                            suggestions.hide();  // Hide the suggestions
                                        });
                                    suggestions.append(suggestionItem);
                                });
                            } else {
                                suggestions.append('<div class="no-results">No results found</div>');
                                suggestions.show();  // Show the no-results message
                            }
                        }
                    });
                } else {
                    $('#suggestions').hide();  // Hide suggestions if the input is empty
                }
            });
        });
    </script>

</body>
</html>
