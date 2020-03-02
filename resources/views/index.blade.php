<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>ClickTI Informática</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

    <link rel="stylesheet" href="/css/app.css">


</head>
<body>
    <div id="app">
        <app></app>
    </div>
    
    <script src="js/app.js"></script>
    <script src="js/0.1-commons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="/js/highlight/jquery.highlight.js"></script>


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries 
    -->
    <script src="https://www.gstatic.com/firebasejs/7.9.3/firebase-firestore.js"></script>

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyB3d8IM889bnq5U44G9RYMrmvzT9WSai_Q",
            authDomain: "firestoreclickti.firebaseapp.com",
            databaseURL: "https://firestoreclickti.firebaseio.com",
            projectId: "firestoreclickti",
            storageBucket: "firestoreclickti.appspot.com",
            messagingSenderId: "794095953996",
            appId: "1:794095953996:web:682cbb1f023e714908ace9"
        };
        
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>

    
</body>
</html>