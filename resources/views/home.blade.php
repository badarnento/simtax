<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Welcome to Home Page</h2>
    <button onclick="logout()">Logout</button>

    <script>
        function logout() {
            fetch("/api/logout", {
                method: "POST",
                headers: {
                    "Authorization": "Bearer " + document.cookie.split('=')[1]
                }
            })
            .then(() => {
                document.cookie = "token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                window.location.href = "/login";
            })
            .catch(error => console.error("Logout error:", error));
        }
    </script>
</body>
</html>
