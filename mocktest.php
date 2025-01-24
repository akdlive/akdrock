<?php
session_start();

// Hardcoded Geography questions for the mock test
$questions = [
    [
        "question" => "What is the capital of France?",
        "options" => ["Paris", "Berlin", "Madrid", "Rome"],
        "answer" => 0 // index of the correct option
    ],
    [
        "question" => "Which continent is Australia part of?",
        "options" => ["Asia", "Europe", "Oceania", "Africa"],
        "answer" => 2
    ],
    // Add more questions as needed
];

// Get the current question number from the URL
$question_number = isset($_GET['question_number']) ? $_GET['question_number'] : 0;

// Check if the user has answered the questions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store the answer in session
    $_SESSION['answers'][$question_number] = $_POST['answer'];
    
    // Check if it's the last question
    if ($question_number < count($questions) - 1) {
        $next_question = $question_number + 1;
        header("Location: mocktest.php?category=geography&question_number=$next_question");
        exit;
    } else {
        // Redirect to result page after the last question
        header("Location: result.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Test</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Container for the form */
        .mocktest-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        /* Heading */
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Question Info */
        p {
            font-size: 1rem;
            margin-bottom: 30px;
            color: #777;
        }

        /* Question and Option Styling */
        form {
            margin-bottom: 20px;
        }

        h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            font-size: 1rem;
            margin-bottom: 10px;
            cursor: pointer;
            color: #555;
        }

        input[type="radio"] {
            margin-right: 15px;
            vertical-align: middle;
        }

        /* Button Styling */
        button {
            padding: 12px 25px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .mocktest-container {
                padding: 20px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="mocktest-container">
        <h2>Geography Mock Test</h2>
        <p>Question <?php echo $question_number + 1; ?> of <?php echo count($questions); ?></p>
        
        <form method="POST">
            <h3><?php echo $questions[$question_number]['question']; ?></h3>
            <?php foreach ($questions[$question_number]['options'] as $index => $option): ?>
                <label>
                    <input type="radio" name="answer" value="<?php echo $index; ?>" required>
                    <?php echo $option; ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Next</button>
        </form>
    </div>
</body>
</html>