<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            background-color:rgb(228, 86, 173);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .title {
            font-size: 24px;
            font-weight: 600;
        }

        .top-bar .actions {
            display: flex;
            gap: 15px;
        }

        .top-bar a,
        .top-bar button {
            background-color:rgb(236, 112, 189);
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .top-bar a:hover,
        .top-bar button:hover {
            background-color:rgb(236, 112, 189);
            transform: scale(1.05);
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgb(236, 112, 189);
        }

        h1 {
            font-size: 32px;
            color:rgb(236, 112, 189);
            margin-bottom: 30px;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .stat-box {
            flex: 1;
            background-color: #f3f4f6;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin: 0 10px;
            box-shadow: 0 2px 6px rgb(236, 112, 189);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: default;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-box h2 {
            font-size: 24px;
            margin: 0;
            color:rgb(236, 112, 189);
        }

        .stat-box p {
            font-size: 16px;
            color:pink  ;
            margin-top: 8px;
        }

        .buttons {
            text-align: center;
        }

        .buttons a {
            background-color:rgb(236, 158, 210);
            color: white;
            padding: 14px 30px;
            margin: 0 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s, transform 0.2s;
        }

        .buttons a:hover {
            background-color: #1d4ed8;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
                gap: 20px;
            }

            .stat-box {
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <div class="title">Ashlley's Booking Dashboard</div>
        <div class="actions">
            <a href="{{ route('profile.edit') }}"> Edit Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>Welcome, {{ auth()->user()->name }}</h1>

        <div class="stats">
            <div class="stat-box">
                <h2>{{ $totalBookings }}</h2>
                <p>Total Bookings</p>
            </div>
            <div class="stat-box">
                <h2>{{ $totalUsers }}</h2>
                <p>Total Users</p>
            </div>
        </div>

        <div class="buttons">
            <a href="{{ route('bookings.index') }}">View Bookings</a>
            <a href="{{ route('bookings.create') }}">Create Booking</a>
        </div>
    </div>

</body>
</html>
