<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Booking</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color:rgb(221, 173, 203);
      margin: 0;
      padding: 0;
    }

    .top-bar {
      background-color:rgb(243, 125, 198);
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-bar .title {
      font-size: 20px;
      font-weight: 600;
    }

    .top-bar .actions a {
      background-color:rgb(228, 86, 173);
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      transition: background-color 0.3s, transform 0.2s;
    }

    .top-bar .actions a:hover {
      background-color:rgb(228, 86, 173);
      transform: scale(1.05);
    }

    .container {
      max-width: 700px;
      margin: 40px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgb(228, 86, 173);
    }

    h2 {
      text-align: center;
      color:rgba(211, 38, 139, 0.99);
      font-size: 28px;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-top: 20px;
      font-weight: 600;
      color:rgba(211, 38, 139, 0.99);
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 14px;
      margin-top: 8px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f9fafb;
    }

    textarea {
      resize: vertical;
    }

    button {
      margin-top: 30px;
      width: 100%;
      background-color:rgb(228, 86, 173);
      color: white;
      border: none;
      padding: 14px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    button:hover {
      background-color:rgb(224, 20, 105);
      transform: translateY(-2px);
    }

    .error {
      color: #dc2626;
      background: #fef2f2;
      border: 1px solid #fecaca;
      padding: 12px;
      border-radius: 6px;
      margin-top: 15px;
    }

    #calendar-container {
      margin-top: 15px;
      display: flex;
      justify-content: center;
    }

    #selected-date {
      margin-top: 15px;
      font-weight: 600;
      color:rgb(226, 131, 187);
      text-align: center;
    }

    /* === CALENDAR CUSTOM STYLING === */
    .flatpickr-calendar {
      font-size: 14px !important;
      width: 100% !important;
      max-width: 500px;
      border-radius: 12px;
      background-color: #000 !important;
      color: white;
      box-shadow: 0 0 10px rgba(243, 117, 191, 0.99);
    }

    .flatpickr-months {
      background-color: #111 !important;
      color: white !important;
      border-bottom: 1px solid #333;
    }

    .flatpickr-current-month {
      color: white !important;
      font-size: 16px !important;
    }

    .flatpickr-weekdays {
      background-color: #111 !important;
    }

    .flatpickr-weekday {
      color: white !important;
      font-weight: 600;
    }

    .flatpickr-day {
      color: white !important;
      border: 1px solid #333;
      width: 40px;
      height: 40px;
      line-height: 40px;
      margin: 2px;
    }

    .flatpickr-day:hover {
      background-color: rgba(243, 117, 191, 0.99) !important;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
      background-color:rgb(240, 159, 236) !important;
      color: white !important;
      border-color:rgb(122, 239, 68) !important;
    }

    .flatpickr-day.booked {
      background-color: red !important;
      color: white !important;
      border-color: red !important;
    }

    .flatpickr-monthDropdown-months,
    .flatpickr-current-month .numInputWrapper,
    .flatpickr-current-month input.cur-year {
      background-color: #000 !important;
      color: white !important;
      border: 1px solid #333 !important;
    }

    .flatpickr-monthDropdown-months option,
    .numInput.cur-year {
      background-color: #pink !important;
      color: white !important;
    }

    .flatpickr-prev-month svg,
    .flatpickr-next-month svg {
      fill: white !important;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div class="title">Create Booking</div>
  <div class="actions">
    <a href="{{ route('dashboard') }}">🔙 Back to Dashboard</a>
  </div>
</div>

<div class="container">
  <h2>➕ Create New Booking</h2>

  @if ($errors->any())
    <div class="error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" required>

    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>

    <label for="booking_date">Booking Date</label>
    <input type="text" id="booking_date" name="booking_date" required style="position: absolute; left: -9999px;">
    <div id="calendar-container"></div>
    <p id="selected-date"></p>

    <button type="submit">✅Book Now</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  const bookedDates = @json($bookedDates ?? []);

  function formatDateToPH(dateObj) {
    const phOffset = 8 * 60;
    const localTime = dateObj.getTime();
    const localOffset = dateObj.getTimezoneOffset();
    const phTime = new Date(localTime + (phOffset + localOffset) * 60000);

    const year = phTime.getFullYear();
    const month = String(phTime.getMonth() + 1).padStart(2, '0');
    const day = String(phTime.getDate()).padStart(2, '0');

    return `${year}-${month}-${day}`;
  }

  flatpickr("#booking_date", {
    inline: true,
    appendTo: document.getElementById('calendar-container'),
    dateFormat: "Y-m-d",
    minDate: "today",
    disable: bookedDates,
    onChange: function (selectedDates, dateStr) {
      document.getElementById('selected-date').innerText = "📅 Selected Date: " + dateStr;
    },
    onDayCreate: function(dObj, dStr, fp, dayElem) {
      const formatted = formatDateToPH(dayElem.dateObj);
      if (bookedDates.includes(formatted)) {
        dayElem.classList.add('booked');
      }
    }
  });
</script>

</body>
</html>
