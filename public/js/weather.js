const getWeather = async function () {
    let response = await fetch('http://api.openweathermap.org/data/2.5/weather?q=Antibes&appid=19a10dbe8d3801419c4aa0e8190bd70a&lang=fr&units=metric')
    let data = await response.json();
    console.log(data);
    document.getElementById('city').textContent = data.name;
    document.getElementById('temp').textContent = data.main.temp;
    document.getElementById('conditions').textContent = data.weather[0].description;
    document.getElementById('antibesWeather').style.display = "block";
}
document.getElementById('weatherButton').addEventListener('click', getWeather);