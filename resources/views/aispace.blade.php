<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Journey Planner</title>
    <style>
        body {
            font-family: 'Merriweather', serif; /* Elegant serif font for a travel theme */
            margin: 0;
            background: linear-gradient(135deg, #f0f8ff, #faebd7); /* Soft, inviting background gradient */
            color: #4a5568; /* Sophisticated dark gray */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            min-height: 100vh;
            box-sizing: border-box;
        }

        h1 {
            color: #2c3e50; /* Deep, professional blue */
            font-size: 3.2em;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #718096; /* Muted gray-blue */
            font-size: 1.8em;
            font-weight: 400;
            text-align: center;
            margin-bottom: 30px;
        }

        #chat-history-container {
            width: 85%;
            max-width: 700px;
            margin-bottom: 35px;
            overflow-y: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08); /* More pronounced shadow */
            border: 1px solid #e2e8f0;
        }

        .chat-bubble {
            margin-bottom: 25px;
            padding: 18px 24px;
            border-radius: 30px;
            clear: both;
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s ease-in-out;
        }

        .chat-bubble:hover {
            transform: translateY(-3px);
        }

        /* Style for user messages (assuming they appear first in the div) */
        #chat-history-container > div:nth-child(odd) {
            background-color: #f7fafc; /* Very light blue for user */
            color: #2d3748;
            float: right;
            border-bottom-right-radius: 8px;
        }

        /* Style for EJP messages (assuming they appear second in the div) */
        #chat-history-container > div:nth-child(even) {
            background-color: #edf2f7; /* Light gray for EJP */
            color: #285e61; /* Teal for EJP */
            float: left;
            border-bottom-left-radius: 8px;
        }

        .chat-bubble strong {
            font-weight: 600;
            color: #1a202c; /* Darker gray for emphasis */
        }

        #chatForm {
            width: 85%;
            max-width: 700px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
            display: block;
            font-size: 1.1em;
        }

        textarea {
            padding: 18px;
            border: 1px solid #cbd5e0;
            border-radius: 10px;
            resize: vertical;
            font-size: 1em;
            color: #2d3748;
            line-height: 1.7;
            box-sizing: border-box;
            transition: border-color 0.2s ease-in-out;
        }

        textarea:focus {
            outline: none;
            border-color: #4299e1; /* Focus blue */
            box-shadow: 0 1px 5px rgba(66, 153, 225, 0.3);
        }

        input[type="submit"] {
            background-color: #4299e1; /* Professional blue */
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 500;
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0 3px 7px rgba(66, 153, 225, 0.2);
        }

        input[type="submit"]:hover {
            background-color: #3182ce; /* Darker blue on hover */
            box-shadow: 0 5px 10px rgba(66, 153, 225, 0.3);
        }

        input[type="submit"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        #bottom {
            height: 1px;
        }
    </style>
</head>
<body>

    <h1>Welcome to EJP AI</h1>
    <h2>AI-Powered Trip Insights🏖️</h2>
    @if(isset($chatHistory) && !empty($chatHistory))
        <div id="chat-history-container">
            @foreach($chatHistory as $entry)
                <div class="chat-bubble">
                    <p><strong>You:</strong> {{ $entry['question'] }}</p>
                    <p><strong>EJP:</strong> {{  $entry['answer'] }}</p>
                </div>
            @endforeach
            <div id="bottom"></div>
        </div>
    @endif

    <form method="post" action="/ai2" id="chatForm">
        @csrf
        <label for="prompt">Plan your trip here:</label><br>
        <textarea id="prompt" name="question" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Send" >
    </form>

    <script>
        document.getElementById('prompt').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault(); // prevent newline
            document.getElementById('chatForm').submit();
        }
    });


    window.onload = function() {
        document.getElementById('bottom').scrollIntoView({ behavior: 'smooth' });
    };
</script>
</body>
</html>
