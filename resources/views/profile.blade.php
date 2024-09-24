<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <!-- Profile Section -->
    <div class="flex items-center space-x-6">
      <img class="w-24 h-24 rounded-full object-cover" src="https://via.placeholder.com/150" alt="Profile Image">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">John Doe</h2>
        <p class="text-gray-600">Web Developer</p>
      </div>
    </div>

    <!-- About Section -->
    <div class="mt-6">
      <h3 class="text-xl font-semibold text-gray-800">About</h3>
      <p class="text-gray-600 mt-2">
        Passionate web developer with expertise in modern JavaScript frameworks and technologies. I love building creative solutions and delivering value through clean, efficient code.
      </p>
    </div>

    <!-- Contact Information -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <h4 class="text-lg font-semibold text-gray-800">Contact Information</h4>
        <ul class="mt-2 text-gray-600">
          <li><strong>Email:</strong> john.doe@example.com</li>
          <li><strong>Phone:</strong> +1 234 567 890</li>
          <li><strong>Location:</strong> New York, USA</li>
        </ul>
      </div>

      <!-- Social Links -->
      <div>
        <h4 class="text-lg font-semibold text-gray-800">Social Profiles</h4>
        <div class="flex space-x-4 mt-2">
          <a href="#" class="text-blue-500 hover:text-blue-700">
            <i class="fab fa-facebook-f"></i> Facebook
          </a>
          <a href="#" class="text-blue-400 hover:text-blue-600">
            <i class="fab fa-twitter"></i> Twitter
          </a>
          <a href="#" class="text-blue-700 hover:text-blue-900">
            <i class="fab fa-linkedin"></i> LinkedIn
          </a>
          <a href="#" class="text-gray-800 hover:text-black">
            <i class="fab fa-github"></i> GitHub
          </a>
        </div>
      </div>
    </div>

    <!-- Skills Section -->
    <div class="mt-6">
      <h3 class="text-xl font-semibold text-gray-800">Skills</h3>
      <div class="mt-2 space-x-2">
        <span class="inline-block bg-blue-500 text-white px-3 py-1 rounded-full text-sm">JavaScript</span>
        <span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm">React</span>
        <span class="inline-block bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">Node.js</span>
        <span class="inline-block bg-purple-500 text-white px-3 py-1 rounded-full text-sm">Tailwind CSS</span>
      </div>
    </div>
  </div>

</body>
</html>
