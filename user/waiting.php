<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Page Not Found</title>
    <style>
      body {
        background-color: #e5f6ff;
        font-family: Arial, sans-serif;
      }

      .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 90vh;
        text-align: center;
      }

      .logo {
        font-size: 140px;
        margin-bottom: 10px;
        font-weight: bold;
        color: #0e0c0c;
        margin-bottom: -65px;
        margin-top: 0;
        letter-spacing: 20px;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
          "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      .image {
        max-width: 600px;
        width: 80%;
        margin-bottom: -20px;
      }

      .quote {
        font-size: 28px;
        color: #555;
        margin-bottom: 0;
        font-family: "Times New Roman", Times, serif;
      }

      .description {
        font-size: 18px;
        color: #777;
        margin-bottom: 30px;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
      }

      .back-button {
        background-color: #346426;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
      }

      .back-button:hover {
        background-color: #46b424;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="logo mt-1">Welcome !</h1>
      <img
        class="image"
        src="https://i.ibb.co/RbCLyJq/Bus-Stop.gif"
        alt="404 Error Image"
      />
      <p class="quote">"You are on the waiting list"</p>
      <p class="description">a few time jus to admin accept you.</p>
      <button class="back-button" onclick="history.back()"">Go Back</button>
    </div>
  
  </body>
</html>
