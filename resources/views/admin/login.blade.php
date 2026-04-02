<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Wanderlust Guides</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #0B1426; min-height: 100vh; display: flex; justify-content: center; align-items: center; color: #333; }
        .login-box { background: white; padding: 40px; border-radius: 16px; width: 100%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .brand { text-align: center; margin-bottom: 30px; color: #0B1426; font-size: 24px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
        .form-control:focus { border-color: #2EC4B6; }
        .btn { display: block; width: 100%; padding: 12px; background: #2EC4B6; color: white; border: none; border-radius: 8px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        .btn:hover { background: #25a89c; }
        .alert { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="brand">
            <i class="fa-solid fa-mountain-sun" style="color: #FF6B6B;"></i> Wanderlust Admin
        </div>
        
        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        <form action="{{ url('admin/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', 'admin@wanderlust.com') }}" required autofocus>
            </div>
            
            <div class="form-group" style="margin-bottom: 30px;">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="password" required>
            </div>
            
            <button type="submit" class="btn">Login to Dashboard</button>
        </form>
    </div>
</body>
</html>
