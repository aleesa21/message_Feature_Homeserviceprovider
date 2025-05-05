
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sidebar</title>
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
  left: 0;  /* Ensures sidebar stays on the left */
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
      text-align: left;
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
    }

    .sidebar ul li:hover {
      background-color: #575757;
      cursor: pointer;
    }

    /* Add active class to highlight current page */
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
    <h2><span>{{ Auth::user()->name }}</span></h2>
    <ul>
      <li><i class="fas fa-user"></i> <a href="{{ route('pdash', ['id' => Auth::user()->id]) }}">Profile</a></li>
      <li class="active" ><i class="fas fa-edit"></i> <a href="{{ route('provider.profile.edit', ['id' => Auth::user()->id]) }}">Edit Profile</a></li>
      <li ><i class="fas fa-star"></i> <a href="{{ route('provider.reviews', ['id' => $provider->id]) }}">Reviews</a></li>
      <li ><i class="fas fa-home"></i> <a href="{{ route('provider.home') }}">Home</a></li>
      <li><i class="fas fa-clipboard-list"></i> <a href="{{ route('provider.requests.index') }}">Service Requests</a></li>

      <!-- <li><i class="fas fa-exclamation-circle"></i> <a href="#">Complain</a></li> -->

    </ul>
  </div>

  <div class="content">
    <!-- Your content here -->
  </div>

</body>
</html>
