document.addEventListener("DOMContentLoaded", function () {
  const cityInput = document.getElementById("search");
  const submitButton = document.getElementById("submit");

  submitButton.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form submission

    const city = cityInput.value.trim(); // Get the city input value

    if (city !== "") {
      // Make a Fetch request to your server
      fetch("index.php?city=" + city)
        .then(function (response) {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then(function (data) {
          // Store data in local storage
          localStorage.setItem("weatherData", JSON.stringify(data));

          // Update the UI
          updateUI(data);
        })
        .catch(function (error) {
          console.error("Error fetching data from server:", error);
        });
    } else {
      console.error("City input is empty.");
    }
  });

  function updateUI(data) {
    // Update UI with fetched data
    const cityElement = document.querySelector(".city");
    const tempElement = document.querySelector(".temp");
    const desElement = document.querySelector(".des");
    const dateElement = document.querySelector(".date");

    cityElement.textContent = "City: " + data.city;
    tempElement.textContent = "Temperature: " + data.temp + "C";
    desElement.textContent = "Description: " + data.weather_type;
    dateElement.textContent = "Date: " + data.weather_when;
  }

  // Check if there is data stored in local storage on page load
  const storedData = localStorage.getItem("weatherData");
  if (storedData) {
    const parsedData = JSON.parse(storedData);
    updateUI(parsedData);
  }

  submitButton.addEventListener("click", () => {
    cityInput.value = "";
  });
  submitButton.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      cityInput.value = "";
    }
  });
});
