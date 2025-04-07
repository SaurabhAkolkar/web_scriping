<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Race Entry Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: #f4f4f4;
    }

    form {
      background-color: white;
      padding: 2rem;
      max-width: 1000px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-top: 1rem;
    }

    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.25rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .button-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 1.5rem;
    }

    button {
      width: auto;
      padding: 0.75rem 1.5rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <form method="POST" action="/australia">
    @csrf
    <h2>Race Form</h2>

    <label for="center_url">Center URL:</label>
    <input type="text" id="center_url" name="center_url" required>

    <label for="race_no">Race No:</label>
    <input type="text" id="race_no" name="race_no" required>

    <!-- Right-aligned button container -->
    <div class="button-container">
      <button type="submit">Submit</button>
    </div>
  </form>

</body>
</html>
