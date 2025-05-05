<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      background-color: #f4f4f4;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #1e1e2f;
      color: white;
      padding-top: 20px;
      position: fixed;
      left: 0;
      top: 0;
      transition: width 0.3s ease;
    }

    .sidebar h2 {
      text-align: center;
      font-size: 20px;
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      flex: 1;
      display: block;
    }

    .sidebar ul li:hover {
      background-color: #575757;
      cursor: pointer;
    }

    /* Active link styling */
    .sidebar ul li.active {
      background-color: #007bff;
    }

    .sidebar ul li i {
      font-size: 18px;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>{{ Auth::user()->name }}</h2>
    <ul>
    <li><i class="fas fa-home"></i> <a href="{{ route('adash') }}">Home</a></li>
      <li><i class="fas fa-users"></i> <a href="{{ route('adashpprofile') }}">Providers</a></li>
      <li><i class="fas fa-user"></i> <a href="{{ route('auserpprofile') }}">Users</a></li>
    </ul>
  </div>

  <script>
    // Get current page path
    const currentPath = window.location.pathname;

    // Select all sidebar links
    const menuItems = document.querySelectorAll(".sidebar ul li a");

    menuItems.forEach(item => {
      if (currentPath === new URL(item.href).pathname) {
        item.parentElement.classList.add("active"); // Add "active" class to <li>
      }
    });
  </script>

</body>
</html>
