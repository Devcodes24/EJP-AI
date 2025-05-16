<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoJourney</title>
</head>
<body>

    <h1>Welcome to EcoJourney</h1>
    <h2>AI-Powered Environmental Insights</h2>
    @if(isset($chatHistory) && !empty($chatHistory))
        

        @foreach($chatHistory as $entry)
            <div style="margin-bottom: 20px;">
                <p><strong>You:</strong> {{ $entry['question'] }}</p>
                <p><strong>EJP:</strong> {{  $entry['answer'] }}</p>
            </div>
        @endforeach
    @endif
    
    


    <form method="post" action="/ai2" id="chatForm">
        @csrf
        <label for="input">Ask your query here:</label><br>
        <textarea id="prompt" name="question" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Send" >
    </form>
    <div id="bottom"></div>
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