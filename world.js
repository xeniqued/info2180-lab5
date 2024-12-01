document.addEventListener("DOMContentLoaded", function () {
    // Get the "Lookup" button and search input by ID
    const lookupButton = document.getElementById("lookup-country");
    const countryInput = document.getElementById("country");

    // Add click event listener to the button
    lookupButton.addEventListener("click", function () {
        // Get the value from the input field
        const country = countryInput.value.trim();

        // Construct the fetch URL with the query parameter
        const url = `http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(country)}`;

        // Fetch data from the server 
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); 
            })
            .then(data => {
                // Display the fetched data in the div with ID "result"
                const resultContainer = document.getElementById("result");
                resultContainer.innerHTML = data; 
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                // Display an error message in the result div
                const resultContainer = document.getElementById("result");
                resultContainer.innerHTML = `<p style="color:red;">Failed to fetch data. Please try again later.</p>`;
            });
    });
});

