<?php
// Sample data for the mock test results (In a real-world scenario, you would retrieve this data from a database or form submission)
$questions = [
    "What is the capital of India?" => "Delhi",
    "Who is the President of India?" => "Droupadi Murmu",
    "Which is the largest continent?" => "Asia"
];

// User's answers (for demonstration purposes, these would be submitted from the quiz form)
$user_answers = [
    "What is the capital of India?" => "Delhi",
    "Who is the President of India?" => "Narendra Modi", // Incorrect
    "Which is the largest continent?" => "Asia"
];

// Calculate the result (Correct answers count)
$correct_answers = 0;
foreach ($questions as $question => $answer) {
    if ($user_answers[$question] === $answer) {
        $correct_answers++;
    }
}

$total_questions = count($questions);
$incorrect_answers = $total_questions - $correct_answers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .result-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }
        button {
            padding: 10px 20px;
            font-size: 1rem;
            margin: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        canvas {
            margin-top: 30px;
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Test Result</h2>
    <p>You answered <?php echo $correct_answers; ?> out of <?php echo $total_questions; ?> questions correctly.</p>

    <!-- Button to show all answers -->
    <button id="show-answers">Show All Questions and Answers</button>

    <!-- Container to display all answers -->
    <div id="answers-preview" style="display: none;">
        <h3>Preview All Questions and Answers</h3>
        <table>
            <tr>
                <th>Question</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
            </tr>
            <?php foreach ($questions as $question => $answer): ?>
                <tr>
                    <td><?php echo $question; ?></td>
                    <td><?php echo $user_answers[$question]; ?></td>
                    <td><?php echo $answer; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Pie chart to visualize results -->
    <canvas id="resultChart" width="300" height="300"></canvas>
</div>

<script>
    // JavaScript to toggle the visibility of the answers preview
    document.getElementById('show-answers').onclick = function() {
        var answersPreview = document.getElementById('answers-preview');
        if (answersPreview.style.display === 'none') {
            answersPreview.style.display = 'block';
        } else {
            answersPreview.style.display = 'none';
        }
    };

    // Pie chart for results using Chart.js
    var ctx = document.getElementById('resultChart').getContext('2d');
    var resultChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Correct', 'Incorrect'],
            datasets: [{
                label: 'Test Results',
                data: [<?php echo $correct_answers; ?>, <?php echo $incorrect_answers; ?>],
                backgroundColor: ['#4CAF50', '#f44336'],
                borderColor: ['#4CAF50', '#f44336'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var percentage = Math.round(tooltipItem.raw / <?php echo $total_questions; ?> * 100);
                            return tooltipItem.label + ': ' + percentage + '%';
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>