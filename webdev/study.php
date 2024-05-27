<?php
$setcode = $_GET['setcode'];
$mode = $_GET['mode'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cards from the database based on the set code
$sql = "SELECT question, answer, memorized FROM cards WHERE setcode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $setcode);
$stmt->execute();
$result = $stmt->get_result();

$cards = [];
while ($row = $result->fetch_assoc()) {
    $cards[] = $row;
}

$stmt->close();
$conn->close();

// Implement different functionality based on the study mode
switch ($mode) {
    case 'flashcards':
        // Implement flashcards mode functionality
        $modeContent = json_encode($cards);
        break;
    case 'multiple_choice':
        // Implement multiple choice mode functionality
        $modeContent = json_encode($cards);
        break;
    case 'writing':
        // Implement writing mode functionality
        // Replace with actual implementation
        break;
    case 'match_list':
        // Implement match list mode functionality
         // Replace with actual implementation
        break;
    default:
        // Handle invalid study mode
        echo "Invalid study mode selected.";
        exit;
}
?>
<?php
$setcode = $_GET['setcode'];
$mode = $_GET['mode'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cards from the database based on the set code
$sql = "SELECT question, answer, memorized FROM cards WHERE setcode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $setcode);
$stmt->execute();
$result = $stmt->get_result();

$cards = [];
while ($row = $result->fetch_assoc()) {
    $cards[] = $row;
}

$stmt->close();
$conn->close();

// Implement different functionality based on the study mode
switch ($mode) {
    case 'flashcards':
        $modeContent = json_encode($cards);
        break;
        case 'multiple_choice':
            $modeContent = json_encode($cards);
            break;
    case 'writing':
        $modeContent = json_encode($cards);
        break;
    case 'match_list':
       $modeContent = json_encode($cards);
        break;
    default:
        echo "Invalid study mode selected.";
        exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FlashSet</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #D0D4CA;
}

.navbar {
  background-color:  #3559E0; /* Navbar background color */
}

.navbar-brand, .navbar-text {
  color: white; /* Text color */
}

.nav-link {
  color: white !important; /* Anchor link color */
}

.nav-link:hover {
  color: #ccc !important; /* Anchor link color on hover */
}

.container {
  margin-top: 20px;
}

.flashcard {
  width: 100%;
  max-width: 600px;
  height: 400px;
  margin: 0 auto;
  perspective: 1000px;
}

.flashcard-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}

.flashcard.is-flipped .flashcard-inner {
  transform: rotateY(180deg);
}

.flashcard-front, .flashcard-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-size: 24px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
}

.flashcard-front {
  background-color: #fff;
}

.flashcard-back {
  background-color: #f9f9f9;
  transform: rotateY(180deg);
}

.flashcard-label {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.buttons {
  text-align: center;
  margin-top: 20px;
}

.buttons button {
  margin: 0 10px;
}

.form-check-input {
position: relative;
  margin-top: 0.8rem; /* Adjust margin to lower the radio button */
  outline: 2px solid black; /* Green outline for input fields on focus */
  left: 20px;
}

.form-check-label {
    margin-top: 0.5rem;
  margin-left: 20px; /* Add margin-left to separate the label from the radio button */
  display: inline-block;
  vertical-align: middle; /* Align the label with the middle of the radio button */
}

#multiple-choice-container {
  background-color: #E3E1D9; /* Light blue background color */
  padding: 20px; /* Add some padding for spacing */
  border-radius: 10px; /* Rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add some shadow for better aesthetics */
}
#question-container {
    background-color: #C7C8CC;
    padding: 10px;
    border-radius: 10px; /* Rounded corners */
}
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.card {
    width: 100%;
    max-width: 300px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.card.selected {
    background-color: #f0f0f0;
}

.card.matched {
    background-color: lightgreen;
}

.buttons {
    margin-top: 20px;
}
.selected {
    background-color: green;
    color: white;
}

.selected-wrong {
    background-color: red;
    color: white;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="flashset.php?setcode=<?php echo $setcode; ?>">Flash Flow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Flash card -->
<div class="container">
  <?php if ($mode == 'flashcards'): ?>
  <div class="flashcard" id="flashcard">
    <div class="flashcard-inner">
      <div class="flashcard-front" id="flashcard-front">
        <div class="flashcard-label">Question</div>
        <div id="question-content"></div>
      </div>
      <div class="flashcard-back" id="flashcard-back">
        <div class="flashcard-label">Answer</div>
        <div id="answer-content"></div>
      </div>
    </div>
  </div>

  <div class="buttons">
    <button class="btn btn-secondary" id="prev-card">Previous Card</button>
    <button class="btn btn-warning" id="not-sure">Not Sure</button>
    <button class="btn btn-success" id="got-it">Got It</button>
  </div>
  <?php endif; ?>
</div>
<!-- Multiple Choice Mode Container -->
<?php if ($mode == 'multiple_choice'): ?>
<div class="container" id="multiple-choice-container">
    <div id="question-container"></div>
    <div id="answers-container"></div>
    <div class="buttons">
      <button class="btn btn-secondary" id="next-question">Next Question</button>
    </div>
  <?php endif; ?>
</div>
<!-- Writing Mode Container -->
<?php if ($mode == 'writing'): ?>
<div class="container" id="writing-container">
    <div id="question-container"></div>
    <div class="form-group">
        <label for="user-answer">Your Answer:</label>
        <input type="text" class="form-control" id="user-answer">
    </div>
    <div class="buttons">
        <button class="btn btn-primary" id="submit-answer">Submit Answer</button>
    </div>
</div>
<?php endif; ?>
<!-- Match List Mode Container -->
<?php if ($mode == 'match_list'): ?>
<div class="container" id="match-list-container">
    <div class="row">
        <div class="col-md-6" id="questions-column">
            <h4>Questions</h4>
            <div id="questions-list" class="list-group"></div>
        </div>
        <div class="col-md-6" id="answers-column">
            <h4>Answers</h4>
            <div id="answers-list" class="list-group"></div>
        </div>
    </div>
    <div id="message-container" class="text-center mt-3"></div>
</div>
<?php endif; ?>




<!-- Summary Modal -->
<div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="summaryModalLabel">Session Summary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Total Correct: <span id="totalCorrect">0</span></p>
        <p>Total Incorrect: <span id="totalIncorrect">0</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="repeatCards">Repeat</button>
        <button type="button" class="btn btn-primary" id="finishSession">Finish</button>
      </div>
    </div>
  </div>
</div>

<script>
  const mode = "<?php echo $mode; ?>";
 
  if (mode === 'flashcards') {
    const setcode = "<?php echo $setcode; ?>";
    let cards = <?php echo $modeContent; ?>;
    let currentCardIndex = 0;
    const flashcard = document.getElementById('flashcard');
    const flashcardFront = document.getElementById('flashcard-front');
    const flashcardBack = document.getElementById('flashcard-back');
    const questionContent = document.getElementById('question-content');
    const answerContent = document.getElementById('answer-content');
    const prevCardButton = document.getElementById('prev-card');
    const notSureButton = document.getElementById('not-sure');
    const gotItButton = document.getElementById('got-it');

    function showCard(index) {
      flashcard.classList.remove('is-flipped');
      questionContent.innerHTML = cards[index].question;
      answerContent.innerHTML = cards[index].answer;
    }

    flashcard.addEventListener('click', () => {
      flashcard.classList.toggle('is-flipped');
    });

    prevCardButton.addEventListener('click', () => {
      if (currentCardIndex > 0) {
        currentCardIndex--;
        showCard(currentCardIndex);
      }
    });

    function updateMemorized(memorized) {
      const question = cards[currentCardIndex].question;

      fetch('update_memorized.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `setcode=${encodeURIComponent(setcode)}&question=${encodeURIComponent(question)}&memorized=${memorized}`
      }).then(response => response.json())
        .then(data => {
          if (data.success) {
            cards[currentCardIndex].memorized = memorized;
            if (currentCardIndex < cards.length - 1) {
              currentCardIndex++;
              showCard(currentCardIndex);
            } else {
              showSummaryModal();
            }
          } else {
            alert('Failed to update card.');
          }
        });
    }

    notSureButton.addEventListener('click', () => {
      updateMemorized(0);
    });

    gotItButton.addEventListener('click', () => {
      updateMemorized(1);
    });

    // Calculate total correct and incorrect answers
    function calculateSummary() {
      let totalCorrect = 0;
      let totalIncorrect = 0;
      cards.forEach(card => {
        if (card.memorized === 1) {
          totalCorrect++;
        } else {
          totalIncorrect++;
        }
      });
      return { totalCorrect, totalIncorrect };
    }

    // Display the summary modal
    function showSummaryModal() {
      const { totalCorrect, totalIncorrect } = calculateSummary();
      const totalCorrectElement = document.getElementById('totalCorrect');
      const totalIncorrectElement = document.getElementById('totalIncorrect');
      totalCorrectElement.textContent = totalCorrect;
      totalIncorrectElement.textContent = totalIncorrect;
      const summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
      summaryModal.show();
    }

    // Handle repeat cards action
    document.getElementById('repeatCards').addEventListener('click', () => {
      currentCardIndex = 0;
      showCard(currentCardIndex);
      const summaryModal = bootstrap.Modal.getInstance(document.getElementById('summaryModal'));
      summaryModal.hide();
    });

    // Handle finish session action
    document.getElementById('finishSession').addEventListener('click', () => {
      window.location.href = 'flashset.php?setcode=' + setcode;
    });

    showCard(currentCardIndex);
  }
  if (mode === 'multiple_choice') {
    const setcode = "<?php echo $setcode; ?>";
    let cards = <?php echo $modeContent; ?>;
  const questionContainer = document.getElementById('question-container');
  const answersContainer = document.getElementById('answers-container');
  const nextQuestionButton = document.getElementById('next-question');
  let currentQuestionIndex = 0;
  
  // Function to shuffle array elements
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }

  // Function to display question and answers
  function showQuestionAndAnswers(index) {
    questionContainer.innerHTML = `<div class="flashcard-label">Question</div>${cards[index].question}`;
    
    const answers = [];
    answers.push(cards[index].answer);
    
    // Randomly select 3 incorrect answers from other questions
    const otherAnswers = cards.filter((_, i) => i !== index).map(card => card.answer);
    shuffleArray(otherAnswers);
    answers.push(...otherAnswers.slice(0, 3));

    // Shuffle all answers
    shuffleArray(answers);

    // Display answer options
    answersContainer.innerHTML = answers.map(answer => `<div class="form-check">
      <input class="form-check-input" type="radio" name="answer" value="${answer}">
      <label class="form-check-label">${answer}</label>
    </div>`).join('');
  }

  // Event listener for next question button
  nextQuestionButton.addEventListener('click', () => {
    const selectedAnswer = document.querySelector('input[name="answer"]:checked');
    if (selectedAnswer) {
      const isCorrect = selectedAnswer.value === cards[currentQuestionIndex].answer ? 1 : 0;
      updateMemorized(isCorrect);
    } else {
      // Handle case where no answer is selected
      alert('Please select an answer.');
    }
  });

  function updateMemorized(memorized) {
  cards[currentQuestionIndex].memorized = memorized;
  if (currentQuestionIndex < cards.length - 1) {
    currentQuestionIndex++;
    showQuestionAndAnswers(currentQuestionIndex);
  } else {
    showSummaryModal();
  }
}
function calculateSummary() {
      let totalCorrect = 0;
      let totalIncorrect = 0;
      cards.forEach(card => {
        if (card.memorized === 1) {
          totalCorrect++;
        } else {
          totalIncorrect++;
        }
      });
      return { totalCorrect, totalIncorrect };
    }
// Display the summary modal
function showSummaryModal() {
      const { totalCorrect, totalIncorrect } = calculateSummary();
      const totalCorrectElement = document.getElementById('totalCorrect');
      const totalIncorrectElement = document.getElementById('totalIncorrect');
      totalCorrectElement.textContent = totalCorrect;
      totalIncorrectElement.textContent = totalIncorrect;
      const summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
      summaryModal.show();
    }

    // Handle repeat cards action
    document.getElementById('repeatCards').addEventListener('click', () => {
    currentQuestionIndex = 0;
    showQuestionAndAnswers(currentQuestionIndex);
      const summaryModal = bootstrap.Modal.getInstance(document.getElementById('summaryModal'));
      summaryModal.hide();
    });

    // Handle finish session action
    document.getElementById('finishSession').addEventListener('click', () => {
      window.location.href = 'flashset.php?setcode=' + setcode;
    });
  showQuestionAndAnswers(currentQuestionIndex);
}
if (mode === 'writing') {
    const setcode = "<?php echo $setcode; ?>";
    let cards = <?php echo $modeContent; ?>;
    let currentQuestionIndex = 0;
    const questionContainer = document.getElementById('question-container');
    const userAnswerInput = document.getElementById('user-answer');
    const submitAnswerButton = document.getElementById('submit-answer');

    function showQuestion(index) {
        questionContainer.innerHTML = `<div class="flashcard-label">Question</div>${cards[index].question}`;
        userAnswerInput.value = ''; // Clear the input field
    }

    showQuestion(currentQuestionIndex);

    submitAnswerButton.addEventListener('click', () => {
        const userAnswer = userAnswerInput.value.trim().toLowerCase();
        const correctAnswer = cards[currentQuestionIndex].answer.toLowerCase();

        if (userAnswer === correctAnswer) {
            updateMemorized(1);
        } else {
            updateMemorized(0);
        }
    });

    function updateMemorized(memorized) {
        cards[currentQuestionIndex].memorized = memorized;
        if (currentQuestionIndex < cards.length - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        } else {
            showSummaryModal();
        }
    }

    // Functions for displaying and handling the summary modal
    function calculateSummary() {
        let totalCorrect = 0;
        let totalIncorrect = 0;
        cards.forEach(card => {
            if (card.memorized === 1) {
                totalCorrect++;
            } else {
                totalIncorrect++;
            }
        });
        return { totalCorrect, totalIncorrect };
    }

    function showSummaryModal() {
        const { totalCorrect, totalIncorrect } = calculateSummary();
        const totalCorrectElement = document.getElementById('totalCorrect');
        const totalIncorrectElement = document.getElementById('totalIncorrect');
        totalCorrectElement.textContent = totalCorrect;
        totalIncorrectElement.textContent = totalIncorrect;
        const summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
        summaryModal.show();
    }

    // Handle repeat cards action
    document.getElementById('repeatCards').addEventListener('click', () => {
        currentQuestionIndex = 0;
        showQuestion(currentQuestionIndex);
        const summaryModal = bootstrap.Modal.getInstance(document.getElementById('summaryModal'));
        summaryModal.hide();
    });

    // Handle finish session action
    document.getElementById('finishSession').addEventListener('click', () => {
        window.location.href = 'flashset.php?setcode=' + setcode;
    });
}
if (mode === 'match_list') {
    const setcode = "<?php echo $setcode; ?>";
    let cards = <?php echo $modeContent; ?>;
    let matchedPairs = 0;
    const questionsList = document.getElementById('questions-list');
    const answersList = document.getElementById('answers-list');
    const messageContainer = document.getElementById('message-container');
    let firstSelection = null;

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function createButton(content, type, index) {
        const button = document.createElement('button');
        button.className = 'list-group-item list-group-item-action';
        button.textContent = content;
        button.dataset.type = type;
        button.dataset.index = index;
        button.addEventListener('click', handleButtonClick);
        return button;
    }

    function populateLists() {
        const questionButtons = cards.map((card, index) => createButton(card.question, 'question', index));
        const answerButtons = cards.map((card, index) => createButton(card.answer, 'answer', index));

        shuffleArray(questionButtons).forEach(button => questionsList.appendChild(button));
        shuffleArray(answerButtons).forEach(button => answersList.appendChild(button));
    }

    function handleButtonClick(event) {
    const button = event.target;
    const index = button.dataset.index;
    const type = button.dataset.type;

    if (!firstSelection) {
        firstSelection = { button, type, index };
        button.classList.add('selected');
    } else {
        if (firstSelection.index !== index && firstSelection.type !== type) {
            const questionIndex = type === 'answer' ? index : firstSelection.index;
            const answerIndex = type === 'question' ? index : firstSelection.index;

            if (cards[questionIndex].answer === cards[answerIndex].answer) {
                // Highlight matched buttons and mark as matched
                const matchedQuestionButton = document.querySelector(`button[data-type="question"][data-index="${questionIndex}"]`);
                const matchedAnswerButton = document.querySelector(`button[data-type="answer"][data-index="${answerIndex}"]`);
                matchedQuestionButton.classList.add('matched');
                matchedAnswerButton.classList.add('matched');
                matchedQuestionButton.classList.remove('selected');
                matchedAnswerButton.classList.remove('selected');
                matchedPairs++;

                // Remove the matched pair from the DOM
                matchedQuestionButton.style.display = 'none';
                matchedAnswerButton.style.display = 'none';

                // Check if all pairs are matched
                if (matchedPairs === cards.length) {
                    showSummaryModal();
                }
            } else {
                firstSelection.button.classList.remove('selected');
                button.classList.add('selected-wrong');
                setTimeout(() => {
                    button.classList.remove('selected-wrong');
                }, 1000);
                showMessage('Wrong pair! Try again.');
            }
            firstSelection = null;
        } else {
            firstSelection.button.classList.remove('selected');
            firstSelection = null;
        }
    }
}



    function showMessage(message) {
        messageContainer.textContent = message;
        setTimeout(() => {
            messageContainer.textContent = '';
        }, 2000);
    }

    function calculateSummary() {
        const totalCorrect = matchedPairs;
        const totalIncorrect = cards.length - matchedPairs;
        return { totalCorrect, totalIncorrect };
    }

    function showSummaryModal() {
        const { totalCorrect, totalIncorrect } = calculateSummary();
        const totalCorrectElement = document.getElementById('totalCorrect');
        const totalIncorrectElement = document.getElementById('totalIncorrect');
        totalCorrectElement.textContent = totalCorrect;
        totalIncorrectElement.textContent = totalIncorrect;
        const summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'));
        summaryModal.show();
    }

    // Handle repeat cards action
    document.getElementById('repeatCards').addEventListener('click', () => {
        matchedPairs = 0;
        firstSelection = null;
        questionsList.innerHTML = '';
        answersList.innerHTML = '';
        populateLists();
        const summaryModal = bootstrap.Modal.getInstance(document.getElementById('summaryModal'));
        summaryModal.hide();
    });

    // Handle finish session action
    document.getElementById('finishSession').addEventListener('click', () => {
        window.location.href = 'flashset.php?setcode=' + setcode;
    });

    populateLists();
}



</script>
</body>
</html>

