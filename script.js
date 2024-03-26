const temperature = document.getElementById("temp");
// const windSpeed = document.querySelector(".speed");
// const pressureClass = document.querySelector(".pressure");
const cityName = document.getElementById("cityName");
const buttonSearch = document.querySelector(".button");
const searchInput = document.getElementById("search");
// const weatherIcon = document.querySelector("img");
const API_KEY = "52fa4270c6cde90aae1224c3f5746413";
const Api_URL = "https://api.openweathermap.org/data/2.5/weather?q=";

async function getWeatherApi(city) {
  try {
    date = new Date();
    const response = await fetch(
      Api_URL + city + `&appid=${API_KEY}&units=metric`
    );
    const data = await response.json();
    console.log(data);
    window.location.href =
      "data-save.php?city=" +
      data.name +
      "&temp=" +
      data.main.temp +
      "&weather_type=" +
      data.weather[0].main +
      "&weather_when=" +
      date;
  } catch (error) {
    console.error(error);
  }
}

buttonSearch.addEventListener("click", () => {
  getWeatherApi(searchInput.value);
  searchInput.value = "";
});
searchInput.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
    getWeatherApi(searchInput.value);
    searchInput.value = "";
  }
});
