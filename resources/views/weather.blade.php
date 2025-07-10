<!DOCTYPE html>
<html>
<head>
    <title>Cuaca Kota Besar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    <style>
       body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg,rgb(157, 83, 241),rgb(240, 241, 247));
            text-align: center;
            padding: 40px;
        }
        .weather-box { background: white; padding: 20px; border-radius: 15px; display: inline-block; margin-top: 20px; }
        select, button { padding: 10px; font-size: 16px; margin: 10px; }
    </style>
</head>
<body>

    <h1>Pilih Kota Besar Dunia</h1>

    <form method="GET" action="/weather">
        <select name="city_id">
            <option value="">-- Pilih Kota --</option>
            @foreach ($cities as $city)
                <option value="{{ $city['id'] }}" {{ isset($selectedCityName) && $selectedCityName == $city['name'] ? 'selected' : '' }}>
                    {{ $city['name'] }} ({{ $city['country'] }})
                </option>
            @endforeach
        </select>
        <button type="submit">Cek Cuaca</button>
    </form>

    @if($weather)
        @php
            $iconCode = $weather['weather'][0]['icon'] ?? '01d';
            $iconMap = [
                '01d' => 'wi-day-sunny',
                '01n' => 'wi-night-clear',
                '02d' => 'wi-day-cloudy',
                '02n' => 'wi-night-alt-cloudy',
                '03d' => 'wi-cloud',
                '03n' => 'wi-cloud',
                '04d' => 'wi-cloudy',
                '04n' => 'wi-cloudy',
                '09d' => 'wi-showers',
                '09n' => 'wi-showers',
                '10d' => 'wi-day-rain',
                '10n' => 'wi-night-alt-rain',
                '11d' => 'wi-thunderstorm',
                '11n' => 'wi-thunderstorm',
                '13d' => 'wi-snow',
                '13n' => 'wi-snow',
                '50d' => 'wi-fog',
                '50n' => 'wi-fog',
            ];
            $iconClass = $iconMap[$iconCode] ?? 'wi-day-sunny';
        @endphp

        <div class="weather-box">
            <h2>{{ $selectedCityName }}</h2>
            <i class="wi {{ $iconClass }}" style="font-size: 60px;"></i>
            <p><strong>Suhu:</strong> {{ $weather['main']['temp'] }}°C</p>
            <p><strong>Kondisi:</strong> {{ ucfirst($weather['weather'][0]['description']) }}</p>
            <p><strong>Kelembapan:</strong> {{ $weather['main']['humidity'] }}%</p>
            <p><strong>Angin:</strong> {{ $weather['wind']['speed'] }} m/s</p>
        </div>
    @endif

</body>
</html>
