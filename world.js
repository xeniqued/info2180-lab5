document.addEventListener("DOMContentLoaded", function () {
    // Get the "Lookup" button and search input by ID
    const lookupCountryButton = document.getElementById("lookup-country");
    const lookupCitiesButton = document.getElementById("lookup-cities");
    const countryInput = document.getElementById("country");
    const resultContainer = document.getElementById("result");

    // Function to fetch and display results
    function fetchResults(lookupType) {
        const country = countryInput.value.trim();
        const url = `http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(country)}&lookup=${encodeURIComponent(lookupType)}`;
        
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                resultContainer.innerHTML = data; // Display fetched data
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                resultContainer.innerHTML = `<p style="color:red;">Failed to fetch data. Please try again later.</p>`;
            });
    }

    
    lookupCountryButton.addEventListener("click", function () {
        fetchResults("country");
    });

    
    lookupCitiesButton.addEventListener("click", function () {
        fetchResults("cities");
    });
});

