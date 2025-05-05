<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profileupdate.css') }}">
</head>

<body>

    <div class="container">
        <h2>Update Your Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Service Type Section -->
            <div class="form-group">
                <label for="service-type">Service Type</label>
                <div id="service-type-container">
                    <div class="service-input">
                        <input type="text" name="service-type[]" value="{{ old('service-type.0') }}" placeholder="Enter service type">
                    </div>
                </div>
                <button type="button" id="add-service">Add More</button>
                <span class="text-danger">
                    @error('service-type')
                    {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- Profile Photo Section -->
            <div class="form-group">
                <label for="photo">Profile Photo</label>
                <input type="file" id="photo" class="form-control" name="photo">
                <span class="text-danger">
                    @error('photo')
                    {{ $message }}
                    @enderror
                </span>
            </div>

            <!-- Submit Button -->
            <button type="submit">Update Profile</button>
        </form>
    </div>

    <!-- JavaScript for dynamic service type input -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('add-service').addEventListener('click', function () {
                let container = document.getElementById('service-type-container');
                let div = document.createElement('div');
                div.classList.add('service-input');
                div.innerHTML = `
                    <input type="text" name="service-type[]" placeholder="Enter service type">
                    <button type="button" class="remove-service">Remove</button>
                `;
                container.appendChild(div);
            });

            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-service')) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>

</body>

</html>
