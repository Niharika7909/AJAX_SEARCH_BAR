<?php
// Simulating a database of search suggestions
$database = [
    'apple',
    'banana',
    'cherry',
    'date',
    'grape',
    'kiwi',
    'lemon',
    'mango',
    'orange',
    'pear',
    'pineapple',
    'strawberry',
    'watermelon'
];

// Get the query parameter from the GET request
$query = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

// Filter the database for matches based on the query
$results = [];
foreach ($database as $item) {
    if (strpos(strtolower($item), $query) !== false) {
        $results[] = $item;
    }
}

// Return the results as a plain-text response (comma-separated)
echo implode(',', $results);
