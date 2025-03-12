<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form id="loginForm">
        <label>Email:</label>
        <input type="email" id="email" required><br>

        <label>Password:</label>
        <input type="password" id="password" required><br>

        <button type="submit">Login</button>
    </form>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function (e) {
            e.preventDefault();

            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;

            fetch("/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    console.log(data.token);
                    document.cookie = "token=" + data.token + "; path=/; SameSite=Lax";
                    window.location.href = "/home";
                } else {
                    alert("Login failed");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    </script>
</body>
</html>
