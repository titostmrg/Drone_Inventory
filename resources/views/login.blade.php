<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drone Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container-fluid login-container d-flex">
        <div class="col-md-5 d-none d-md-block p-0">
            <img src="..\assets\bg-login.jpg" alt="Drone" class="login-image">
        </div>
        <div class="col-md-6 d-flex justify-content-start align-items-center">
            <div class="login-form ms-auto me-5 text-center">
            @if ($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif
                <!-- Logo -->
                <img src="../assets/logoptpn4.png" alt="Company Logo" class="mb-4" style="max-width: 325px;">
                
                <!-- Title -->
                <h2 class="login-title">Drone Inventory</h2>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="name" class="form-control" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
